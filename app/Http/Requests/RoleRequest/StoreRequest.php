<?php

namespace App\Http\Requests\RoleRequest;

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
                    case 'store':
                        $rule = [
                            'name' => 'required|max:255|unique:roles',
                            'salary' => 'required|min:0',
                            'description' => 'required|max:255'
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
                'name.unique' => 'Name already exist',
                'salary.required' => 'Please do not leave it blank the Salary',
                'salary.min' => 'Please do not leave negative numbers',
                'description.required' => 'Please do not leave it blank the Description',
                'description.max' => 'Description exceed 255 characters',
            ];
    }
}
