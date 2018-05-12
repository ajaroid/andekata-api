<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['jwt.auth'])->group(function () {

    /**
     * Provincy
     */
    Route::prefix('provincy')->group(function () {
        Route::get('/', 'ProvincyController@index')->middleware('can:provinsi-index,provinsi');
        Route::get('/{id}', 'ProvincyController@show')->middleware('can:provinsi-show,provinsi');
        Route::post('/', 'ProvincyController@store')->middleware('can:provinsi-store,provinsi');
        Route::put('/{id}', 'ProvincyController@update')->middleware('can:provinsi-update,provinsi');
        Route::delete('/{id}', 'ProvincyController@destroy')->middleware('can:provinsi-destroy,provinsi');
    });

    /**
     * Regency
     */
    Route::prefix('regency')->group(function () {
        Route::get('/', 'RegencyController@index')->middleware('can:kabupaten-index,kabupaten');
        Route::get('/{id}', 'RegencyController@show')->middleware('can:kabupaten-show,kabupaten');
        Route::post('/', 'RegencyController@store')->middleware('can:kabupaten-store,kabupaten');
        Route::put('/{id}', 'RegencyController@update')->middleware('can:kabupaten-update,kabupaten');
        Route::delete('/{id}', 'RegencyController@destroy')->middleware('can:kabupaten-destroy,kabupaten');
    });

    /**
     * Subdistrict
     */
    Route::prefix('subdistrict')->group(function () {
        Route::get('/', 'SubdistrictController@index')->middleware('can:kecamatan-index,kecamatan');
        Route::get('/{id}', 'SubdistrictController@show')->middleware('can:kecamatan-show,kecamatan');
        Route::post('/', 'SubdistrictController@store')->middleware('can:kecamatan-store,kecamatan');
        Route::put('/{id}', 'SubdistrictController@update')->middleware('can:kecamatan-update,kecamatan');
        Route::delete('/{id}', 'SubdistrictController@destroy')->middleware('can:kecamatan-destroy,kecamatan');
    });

    /**
     * Village
     */
    Route::prefix('village')->group(function () {
        Route::get('/', 'VillageController@index')->middleware('can:kelurahan-index,kelurahan');
        Route::get('/{id}', 'VillageController@show')->middleware('can:kelurahan-show,kelurahan');
        Route::post('/', 'VillageController@store')->middleware('can:kelurahan-store,kelurahan');
        Route::put('/{id}', 'VillageController@update')->middleware('can:kelurahan-update,kelurahan');
        Route::delete('/{id}', 'VillageController@destroy')->middleware('can:kelurahan-destroy,kelurahan');
    });

    /**
     * Religion
     */
    Route::prefix('religion')->group(function () {
        Route::get('/', 'ReligionController@index')->middleware('can:agama-index,agama');
        Route::get('/{id}', 'ReligionController@show')->middleware('can:agama-show,agama');
        Route::post('/', 'ReligionController@store')->middleware('can:agama-store,agama');
        Route::put('/{id}', 'ReligionController@update')->middleware('can:agama-update,agama');
        Route::delete('/{id}', 'ReligionController@destroy')->middleware('can:agama-destroy,agama');
    });

    /**
     * Education
     */
    Route::prefix('education')->group(function () {
        Route::get('/', 'EducationController@index')->middleware('can:pendidikan-index,pendidikan');
        Route::get('/{id}', 'EducationController@show')->middleware('can:pendidikan-show,pendidikan');
        Route::post('/', 'EducationController@store')->middleware('can:pendidikan-store,pendidikan');
        Route::put('/{id}', 'EducationController@update')->middleware('can:pendidikan-update,pendidikan');
        Route::delete('/{id}', 'EducationController@destroy')->middleware('can:pendidikan-destroy,pendidikan');
    });

    /**
     * Job
     */
    Route::prefix('job')->group(function () {
        Route::get('/', 'JobController@index')->middleware('can:pekerjaan-index,pekerjaan');
        Route::get('/{id}', 'JobController@show')->middleware('can:pekerjaan-show,pekerjaan');
        Route::post('/', 'JobController@store')->middleware('can:pekerjaan-store,pekerjaan');
        Route::put('/{id}', 'JobController@update')->middleware('can:pekerjaan-update,pekerjaan');
        Route::delete('/{id}', 'JobController@destroy')->middleware('can:pekerjaan-destroy,pekerjaan');
    });

    /**
     * Marital Status
     */
    Route::prefix('marital-status')->group(function () {
        Route::get('/', 'MaritalStatusController@index')->middleware('can:status-kawin-index,status-kawin');
        Route::get('/{id}', 'MaritalStatusController@show')->middleware('can:status-kawin-show,status-kawin');
        Route::post('/', 'MaritalStatusController@store')->middleware('can:status-kawin-store,status-kawin');
        Route::put('/{id}', 'MaritalStatusController@update')->middleware('can:status-kawin-update,status-kawin');
        Route::delete('/{id}', 'MaritalStatusController@destroy')->middleware('can:status-kawin-destroy,status-kawin');
    });

    /**
     * Village Identity
     */
    Route::prefix('village-identity')->group(function () {
        Route::get('/', 'VillageIdentityController@index')->middleware('can:identitas-desa-index,identitas-desa');
        Route::post('/', 'VillageIdentityController@store')->middleware('can:identitas-desa-store,identitas-desa');
        Route::get('/{id}', 'VillageIdentityController@show')->middleware('can:identitas-desa-show,identitas-desa');
        Route::put('/{id}', 'VillageIdentityController@update')->middleware('can:identitas-desa-update,identitas-desa');
        Route::delete('/{id}', 'VillageIdentityController@destroy')->middleware('can:identitas-desa-destroy,identitas-desa');
        Route::post('/upload-logo','VillageIdentityController@upload')->middleware('can:identitas-desa-upload-logo,identitas-desa');
    });

    /**
     * Resident
     */
    Route::prefix('resident')->group(function () {
        Route::get('/', 'ResidentController@index')->middleware('can:penduduk-index,penduduk');
        Route::post('/', 'ResidentController@store')->middleware('can:penduduk-store,penduduk');
        Route::get('/{id}', 'ResidentController@show')->middleware('can:penduduk-show,penduduk');
        Route::put('/{id}', 'ResidentController@update')->middleware('can:penduduk-update,penduduk');
        Route::delete('/{id}', 'ResidentController@destroy')->middleware('can:penduduk-destroy,penduduk');
        Route::post('/import-csv', 'ResidentController@importCsv');
        Route::post('/import-excel', 'ResidentController@importExcel');
    });

    /**
     * Keperluan Surat
     * todo
     */
    Route::prefix('keperluan-surat')->group(function () {
        Route::get('/', 'KeperluanSuratController@index')->middleware('can:keperluan-surat-index,keperluan-surat');
        Route::get('/{id}', 'KeperluanSuratController@show')->middleware('can:keperluan-surat-show,keperluan-surat');
        Route::post('/', 'KeperluanSuratController@store')->middleware('can:keperluan-surat-store,keperluan-surat');
        Route::put('/{id}', 'KeperluanSuratController@update')->middleware('can:keperluan-surat-update,keperluan-surat');
        Route::delete('/{id}', 'KeperluanSuratController@destroy')->middleware('can:keperluan-surat-destroy,keperluan-surat');
    });

    Route::prefix('shk')->group(function () {
        Route::get('/', 'SHKController@index')->middleware('can:shk-index,shk');
        Route::post('/', 'SHKController@store')->middleware('can:shk-store,shk');
        Route::get('/{id}', 'SHKController@show')->middleware('can:shk-show,shk');
        Route::put('/{id}', 'SHKController@update')->middleware('can:shk-update,shk');
        Route::delete('/{id}', 'SHKController@destroy')->middleware('can:shk-destroy,shk');
    });

    Route::prefix('kk')->group(function () {
        Route::get('/', 'KKController@index')->middleware('can:kk-index,kk');
        Route::post('/', 'KKController@store')->middleware('can:kk-store,kk');
        Route::get('/{id}', 'KKController@show')->middleware('can:kk-show,kk');
        Route::put('/{id}', 'KKController@update')->middleware('can:kk-update,kk');
        Route::delete('/{id}', 'KKController@destroy')->middleware('can:kk-destroy,kk');
    });

    Route::prefix('kkdetail')->group(function () {
        Route::get('/', 'KKDetailController@index')->middleware('can:kkdetail-index,kkdetail');
        Route::post('/', 'KKDetailController@store')->middleware('can:kkdetail-store,kkdetail');
        Route::get('/{id}', 'KKDetailController@show')->middleware('can:kkdetail-show,kkdetail');
        Route::get('/by-kk/{id}', 'KKDetailController@byKk')->middleware('can:kkdetail-show,kkdetail');
        Route::put('/{id}', 'KKDetailController@update')->middleware('can:kkdetail-update,kkdetail');
        Route::delete('/{id}', 'KKDetailController@destroy')->middleware('can:kkdetail-destroy,kkdetail');
    });

    Route::prefix('surat-keluar-masuk')->group(function () {
        Route::get('/', 'SuratKeluarMasukController@index')->middleware('can:surat-keluar-masuk-index,surat-keluar-masuk');
        Route::post('/', 'SuratKeluarMasukController@store')->middleware('can:surat-keluar-masuk-store,surat-keluar-masuk');
        Route::get('/{id}', 'SuratKeluarMasukController@show')->middleware('can:surat-keluar-masuk-show,surat-keluar-masuk');
        Route::put('/{id}', 'SuratKeluarMasukController@update')->middleware('can:surat-keluar-masuk-update,surat-keluar-masuk');
        Route::delete('/{id}', 'SuratKeluarMasukController@destroy')->middleware('can:surat-keluar-masuk-destroy,surat-keluar-masuk');
    });

    /**
     * Surat Nikah
     */
    Route::prefix('surat-nikah')->group(function() {
        Route::get('/', 'SuratNikahController@index')->middleware('can:surat-nikah-index,surat-nikah');
        Route::post('/', 'SuratNikahController@store')->middleware('can:surat-nikah-store,surat-nikah');
        Route::get('/{id}', 'SuratNikahController@show')->middleware('can:surat-nikah-show,surat-nikah');
        Route::put('/{id}', 'SuratNikahController@update')->middleware('can:surat-nikah-update,surat-nikah');
        Route::delete('/{id}', 'SuratNikahController@destroy')->middleware('can:surat-nikah-destroy,surat-nikah');
        Route::get('/{id}/render', 'SuratNikahController@render')->middleware('can:surat-nikah-render,surat-nikah');
    });

    /**
     * Surat Pengantar dan Keterangan Umum
     */
    Route::prefix('surat-pelayanan')->group(function () {
        Route::get('/', 'SuratPelayananController@index')->middleware('can:surat-pelayanan-index,surat-pelayanan');
        Route::post('/', 'SuratPelayananController@store')->middleware('can:surat-pelayanan-store,surat-pelayanan');
        Route::get('/{id}', 'SuratPelayananController@show')->middleware('can:surat-pelayanan-show,surat-pelayanan');
        Route::put('/{id}', 'SuratPelayananController@update')->middleware('can:surat-pelayanan-update,surat-pelayanan');
        Route::delete('/{id}', 'SuratPelayananController@destroy')->middleware('can:surat-pelayanan-destroy,surat-pelayanan');
        Route::get('/{id}/render', 'SuratPelayananController@render')->middleware('can:surat-pelayanan-render,surat-pelayanan');
    });

    Route::prefix('permohonan-kk')->group(function () {
        Route::get('/', 'PermohonanKKController@index')->middleware('can:permohonan-kk-index,permohonan-kk');
        Route::post('/', 'PermohonanKKController@store')->middleware('can:permohonan-kk-store,permohonan-kk');
        Route::get('/{id}', 'PermohonanKKController@show')->middleware('can:permohonan-kk-show,permohonan-kk');
        Route::put('/{id}', 'PermohonanKKController@update')->middleware('can:permohonan-kk-update,permohonan-kk');
        Route::delete('/{id}', 'PermohonanKKController@destroy')->middleware('can:permohonan-kk-destroy,permohonan-kk');
    });

    Route::prefix('permohonan-kk-detail')->group(function () {
        Route::get('/', 'PermohonanKKDetailController@index')->middleware('can:permohonan-kk-detail-index,permohonan-kk');
        Route::post('/', 'PermohonanKKDetailController@store')->middleware('can:permohonan-kk-store,permohonan-kk');
        Route::get('/{id}', 'PermohonanKKDetailController@show')->middleware('can:permohonan-kk-show,permohonan-kk');
        Route::get('/by-permohonan-kk-id/{id}', 'PermohonanKKDetailController@byPermohonanKK')->middleware('can:permohonan-kk-by-permohonan-kk,permohonan-kk');
        Route::put('/{id}', 'PermohonanKKDetailController@update')->middleware('can:permohonan-kk-update,permohonan-kk');
        Route::delete('/{id}', 'PermohonanKKDetailController@destroy')->middleware('can:permohonan-kk-destroy,permohonan-kk');
    });

    Route::prefix('ktp')->group(function () {
        Route::get('/', 'KTPController@index')->middleware('can:ktp-index,ktp');
        Route::post('/', 'KTPController@store')->middleware('can:ktp-store,ktp');
        Route::get('/{id}', 'KTPController@show')->middleware('can:ktp-show,ktp');
        Route::put('/{id}', 'KTPController@update')->middleware('can:ktp-update,ktp');
        Route::delete('/{id}', 'KTPController@destroy')->middleware('can:ktp-destroy,ktp');
    });

});
