@component('mail::message')
    <p style="font-weight: bold">Hello!</p>
    <p>Unfortunately, your app on apps4macs was rejected :(</p>
    @if($additionalInfo)
        <p style="margin-top: 40px">Here's an explanation from the creator:</p>
        <p style="font-style: italic; color: navy">{{ $additionalInfo }}</p>
    @endif
@endcomponent
