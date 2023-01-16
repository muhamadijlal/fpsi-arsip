<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Surat Aktif Kuliah Dinas</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <link rel="stylesheet" href="{{asset('/css/paper.css')}}">

    <!-- MyCSS -->
    <style>
        .container {
            height: 1000px;
            position: relative;
            margin-right: 25px;
            margin-top: 20px;
            margin-left: 25px;
        }

        .judul {
            text-align:center;
        }

        .deskripsi{
            line-height: 1.5;
            text-align: justify;
        }

        table, td {            
            border-collapse: collapse;
        }

        .deskripsi2 {
            margin: 15px 0;
            line-height: 1.5;
            text-align: justify;
        }

        .ttd {
            margin-top: 25px;
            float: right;
        }
    </style>

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>@page { size: A4 }</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
    <section class="sheet padding-10mm">

    <article>

        <div class="kop" style="display: flex; margin: auto;">
            <img style="width: 100%;" src="{{ asset('/img/kopSuratPsi.jpeg') }}">
        </div>

        <div class="container">
            <div class="judul">
                <p>
                    <b>
                    <u>SURAT KETERANGAN AKTIF KULIAH</u>
                    </b>
                    <br>
                    <span>NOMOR:</span>{{ $aktif->nomor_dokumen }}/D/AK/{{getRomawi(Carbon\Carbon::now()->isoFormat('M')) }}/{{Carbon\Carbon::now()->isoFormat('Y') }}
                </p>
            </div>
            <div class="deskripsi">
                <p>Yang bertanda tangan dibawah ini :</p>
            </div>
            <div class="biodata">
                <table>
                    <tr>
                        <td width="41%;">Nama</td>
                        <td>:</td>
                        <td>Dr. Cempaka Putri Dimala, M.Psi Psikolog</td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>416200008</td>
                    </tr>
                    <tr>
                        <td>JABATAN</td>
                        <td>:</td>
                        <td>Dekan Fakultas Psikologi</td>
                    </tr>
                </table>
            </div>
            <div class="deskripsi">
                <p>Dengan ini menyatakan dengan sesungguhnya bahwa :</p>
            </div>
            <div class="biodata">
                <table>
                    <tr>
                        <td width="56%;">Nama</td>
                        <td>:</td>
                        <td>{{ ucwords($aktif->nama) }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td>{{ $aktif->nim }}</td>
                    </tr>
                    <tr>
                        <td>Tempat/Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{ ucwords($aktif->kota_lahir) }}, {{ $aktif->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $aktif->alamat}}</td>
                    </tr>
                </table>
            </div>
            <div class="deskripsi2">
                Adalah benar tercatat sebagi mahasiswa Fakultas Psikologi Universitas Buana Perjuangan  Karawang  pada Semester Ganjil Tahun Akademik {{Carbon\Carbon::now()->isoFormat('Y') }}/{{Carbon\Carbon::now()->addYears(1)->isoFormat('Y') }}, dan sesuai data yang ada pada kami, yang bersangkutan adalah anak dari orang tua/wali :
            </div>
            <div class="biodata">
                <table>
                    <tr>
                        <td width="72%;">Nama Orang Tua</td>
                        <td>:</td>
                        <td>{{ ucwords($aktif->nama_orang_tua) }}</td>
                    </tr>
                    <tr>
                        <td>NIP/NRP/NIK</td>
                        <td>:</td>
                        <td>{{ $aktif->nip_nrp_no_pensiun }}</td>
                    </tr>
                    <tr>
                        <td>Pangkat/Golongan</td>
                        <td>:</td>
                        <td>{{ ucwords($aktif->pangkat_golongan) }}</td>
                    </tr>
                    <tr>
                        <td>Pekerjaan/Jabatan</td>
                        <td>:</td>
                        <td>{{ ucwords($aktif->jabatan)}}</td>
                    </tr>
                    <tr>
                        <td>Instansi/Tempat Bekerja</td>
                        <td>:</td>
                        <td>{{ ucwords($aktif->instansi_tempat_ortu_kerja) }}</td>
                    </tr>
                </table>
            </div>
            <div class="penutup">
                <p>Demikian surat keterangan ini dibuat atas permintaan dari yang bersangkutan, untuk dipergunakan seperlunya.</p>
            </div>
            <div class="ttd">
                <table>
                    <tr>
                        <td>
                            Karawang, {{Carbon\Carbon::now()->isoFormat('D MMMM Y') }}<br>
                            <b>Dekan,</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <br>
                            <br>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Dr. Cempaka Putrie Dimala, M.Psi Psikolog</b><br>
                            <b>NIK.416200008</b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </article>
</section>

</body>
<script>
    window.print();
</script>
</html>