<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\AccountService;
use App\Service\FacebookService;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;

class ActionAccountController extends Controller
{
    public function __construct()
    {
        try {
            $this->fb = new FacebookService();
        } catch (FacebookSDKException $e) {
            dd($e);
        }
    }

    public function postToFacebook($id,Request $request)
    {
        $account = AccountService::getAccount($id);
        if($account == null)
        {
            return response()->json([
                "error" => "Account not found"
            ]);
        }
        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $this->fb->get('100030158474908/feed?limit=15', 'EAAK3S2LyLpABAMi4eU9deEDw2mElK9xeDuG473ZBDQhwlynrOC9rzAV6uY2qNCtrjxZClkbfXDgyx1JZB4IasZAllwcofdWD9LDq2xFVcZBRBoOZCJRgTXFLuWNZBE5OKJY4SrlMw6ESJnZCfnEp9tJFlm2ewvQh5ijlYWQiGfPWO4s7PTSkpxKJwxPdtEAAsogPFZBPgB2QxJGul8BeGEIao2pjRvXEJmmGQg5bGdz1nCqJu4tfn2h3m');
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        $feeds = $response->getGraphEdge();
        $data = [];
        foreach ($feeds as $feed)
        {
            $data[] = $feed->getField("message");
        }
        dd($data);


    }
}
