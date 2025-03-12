<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeSettingRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan membuat permintaan ini.
     */
    public function authorize(): bool
    {
        // Jika kamu punya sistem otorisasi, bisa diatur di sini.
        return true;
    }

    /**
     * Aturan validasi untuk request.
     */
    public function rules(): array
    {
        return [
            'section' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * Custom pesan error (opsional).
     */
    public function messages(): array
    {
        return [
            'section.required' => 'Bagian (section) wajib diisi.',
            'section.string' => 'Bagian harus berupa teks.',
            'images.*.image' => 'Setiap file harus berupa gambar.',
            'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'images.*.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}