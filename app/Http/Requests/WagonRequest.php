<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WagonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'inw' => 'required|regex:/^\d{8}$/',
            'arrived_at' => 'nullable|date|before:detained_at',
            'detained_at' => 'nullable|date|before:tomorrow',
            'released_at' => 'nullable|date|before:tomorrow',
            'departed_at' => 'nullable|date|before:tomorrow',
            'delivered_at' => 'nullable|date|before:tomorrow',
            'cargo_operation_finished_at' => 'nullable|date|before:tomorrow',
            'removed_at' => 'nullable|date|before:tomorrow',
            'detainer_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'inw.required' => 'Номер вагона не должен быть пустым',
            'inw.regex' => 'Номер вагона должен быть из 8-ми цифр',
        ];
    }
}
