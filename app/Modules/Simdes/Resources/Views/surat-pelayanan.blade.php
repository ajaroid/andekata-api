<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $surat_jenis }} - {{ $pemegang }}</title>
    <style>
      html, body, div, span, applet, object, iframe,
      h1, h2, h3, h4, h5, h6, p, blockquote, pre,
      a, abbr, acronym, address, big, cite, code,
      del, dfn, em, img, ins, kbd, q, s, samp,
      small, strike, strong, sub, sup, tt, var,
      b, u, i, center,
      dl, dt, dd, ol, ul, li,
      fieldset, form, label, legend,
      table, caption, tbody, tfoot, thead, tr, th, td,
      article, aside, canvas, details, embed,
      figure, figcaption, footer, header, hgroup,
      menu, nav, output, ruby, section, summary,
      time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
      }
      /* HTML5 display-role reset for older browsers */
      article, aside, details, figcaption, figure,
      footer, header, hgroup, menu, nav, section {
        display: block;
      }
      body {
        line-height: 150%;
      }
      ol, ul {
        list-style: none;
      }
      blockquote, q {
        quotes: none;
      }
      blockquote:before, blockquote:after,
      q:before, q:after {
        content: '';
        content: none;
      }
      table {
        border-collapse: collapse;
        border-spacing: 0;
      }

      /** Styles for Surat Related */
      .surat-konten {
        padding: 1cm;
      }
      .surat-kop {
        font-size: 18pt;
        text-align: center;
        line-height: 120%;
      }
      .surat-kop .logo {
        position: absolute;
        width: auto;
        height: 64px;
        left: 1cm;
      }
      .surat-kop-separator {
        border-top: double 5px;
      }
      .surat-kop .pemkab {
        font-weight: bold;
      }
      .surat-kop .kecamatan {
        font-weight: bold;
      }
      .surat-kop .desa {
        font-weight: bold;
      }
      .surat-kop .alamat {
        font-size: 10pt;
      }

      .surat-judul {
        text-align: center;
        margin-top: 0.5cm;
        margin-bottom: 0.5cm;
      }
      .surat-jenis {
        text-decoration: underline;
      }

      .tabulasi {
          text-indent:1cm;
      }
      .surat-isi {
        padding-left: 1.5cm;
        padding-right: 1.5cm;
      }
      .surat-isi table tr td{
          vertical-align: top;
          text-align: left;
      }
      .surat-tempat-tanggal {
          text-align: right;
      }
      .surat-mengetahui table{
        width: 100%;
      }
      .surat-mengetahui table tr td {
        text-align: center;
        line-height: 500%;
      }

      /** Rules */
      @page {
        size: A4;
        margin: 0;
      }
      @media print {
        html, body {
          width: 210mm;
          height: 297mm;
        }
      }
    </style>
</head>
<body>
  <div class="surat-konten">
    <div class="surat-kop">
    <img class="logo" src="{{ $logo }}">
      <div class="pemkab">PEMERINTAH {{ strtoupper($kabupaten) }}</div>
      <div class="kecamatan">KECAMATAN {{ strtoupper($kecamatan) }}</div>
      <div class="desa">DESA {{ strtoupper($desa) }}</div>
      <p class="alamat">{{ $alamat_kelurahan }}</p>
    </div>
    <hr class="surat-kop-separator" />
    <div class="surat-judul">
      <div class="surat-keterangan-surat">
        <p class="surat-jenis">{{ $surat_jenis }}</p>
        <p>Nomor : {{ $nomor_surat }}</p>
      </div>
    </div>
    <div class="surat-isi">
      <p class="tabulasi">Yang bertanda tangan di bawah ini menerangkan bahwa :</p>
      <br/>
      <table>
        <tr>
          <td>Nama</td>
          <td> : </td>
          <td>{{ $pemegang }}</td>
        </tr>
        <tr>
          <td>Tempat & Tanggal Lahir</td>
          <td> : </td>
          <td> {{ $tempat_lahir }}, {{ $tanggal_lahir }}</td>
        </tr>
        <tr>
          <td>NIK</td>
          <td> : </td>
          <td>{{ $nik }}</td>
        </tr>
        <tr>
          <td>Kewarganegaraaan & Agama</td>
          <td> : </td>
          <td>{{ $warganegara }}, {{ $agama }}</td>
        </tr>
        <tr>
          <td>Pekerjaan</td>
          <td> : </td>
          <td>{{ $pekerjaan }}</td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td> : </td>
          <td>{{ $alamat_pemegang }}</td>
        </tr>
        <tr>
          <td>Berlaku</td>
          <td> : </td>
          <td>{{ $berlaku }}</td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td> : </td>
          <td>{{ $keterangan }}</td>
        </tr>
      </table>
      <br/>
      <p class="tabulasi text-center">Demikian untuk menjadikan maklum bagi yang berkepentingan.</p>
      <br/>
    </div>

    <div class="surat-tempat-tanggal">{{ $kabupaten }}, {{ $dibuatpada }}</div>
    <div class="surat-mengetahui">
      <table>
          <tr class="surat-pemegang">
              <td>Pemegang</td>
              <td>Kepala Desa</td>
          </tr>
          <tr class="surat-kepala-desa">
              <td>{{ $pemegang }}</td>
              <td>{{ $kepala_desa }}</td>
          </tr>
      </table>
    </div>
  </div>
</body>
</html>
