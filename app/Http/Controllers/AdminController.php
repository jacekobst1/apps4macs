<?php

namespace App\Http\Controllers;

use App\Enums\AppStatus;
use App\Mail\AppAcceptedMail;
use App\Models\App;
use App\Resources\AppResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function getSubmittedAppsList(): Response
    {
        $submittedAppsModels = App::query()
            ->with('user')
            ->where('status', AppStatus::Submitted)
            ->get();

        $submittedApps = AppResource::collect($submittedAppsModels)->toArray();

        return Inertia::render('Admin/SubmittedAppsList', [
            'submittedApps' => $submittedApps,
        ]);
    }

    public function getSubmittedApp(App $app): Response
    {
        return Inertia::render('Admin/SubmittedApp', [
            'submittedApp' => AppResource::from($app),
        ]);
    }

    public function accept(App $app, Request $request): RedirectResponse
    {
        $app->status = AppStatus::Accepted;
        $app->save();

        $additionalInfo = $request->input('additional_info');

        Mail::to($app->user->email)->queue(new AppAcceptedMail($app, $additionalInfo));

        return to_route('admin.submitted-apps-list');
    }

    public function reject(App $app, Request $request): RedirectResponse
    {
        $app->status = AppStatus::Rejected;
        $app->save();

        $additionalInfo = $request->input('additional_info');

        Mail::to($app->user->email)->queue(new AppAcceptedMail($app, $additionalInfo));

        return to_route('admin.submitted-apps-list');
    }
}
