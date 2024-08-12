@component('mail::message')
    <p style="font-weight: bold">New app submitted!</p>
    <p>Title: {{ $newApp->title }}</p>
    <p>Url: {{ $newApp->url }}</p>
    <p>Paid: {{ $newApp->is_paid ? "true" : "false" }}</p>
    <p>Submitted by: {{ $newApp->user->email }}</p>
    <p>Sentence: {{ $newApp->sentence }}</p>
    <p>Description: {{ $newApp->description }}</p>
    @component('mail::button', ['url' => 'https://apps4macs.com/admin'])
        Go to admin panel
    @endcomponent
@endcomponent
