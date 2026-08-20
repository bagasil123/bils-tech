<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $imageRules = $this->isMethod('post')
            ? ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072']
            : ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'];

        return [
            'category_id' => ['required', 'exists:categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'image'       => $imageRules,
            'demo_link'   => ['nullable', 'url', 'max:500'],
            'description' => ['nullable', 'string', 'max:3000'],
        ];
    }
}
