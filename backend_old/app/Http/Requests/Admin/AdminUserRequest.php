<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use App\Models\User;
class AdminUserRequest extends FormRequest
{
    public function __construct(ValidationFactory $vFactory)
    {
        $vFactory->extend('duplicate', function($attribute, $value, $parameters) {
            $found = User::where('username', $value)->where('email', $parameters[1]);
            if (!empty($parameters[0])) {
                $found = $found->where('id', '<>', $parameters[0]);
            }
            return ($found->count() == 0) ? 'unique:users,username' : '';
        });

        $vFactory->extend('duplicateemail', function($attribute, $value, $parameters) {
            $found = User::where('email', $value)->where('username', $parameters[1]);
            if (!empty($parameters[0])) {
                $found = $found->where('id', '<>', $parameters[0]);
            }
            return ($found->count() == 0) ? 'unique:users,email' : '';
        });
    }  
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
            'username' => 'required|duplicate:' . $this->input('id') . "," . $this->input('email'),
            'email' => 'required|duplicate:' . $this->input('id') . "," . $this->input('username')
        ];
    }
    public function message()
    {
        return [
            'username.duplicate' => 'Already exist',
            'email.duplicateemail' => 'Already exist'
        ];
    }
}
