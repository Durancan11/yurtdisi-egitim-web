<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['title' => 'Londra Dil Okulu - 4 Hafta', 'price' => 45000, 'stock' => 10],
            ['title' => 'Berlin Almanca Kursu - 8 Hafta', 'price' => 32000, 'stock' => 15],
            ['title' => 'New York İşletme Sertifikası', 'price' => 85000, 'stock' => 5],
            ['title' => 'Paris Sanat Eğitimi', 'price' => 55000, 'stock' => 8],
            ['title' => 'Roma Gastronomi Atölyesi', 'price' => 28000, 'stock' => 12],
            ['title' => 'Dublin IT Staj Programı', 'price' => 38000, 'stock' => 20],
            ['title' => 'Toronto Lise Değişim Programı', 'price' => 120000, 'stock' => 3],
            ['title' => 'Barcelona Tasarım Yaz Okulu', 'price' => 25000, 'stock' => 18],
            ['title' => 'Viyana Klasik Müzik Eğitimi', 'price' => 42000, 'stock' => 7],
            ['title' => 'Amsterdam Yazılım Kampı', 'price' => 65000, 'stock' => 10],
            ['title' => 'Tokyo Japonca Hazırlık', 'price' => 50000, 'stock' => 12],
            ['title' => 'Seul K-Pop Dans Akademisi', 'price' => 35000, 'stock' => 25],
            ['title' => 'Sidney İngilizce ve Sörf Programı', 'price' => 48000, 'stock' => 15],
            ['title' => 'Prag Mühendislik Stajı', 'price' => 22000, 'stock' => 30],
            ['title' => 'Zurich Finans Sertifika Programı', 'price' => 95000, 'stock' => 4],
            ['title' => 'Madrid Spor Yönetimi Eğitimi', 'price' => 40000, 'stock' => 10],
            ['title' => 'Lizbon Dijital Göçebe Eğitimi', 'price' => 15000, 'stock' => 50],
            ['title' => 'Oslo Sürdürülebilir Enerji Kursu', 'price' => 58000, 'stock' => 6],
            ['title' => 'Kopenhag Mimarlık Atölyesi', 'price' => 44000, 'stock' => 9],
            ['title' => 'Budapeşte Tıp Hazırlık Programı', 'price' => 30000, 'stock' => 20],
        ];

        foreach ($products as $p) {
    Product::create(array_merge($p, [
        'description' => 'Global Vizyon ile hayallerine bir adım daha yaklaş. Bu program kapsamlı eğitim ve danışmanlık hizmetlerini içerir.',
        'image' => 'products/default.webp',
        'is_active' => true,
    ]));
}
    }
}