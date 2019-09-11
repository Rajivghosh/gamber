<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use App\Models\CompetitionLevelType;

class CompetitionLevelRequest extends FormRequest
{

    public function __construct(ValidationFactory $vFactory) {
        $vFactory->extend('duplicate', function($attribute, $value, $parameters) {
            $found = CompetitionLevelType::where('name', $value)->where('screen_id', $parameters[1]);
            if (!empty($parameters[0])) {
                $found = $found->where('id', '<>', $parameters[0]);
            }
            return ($found->count() == 0) ? 'unique:competition_level_type,name' : '';
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
            'type_name' => 'required|duplicate:' . $this->input('id') . "," . $this->input('screen_id')
        ];
    }
    
    public function message()
    {
        return [
            'type_name.duplicate' => 'Already exist'
        ];
    }
}
