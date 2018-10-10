<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistration extends FormRequest
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
        return [

            'first_name' => 'required|min:3',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|min:5',
            'password' => 'required|min:5'
        ];
    }
}
