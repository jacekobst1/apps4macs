<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\AppStatus;
use App\Http\Requests\PostSubmitAppRequest;
use App\Mail\NewAppSubmittedMail;
use App\Models\App;
use App\Services\Tools\AlertFlasher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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
            return to_route('new-app.choose-plan', ['is_paid' => $request->is_paid]);
        }

        $this->createApp($request);

        $this->deleteTemplateAppIfExists($request);

        AlertFlasher::success(
            "Your app has been submitted successfully! Now it's under review. You will be notified about the result via email."
        );

        return to_route('home');
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    private function createApp(PostSubmitAppRequest $request): void
    {
        /** @var App $app */
        $app = Auth::user()->apps()->make();
        $app->status = AppStatus::Submitted;
        $app->url = $request->url;
        $app->title = $request->title;
        $app->sentence = $request->sentence;
        $app->description = $request->description;
        $app->is_paid = $request->is_paid;
        $app->save();

        $app->addLogo($request->logo);

        $this->sendMailToAdmin($app);
    }

    private function deleteTemplateAppIfExists(PostSubmitAppRequest $request): void
    {
        if ($request->url === Auth::user()->appTemplate?->url) {
            Auth::user()->appTemplate->delete();
        }
    }

    private function sendMailToAdmin(App $app): void
    {
        $adminEmail = Config::get('env.admin_email');

        Mail::to($adminEmail)->queue(new NewAppSubmittedMail($app));
    }
}
