<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstitutionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitutionHistoryController extends Controller
{
    public function edit()
    {
        $history = InstitutionHistory::firstOrCreate(
            ['id' => 1]
        );

        return view('admin.institution-history.edit', compact('history'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'history' => ['nullable', 'string', 'max:50000'],
            'photo_1' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'photo_2' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $history = InstitutionHistory::firstOrCreate(
            ['id' => 1]
        );

        foreach (['photo_1', 'photo_2'] as $field) {
            unset($data[$field]);

            if ($request->hasFile($field)) {
                $oldPhoto = $history->$field;

                $newPhoto = $request->file($field)
                    ->store('institution-history', 'public');

                $data[$field] = $newPhoto;

                if ($oldPhoto && Storage::disk('public')->exists($oldPhoto)) {
                    Storage::disk('public')->delete($oldPhoto);
                }
            }
        }

        $history->update($data);

        return redirect()
            ->route('admin.institution-history.edit')
            ->with('success', 'Sejarah madrasah berhasil diperbarui.');
    }
}
