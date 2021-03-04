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

        $url=$this->request->server->all()['HTTP_ORIGIN'];
        $url=$str = preg_replace('#^https?://#', '', $url);
        preg_match('/^([a-z0-9|-]+[a-z0-9]{1,}\.)*[a-z0-9|-]+[a-z0-9]{1,}\.[a-z]{2,}$/',$url, $matches);
        $subdomain=null;
        if (isset($matches[1]))
            $subdomain=rtrim($matches[1], " \t.");
        if ($subdomain && $subdomain!='www') {
            $center=Tenant::where(['url'=>$subdomain])->firstOrFail();
            session(['tenant' => $center]);
        }
    }
}
