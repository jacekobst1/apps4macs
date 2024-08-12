<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\AppStatus;
use App\Http\Requests\PostSubmitAppRequest;
use App\Mail\NewAppSubmittedMail;
use App\Models\App;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

final readonly class PostSubmitAppService
{
    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function handle(PostSubmitAppRequest $request): RedirectResponse
    {
        if (!Auth::user()->canCreateApp($request->is_paid)) {
            // return subscription page
        }

        $this->createApp($request);

        $this->deleteTemplateApp($request);

        return to_route('homepage');
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    private function createApp(PostSubmitAppRequest $request): void
    {
        /** @var App $app */
        $app = Auth::user()->apps()->create([
            'status' => AppStatus::Submitted,
            'url' => $request->url,
            'title' => $request->title,
            'sentence' => $request->sentence,
            'description' => $request->description,
            'is_paid' => $request->is_paid,
        ]);

        $app->addLogo($request->logo);

        $this->sendMailToAdmin($app);
    }

    private function deleteTemplateApp(PostSubmitAppRequest $request): void
    {
        if ($request->url === Auth::user()->appTemplate->url) {
            Auth::user()->appTemplate->delete();
        }
    }

    private function sendMailToAdmin(App $app): void
    {
        Mail::to(config('env.admin_email'))->queue(new NewAppSubmittedMail($app));
    }
}
