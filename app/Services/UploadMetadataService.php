<?php

namespace App\Services;

use App\Models\SubjectMaster;

class UploadMetadataService
{
    public function lookup(array $input): array
    {
        $query = SubjectMaster::query();
        $used = false;

        foreach (['paper_code', 'subject_code', 'branch'] as $field) {
            if (! empty($input[$field])) {
                $query->where($field, trim((string) $input[$field]));
                $used = true;
            }
        }

        foreach (['paper_name', 'subject_name'] as $field) {
            if (! empty($input[$field])) {
                $query->whereRaw('LOWER('.$field.') = ?', [mb_strtolower(trim((string) $input[$field]))]);
                $used = true;
            }
        }

        if (! empty($input['semester'])) {
            $query->where('semester', $this->normalizeSemester((string) $input['semester']));
            $used = true;
        }

        if (! $used) {
            return ['matches' => [], 'unique' => null];
        }

        $matches = $query
            ->limit(20)
            ->get(['paper_code', 'subject_code', 'paper_name', 'subject_name', 'semester', 'branch'])
            ->toArray();

        return [
            'matches' => $matches,
            'unique' => count($matches) === 1 ? $matches[0] : null,
        ];
    }

    public function enrichPaper(array $input): array
    {
        $result = $this->lookup($input);

        if ($result['unique']) {
            foreach ($result['unique'] as $key => $value) {
                if (empty($input[$key])) {
                    $input[$key] = $value;
                }
            }
        }

        if (! empty($input['semester'])) {
            $input['semester'] = $this->normalizeSemester($input['semester']);
        }

        return $input;
    }

    public function normalizeSemester(string $semester): string
    {
        $semester = trim(str_ireplace('Semester', '', $semester));

        return strtoupper($semester);
    }

    public function fingerprintPaper(array $data): ?string
    {
        $keys = [
            'paper_code',
            'subject_code',
            'paper_name',
            'subject_name',
            'branch',
            'semester',
            'year',
            'session',
        ];

        foreach ($keys as $key) {
            if (! isset($data[$key]) || trim((string) $data[$key]) === '') {
                return null;
            }
        }

        return hash('sha256', implode('|', array_map(
            fn (string $key): string => mb_strtolower(trim((string) $data[$key])),
            $keys
        )));
    }

    public function fingerprintNote(array $data, ?string $fileHash = null): string
    {
        $parts = [
            'branch' => $data['branch'] ?? '',
            'semester' => $data['semester'] ?? '',
            'year' => $data['year'] ?? '',
            'subject_name' => $data['subject_name'] ?? '',
            'subject_code' => $data['subject_code'] ?? '',
            'title' => $data['title'] ?? '',
            'description' => $data['description'] ?? '',
        ];

        if ($fileHash !== null && $fileHash !== '') {
            $parts['file_hash'] = $fileHash;
        }

        return hash('sha256', implode('|', array_map(
            static fn ($value): string => mb_strtolower(trim((string) $value)),
            array_values($parts)
        )));
    }
}
