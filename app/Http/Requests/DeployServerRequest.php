<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeployServerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Auth check pehle hi route middleware mein ho chuka hai
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\-_]+$/',
            'memory' => 'required|integer|min:512',
            'cpu' => 'required|integer|min:50',
            'disk' => 'required|integer|min:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'Server name can only contain letters, numbers, and dashes.',
            'memory.min' => 'A minimum of 512MB RAM is required to boot a node.',
        ];
    }
}