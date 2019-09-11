<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use App\Models\AdminVenue;
class VenueRequest extends FormRequest
{
    public function __construct(ValidationFactory $vFactory)
    {
        $vFactory->extend('duplicate', function ($attribute, $value, $parameters) {
            $found = AdminVenue::where('name', $value);
            if (!empty($parameters[0])) {
                $found = $found->where('id', '<>', $parameters[0]);
            }
            return ($found->count() == 0) ? 'unique:venue,name' : '';
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
            'name' => 'required|duplicate:' . $this->input('id')
        ];
    }
    public function messages()
    {
        return [
            'name.duplicate' => 'Already exists'
        ];
    }
}
