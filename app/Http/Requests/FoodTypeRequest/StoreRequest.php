<?php

namespace App\Http\Requests\FoodTypeRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        $rule = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'store':
                        $rule = [
                            'name' => 'required|max:255',
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
            ];
    }
}
