@extends('emails.layout')

@section('title')
    Il tuo invito da {{$invite->center->name}}
@endsection

@section('content')

<div style="text-align: center">
    <img src="{{$invite->center->profile_photo_url}}" width="100" alt="{{$invite->center->name}}" class="sm-w-80" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; border-radius: 9999px">
</div>
<div class="sm-leading-32" style="line-height: 48px">&zwnj;</div>
<table style="width: 100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td class="sm-p-0" style="padding-left: 48px; padding-right: 48px">
            <h1 class="sm-text-40px sm-leading-44" style="font-size: 48px; line-height: 56px; margin: 0; text-align: center; color: #5744cb">
                {{$invite->center->name}} ti ha invitato
            </h1>
        </td>
    </tr>
</table>
<div class="sm-leading-32" style="line-height: 48px">&zwnj;</div>
<p style="font-size: 16px; line-height: 24px; margin: 0; text-align: center; color: #4f5a68">
    Il centro medico {{$invite->center->name}} ti ha invitato ad una sua visita. Per completare la tua iscrizione segui il link qui sotto
</p>
<div class="sm-leading-32" style="line-height: 48px">&zwnj;</div>
<div style="text-align: center">
    <a href="{{$invite->acceptUrl}}" class="sm-block hover-bg-accent-dark" style="background-color: #986dff; border-radius: 4px; display: inline-block; font-weight: 700; line-height: 100%; padding: 16px 48px; text-align: center; color: #ffffff; text-decoration: none">
        <!--[if mso]><i style="letter-spacing: 48px; mso-font-width: -100%; mso-text-raise:30px;">&nbsp;</i><![endif]--><span style="mso-text-raise: 15px">Accetta</span>
        <!--[if mso]><i style="letter-spacing: 48px; mso-font-width: -100%;">&nbsp;</i><![endif]-->
    </a>
</div>

@endsection
