<?php

namespace App\Http\Controllers;

use App\Helpers\DecoCalculator;
use App\Mail\UserInvited;
use App\Models\Dive;
use App\Models\Invite;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Notifications\InviteCreated;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Http;
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;

class TestController extends Controller
{
    public function ploi()
    {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNmY0MmUxYWJhOGM2N2NjN2IyNDEwMmMxMGQwZmQ0MzFmNTBmYzUxNGVjYWYzMjIwYjE5ZmFlMWZkNTBjMTRjZmNhNzEwNzc0ZGU1ZTIyMWIiLCJpYXQiOjE2MTMxMzQ5ODMsIm5iZiI6MTYxMzEzNDk4MywiZXhwIjoxNjc2MjA2OTgzLCJzdWIiOiI2NzA0Iiwic2NvcGVzIjpbInNlcnZlcnMtcmVhZCIsInNlcnZlcnMtY3JlYXRlIiwic2VydmVycy1kZWxldGUiLCJkYXRhYmFzZS1yZWFkIiwiZGF0YWJhc2UtY3JlYXRlIiwiZGF0YWJhc2UtZGVsZXRlIiwiZGFlbW9ucy1yZWFkIiwiZGFlbW9ucy1jcmVhdGUiLCJkYWVtb25zLWRlbGV0ZSIsImNyb25qb2JzLXJlYWQiLCJjcm9uam9icy1jcmVhdGUiLCJjcm9uam9icy1kZWxldGUiLCJuZXR3b3JrLXJ1bGVzLXJlYWQiLCJuZXR3b3JrLXJ1bGVzLWNyZWF0ZSIsIm5ldHdvcmstcnVsZXMtZGVsZXRlIiwic3lzdGVtLXVzZXJzLXJlYWQiLCJzeXN0ZW0tdXNlcnMtY3JlYXRlIiwic3lzdGVtLXVzZXJzLWRlbGV0ZSIsInNzaC1rZXlzLXJlYWQiLCJzc2gta2V5cy1jcmVhdGUiLCJzc2gta2V5cy1kZWxldGUiLCJzaXRlcy1yZWFkIiwic2l0ZXMtY3JlYXRlIiwic2l0ZXMtZGVsZXRlIiwicmVkaXJlY3RzLXJlYWQiLCJyZWRpcmVjdHMtY3JlYXRlIiwicmVkaXJlY3RzLWRlbGV0ZSIsImNlcnRpZmljYXRlcy1yZWFkIiwiY2VydGlmaWNhdGVzLWNyZWF0ZSIsImNlcnRpZmljYXRlcy1kZWxldGUiLCJhdXRoLXVzZXJzLXJlYWQiLCJhdXRoLXVzZXJzLWNyZWF0ZSIsImF1dGgtdXNlcnMtZGVsZXRlIiwiYWxpYXNlcy1yZWFkIiwiYWxpYXNlcy1jcmVhdGUiLCJhbGlhc2VzLWRlbGV0ZSJdfQ.HnSvGl70XWalIk8f6693wZpWW2NXx7bPxBf9mRWyEzpDfVYsjsonkQCC6HKjW_-0TCK2j4ZlQNXSfzdljFBh5u9zMVztTe5Z_H4v7LyknytyiywFkHuePEvrnGmG_GUE7TCcSxVmt_2MrLG6h3zf3aaqZLmMeK_eTJyMBlqf1OL9vOTSDDj2EGJ9_JqMnyu6L7nXFHCLnZt_kUFFG-XIArHOBsjlQ-NW5jTqYWK8XuOGm8g6LjJ4Cm1pTKY3Yoo8KGi4ZGN-2wh5ELghgr-7RYm8N_8bOth5CZtOv46uf7Z1PWKTVnyPxB6BJUrePC7RQg5Vap9aHT64qDBv-DOdWeZGD3ZL5jk3wYiwAV44d9SgJmR98lvuEmIYQfrZGr-INOQWwH8pN_X0JuR_UnGuPSIdxnAwohsztS-I3GMaZ2tkA_NcLc_wEbk7fTMXZc4u4I7o3blah8jex7G9-splHq0pLX4UoJjkTQZW7E7toRPyPlS6vBAN4O-VpuzMKdTy0SkjFLQ8CC95Avhy3GZEu0xUgQ9EflEj2tcoMpVtoyIawghsvqzzXdFqyJFasEcxZ4tJ4CphvaV8pDiP4w5Bcw6ZnFVahLumfejrCOKlD1h4G51lbreMvRR1GHua8DLtEN51xzNXqzW77Mo6lX2r8IvOxe4cQQph60gvwOC1JuE
';
        // Http::withToken($token)
        //   ->post("https://ploi.io/api/servers/13994/sites/40378/aliases",['aliases'=>['test.daneurope.eu']]);

        Http::withToken($token)
            ->delete("https://ploi.io/api/servers/13994/sites/40378/aliases/test.daneurope.eu");
        dd(Http::withToken($token)
            ->get("https://ploi.io/api/servers/13994/sites/40378/aliases")->json());
    }

    public function cloud()
    {
        $token = 'XoHx8O6domK96jrish1EpLmCXPhKHR1vTxqdQAXK';
        $url = 'https://api.cloudflare.com/client/v4/zones/f7c3a622b8a0f158e18bf286b7fd807a/dns_records';
        $email = 'andrea.covelli@gmailcom';
        Http::withToken($token)->withHeaders([
            "X-Auth-Email" => $email,
            "Content-Type" => "application/json"
        ])->post($url, [
            "type" => 'A',
            "name" => 'test',
            "content" => "172.104.226.114",
            "proxied" => true
        ])->body();

        $url2 = "https://api.cloudflare.com/client/v4/zones/f7c3a622b8a0f158e18bf286b7fd807a/dns_records?name=test.danavatar.eu";
        dd(Http::withToken($token)->withHeaders([
            "X-Auth-Email" => $email,
            "Content-Type" => "application/json"
        ])->get($url2)->body());
    }

    public function sendInvite()
    {
        $invite = Invite::find(1);
        if ($invite)
            $invite->notify(new InviteCreated());
        $user = User::find(2);
        $token = '123';
        $user->sendPasswordResetNotification($token);
    }


    public function influx()
    {

        # You can generate a Token from the "Tokens Tab" in the UI
        $token = '2N8qnyK4qyHSfQaZYEoXOdUDkrp9fMx1FPBBnu9VgBREGnRMczw1U2xcNT-aGL4rz7esMjHr10nhTL4Gb6yhZg==';
        $org = 'danrni';
        $bucket = 'AvatarStaging';

        $client = new Client([
            "url" => "http://172.105.76.135:8086",
            "token" => $token,
            "org" => $org,
            "debug" => false,
            "timeout"=>0
        ]);

        $queryApi = $client->createQueryApi();

        $records = $queryApi->query(
            'from(bucket: "AvatarStaging")   |> range(start: 2021-04-07T12:00:00Z, stop: 2021-04-07T13:05:00Z)
 |> filter(fn: (r) => r["_measurement"] == "Ecg") |> filter(fn: (r) => r["user_id"] == "2")');
        foreach ($records[0]->records as $record) {
            $data[]=[
                "x"=>$record->getTime(),
                "y"=>$record->getValue()
            ];
        }
        dd($data[0]);
    }
    public function testGF()
    {
        ini_set('output_buffering', 'off');
        // Turn off PHP output compression
        ini_set('zlib.output_compression', false);

        //Flush (send) the output buffer and turn off output buffering
        while (@ob_end_flush()) ;

        // Implicitly flush the buffer(s)
        ini_set('implicit_flush', true);
        ob_implicit_flush(true);

        // Needed to force browsers to actually display data
        echo str_pad("", 1024, " ");
        echo "<br />";
        $dives=Dive::get();
        foreach ($dives as $dive) {
            $gfCalculator=new DecoCalculator($dive);
            $gfCalculator->calculateGF();
        }
    }
    public function resetDsgRoles () {
        $users=User::get();
        $userRole=Role::where('name','user')->first();
        $adminRole=Role::where('name','admin')->first();
        $team = Team::where('name', 'dsg')->first();
        foreach ($users as $user) {
            if ($user->email=='andrea.covelli@gmail.com')
                $user->syncRoles([$adminRole], $team);
            else
                $user->syncRoles([$userRole], $team);
        }
        dd('fatto');
    }
    public function sort() {

        $dive=Dive::first();
        $reb=$dive->rebData['ppo2s'];


        $collection = collect($reb);

        $sorted = $collection->sortBy('time');
        dump($sorted);
    }
}
