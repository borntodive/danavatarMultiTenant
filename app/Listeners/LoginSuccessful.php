<?php

namespace App\Listeners;

use App\Models\Tenant;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class LoginSuccessful
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Login $event)
    {
        dd($this->request);
        preg_match('/^([a-z0-9|-]+[a-z0-9]{1,}\.)*[a-z0-9|-]+[a-z0-9]{1,}\.[a-z]{2,}$/', $_SERVER['SERVER_NAME'], $matches);
        dd($_SERVER['SERVER_NAME']);
        $subdomain=null;
        if (isset($matches[1]))
            $subdomain=rtrim($matches[1], " \t.");
        if ($subdomain) {
            dd($subdomain);
            $center=Tenant::where(['url'=>$subdomain])->firstOrFail();
            session(['tenant_id' => $center->id]);
            session(['tenant_slug' => $center->slug]);
            session(['tenant' => $center]);
        }
    }
}