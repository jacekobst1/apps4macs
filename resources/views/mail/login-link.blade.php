@component('mail::message')
    <p style="font-weight: bold">Hello!</p>
    <p>To finish logging in please click the button below:</p>
    @component('mail::button', ['url' => $url])
        Click to login
    @endcomponent
    @component('mail::subcopy')
        <div style=" font-size: 12px;">
            <span>If you're having trouble clicking the "Click to login" button, copy and paste the URL below into your
            web browser:</span>
            <span style="color:dodgerblue">{{ $url }}</span>
        </div>
    @endcomponent
@endcomponent
