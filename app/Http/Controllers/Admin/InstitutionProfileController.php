<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstitutionProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitutionProfileController extends Controller
{
    public function edit()
    {
        $profile = InstitutionProfile::firstOrCreate(
            ['id' => 1],
            ['name' => 'MA Miftahul Midad']
        );

        return view('admin.institution-profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nsm' => ['nullable', 'string', 'max:50'],
            'npsn' => ['nullable', 'string', 'max:50'],
            'establishment_charter' => ['nullable', 'string', 'max:255'],
            'operational_license' => ['nullable', 'string', 'max:255'],
            'founded_at' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:2000'],
            'village' => ['nullable', 'string', 'max:255'],
            'district' => ['nullable', 'string', 'max:255'],
            'regency' => ['nullable', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'province' => ['nullable', 'string', 'max:255'],
            'accreditation' => ['nullable', 'string', 'max:50'],
            'foundation' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'website' => ['nullable', 'url', 'max:255'],

            'principal_name' => ['nullable', 'string', 'max:255'],
            'principal_period' => ['nullable', 'string', 'max:100'],
            'principal_quote' => ['nullable', 'string', 'max:3000'],
            'principal_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'academic_year' => ['nullable', 'string', 'max:30'],
            'alumni_year' => ['nullable', 'string', 'max:30'],
            'vision' => ['nullable', 'string', 'max:10000'],
            'mission' => ['nullable', 'string', 'max:50000'],

            'class_x_male' => ['required', 'integer', 'min:0'],
            'class_x_female' => ['required', 'integer', 'min:0'],
            'class_xi_male' => ['required', 'integer', 'min:0'],
            'class_xi_female' => ['required', 'integer', 'min:0'],
            'class_xii_male' => ['required', 'integer', 'min:0'],
            'class_xii_female' => ['required', 'integer', 'min:0'],

            'class_x_rombel' => ['required', 'integer', 'min:0'],
            'class_xi_rombel' => ['required', 'integer', 'min:0'],
            'class_xii_rombel' => ['required', 'integer', 'min:0'],

            'alumni_male' => ['required', 'integer', 'min:0'],
            'alumni_female' => ['required', 'integer', 'min:0'],

            'staff_smu' => ['required', 'integer', 'min:0'],
            'staff_d3' => ['required', 'integer', 'min:0'],
            'staff_s1' => ['required', 'integer', 'min:0'],
            'staff_s2' => ['required', 'integer', 'min:0'],
            'staff_s3' => ['required', 'integer', 'min:0'],
        ]);

        $profile = InstitutionProfile::firstOrCreate(
            ['id' => 1],
            ['name' => 'MA Miftahul Midad']
        );

        // Jangan mengubah foto jika admin tidak mengunggah foto baru.
        unset($data['principal_photo']);

        if ($request->hasFile('principal_photo')) {
            $newPhoto = $request->file('principal_photo')
                ->store('institution', 'public');

            $oldPhoto = $profile->principal_photo;

            $data['principal_photo'] = $newPhoto;

            // Simpan data terlebih dahulu sebelum menghapus foto lama.
            $profile->update($data);

            if ($oldPhoto && Storage::disk('public')->exists($oldPhoto)) {
                Storage::disk('public')->delete($oldPhoto);
            }
        } else {
            $profile->update($data);
        }

        return redirect()
            ->route('admin.institution-profile.edit')
            ->with('success', 'Profil lembaga berhasil diperbarui.');
    }
}
