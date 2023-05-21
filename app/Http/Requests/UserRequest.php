<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 'min:3'
            ],
            'email' => [
                'required', 'email', Rule::unique((new User)->getTable())->ignore($this->route()->user->id ?? null)
            ],
            'password' => [
                $this->route()->user ? 'nullable' : 'required', 'confirmed', 'min:6'
            ],
            'phone' => ['required', 'string', 'min:10', 'max:15', 'regex:^([+][9][1]|[9][1]|[0]){0,1}([7-9]{1})([0-9]{9})$', 'unique:users'],
            'accountType' => ['required', 'in:normal,validator'],
            'proofType' => ['required', 'in:adhaar,voter_id,driving_licsence'],
            'proofId' => ['required', 'string', 'min:6', 'max:25'],
            'address' => ['string'],
        ];
    }
}
