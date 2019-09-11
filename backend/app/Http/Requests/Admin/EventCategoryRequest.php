<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Factory as ValidationFactory;
use App\Models\EventCategoryModel;

class EventCategoryRequest extends FormRequest
{
    public function __construct(ValidationFactory $vFactory) {
        $vFactory->extend('duplicate', function($attribute, $value, $parameters) {
            $found = EventCategoryModel::where('name', $value)->where('screen_id', $parameters[1])->where('level_id', $parameters[2]);
            if (!empty($parameters[0])) {
                $found = $found->where('id', '<>', $parameters[0]);
            }
            return ($found->count() == 0) ? 'unique:event_category,name' : '';
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
            'cat_name' => 'required|duplicate:' . $this->input('id') . "," . $this->input('screen_id') . "," . $this->input('level_screen_id')
        ];
    }

    public function message()
    {
        return [
            'cat_name.duplicate' => 'Already exist'
        ];
    }
}
