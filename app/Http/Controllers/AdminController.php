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
        $appsModels = App::query()
            ->with('user')
            ->where('status', AppStatus::Submitted)
            ->get();

        $apps = AppResource::collect($appsModels)->toArray();

        return Inertia::render('Admin/SubmittedAppsListPage', [
            'apps' => $apps,
        ]);
    }

    public function getSubmittedApp(App $app): Response
    {
        return Inertia::render('Admin/SubmittedAppPage', [
            'app' => AppResource::from($app),
        ]);
    }

    public function postAccept(App $app, Request $request): RedirectResponse
    {
        $app->status = AppStatus::Accepted;
        $app->verified_at = now();
        $app->save();

        $additionalInfo = $request->input('additional_info');

        Mail::to($app->user->email)->queue(new AppAcceptedMail($app, $additionalInfo));

        return to_route('admin.submitted-apps-list');
    }

    public function postReject(App $app, Request $request): RedirectResponse
    {
        $app->status = AppStatus::Rejected;
        $app->save();

        $additionalInfo = $request->input('additional_info');

        Mail::to($app->user->email)->queue(new AppAcceptedMail($app, $additionalInfo));

        return to_route('admin.submitted-apps-list');
    }
}
