@component('mail::message')
    <div style="width: 100%; text-align: center">
        Hi! To finish logging in please click the link below:
    </div>
    @component('mail::button', ['url' => $url])
        Click to login
    @endcomponent
    @component('mail::subcopy')
        <div style="font-size: 11px; color: silver">
            If you did not request this email or are unsure why you received it, please contact the site administrator
            immediately for assistance.
        </div>
    @endcomponent
@endcomponent
