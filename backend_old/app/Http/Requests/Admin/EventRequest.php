<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use App\Models\AdminEvent;

class EventRequest extends FormRequest
{
    public function __construct(ValidationFactory $vFactory) {
        $vFactory->extend('duplicate', function($attribute, $value, $parameters) {
            $found = AdminEvent::where('title', $value)->where('cat_id', $parameters[1]);
            if (!empty($parameters[0])) {
                $found = $found->where('id', '<>', $parameters[0]);
            }
            return ($found->count() == 0) ? 'unique:game_event,title' : '';
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
            'event_title' => 'required|duplicate:' . $this->input('id') . "," . $this->input('event_sub_cat')
        ];
    }

    public function message()
    {
        return [
            'event_title.duplicate' => 'Already exist'
        ];
    }
}
