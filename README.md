
<h1 align="center">Andekata</h1>
<p align="center">* version : 1.0.3-beta</p>
<p align="center">* codename : yudistira</p>
<p align="center">* license : MIT</p>

## About

Andekata merupakan aplikasi untuk mengolah informasi data pada sebuah Desa yang dikembangkan dengan tujuan untuk memenuhi beberapa kebutuhan mulai dari mencatat data kependudukan hingga keperluan administrasi surat menyurat. Untuk kedepannya, aplikasi ini akan terus dikembangkan dengan menyesuaikan kebutuhan yang terus bertambah.

## Andekata API 

Andekata API merupakan Backend sistem yang dikembangkan menggunakan framework PHP Laravel. Andekata API ini dikembangkan untuk memenuhi kebutuhan data [Andekata Web Client](https://github.com/ajaroid/andekata-client).

## Requirements

* [Composer v1.5.2](https://getcomposer.org/)
* PHP >= 7.0.0
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* [Redis](https://redis.io/)

## Installation

clone project :

* Dengan https :

```
git clone https://github.com/ajaroid/andekata-api.git
```

* Dengan ssh :

```
git clone git@github.com:ajaroid/andekata-api.git
```

Setelah clone project, install dependensi dengan menjalankan perintah berikut di folder project :

```
composer install
```

Setelah itu, jalankan perintah berikut untuk setup konfigurasi :
```
composer setup
```

_Catatan:_ Setelah menjalankan `composer setup` anda akan melihat output seperti ini di terminal :
```
> @php -r "file_exists('.env') || copy('.env.example', '.env');"
> @php artisan key:generate
Application key [YOUR_APPLICATION_KEY_HERE] set successfully.
> Illuminate\Foundation\ComposerScripts::postAutoloadDump
> @php artisan package:discover
Discovered Package: fideloper/proxy
Discovered Package: laravel/tinker
Discovered Package: caffeinated/modules
Discovered Package: tymon/jwt-auth
Package manifest generated successfully.
> @php artisan jwt:secret -f
jwt-auth secret [YOUR_JWT_SECRET_HERE] set successfully.
> @php artisan module:optimize
Generating optimized module cache
```

## Setup `.env`

Setelah itu, anda bisa atur konfigurasi database di file `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=YOUR_DB_USERNAME
DB_PASSWORD=YOUR_DB_PASSWORD
```

Ganti QUEUE_DRIVER menjadi `redis`
```
QUEUE_DRIVER=redis
```

Ganti CACHE_DRIVER menjadi `redis`
```
CACHE_DRIVER=redis
```

Jalankan perintah berikut untuk setup folder untuk storage (folder untuk penyimpanan file, media, logs, dll)

```
php artisan storage:link
```

### Database Migration

Perintah untuk migration dibedakan menjadi 2 :

* Jika pertama kali, jalankan perintah berikut

```
composer new-migration-seed
```

* Jika sudah pernah menjalankan perintah diatas, maka gunakan perintah berikut :

```
composer reset-migration-seed
```

mengecek sistem di lokal :
  1. `sudo locale-gen id_ID.UTF-8`
  2. `sudo dpkg-reconfigure locales`


## Menjalankan Server

Untuk menjalankan server, jalankan perintah `php artisan serve`

Jalankan worker untuk queue `php artisan queue:work --tries=3 --sleep=3 `

Setelah menjalankan perintah tersebut, anda bisa mencoba mengakses `http://localhost:8000`, dan anda akan melihat output seperti berikut :
```json
{
    "name": "SIMDES-API",
    "version": "1.0.0",
    "created": "Sat, 21 oct 2017",
    "author": {
        "team": "ajaro.id",
        "contact": "mail@ajaro.id"
    }
}
```

## How To Use / Testing

### User Testing
Anda bisa mencoba mengakses sistem dengan menggunakan akun yg sudah tersedia secara default :

- `[superadmin]` : superadmin@ajaro.id | superadminsuperadmin
- `[admin]` : admin@ajaro.id | adminadmin
- `[petugas]` : petugas@ajaro.id | petugaspetugas

### Postman Collections

 1. Import postman collections file di folder `collections` ke dalam postman
 2. Buat environment dan tambahkan variable berikut :

    a. `BASE_API_URL` untuk url api, misalnya `http://localhost:8000`

    b. `JWT` untuk token api `Bearer yourtokenheregengs`

## Built With

* [Laravel](https://laravel.com/) - The web framework used
* [PostgreSQL](https://www.postgresql.org/) - Database
* [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth) - JWT Auth
* [caffeinated/modules](https://github.com/caffeinated/modules) - Separate Application out into modules
* [laravel-dompdf](https://github.com/barryvdh/laravel-dompdf) - PDF Renderer

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://gitlab.com/ajaro-id/simdes/simdes-api/tags).

## Authors

* **Andhika Yuana** - *@andhikayuana* - [Facebook](https://www.facebook.com/yuana.andhika)
* **Arif Yeri Pratama** - *@pirey*
* **Shinta Saptarini** - *@shintasapta*
* **Syahroni** - *@syahrn*

