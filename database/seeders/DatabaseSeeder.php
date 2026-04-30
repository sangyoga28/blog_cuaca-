<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Admin
        User::create([
            'name' => 'Admin Blog Cuaca',
            'email' => 'admin@blogcuaca.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Create Writers
        $writer1 = User::create([
            'name' => 'Budi Hartono',
            'email' => 'budi@blogcuaca.com',
            'password' => Hash::make('password123'),
            'role' => 'penulis',
        ]);

        $writer2 = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@blogcuaca.com',
            'password' => Hash::make('password123'),
            'role' => 'penulis',
        ]);

        // Create Visitors
        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi@email.com',
            'password' => Hash::make('password123'),
            'role' => 'pengunjung',
        ]);

        User::create([
            'name' => 'Rini Kusuma',
            'email' => 'rini@email.com',
            'password' => Hash::make('password123'),
            'role' => 'pengunjung',
        ]);

        // Create Categories

        $kategoriHujan = Category::create([
            'name' => 'Prakiraan Cuaca',
            'slug' => 'prakiraan-cuaca',
            'description' => 'Prediksi cuaca dan iklim terkini'
        ]);

        $kategoriBerita = Category::create([
            'name' => 'Berita Cuaca',
            'slug' => 'berita-cuaca',
            'description' => 'Berita terbaru tentang cuaca ekstrem'
        ]);

        $kategoriTips = Category::create([
            'name' => 'Tips & Trik',
            'slug' => 'tips-trik',
            'description' => 'Tips dan trik menghadapi cuaca'
        ]);

        $kategoriUmum = Category::create([
            'name' => 'Pengetahuan Umum',
            'slug' => 'pengetahuan-umum',
            'description' => 'Pengetahuan umum tentang meteorologi'
        ]);

        // Create Sample Posts
        Post::create([
            'user_id' => $writer1->id,
            'category_id' => $kategoriHujan->id,
            'title' => 'Gelombang Panas Diprediksi Melanda Indonesia Bulan Depan',
            'slug' => Str::slug('Gelombang Panas Diprediksi Melanda Indonesia Bulan Depan') . '-' . time(),
            'content' => 'Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) memprediksi gelombang panas akan melanda sebagian besar wilayah Indonesia pada bulan depan. Hal ini disebabkan oleh tingginya tekanan udara di atas Benua Asia dan Samudera Pasifik.',
            'status' => 'published',
        ]);

        Post::create([
            'user_id' => $writer2->id,
            'category_id' => $kategoriTips->id,
            'title' => 'Cuaca Ekstrem: Pengenalan dan Cara Menghadapinya',
            'slug' => Str::slug('Cuaca Ekstrem: Pengenalan dan Cara Menghadapinya') . '-' . time(),
            'content' => 'Cuaca ekstrem dapat membawa dampak besar bagi kehidupan manusia. Dalam artikel ini kami akan membahas cara-cara yang dapat dilakukan untuk meminimalkan risiko akibat cuaca ekstrem.',
            'status' => 'published',
        ]);

        Post::create([
            'user_id' => $writer1->id,
            'category_id' => $kategoriUmum->id,
            'title' => 'Apa Itu Musim Hujan dan Bagaimana Dampaknya?',
            'slug' => Str::slug('Apa Itu Musim Hujan dan Bagaimana Dampaknya?') . '-' . time(),
            'content' => 'Musim hujan adalah musim di mana curah hujan tinggi terjadi di suatu wilayah. Musim ini biasanya terjadi pada waktu-waktu tertentu dalam setahun. Artikel ini menjelaskan lebih lanjut tentang musim hujan dan dampaknya.',
            'status' => 'published',
        ]);
    }
}
