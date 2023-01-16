<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Surat Izin {{ $surat_izin->jenis }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <link rel="stylesheet" href="{{asset('/css/paper.css')}}">

    <!-- MyCSS -->
    <style>
        /* kop */
        .kop {
            margin: -35px 0 0 -35px;
        }

        /* container */
        .container {
            height: 1000px;
            position: relative;
            margin-right: 25px;
            margin-top: 20px;
            margin-left: 25px;
        }

        .salam_pembuka {
            margin-top: 25px;
            margin-left: 95px;
        }

        .salam_pembuka p {
            line-height: 1.3;
        }

        div.isi_surat{
            margin-left: 95px;
        }

        .isi_surat p {
            text-align: justify;
            line-height: 1.3;
        }

        .tabel-data {
          width: 100%;
        }

        table.tabelData{
          border-collapse: collapse;
          margin-left: 95px;
          table-layout:fixed;
          width: 592px;
        }

        .tabel-data td {
          padding: 5px;
        }

        .p1,
        .p2,
        .p3,
        .p4 {
            margin-left: 95px;
            text-align: justify;
            line-height: 1.3;
        }        


        .ttd {
            margin-top: 25px;
            float: right;
        }

        .tembusan {
            position: absolute;
            bottom: 0;
        }
    </style>

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>@page { size: F4 }</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="F4">
    <section class="sheet padding-10mm">

    <article>

        <div class="kop" style="display: flex; margin: auto;">
            <img style="width: 100%;" src="{{ asset('/img/kopSuratPsi.jpeg') }}">
        </div>

        <div class="container">
            <div class="deskripsi">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width: 90px;">Nomor</td>
                        <td>:</td>
                        <td style="padding-left:5px;">{{ $surat_izin->nomor_dokumen }}/D/KM/{{ getRomawi(date('n')) }}/{{Carbon\Carbon::now()->isoFormat('Y') }}</td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td style="padding-left:5px;">-</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td style="padding-left:5px;"><b>Permohonan Ijin {{ ucwords($surat_izin->jenis) }}</b></td>
                    </tr>
                </table>
            </div>

            <div class="salam_pembuka">
                <p>
                    Kepada Yth,<br>
                    Bapak/Ibu Pimpinan<br>
                    {{ ucwords($surat_izin->tujuan) }}<br>
                    di<br>
                    Tempat
                </p>
            </div>
            
            <div class="isi_surat">
                <p>
                  Dekan Fakultas Psikologi Universitas Buana Perjuangan Karawang, menerangkan dengan sesungguhnya bahwa :
                </p>
            </div>

            <div class="tabel-data">
                <table class="tabelData">
                  <tr>
                      <td width="20%">Nama</td>
                      <td width="5%">:</td>
                      <td>{{ ucwords($surat_izin->nama) }}</td>
                  </tr>
                  <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td>{{ $surat_izin->nim }}</td>
                </tr>
                <tr>
                    <td>Program Studi</td>
                    <td>:</td>
                    <td>Psikologi</td>
                </tr>
                <tr>
                    <td>Jenjang</td>
                    <td>:</td>
                    <td>Strata 1</td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>:</td>
                    <td>{{ $surat_izin->semester }}</td>
                </tr>
                </table>
            </div>

            <div class="deskripsi">
                <p class="p1">
                  Mahasiswa tersebut di atas telah tercatat sebagai peserta <b>{{ ucwords($surat_izin->jenis) }}</b> Tahun Akademik {{Carbon\Carbon::now()->isoFormat('Y') }}/{{Carbon\Carbon::now()->addYears(1)->isoFormat('Y') }} yang diselenggarakan pada tanggal <b>{{Carbon\Carbon::parse($surat_izin->tanggal_awal)->isoFormat('D MMMM ') }} – {{Carbon\Carbon::parse($surat_izin->tanggal_akhir)->isoFormat('D MMMM Y') }}.</b>
                </p>
                <p class="p2">
                  Berkaitan dengan hal di atas, kami mohon perkenannya bagi mahasiswa tersebut untuk mengikuti kegiatan dimaksud.
                </p>
                <p class="p3">
                  Demikian kami sampaikan, atas perhatian dan kebijaksanaan yang diberikan kami haturkan terima kasih.
                </p>
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
                            <b>Dr. Cempaka Putrie Dimala, M.Psi</b><br>
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
    // window.print();
</script>
</html>