<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AccountRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        return $user->accounts()->paginate($request->limit == null ? 20 : $request->limit);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        $user = Auth::user();
        $account = $user->accounts()->create([
           "email" => $request->email,
            "token" => $request->token
        ]);
        return $account;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $account = $user->accounts()->where("id","=",$id)->first();
        if($account!= null)
        {
            return $account;
        }
        return response()->json([
            "error" => "404"
        ],404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, $id)
    {
        $user = Auth::user();
        $account = $user->accounts()->where("id","=",$id)->first();
        if($account!= null)
        {
            $account->token = $request->token;
            $account->save();
            return $account;
        }
        return response()->json([
            "error" => "404"
        ],404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $account = $user->accounts()->where("id","=",$id)->first();
        if($account == null)
        {
            return response()->json([
                "error" => "Account not found"
            ]);
        }
        $account->delete();
        return $account;
    }
}
