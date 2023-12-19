@component('mail::message')
# Contact Form

<p>From: {{ $contact['name'] }}   {{ $contact['name2'] }}</p>
<p>Phone: {{ $contact['phone'] }}</p>
<p>Email: {{ $contact['email'] }}</p>

{{ $contact['message'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent