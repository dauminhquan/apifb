<?php

namespace App\Service;

use Facebook\Facebook;
use Illuminate\Database\Eloquent\Model;

class FacebookService extends Facebook
{
    public function __construct(array $config = [])
    {
        $config = [
            'app_id' => '764484363890320',
            'app_secret' => '14414f4af2fccd7af9d582e48b473efb',
            'default_graph_version' => 'v3.2',
            //'default_access_token' => '{access-token}', // optional
        ];
        parent::__construct($config);
    }
}
