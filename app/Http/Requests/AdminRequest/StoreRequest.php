<?php

namespace App\Http\Requests\AdminRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
                    case 'update':
                        $rule = [
                            'name' => 'required|max:255',
                            'address' => 'required|max:255',
                            'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
                            'username' => 'required|max:255|unique:admins',
                            'password' => 'required|max:255',
                            'email' => 'required|unique:admins'
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
                'name.required' => 'Please do not leave it blank the Name',
                'name.max' => 'Name exceed 255 characters',
                'address.required' => 'Please do not leave it blank the Address',
                'address.max' => 'Address exceed 255 characters',
                'phone.required' => 'Please do not leave it blank the Phone',
                'phone.min' => 'Please do not leave negative numbers',
                'phone.regex' => 'Please fill in the correct phone number format',
                'username.required' => 'Please do not leave it blank the Username',
                'username.max' => 'Username exceed 255 characters',
                'username.unique' => 'Username already exits',
                'email.required' => 'Please do not leave it blank the Email',
                'email.unique' => 'Email already exits',
            ];
    }
}
