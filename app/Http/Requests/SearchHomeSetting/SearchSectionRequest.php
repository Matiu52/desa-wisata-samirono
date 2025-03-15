<?php

namespace App\Http\Requests\SearchHomeSetting;

use Illuminate\Foundation\Http\FormRequest;

class SearchSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // atau bisa pakai policy jika perlu
    }

    public function rules(): array
    {
        return [
            'q' => 'nullable|string|max:100',
        ];
    }

    public function searchQuery(): string
    {
        return $this->input('q', '');
    }
}