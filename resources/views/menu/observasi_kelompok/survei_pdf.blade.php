<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Surat Ijin Survei Kelompok</title>

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

        .tr, .td{
            border: 1px solid;
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
                        <td style="padding-left:5px;"> {{$observasi->nomor_dokumen}}/D/KM/{{ getRomawi(date('n')) }}/{{Carbon\Carbon::now()->isoFormat('Y') }}</td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td style="padding-left:5px;">-</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td style="padding-left:5px;"><b>Permohonan Ijin Survei</b></td>
                    </tr>
                </table>
            </div>

            <div class="salam_pembuka">
                <p>
                    Kepada Yth,<br>
                    Bapak/Ibu Pimpinan<br>
                    {{ ucwords($observasi->tempat) }}<br>
                    di<br>
                    Tempat
                </p>
            </div>
            
            <div class="isi_surat">
                <p>
                    {{ ucwords($observasi->agenda) }} pada program studi Psikologi Universitas Buana Perjuangan karawang. Kami berharap Bapak/Ibu Pimpinan memberikan ijin observasi di lembaga yang bapak/ibu pimpin kepada mahasiswa kami yang bernama:                    
                </p>
            </div>

            <div class="tabel-data">
                <table class="tabelData">
                    <h4 style="margin-left: 95px; margin-bottom: 0px;">Dosen Pengampu : {{ ucwords($observasi->pengampu) }}</h4>
                    <thead>
                        <th width="5%" style="border: 1px solid;">No</th>
                        <th width="60%" style="border: 1px solid;">Nama Mahasiswa</th>
                        <th width="20%" style="border: 1px solid;">NIM</th>
                    </thead>
                    <tbody>
                        <tr class="tr">
                            <td class="td">1</td>
                            <td class="td" style="word-wrap: break-word;">{{ ucwords($observasi->nama) }}</td>
                            <td class="td">{{ $observasi->nim }}</td>
                        </tr>
                        @foreach ($observasi->anggota_observasi_kelompok as $anggota)
                        <tr class="tr">
                            <td class="td">{{ $loop->iteration+1 }}</td>
                            <td class="td" style="word-wrap: break-word;">{{ ucwords($anggota->nama) }}</td>
                            <td class="td">{{ $anggota->nim }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="deskripsi">
                <p class="p1">
                    Untuk melaksanakan survei tersebut, kami telah mewajibkan mahasiswa untuk senantiasa memperhatikan, menerapkannya dan melaksanakan protokol kesehatan serta mengikuti peraturan yang berlaku ditempat Bapak/Ibu.
                </p>
                <p class="p2">
                    Demikian surat permohonan ijin ini kami sampaikan, atas perhatian dan kerjasmanya kami ucapkan terima kasih
                </p>
                {{-- <p class="p3">
                    Demikian permohonan ini, atas perhatian dan kerjasamanya kami ucapkan terima kasih.
                </p> --}}
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
            <div class="tembusan">
                <p>Tembusan :</p>
                <ol>
                    <li>Koordinator Program Studi</li>
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