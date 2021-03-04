@extends('emails.layout')

@section('title')
    Password Reset
@endsection

@section('content')

    <h1 class="sm-text-32px sm-leading-36" style="font-size: 40px; line-height: 44px; margin: 0; color: #4f5a68">
        Abbiamo ricevuto una richiesta per reimpostare la tua password!!
    </h1>
    <div class="sm-leading-32" style="line-height: 48px">&zwnj;</div>
    <p style="font-size: 16px; line-height: 24px; margin: 0; color: #4f5a68">
        Usa il link qui sotto per impostare la nuova password per il tuo account.
        Se non hai richiesto di reimpostare la tua password, semplicemente ignora questa mail
    </p>
    <div class="sm-leading-32" style="line-height: 48px">&zwnj;</div>
    <a href="{{$url}}" class="sm-block hover-bg-accent-dark" style="background-color: #986dff; border-radius: 4px; display: inline-block; font-weight: 700; line-height: 100%; padding: 16px 48px; text-align: center; color: #ffffff; text-decoration: none">
        <!--[if mso]><i style="letter-spacing: 48px; mso-font-width: -100%; mso-text-raise:30px;">&nbsp;</i><![endif]--><span style="mso-text-raise: 15px">Reimposta la password</span>
        <!--[if mso]><i style="letter-spacing: 48px; mso-font-width: -100%;">&nbsp;</i><![endif]-->
    </a>

@endsection
