# 🌐 Global Vizyon - Yurtdışı Eğitim Danışmanlığı Platformu

Global Vizyon, Kocaeli Üniversitesi Bilişim Sistemleri Mühendisliği Web Programlama kapsamında geliştirilmiş, uçtan uca bir **yurtdışı eğitim danışmanlığı ve e-ticaret platformudur**.

Sistem, öğrencilerin yurtdışı eğitim paketlerini inceleyip satın alabildiği, sanal cüzdan sistemi ile ödeme yapabildiği ve yöneticilerin tüm süreci merkezi bir admin panel üzerinden yönetebildiği tam kapsamlı bir web uygulamasıdır.

---

## 🚀 Proje Özellikleri

- Eğitim paketlerini listeleme ve satın alma
- Sanal cüzdan (bakiye yükleme ve harcama sistemi)
- Sepet ve sipariş yönetimi
- Admin paneli ile ürün, kullanıcı ve sipariş kontrolü
- Rol bazlı erişim kontrolü (Admin / User)
- Otomatik deploy (CI/CD entegrasyonu)
- Bulut uyumlu mimari (Render PaaS)

---

## 🛠️ Kullanılan Teknolojiler

- Backend: PHP 8+, Laravel 10
- Frontend: Blade, HTML5, CSS3, JavaScript
- Veritabanı:
  - MySQL (development)
  - PostgreSQL (production - Render)
- DevOps / Hosting: Render (PaaS)
- Version Control: Git & GitHub
- CI/CD: GitHub Webhooks

---

## 🧠 Mimari Yapı

Proje MVC (Model - View - Controller) mimarisi ile geliştirilmiştir:

- Model: Veritabanı işlemleri
- View: Blade template arayüzleri
- Controller: İş mantığı ve istek yönetimi

---

## 🔐 Güvenlik Özellikleri

- Laravel Middleware tabanlı rol kontrolü
- auth, admin ve checkStatus middleware yapıları
- Kullanıcı bazlı veri izolasyonu
- Transaction tabanlı güvenli bakiye işlemleri

---

## 💰 Sanal Cüzdan Sistemi

- Kullanıcı bakiye yükleme talebi oluşturur
- Admin onaylar veya reddeder
- Onaylanan bakiye DB::transaction ile güvenli şekilde aktarılır
- Kullanıcı bu bakiye ile eğitim paketi satın alabilir

---

## ☁️ Bulut Ortamı Çözümleri

Render ücretsiz plan kısıtlarına karşı geliştirilen çözümler:

- Storage link kopmalarına karşı otomatik yeniden oluşturma (/resimleri-bagla)
- PostgreSQL ID sequence senkronizasyon çözümü (/sayaclari-duzelt)
- Veritabanı constraint uyumluluk optimizasyonları

---

## ⚙️ Kurulum

```bash
git clone https://github.com/kullaniciadin/global-vizyon.git
cd global-vizyon
composer install
npm install
npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```
Uygulama: http://localhost:8000

📁 Proje Yapısı
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
