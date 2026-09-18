<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortalNotification;
use App\Services\AdminActivityService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminNotificationController extends Controller
{
    public function index()
    {
        return view('admin.notifications.index', [
            'notifications' => PortalNotification::latest()->paginate(30),
        ]);
    }

    public function store(Request $request, AdminActivityService $log)
    {
        $validated = $request->validate([
            'audience' => ['required', Rule::in(['all', 'students', 'faculty', 'single'])],
            'recipient' => [
                Rule::requiredIf(fn () => $request->input('audience') === 'single'),
                'nullable',
                'string',
                'max:190',
            ],
            'title' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:1000'],
            'link' => [
                'nullable',
                'string',
                'max:500',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if ($value === null || $value === '') {
                        return;
                    }

                    $link = trim((string) $value);

                    if (str_starts_with($link, '/')) {
                        if (str_starts_with($link, '//') || str_contains($link, '\\')) {
                            $fail('The notice link must be a safe portal path or a valid HTTPS URL.');
                        }

                        return;
                    }

                    if (! filter_var($link, FILTER_VALIDATE_URL) || ! str_starts_with(strtolower($link), 'https://')) {
                        $fail('The notice link must be a safe portal path or a valid HTTPS URL.');
                    }
                },
            ],
        ]);

        $notification = PortalNotification::create($validated + [
            'admin_id' => $request->user()->id,
        ]);

        $log->log('notification_created', 'notification', $notification->id);

        return back()->with('status', 'Notification saved.');
    }
}
