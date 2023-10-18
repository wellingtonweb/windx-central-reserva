@component('mail::message')

<p>Olá, <b>{{ $customer_name }}</b>, você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta da Central do Assinante Windx.</p>

@component('mail::button', ['url' => $url])
    Modificar senha
@endcomponent

<p>Este link de redefinição de senha expirará em 60 minutos.</p>
<p>Se você não solicitou a redefinição de senha, nenhuma ação adicional será necessária.</p>

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
