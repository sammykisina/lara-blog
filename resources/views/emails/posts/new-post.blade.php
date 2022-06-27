@component('mail::message')
# {{ $object->title }} added

Thanks for creating a new post on our site.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
