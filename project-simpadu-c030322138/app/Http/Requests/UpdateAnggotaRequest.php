<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAnggotaRequest extends FormRequest
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
            'nama' => 'required|string|max:80',
            'email' => ['required', 'email', Rule::unique('anggotas')->ignore($this->route('anggotum')), ],
            'usia' => 'numeric',
            'tgl_lahir' => 'string',
            'alamat' => 'string',
            'gender' => 'string',
            'status' => 'string',
        ];
    }
}
