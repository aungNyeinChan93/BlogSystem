<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            "title"=>"required",
            "description"=>"required",
            "image"=>"required",
            "writer"=>"required",
        ];
    }
    public function messages(): array
    {
        return [
            //
            "title.required" => "ဖြည့်ဖို့လိုပါတယ်",
            "description.required" => "ဖြည့်ဖို့လိုပါတယ်",
            "writer.required" => "ဖြည့်ဖို့လိုပါတယ်",
            "image.required" => "ဖြည့်ဖို့လိုပါတယ်",
        ];
    }
}
