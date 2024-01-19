<?php

namespace App\Http\Requests\CancellationPolicyRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rule = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'update':
                        $rule = [
                            'title' => 'required|max:255',
                            'content' => 'required|max:255'
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
                'title.required' => 'Please do not leave it blank the Name',
                'title.max' => 'Name exceed 255 characters',
                'title.unique' => 'Name already exist',
                'content.required' => 'Please do not leave it blank the Description',
                'content.max' => 'Description exceed 255 characters',
            ];
    }
}
