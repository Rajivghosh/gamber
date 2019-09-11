<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use App\Models\GameScreen;

class GameRequest extends FormRequest
{
    public function __construct(ValidationFactory $vFactory)
    {
        $vFactory->extend('duplicate', function ($attribute, $value, $parameters) {
            $found = GameScreen::where('game_screen_name', $value);
            if (!empty($parameters[0])) {
                $found = $found->where('id', '<>', $parameters[0]);
            }
            return ($found->count() == 0) ? 'unique:game_screen,game_screen_name' : '';
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
