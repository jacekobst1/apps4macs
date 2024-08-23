<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PutUpdateAppRequest;
use App\Models\App;
use App\Services\Tools\AlertFlasher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

final readonly class MyAppsController
{
    public function getIndex(): Response
    {
        $apps = Auth::user()->apps;

        return Inertia::render('MyApps/MyAppsPage', [
            'apps' => $apps,
        ]);
    }

    public function getEdit(App $app): Response
    {
        return Inertia::render('MyApps/EditMyAppPage', [
            'app' => $app,
        ]);
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function putUpdate(App $app, PutUpdateAppRequest $request): RedirectResponse
    {
        $app->update([
            'title' => $request->title,
            'sentence' => $request->sentence,
            'description' => $request->description,
        ]);

        if ($request->logo) {
            $app->addLogo($request->logo);
        }

        AlertFlasher::success('App updated successfully!');

        return to_route('my-apps.index');
    }

    public function delete(App $app): RedirectResponse
    {
        $app->delete();

        AlertFlasher::success('App deleted successfully!');

        return to_route('my-apps.index');
    }
}
