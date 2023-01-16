<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Surat Kerja Praktik Umum</title>

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
        .biodata {
            padding-left: 100px;
        }

        table, td {            
            border-collapse: collapse;
            padding: 8px
        }

        .deskripsi2 {
            margin-top: 15px;
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
                <p>Yang bertanda tangan dibawah ini Dekan Fakultas Psikologi Universitas Buana Perjuangan Karawang, menerangkan bahwa mahasiswa yang tercantum namanya dibawah ini :</p>
            </div>
            <div class="biodata">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $aktif->nama }}</td>
                    </tr>
                    <tr>
                        <td>Tempat tanggal lahir</td>
                        <td>:</td>
                        <td>{{ ucwords($aktif->kota_lahir) }}, {{ $aktif->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td>{{ $aktif->nim }}</td>
                    </tr>
                    <tr>
                        <td>Program studi</td>
                        <td>:</td>
                        <td>Psikologi</td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td>{{ $aktif->semester }}</td>
                    </tr>
                </table>
            </div>
            <div class="deskripsi2">
                Adalah benar-benar terdaftar sebagai mahasiswa pada Program Studi Psikologi Fakultas Psikologi Universitas Buana Perjuangan Karawang dan aktif mengikuti perkuliahan semester berlangsung tahun akademik {{Carbon\Carbon::now()->isoFormat('Y') }}/{{Carbon\Carbon::now()->addYears(1)->isoFormat('Y') }}.
            </div>
            <div class="penutup">
                <p>Demikian surat keterangan ini dikeluarkan untuk dapat dipergunakan sebagaimana mestinya.</p>
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