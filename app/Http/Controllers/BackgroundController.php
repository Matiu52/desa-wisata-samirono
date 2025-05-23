<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BackgroundSetting;
use Illuminate\Support\Facades\DB;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;
use Illuminate\Support\Facades\Log;

class BackgroundController extends Controller
{
    // Folder khusus di Cloudinary
    const CLOUDINARY_FOLDER = 'desa_wisata_samirono/background_image';

    public function __construct()
    {
        // Setup konfigurasi Cloudinary
        Configuration::instance([
            'cloud' => [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret' => config('cloudinary.api_secret')
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'background_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        DB::beginTransaction();

        try {
            $current = BackgroundSetting::first();

            // Hapus gambar lama dari Cloudinary jika ada
            if ($current && $current->image_path && str_contains($current->image_path, 'cloudinary')) {
                $publicId = $this->extractPublicId($current->image_path);
                if ($publicId) {
                    $this->deleteCloudinaryImage($publicId);
                }
                $current->delete();
            }

            // Upload gambar baru ke folder khusus
            $uploader = new UploadApi();
            $uploadResult = $uploader->upload(
                $request->file('background_image')->getRealPath(),
                [
                    'folder' => self::CLOUDINARY_FOLDER,
                    'resource_type' => 'image',
                    'transformation' => [
                        'width' => 1920,
                        'height' => 1080,
                        'crop' => 'fill',
                        'quality' => 'auto'
                    ],
                    'public_id' => 'bg_' . time() // Nama unik untuk file
                ]
            );

            // Simpan ke database
            BackgroundSetting::create([
                'image_path' => "cloudinary|{$uploadResult['secure_url']}|{$uploadResult['public_id']}"
            ]);

            DB::commit();

            return back()->with('success', 'Background berhasil diperbarui!');
        } catch (\Exception $e) {
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

            if ($setting->image_path && str_contains($setting->image_path, 'cloudinary')) {
                $publicId = $this->extractPublicId($setting->image_path);
                if ($publicId) {
                    $this->deleteCloudinaryImage($publicId);
                }
            }

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

    private function extractPublicId($path)
    {
        $parts = explode('|', $path);
        return $parts[2] ?? null;
    }

    private function deleteCloudinaryImage($publicId)
    {
        try {
            $uploader = new UploadApi();
            $uploader->destroy($publicId, [
                'resource_type' => 'image',
                'invalidate' => true // Hapus dari cache CDN
            ]);
        } catch (\Exception $e) {
            Log::error("Gagal menghapus gambar Cloudinary: " . $e->getMessage());
        }
    }
}
