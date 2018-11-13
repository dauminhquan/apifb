<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = $this->getMethod();
        switch ($method)
        {
            case "POST" : return [
                "email" => "required|email",
                "password" => "required|min:6",
                "password_confirm" => "required|same:password"
            ];
            case "PUT"  : return [
                "password" => "required|min:6",
                "password_confirm" => "required|same:password"
            ];
        }
        return [

        ];
    }
}
