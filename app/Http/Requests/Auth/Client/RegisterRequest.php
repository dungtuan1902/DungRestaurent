<?php

namespace App\Http\Requests\Auth\Client;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rule = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'register':
                        $rule = [
                            'firstname' => 'required|min:1',
                            'lastname' => 'required|min:1',
                            'password' => 'required|min:6|max:12',
                            'confirm_password' => 'required|same:password|min:6',
                            'email' => 'required|unique:user|unique:admins'
                        ];
                        break;
                    default:
                        # code...
                        break;
                }
                break;

            default:
                # code...
                break;
        }
        return $rule;
    }
    public function messages()
    {
        return
            [
                'firstname.required' => 'Please do not leave it blank the FirstName',
                'firstname.min' => 'Minimum 1 characters',
                'lastname.required' => 'Please do not leave it blank the LastName',
                'lastname.min' => 'Minimum 1 characters',
                'email.required' => 'Please do not leave it blank the Email',
                'email.unique' => 'Email already exits',
                'password.required' => 'Please do not leave it blank the Password',
                'password.min' => 'Minimum 6 characters',
                'password.max' => 'Maximum 12 characters',
                'confirm_password.required' => 'Please do not leave it blank the Confirm Password',
                'confirm_password.same' => 'Fill in the correct password',
                'confirm_password.min' => 'Minimum 6 characters'
            ];
    }
}
