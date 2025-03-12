<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TourPackage;
use Illuminate\Support\Str;

class TourPackageSeeder extends Seeder
{
    public function run()
    {
        $tourPackages = [
            ['package_name' => 'Eksplor Bali', 'description' => 'Nikmati keindahan pulau Bali dengan berbagai aktivitas seru dan destinasi wisata yang menakjubkan.', 'duration' => '5 hari', 'price' => 1500000, 'user_id' => 1, 'listItems' => ['Mengunjungi Pantai Kuta', 'Menjelajahi Ubud', 'Menyelam di Tulamben']],
            ['package_name' => 'Wisata Kuliner Yogyakarta', 'description' => 'Rasakan lezatnya kuliner khas Yogyakarta sambil menjelajahi tempat-tempat bersejarah.', 'duration' => '3 hari', 'price' => 1000000, 'user_id' => 1, 'listItems' => ['Mencicipi Gudeg Jogja', 'Mengunjungi Keraton Yogyakarta', 'Belanja di Malioboro']],
            ['package_name' => 'Petualangan di Lombok', 'description' => 'Petualangan menantang di Pulau Lombok dengan panorama alam yang memukau.', 'duration' => '7 hari', 'price' => 2000000, 'user_id' => 1, 'listItems' => ['Mendaki Gunung Rinjani', 'Snorkeling di Gili Trawangan', 'Menjelajahi Desa Sade']],
            ['package_name' => 'Eksplorasi Budaya di Toraja', 'description' => 'Jelajahi kebudayaan unik dan tradisi masyarakat Toraja yang kaya akan sejarah.', 'duration' => '4 hari', 'price' => 1800000, 'user_id' => 1, 'listItems' => ['Mengunjungi Londa', 'Menyaksikan Upacara Rambu Solo', 'Berwisata ke Kete Kesu']],
            ['package_name' => 'Menikmati Keindahan Pulau Komodo', 'description' => 'Lihat komodo di habitat aslinya dan nikmati keindahan alam Pulau Komodo.', 'duration' => '6 hari', 'price' => 2500000, 'user_id' => 1, 'listItems' => ['Trekking di Pulau Komodo', 'Snorkeling di Pink Beach', 'Mengunjungi Pulau Rinca']],
        ];
        foreach ($tourPackages as $package) {
            $tourPackage = TourPackage::create(['package_name' => $package['package_name'], 'description' => $package['description'], 'duration' => $package['duration'], 'price' => $package['price'], 'slug' => $this->createUniqueSlug($package['package_name']), 'user_id' => $package['user_id'],]);
            foreach ($package['listItems'] as $item) {
                $tourPackage->listItems()->create(['name' => $item]);
            }
        }
    }
    private function createUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;
        while (TourPackage::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }
        return $slug;
    }
}