@component('mail::message')

<p>Olá, <b>{{ explode(' ', $customer_name)[0] }}</b>, você solicitou a redefinição da senha de acesso à Central do Assinante Windx.</p>

@component('mail::button', ['url' => $url])
    Modificar senha
@endcomponent

<p>Este link de redefinição de senha expirará em 15 minutos.</p>
<p>Se você não solicitou a redefinição de senha, nenhuma ação adicional será necessária.</p>

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
