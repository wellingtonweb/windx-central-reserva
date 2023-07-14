@component('mail::message')

{{ $data['body'] }}

<b>{{ $data['billetNumber'] }}<br>
{{ $data['pay'] }}<br>
{{ $data['value'] }}</b>

@component('mail::button', ['url' => getenv('WHATSAPP_FINANCIAL')])
Dúvidas?
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
