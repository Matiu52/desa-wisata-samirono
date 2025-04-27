<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BackgroundSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class BackgroundController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'background_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Mulai transaction database
        DB::beginTransaction();

        try {
            // Buat folder jika belum ada
            $uploadPath = public_path('images/uploads');
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Dapatkan data saat ini
            $current = BackgroundSetting::first();

            // Hapus gambar lama dan data terkait jika ada
            if ($current) {
                // Hapus file gambar lama
                if ($current->image_path) {
                    $oldImagePath = public_path($current->image_path);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }

                // Hapus record dari data_settings
                DB::table('background_settings')
                    ->where('id', $current->id)
                    ->delete();

                // Hapus record background setting
                $current->delete();
            }

            // Simpan gambar baru
            $image = $request->file('background_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move($uploadPath, $imageName);

            // Path relatif untuk disimpan di database
            $relativePath = 'images/uploads/' . $imageName;

            // Buat record baru
            $newSetting = BackgroundSetting::create([
                'image_path' => $relativePath
            ]);

            // Commit transaction jika semua berhasil
            DB::commit();

            return back()->with('success', 'Background berhasil diperbarui! Data lama telah dihapus.');
        } catch (\Exception $e) {
            // Rollback transaction jika terjadi error
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui background: ' . $e->getMessage());
        }
    }

    public function removeImage()
    {
        DB::beginTransaction();

        try {
            $setting = BackgroundSetting::first();

            if (!$setting) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada background untuk dihapus'
                ], 404);
            }

            // Hapus file gambar jika ada
            if ($setting->image_path) {
                $imagePath = public_path($setting->image_path);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            // Hapus record dari database
            $setting->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Background berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus background: ' . $e->getMessage()
            ], 500);
        }
    }
}
