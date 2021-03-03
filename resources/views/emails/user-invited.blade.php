<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <!--[if mso]>
    <xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml>
    <style>
        td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
    </style>
    <![endif]-->
    <title>Il tuo invito da {{$invite->center->name}}</title>
    <style>
        .hover-bg-accent-dark:hover {
            background-color: #5744cb !important;
        }

        .hover-no-underline:hover {
            text-decoration: none !important;
        }

        @media (max-width: 600px) {
            .sm-block {
                display: block !important;
            }

            .sm-text-40px {
                font-size: 40px !important;
            }

            .sm-leading-16 {
                line-height: 16px !important;
            }

            .sm-leading-32 {
                line-height: 32px !important;
            }

            .sm-leading-44 {
                line-height: 44px !important;
            }

            .sm-leading-64 {
                line-height: 64px !important;
            }

            .sm-p-0 {
                padding: 0 !important;
            }

            .sm-p-24 {
                padding: 24px !important;
            }

            .sm-w-80 {
                width: 80px !important;
            }

            .sm-w-full {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased; background-color: #f2f2f7">
<div style="display: none">Your invitation from Smiles Davis&#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &zwnj;
    &#160;&#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &zwnj;
    &#160;&#847; &#847; &#847; &#847; &#847; </div>
<div role="article" aria-roledescription="email" aria-label="Your invitation from Smiles Davis" lang="en">
    <table style="font-family: Arial, sans-serif; width: 100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center" style="background-color: #f2f2f7" bgcolor="#f2f2f7">
                <table class="sm-w-full" style="width: 600px" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="sm-p-24" style="padding: 48px 20px">
                            <table style="width: 100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                    <td>
                                        <div style="text-align: center">
                                            <a href="https://example.com" style="text-decoration: none">
                                                <img src="https://storage.danavatar.eu:9000/staging/logos/dan_avatar.png" width="200" alt="Logo" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle">
                                            </a>
                                        </div>
                                        <div class="sm-leading-64" style="line-height: 120px">&zwnj;</div>
                                        <div style="text-align: center">
                                            <img src="{{$invite->center->profile_photo_url}}" width="100" alt="Smiles Davis" class="sm-w-80" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; border-radius: 9999px">
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
                                        <div style="line-height: 64px">&zwnj;</div>
                                        <div style="background-color: #d4d5d6; height: 1px; line-height: 1px">&nbsp;</div>
                                        <div class="sm-leading-16" style="line-height: 32px">&zwnj;</div>
                                        <p style="font-size: 14px; line-height: 20px; margin: 0; color: #a0a6b0">If you did not sign up for this account you can ignore this email and the account will be deleted.</p>
                                        <div class="sm-leading-16" style="line-height: 32px">&zwnj;</div>
                                        <p style="font-size: 14px; line-height: 20px; margin: 0; color: #a0a6b0">
                                            &copy; {{date('Y')}} DAN Europe R&I srl. All rights reserved.
                                        </p>
                                        <div class="sm-leading-32" style="line-height: 48px">&zwnj;</div>
                                        <p style="font-size: 14px; line-height: 20px; margin: 0; text-align: center">
                                            <a href="https://example.com" class="hover-no-underline" style="color: #986dff; text-decoration: underline">View this email in the browser</a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>

</html>
