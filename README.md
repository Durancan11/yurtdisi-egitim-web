Global Vizyon - Yurtdışı Eğitim Danışmanlığı Platformu

Bu proje, Kocaeli Üniversitesi Bilişim Sistemleri Mühendisliği Bölümü Web Programlama dersi kapsamında geliştirilmiş; öğrencilerin yurtdışı eğitim paketlerini inceleyebildiği, sanal cüzdan/bakiye yönetimiyle satın alım yapabildiği, yöneticilerin ise tüm sistemi dinamik bir panel üzerinden kontrol edebildiği uçtan uca (end-to-end) bir E-Ticaret ve Otomasyon Sistemidir.

Proje, kurumsal yazılım standartlarına uygun olarak MVC (Model-View-Controller) mimari deseniyle kodlanmış, yerelde ve bulutta çalışabilecek şekilde tasarlanmış ve CI/CD (Sürekli Entegrasyon / Sürekli Dağıtım) süreçleri entegre edilerek canlı ortama alınmıştır.

🛠️ Teknik Mimari ve Teknolojik Altyapı
Backend Framework: PHP 8.x / Laravel 10.x (MVC)
Veritabanı:
Geliştirme: MySQL (phpMyAdmin)
Production: PostgreSQL (Render Cloud Database)
Sunucu / DevOps: Render (PaaS)
Frontend: Blade Template Engine, HTML5, CSS3, JavaScript
CI/CD: GitHub Webhooks ile otomatik deploy
🚀 Öne Çıkan Özellikler
1. Kapalı Devre Finans ve Sipariş Sistemi

Harici ödeme sistemi kullanmadan çalışan sanal cüzdan altyapısı geliştirilmiştir.

Öğrenci bakiye talebi oluşturur
Admin panel üzerinden onay/iptal yapılır
Onaylanan bakiye DB::transaction ile güvenli şekilde hesaba aktarılır
Kullanıcı bakiye ile eğitim paketlerini satın alabilir
2. Role-Based Access Control (Middleware)

Laravel middleware yapısı ile güvenlik katmanı oluşturulmuştur:

auth, admin, checkStatus middleware
Admin paneline yetkisiz erişim engellenir
Pasif kullanıcılar sistem dışı bırakılır
Kullanıcılar yalnızca kendi verilerine erişir
3. Bulut Ortamı Problemleri ve Çözümler

Render ücretsiz plan kısıtlarına karşı geliştirilmiş çözümler:

Ephemeral Storage Fix: /storage:link kopmalarına karşı runtime symbolic link yeniden oluşturma mekanizması
ID Sequence Fix: PostgreSQL auto-increment uyuşmazlıkları için /sayaclari-duzelt endpoint’i
Veri Bütünlüğü: PostgreSQL constraint uyumluluk optimizasyonları
⚙️ Kurulum (Local Setup)
git clone https://github.com/kullaniciadin/global-vizyon.git
cd global-vizyon
Bağımlılıklar
composer install
npm install
npm run build
Environment
cp .env.example .env
php artisan key:generate
Veritabanı
php artisan migrate --seed
Storage Link
php artisan storage:link
Çalıştırma
php artisan serve

Uygulama: http://localhost:8000

📁 Proje Klasör Yapısı
app/Http/Controllers/
├── Admin/
│   ├── BalanceRequestController.php
│   ├── OrderController.php
│   ├── ProductController.php
│   └── UserController.php
├── AdminController.php
├── CartController.php
├── ProfileController.php
├── ShopController.php
└── Controller.php
👨‍💻 Geliştirici

Duran Can Demirezen
Kocaeli Üniversitesi – Bilişim Sistemleri Mühendisliği
