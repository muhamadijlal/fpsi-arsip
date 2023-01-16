<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Surat Kerja Praktik Dinas</title>

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
            border: 1px solid;
            border-collapse: collapse;
            text-align: center;
            margin-left: 95px;
            table-layout:fixed;
            width: 592px;
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

    <style>@page { size: F4 }</style>
</head>
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
                        <td style="padding-left:5px;"> {{$kp->nomor_dokumen}}/D/KM/{{ getRomawi(date('n')) }}/{{Carbon\Carbon::now()->isoFormat('Y') }}</td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td style="padding-left:5px;">-</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td style="padding-left:5px;"><b>Permohonan Ijin Kerja Praktik</b></td>
                    </tr>
                </table>
            </div>

            <div class="salam_pembuka">
                <p>
                    Kepada Yth,<br>
                    Bapak/Ibu Kepala<br>
                    {{ ucwords($kp->tempat) }}<br>
                    di
                    <br>
                    Tempat
                </p>
            </div>
            
            <div class="isi_surat">
                <p>
                    Dalam rangka melaksanakan kurikulum Fakultas Psikologi Universitas Buana Perjuangan Karawang pada Tahun Akademik {{Carbon\Carbon::now()->isoFormat('Y') }}/{{Carbon\Carbon::now()->addYears(1)->isoFormat('Y') }} yaitu kegiatan penempatan kerja praktik bagi mahasiswa semester V (lima) selama 1 (satu) bulan untuk memberi pengalaman mengenai penerapan pengetahuan dan keahlian pada lingkungan dunia kerja/instansi<br>
                    <br>Dengan ini, kami mohon kesediaan memberikan surat rekomendasi kepada mahasiswa/i kami untuk melaksanakan kerja praktik di Dinas <b>{{ ucwords($kp->instansi) }}</b>.<br> Mahasiswa tersebut adalah:
                </p>
            </div>

            <div class="tabel-data">
                <table class="tabelData">
                    <thead>
                        <th width="40%" style="border: 1px solid;">Nama</th>
                        <th width="20%" style="border: 1px solid;">NIM</th>
                        <th width="20%" style="border: 1px solid;">Fakultas</th>
                        <th width="20%" style="border: 1px solid;">Jenjang</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid; word-wrap: break-word;">{{ strtoupper($kp->nama) }}</td>
                            <td style="border: 1px solid;">{{ $kp->nim }}</td>
                            <td style="border: 1px solid;">Psikologi</td>
                            <td style="border: 1px solid;">Strata 1</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="deskripsi">
                <p class="p1">
                    Adapun mengenai jadwal dan pelaksanaan Kerja Praktik dapat dilaksanakan pada jadwal waktu yang sesuai dengan kesediaan instansi/perusahaan yang Bapak/Ibu pimpin.
                </p>
                <p class="p2">
                    Kami mohon jika mahasiswa tersebut diterima, diberikan penilaian selama kerja praktik dan surat keterangan telah mengikuti kerja praktik.
                </p>
                <p class="p3">
                    Demikian permohonan ini, atas perhatian dan kerjasamanya kami ucapkan terima kasih.
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
            <div class="tembusan">
                <p>Tembusan :</p>
                <ol>
                    <li>Koordinator Program Studi</li>
                    <li>Koordinator KP Program Studi</li>
                    <li>Arsip</li>
                </ol>
            </div>   
        </div>
    </article>
</section>

</body>
<script>
    window.print();
</script>
</html>