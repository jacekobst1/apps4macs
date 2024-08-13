@component('mail::message')
    <p style="font-weight: bold">Hello!</p>
    <p>Just letting you know, that your app on apps4macs was accepted :)</p>
    @if($additionalInfo)
        <p style="margin-top: 40px">Here's an additional message from the creator:</p>
        <p style="font-style: italic; color: navy">{{ $additionalInfo }}</p>
    @endif
@endcomponent
