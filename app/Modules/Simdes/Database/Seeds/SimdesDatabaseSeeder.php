<?php

namespace App\Modules\Simdes\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Modules\Core\Models\Group;
use App\Modules\Core\Models\Privilege;
use App\Modules\Simdes\Models\Resident;
use App\Modules\Simdes\Models\KeperluanSurat;

class SimdesDatabaseSeeder extends Seeder
{
    private $faker;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(WilayahSeeder::class);
        $this->seedPrivilege();
        $this->addSimdesPrivilegeToSuperadmin();
        $this->seedMaster();
        $this->seedResident();
        $this->seedVillageIdentity();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    private function seedMaster()
    {
        DB::table('job')->insert([
            [ 'name' => 'Guru' ],
            [ 'name' => 'Programmer' ],
            [ 'name' => 'Designer' ],
        ]);

        DB::table('education')->insert([
            [ 'name' => 'SD' ],
            [ 'name' => 'SMP' ],
            [ 'name' => 'SMA' ],
            [ 'name' => 'S1' ],
            [ 'name' => 'S2' ],
            [ 'name' => 'S3' ]
        ]);

        DB::table('religion')->insert([
            [ 'name' => 'Islam' ],
            [ 'name' => 'Kristen' ],
            [ 'name' => 'Katholik' ],
            [ 'name' => 'Hindu' ],
            [ 'name' => 'Budha' ],
        ]);

        DB::table('status_hubungan_keluarga')->insert([
            [ 'name' => 'Kepala Keluarga' ],
            [ 'name' => 'Anak' ],
            [ 'name' => 'Istri'],
            [ 'name' => 'Famili Lain'],
            [ 'name' => 'Cucu'],
            [ 'name' => 'Orang Tua']
        ]);

        DB::table('marital_status')->insert([
            [ 'name' => 'Lajang' ],
            [ 'name' => 'Belum Kawin' ],
            [ 'name' => 'Cerai Mati' ],
            [ 'name' => 'Cerai Hidup']
        ]);

        DB::table('keperluan_surat')->insert([
            [
                'nama' => 'Surat Keterangan Tidak Mampu',
                'kode_pelayanan' => 'SP-SKTM',
                'village_id' => 3402122002,
                'kode_surat' => 'SKTM-01',
                'tipe' => KeperluanSurat::SURAT_PENGANTAR,
            ]
        ]);
    }

    private function seedResident()
    {
        foreach (range(1, 100) as $index) {

            DB::table('resident')->insert([
                'religion_id' => 1,
                'marital_status_id' => 1,
                'status_hub_keluarga_id' => 1,
                'job_id' => 1,
                'education_id' => 1,
                'nik' => '121212121212'.$index,
                'name' => $this->faker->name,
                'gender' => Resident::MALE,
                'birth_place' => $this->faker->city,
                'birth_date' => $this->faker->date('Y-m-d', 'now'),
                'father_name' => $this->faker->firstNameMale,
                'mother_name' => $this->faker->firstNameFemale,
                'citizenship' => Resident::WNI,
                'status' => Resident::ACTIVE,
                'village_id' => 3402122002
            ]);
        }
    }

    /**
     * @author Yuana
     * note : Urutan memengaruhi
     */
    private function seedPrivilege()
    {
        DB::table('privileges')->insert([

            Privilege::generatePrivilege('provinsi-index', 'Provinsi Get All', 'Provinsi'),
            Privilege::generatePrivilege('provinsi-show', 'Provinsi Get One', 'Provinsi'),
            Privilege::generatePrivilege('provinsi-store', 'Provinsi Create', 'Provinsi'),
            Privilege::generatePrivilege('provinsi-update', 'Provinsi Update', 'Provinsi'),
            Privilege::generatePrivilege('provinsi-destroy', 'Provinsi Destroy', 'Provinsi'),

            Privilege::generatePrivilege('kabupaten-index', 'Kabupaten Get All', 'Kabupaten'),
            Privilege::generatePrivilege('kabupaten-show', 'Kabupaten Get One', 'Kabupaten'),
            Privilege::generatePrivilege('kabupaten-store', 'Kabupaten Create', 'Kabupaten'),
            Privilege::generatePrivilege('kabupaten-update', 'Kabupaten Update', 'Kabupaten'),
            Privilege::generatePrivilege('kabupaten-destroy', 'Kabupaten Destroy', 'Kabupaten'),

            Privilege::generatePrivilege('kecamatan-index', 'Kecamatan Get All', 'Kecamatan'),
            Privilege::generatePrivilege('kecamatan-show', 'Kecamatan Get One', 'Kecamatan'),
            Privilege::generatePrivilege('kecamatan-store', 'Kecamatan Create', 'Kecamatan'),
            Privilege::generatePrivilege('kecamatan-update', 'Kecamatan Update', 'Kecamatan'),
            Privilege::generatePrivilege('kecamatan-destroy', 'Kecamatan Destroy', 'Kecamatan'),

            Privilege::generatePrivilege('kelurahan-index', 'Kelurahan Get All', 'Kelurahan'),
            Privilege::generatePrivilege('kelurahan-show', 'Kelurahan Get One', 'Kelurahan'),
            Privilege::generatePrivilege('kelurahan-store', 'Kelurahan Create', 'Kelurahan'),
            Privilege::generatePrivilege('kelurahan-update', 'Kelurahan Update', 'Kelurahan'),
            Privilege::generatePrivilege('kelurahan-destroy', 'Kelurahan Destroy', 'Kelurahan'),

            Privilege::generatePrivilege('keperluan-surat-index', 'Keperluan Surat Get All', 'Keperluan Surat'),
            Privilege::generatePrivilege('keperluan-surat-show', 'Keperluan Surat Get One', 'Keperluan Surat'),
            Privilege::generatePrivilege('keperluan-surat-store', 'Keperluan Surat Create', 'Keperluan Surat'),
            Privilege::generatePrivilege('keperluan-surat-update', 'Keperluan Surat Update', 'Keperluan Surat'),
            Privilege::generatePrivilege('keperluan-surat-destroy', 'Keperluan Surat Destroy', 'Keperluan Surat'),

            Privilege::generatePrivilege('agama-index', 'Agama Get All', 'Agama'),
            Privilege::generatePrivilege('agama-show', 'Agama Get One', 'Agama'),
            Privilege::generatePrivilege('agama-store', 'Agama Create', 'Agama'),
            Privilege::generatePrivilege('agama-update', 'Agama Update', 'Agama'),
            Privilege::generatePrivilege('agama-destroy', 'Agama Destroy', 'Agama'),

            Privilege::generatePrivilege('status-kawin-index', 'Status Kawin Get All', 'Status Kawin'),
            Privilege::generatePrivilege('status-kawin-show', 'Status Kawin Get One', 'Status Kawin'),
            Privilege::generatePrivilege('status-kawin-store', 'Status Kawin Create', 'Status Kawin'),
            Privilege::generatePrivilege('status-kawin-update', 'Status Kawin Update', 'Status Kawin'),
            Privilege::generatePrivilege('status-kawin-destroy', 'Status Kawin Destroy', 'Status Kawin'),

            Privilege::generatePrivilege('pekerjaan-index', 'Pekerjaan Get All', 'Pekerjaan'),
            Privilege::generatePrivilege('pekerjaan-show', 'Pekerjaan Get One', 'Pekerjaan'),
            Privilege::generatePrivilege('pekerjaan-store', 'Pekerjaan Create', 'Pekerjaan'),
            Privilege::generatePrivilege('pekerjaan-update', 'Pekerjaan Update', 'Pekerjaan'),
            Privilege::generatePrivilege('pekerjaan-destroy', 'Pekerjaan Destroy', 'Pekerjaan'),

            Privilege::generatePrivilege('pendidikan-index', 'Pendidikan Get All', 'Pendidikan'),
            Privilege::generatePrivilege('pendidikan-show', 'Pendidikan Get One', 'Pendidikan'),
            Privilege::generatePrivilege('pendidikan-store', 'Pendidikan Create', 'Pendidikan'),
            Privilege::generatePrivilege('pendidikan-update', 'Pendidikan Update', 'Pendidikan'),
            Privilege::generatePrivilege('pendidikan-destroy', 'Pendidikan Destroy', 'Pendidikan'),

            Privilege::generatePrivilege('shk-index', 'SHK Get All', 'SHK'),
            Privilege::generatePrivilege('shk-show', 'SHK Get One', 'SHK'),
            Privilege::generatePrivilege('shk-store', 'SHK Create', 'SHK'),
            Privilege::generatePrivilege('shk-update', 'SHK Update', 'SHK'),
            Privilege::generatePrivilege('shk-destroy', 'SHK Destroy', 'SHK'),

            Privilege::generatePrivilege('kk-index', 'KK Get All', 'KK'),
            Privilege::generatePrivilege('kk-show', 'KK Get One', 'KK'),
            Privilege::generatePrivilege('kk-store', 'KK Create', 'KK'),
            Privilege::generatePrivilege('kk-update', 'KK Update', 'KK'),
            Privilege::generatePrivilege('kk-destroy', 'KK Destroy', 'KK'),

            Privilege::generatePrivilege('kkdetail-index', 'KK Detail Get All', 'KK Detail'),
            Privilege::generatePrivilege('kkdetail-show', 'KK Detail Get One', 'KK Detail'),
            Privilege::generatePrivilege('kkdetail-store', 'KK Detail Create', 'KK Detail'),
            Privilege::generatePrivilege('kkdetail-update', 'KK Detail Update', 'KK Detail'),
            Privilege::generatePrivilege('kkdetail-destroy', 'KK Detail Destroy', 'KK Detail'),

            Privilege::generatePrivilege('penduduk-index', 'Penduduk Get All', 'Penduduk'),
            Privilege::generatePrivilege('penduduk-show', 'Penduduk Get One', 'Penduduk'),
            Privilege::generatePrivilege('penduduk-store', 'Penduduk Create', 'Penduduk'),
            Privilege::generatePrivilege('penduduk-update', 'Penduduk Update', 'Penduduk'),
            Privilege::generatePrivilege('penduduk-destroy', 'Penduduk Destroy', 'Penduduk'),

            Privilege::generatePrivilege('surat-keluar-masuk-index', 'Surat Keluar Masuk Get All', 'Surat Keluar Masuk'),
            Privilege::generatePrivilege('surat-keluar-masuk-show', 'Surat Keluar Masuk Get One', 'Surat Keluar Masuk'),
            Privilege::generatePrivilege('surat-keluar-masuk-store', 'Surat Keluar Masuk Create', 'Surat Keluar Masuk'),
            Privilege::generatePrivilege('surat-keluar-masuk-update', 'Surat Keluar Masuk Update', 'Surat Keluar Masuk'),
            Privilege::generatePrivilege('surat-keluar-masuk-destroy', 'Surat Keluar Masuk Destroy', 'Surat Keluar Masuk'),

            Privilege::generatePrivilege('surat-pelayanan-index', 'Surat Pelayanan Get All', 'Surat Pelayanan'),
            Privilege::generatePrivilege('surat-pelayanan-show', 'Surat Pelayanan Get One', 'Surat Pelayanan'),
            Privilege::generatePrivilege('surat-pelayanan-store', 'Surat Pelayanan Create', 'Surat Pelayanan'),
            Privilege::generatePrivilege('surat-pelayanan-update', 'Surat Pelayanan Update', 'Surat Pelayanan'),
            Privilege::generatePrivilege('surat-pelayanan-destroy', 'Surat Pelayanan Destroy', 'Surat Pelayanan'),
            Privilege::generatePrivilege('surat-pelayanan-render', 'Surat Pelayanan Render', 'Surat Pelayanan'),

            Privilege::generatePrivilege('identitas-desa-index', 'Identitas Desa Get All', 'Identitas Desa'),
            Privilege::generatePrivilege('identitas-desa-show', 'Identitas Desa Get One', 'Identitas Desa'),
            Privilege::generatePrivilege('identitas-desa-store', 'Identitas Desa Create', 'Identitas Desa'),
            Privilege::generatePrivilege('identitas-desa-update', 'Identitas Desa Update', 'Identitas Desa'),
            Privilege::generatePrivilege('identitas-desa-destroy', 'Identitas Desa Destroy', 'Identitas Desa'),
            Privilege::generatePrivilege('identitas-desa-upload-logo', 'Identitas Desa Upload Logo', 'Identitas Desa'),

            Privilege::generatePrivilege('surat-nikah-index', 'Surat Nikah Get All', 'Surat Nikah'),
            Privilege::generatePrivilege('surat-nikah-show', 'Surat Nikah Get One', 'Surat Nikah'),
            Privilege::generatePrivilege('surat-nikah-store', 'Surat Nikah Create', 'Surat Nikah'),
            Privilege::generatePrivilege('surat-nikah-update', 'Surat Nikah Update', 'Surat Nikah'),
            Privilege::generatePrivilege('surat-nikah-destroy', 'Surat Nikah Destroy', 'Surat Nikah'),
            Privilege::generatePrivilege('surat-nikah-render', 'Surat Nikah Render', 'Surat Nikah'),

        ]);
    }

    private function addSimdesPrivilegeToSuperadmin()
    {
        $group = Group::where('name', 'superadmin')->first();
        $group->removeAllPrivilege();

        $privileges = Privilege::all();

        foreach ($privileges as $privilege) {
            $group->addPrivilege($privilege->name);
        }
    }

    private function seedVillageIdentity()
    {
        DB::table('village_identity')->insert([
            [
                'village_id' => 3402122001,
                'headman_name' => 'pak lurah satu',
                'headman_nip' => 123123123,
                'head_subdistrict_name' => 'pak camat satu',
                'head_subdistrict_nip' => 2342342341,
                'regent_name' => 'dummy bupati',
                'address' => 'jalan anu nomor 9',
                'phone' => '0274-123123',
                'website' => 'http://www.kelurahan.com',
                'email' => 'kelurahan@mail.com',
                'logo' => 'http://localhost:8000/storage/village-identity/logo/xikebrBQowtZX7uIpFvu9QRTNZQ1kzkKsLjy3E1C.jpeg',

            ],
            [
                'village_id' => 3402122002,
                'headman_name' => 'pak lurah dua',
                'headman_nip' => 123123124,
                'head_subdistrict_name' => 'pak camat dua',
                'head_subdistrict_nip' => 2342342342,
                'regent_name' => 'dummy bupati',
                'address' => 'jalan anu nomor 9',
                'phone' => '0274-123123',
                'website' => 'http://www.kelurahan.com',
                'email' => 'kelurahan@mail.com',
                'logo' => 'http://localhost:8000/storage/village-identity/logo/xikebrBQowtZX7uIpFvu9QRTNZQ1kzkKsLjy3E1C.jpeg',

            ],
            [
                'village_id' => 3402122003,
                'headman_name' => 'pak lurah tiga',
                'headman_nip' => 123123125,
                'head_subdistrict_name' => 'pak camat tiga',
                'head_subdistrict_nip' => 2342342343,
                'regent_name' => 'dummy bupati',
                'address' => 'jalan anu nomor 9',
                'phone' => '0274-123123',
                'website' => 'http://www.kelurahan.com',
                'email' => 'kelurahan@mail.com',
                'logo' => 'http://localhost:8000/storage/village-identity/logo/xikebrBQowtZX7uIpFvu9QRTNZQ1kzkKsLjy3E1C.jpeg',

            ],
            [
                'village_id' => 3402122004,
                'headman_name' => 'pak lurah empat',
                'headman_nip' => 123123126,
                'head_subdistrict_name' => 'pak camat empat',
                'head_subdistrict_nip' => 2342342344,
                'regent_name' => 'dummy bupati',
                'address' => 'jalan anu nomor 9',
                'phone' => '0274-123123',
                'website' => 'http://www.kelurahan.com',
                'email' => 'kelurahan@mail.com',
                'logo' => 'http://localhost:8000/storage/village-identity/logo/xikebrBQowtZX7uIpFvu9QRTNZQ1kzkKsLjy3E1C.jpeg',

            ],
            [
                'village_id' => 3402122005,
                'headman_name' => 'pak lurah lima',
                'headman_nip' => 123123127,
                'head_subdistrict_name' => 'pak camat lima',
                'head_subdistrict_nip' => 2342342345,
                'regent_name' => 'dummy bupati',
                'address' => 'jalan anu nomor 9',
                'phone' => '0274-123123',
                'website' => 'http://www.kelurahan.com',
                'email' => 'kelurahan@mail.com',
                'logo' => 'http://localhost:8000/storage/village-identity/logo/xikebrBQowtZX7uIpFvu9QRTNZQ1kzkKsLjy3E1C.jpeg',

            ],
            [
                'village_id' => 3402122006,
                'headman_name' => 'pak lurah enam',
                'headman_nip' => 123123128,
                'head_subdistrict_name' => 'pak camat enam',
                'head_subdistrict_nip' => 2342342346,
                'regent_name' => 'dummy bupati',
                'address' => 'jalan anu nomor 9',
                'phone' => '0274-123123',
                'website' => 'http://www.kelurahan.com',
                'email' => 'kelurahan@mail.com',
                'logo' => 'http://localhost:8000/storage/village-identity/logo/xikebrBQowtZX7uIpFvu9QRTNZQ1kzkKsLjy3E1C.jpeg',

            ],
            [
                'village_id' => 3402122007,
                'headman_name' => 'pak lurah tujuh',
                'headman_nip' => 123123129,
                'head_subdistrict_name' => 'pak camat tujuh',
                'head_subdistrict_nip' => 2342342347,
                'regent_name' => 'dummy bupati',
                'address' => 'jalan anu nomor 9',
                'phone' => '0274-123123',
                'website' => 'http://www.kelurahan.com',
                'email' => 'kelurahan@mail.com',
                'logo' => 'http://localhost:8000/storage/village-identity/logo/xikebrBQowtZX7uIpFvu9QRTNZQ1kzkKsLjy3E1C.jpeg',

            ],
            [
                'village_id' => 3402122008,
                'headman_name' => 'pak lurah delapan',
                'headman_nip' => 123123110,
                'head_subdistrict_name' => 'pak camat delapan',
                'head_subdistrict_nip' => 2342342348,
                'regent_name' => 'dummy bupati',
                'address' => 'jalan anu nomor 9',
                'phone' => '0274-123123',
                'website' => 'http://www.kelurahan.com',
                'email' => 'kelurahan@mail.com',
                'logo' => 'http://localhost:8000/storage/village-identity/logo/xikebrBQowtZX7uIpFvu9QRTNZQ1kzkKsLjy3E1C.jpeg',

            ],

            //sleman
            [
                'village_id' => 3404132002,
                'headman_name' => 'pak lurah sembilan',
                'headman_nip' => 123123123,
                'head_subdistrict_name' => 'pak camat satu',
                'head_subdistrict_nip' => 2342342341,
                'regent_name' => 'dummy bupati',
                'address' => 'jalan anu nomor 10',
                'phone' => '0274-123123',
                'website' => 'http://www.kelurahan.com',
                'email' => 'kelurahan@mail.com',
                'logo' => 'http://localhost:8000/storage/village-identity/logo/xikebrBQowtZX7uIpFvu9QRTNZQ1kzkKsLjy3E1C.jpeg',

            ],
        ]);
    }
}
