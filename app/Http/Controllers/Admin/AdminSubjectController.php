<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubjectMaster;
use App\Services\AdminActivityService;
use App\Services\PortalSettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminSubjectController extends Controller
{
    public function index()
    {
        return view('admin.subjects.index', [
            'subjects' => SubjectMaster::query()
                ->orderBy('branch')
                ->orderBy('semester')
                ->orderBy('subject_code')
                ->paginate(40),
        ]);
    }

    public function create(PortalSettingsService $settings)
    {
        return view('admin.subjects.form', [
            'subject' => new SubjectMaster(),
            'branches' => $settings->branches(),
        ]);
    }

    public function store(
        Request $request,
        PortalSettingsService $settings,
        AdminActivityService $log
    ) {
        $validated = $this->validated($request, $settings);
        $this->assertIdentityAvailable($validated);

        $subject = SubjectMaster::create($validated);
        Cache::forget('portal.home.counts');
        $log->log('subject_created', 'subject_master', $subject->id, $validated);

        return redirect()->route('admin.subjects.index')
            ->with('status', 'Master Subject added.');
    }

    public function edit(SubjectMaster $subject, PortalSettingsService $settings)
    {
        return view('admin.subjects.form', [
            'subject' => $subject,
            'branches' => $settings->branches(),
        ]);
    }

    public function update(
        Request $request,
        SubjectMaster $subject,
        PortalSettingsService $settings,
        AdminActivityService $log
    ) {
        $validated = $this->validated($request, $settings);
        $this->assertIdentityAvailable($validated, $subject->id);

        $subject->update($validated);
        Cache::forget('portal.home.counts');
        $log->log('subject_updated', 'subject_master', $subject->id, $validated);

        return redirect()->route('admin.subjects.index')
            ->with('status', 'Master Subject updated.');
    }

    public function destroy(SubjectMaster $subject, AdminActivityService $log)
    {
        $id = $subject->id;
        $subject->delete();
        Cache::forget('portal.home.counts');
        $log->log('subject_deleted', 'subject_master', $id);

        return back()->with('status', 'Master Subject deleted.');
    }

    private function validated(Request $request, PortalSettingsService $settings): array
    {
        return $request->validate([
            'paper_code' => ['required', 'string', 'max:30'],
            'subject_code' => ['required', 'string', 'max:30'],
            'paper_name' => ['required', 'string', 'max:255'],
            'subject_name' => ['required', 'string', 'max:255'],
            'semester' => ['required', Rule::in(['I', 'II', 'III', 'IV', 'V', 'VI'])],
            'branch' => ['required', Rule::in($settings->branches())],
        ]);
    }

    private function assertIdentityAvailable(array $data, ?int $ignoreId = null): void
    {
        $query = SubjectMaster::query()
            ->where('branch', $data['branch'])
            ->where('semester', $data['semester'])
            ->where('paper_code', $data['paper_code'])
            ->where('subject_code', $data['subject_code']);

        if ($ignoreId !== null) {
            $query->whereKeyNot($ignoreId);
        }

        if ($query->exists()) {
            throw ValidationException::withMessages([
                'subject_code' => 'This Branch + Semester + Paper Code + Subject Code identity already exists.',
            ]);
        }
    }
}
