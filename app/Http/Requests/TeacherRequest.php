<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Authorize
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        $photoRule = $this->isMethod('post')
            ? 'required'
            : 'nullable';

        return [

            'photo' => [
                $photoRule,
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'position' => [
                'required',
                'string',
                'max:255',
            ],

            'subject' => [
                'required',
                'string',
                'max:255',
            ],

            'education' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'sort_order' => [
                'required',
                'integer',
                'min:1',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

        ];
    }

    /**
     * Custom Messages
     */
    public function messages(): array
    {
        return [

            'photo.required' => 'Foto guru wajib diupload.',

            'photo.image' => 'File harus berupa gambar.',

            'photo.mimes' => 'Format gambar harus JPG, JPEG, PNG atau WEBP.',

            'photo.max' => 'Ukuran gambar maksimal 2 MB.',

            'name.required' => 'Nama guru wajib diisi.',

            'position.required' => 'Jabatan wajib diisi.',

            'subject.required' => 'Mata pelajaran wajib diisi.',

            'education.required' => 'Pendidikan terakhir wajib diisi.',

            'email.email' => 'Format email tidak valid.',

            'sort_order.required' => 'Urutan tampil wajib diisi.',

            'sort_order.integer' => 'Urutan tampil harus berupa angka.',

            'is_active.required' => 'Status wajib dipilih.',

        ];
    }

    /**
     * Attribute Names
     */
    public function attributes(): array
    {
        return [

            'photo' => 'Foto',

            'name' => 'Nama',

            'position' => 'Jabatan',

            'subject' => 'Mata Pelajaran',

            'education' => 'Pendidikan',

            'email' => 'Email',

            'phone' => 'Nomor HP',

            'description' => 'Deskripsi',

            'sort_order' => 'Urutan',

            'is_active' => 'Status',

        ];
    }
}
