<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class RolesRequest extends FormRequest
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
        $title = Request::input('title')?Request::input('title'):'';


        if($title == null)
        {
            return [
                'title'   => 'required|unique:roles,title,' . $title,
            ];
        }else{
            return [
                //
            ];
        }

    }
}
