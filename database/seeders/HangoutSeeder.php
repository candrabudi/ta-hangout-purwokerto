<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Hangout;
use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HangoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyHangouts = [
            [
                'name' => 'Kedai Kopi Sore',
                'address' => 'Jl. Jenderal Sudirman No.10, Purwokerto Barat',
                'description' => 'Tempat ngopi santai dengan vibes senja.',
                'location' => 'Purwokerto Barat',
                'categories' => ['cafe', 'romantic']
            ],
            [
                'name' => 'Resto Sambal Dower',
                'address' => 'Jl. HR Bunyamin No.15, Purwokerto Utara',
                'description' => 'Resto khas sambal dengan pilihan lauk lengkap.',
                'location' => 'Purwokerto Utara',
                'categories' => ['restaurant', 'family']
            ],
            [
                'name' => 'Workzone Coworking',
                'address' => 'Jl. Dr. Soeparno No.8, Bancarkembar',
                'description' => 'Coworking modern untuk freelancer dan startup.',
                'location' => 'Purwokerto Timur',
                'categories' => ['coworking', 'cafe']
            ],
            [
                'name' => 'Kopi Alas Rooftop',
                'address' => 'Jl. Overste Isdiman No.5, Purwokerto Selatan',
                'description' => 'Menikmati kopi dari rooftop dengan panorama gunung.',
                'location' => 'Purwokerto Selatan',
                'categories' => ['rooftop', 'instagramable']
            ],
            [
                'name' => 'Taman Bunga Nusantara',
                'address' => 'Jl. Prof. Dr. Suharso, Karanglewas',
                'description' => 'Taman hangout outdoor yang cocok untuk keluarga.',
                'location' => 'Karanglewas',
                'categories' => ['outdoor', 'family', 'park']
            ],
            [
                'name' => 'Sinar Remang Lounge',
                'address' => 'Jl. Komisaris Bambang Suprapto, Berkoh',
                'description' => 'Lounge dengan live music dan suasana cozy.',
                'location' => 'Purwokerto Selatan',
                'categories' => ['bar', 'live-music', 'late-night']
            ],
            [
                'name' => 'Tepi Sawah Café',
                'address' => 'Jl. Gunung Slamet, Kranji',
                'description' => 'Ngopi dengan view hamparan sawah hijau.',
                'location' => 'Purwokerto Barat',
                'categories' => ['cafe', 'outdoor']
            ],
            [
                'name' => 'Burger Gang',
                'address' => 'Jl. Merdeka No.20, Purwokerto Timur',
                'description' => 'Fast food dengan gaya anak muda kekinian.',
                'location' => 'Purwokerto Timur',
                'categories' => ['fast-food', 'gaming-cafe']
            ],
            [
                'name' => 'Rumah Baca Lintas Aksara',
                'address' => 'Jl. Dr. Angka No.9, Purwokerto Tengah',
                'description' => 'Café perpustakaan untuk pecinta literasi.',
                'location' => 'Purwokerto Tengah',
                'categories' => ['book-cafe', 'romantic']
            ],
            [
                'name' => 'Ngopi Pet Friendly',
                'address' => 'Jl. Karangwangkal Raya, Karangwangkal',
                'description' => 'Café terbuka untuk para pecinta hewan.',
                'location' => 'Purwokerto Utara',
                'categories' => ['pet-friendly', 'cafe']
            ],
            [
                'name' => 'Taman Hutan Kota',
                'address' => 'Jl. Gerilya Timur, Kebondalem',
                'description' => 'Taman kota dengan area hangout dan jogging.',
                'location' => 'Purwokerto Selatan',
                'categories' => ['outdoor', 'park', 'instagramable']
            ],
            [
                'name' => 'Hangout Station Purwo',
                'address' => 'Jl. S Parman, Karangpucung',
                'description' => 'Spot nongkrong favorit anak kuliahan.',
                'location' => 'Purwokerto Utara',
                'categories' => ['cafe', 'gaming-cafe']
            ],
            [
                'name' => 'Dapur Vegan Sehat',
                'address' => 'Jl. Soepardjo Rustam, Kalibagor',
                'description' => 'Menu sehat, ramah lingkungan, dan enak.',
                'location' => 'Kalibagor',
                'categories' => ['vegan', 'restaurant']
            ],
            [
                'name' => 'Warkop Bola Mania',
                'address' => 'Jl. Sudagaran, Bancarkembar',
                'description' => 'Warkop dengan layar besar untuk nobar.',
                'location' => 'Purwokerto Timur',
                'categories' => ['sports-bar', 'fast-food']
            ],
            [
                'name' => 'Saung Tradisional Banyumas',
                'address' => 'Jl. Gatot Subroto, Kembaran',
                'description' => 'Nuansa khas Banyumas dengan musik gamelan.',
                'location' => 'Kembaran',
                'categories' => ['cultural', 'restaurant']
            ],
            [
                'name' => 'Rooftalk Coffee & View',
                'address' => 'Jl. Letkol Isdiman, Karanglewas',
                'description' => 'Rooftop vibes dan tempat diskusi kreatif.',
                'location' => 'Karanglewas',
                'categories' => ['rooftop', 'coworking']
            ],
            [
                'name' => 'The Late Spot',
                'address' => 'Jl. Jatisaba, Jatilawang',
                'description' => 'Tempat nongkrong malam paling asyik.',
                'location' => 'Jatilawang',
                'categories' => ['late-night', 'bar']
            ],
            [
                'name' => 'Beach Vibes Mini Café',
                'address' => 'Jl. Sokaraja Timur, Sokaraja',
                'description' => 'Mini café dengan dekor pantai tropis.',
                'location' => 'Sokaraja',
                'categories' => ['beachfront', 'instagramable']
            ],
            [
                'name' => 'Live Tunes Café',
                'address' => 'Jl. GOR Satria, Purwokerto Tengah',
                'description' => 'Café dengan band akustik live tiap malam.',
                'location' => 'Purwokerto Tengah',
                'categories' => ['live-music', 'cafe']
            ],
            [
                'name' => 'Healthy Bowl Spot',
                'address' => 'Jl. A. Yani, Purwokerto Timur',
                'description' => 'Tempat makan sehat dan stylish.',
                'location' => 'Purwokerto Timur',
                'categories' => ['vegan', 'instagramable']
            ],
        ];


        foreach ($dummyHangouts as $data) {
            $location = Location::firstOrCreate(
                ['name' => $data['location']],
                ['latitude' => -7.42, 'longitude' => 109.24]
            );

            $hangout = Hangout::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'address' => $data['address'],
                'description' => $data['description'],
                'status' => 1,
                'google_maps_url' => null,
                'location_id' => $location->id,
                'thumbnail' => 'thumbnails/default.jpg',
                'latitud' => $location->latitude,
                'longtitud' => $location->longitude,
            ]);

            $categoryIds = [];
            foreach ($data['categories'] as $slug) {
                $category = Category::firstOrCreate(
                    ['slug' => $slug],
                    ['name' => Str::title(str_replace('-', ' ', $slug))]
                );
                $categoryIds[] = $category->id;
            }

            $hangout->categories()->sync($categoryIds);
        }
    }
}
