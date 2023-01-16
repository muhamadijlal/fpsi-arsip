<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Surat Izin {{ $observasi->jenis }}</title>

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

        table.tabelData{
          text-align: center;
          margin-top: 50px;
          border: 1px solid black;
          border-collapse: collapse;
          table-layout:fixed;
        }

        .tabel-data th {
          text-transform: uppercase;
          border: 1px solid black;
          padding: 5px;
        }

        .tabel-data td {
          border: 1px solid black;
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
                        <td style="padding-left:5px;">{{ $observasi->nomor_dokumen }}/D/KM/{{ getRomawi(date('n')) }}/{{Carbon\Carbon::now()->isoFormat('Y') }}</td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td style="padding-left:5px;">-</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td style="padding-left:5px;"><b>Permohonan Izin {{ ucwords($observasi->jenis) }}</b></td>
                    </tr>
                </table>
            </div>

            <div class="salam_pembuka">
                <p>
                    Kepada Yth,<br>
                    Bapak/Ibu Pimpinan<br>
                    <b>{{ strtoupper($observasi->lokasi) }}</b><br>
                    di<br>
                    Tempat
                </p>
            </div>
            
            <div class="isi_surat">
                <p>
                  Sehubung dengan akan dilakukan {{ ucwords($observasi->jenis) }} dari mahasiswa Program Studi Psikologi Fakultas Psikologi Universitas Buana Perjuangan Karawang, kami mohon Bapak/Ibu berkenan memberikan ijin kepada Mahasiswa sebagaimana terlampir dalam lembar lampiran, untuk melaksanakan {{ ucwords($observasi->jenis) }} dan pengumpulan data yang diperlukan terkait penulisan skripsi.<br>
                  Dalam upaya melaksanakan protokol kesehatan kami telah mewajibkan mahasiswa senantiasa memperhatikan dan menerapkannya serta mengikuti peraturan yang berlaku ditempat Bapak/Ibu.
                </p>
            </div>            

            <div class="deskripsi">
                {{-- <p class="p1">
                  Untuk melaksanakan {{ $observasi->jenis }} dan pengumpulan data yang diperlukan terkait penulisan skripsi. dalam upaya melaksanakan protokol kesehatan kami telah mewajibkan mahasisswa senantiasa memperhatikan dan menerapkannya serta mengikuti peraturan yang berlaku di tempat Bapak/Ibu.
                </p> --}}
                <p class="p2">
                  Demikian surat permohonan ijin ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.
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
<section class="sheet padding-10mm">
    <article>

        <div class="kop" style="display: flex; margin: auto;">
            <img style="width: 100%;" src="{{ asset('/img/kopSuratPsi.jpeg') }}">
        </div>

        <div class="container">
          <div class="deskripsi">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>Perihal</td>
                  <td>:</td>
                  <td style="padding-left:5px;"><b>Permohonan Izin {{ ucwords($observasi->jenis) }}</b></td>
                </tr>
                <tr>
                    <td style="width: 90px;">Nomor</td>
                    <td>:</td>
                    <td style="padding-left:5px;">{{ $observasi->no_dokumen }}/D/KM/{{ getRomawi(date('n')) }}/{{Carbon\Carbon::now()->isoFormat('Y') }}</td>
                </tr>
              </table>
          </div>

          <div class="tabel-data">
            <table width="100%" class="tabelData">
              <thead>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>Nim</th>
                <th>Program Studi</th>
                <th>Semester</th>
                <th>Jenjang</th>
                <th>Tema Penelitian</th>
              </thead>
              <tbody>
                @foreach ($observasi->anggota_observasi as $index => $anggota)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="word-wrap:break-word;">{{ ucwords($anggota->nama) }}</td>
                    <td  style="word-wrap:break-word;">{{ $anggota->nim }}</td>
                    <td>Psikologi</td>
                    <td>{{ $observasi->semester }}</td>
                    <td>Strata 1</td>
                    <td style="word-wrap:break-word;">{{ ucwords($observasi->judul) }}</td>
                  </tr>
                @endforeach
              </tbody>
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