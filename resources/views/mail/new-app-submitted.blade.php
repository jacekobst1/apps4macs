@component('mail::message')
    <p style="font-weight: bold">New app submitted!</p>
    <p>Name: {{ $newApp->name }}</p>
    <p>Url: {{ $newApp->url }}</p>
    <p>Paid: {{ $newApp->is_paid ? "true" : "false" }}</p>
    @component('mail::button', ['url' => 'http://localhost:8000/admin'])
        Go to admin panel
    @endcomponent
@endcomponent
