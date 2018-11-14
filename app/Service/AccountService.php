<?php

namespace App\Service;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AccountService extends Model
{
    public static function getAccount($id)
    {
        $user = Auth::user();
        $account = $user->accounts()->where("id","=",$id)->first();
        return $account;
    }
}
