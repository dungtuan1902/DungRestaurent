<?php

namespace App\Http\Requests\DrinkRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
                            'name' => 'required|max:255',
                            'price' => 'required|min:0|numeric',
                            'ingredient' => 'required|max:255',
                            'description' => 'required|max:255',
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
                'price.required' => 'Please do not leave it blank the Price',
                'price.min' => 'Please do not let the Price go below 0',
                'price.numeric' => 'Price must be an integer',
                'ingredient.required' => 'Please do not leave it blank the Ingredient',
                'ingredient.max' => 'Ingredient exceed 255 characters',
                'description.required' => 'Please do not leave it blank the Description',
                'description.max' => 'Description exceed 255 characters',
            ];
    }
}
