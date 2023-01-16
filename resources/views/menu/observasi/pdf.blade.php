<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Surat Izin {{ $observasi->jenis }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">

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
            <img style="width: 100%;" src="{{ asset('img/kopSuratPsi.jpeg') }}">
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
                  Sehubung dengan akan dilakukan {{ $observasi->jenis }} dari mahasiswa Program Studi Psikologi Fakultas Psikologi Universitas Buana Perjuangan Karawang, kami mohon Bapak/Ibu berkenan memberikan ijin kepada :
                </p>
            </div>

            <div class="tabel-data">
                <table class="tabelData">
                  <tr>
                      <td width="20%">Nama</td>
                      <td width="5%">:</td>
                      <td>{{ ucwords($observasi->nama) }}</td>
                  </tr>
                  <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td>{{ $observasi->nim }}</td>
                </tr>
                <tr>
                    <td>Program Studi</td>
                    <td>:</td>
                    <td>Psikologi</td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>:</td>
                    <td>{{ $observasi->semester }}</td>
                </tr>
                <tr>
                    <td>Jenjang</td>
                    <td>:</td>
                    <td>Strata 1</td>
                </tr>
                <tr>
                  @if($observasi->jenis == 'try out')
                    <td>Tema</td>
                  @else
                    <td>Judul</td>
                  @endif
                  <td>:</td>
                  <td><b>{{ strtoupper($observasi->judul) }}</b></td>
                </tr>
                </table>
            </div>

            <div class="deskripsi">
                <p class="p1">
                  Untuk melaksanakan {{ ucwords($observasi->jenis) }} dan pengumpulan data yang diperlukan terkait penulisan skripsi. dalam upaya melaksanakan protokol kesehatan kami telah mewajibkan mahasisswa senantiasa memperhatikan dan menerapkannya serta mengikuti peraturan yang berlaku di tempat Bapak/Ibu.
                </p>
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

</body>
<script>
    // window.print();
</script>
</html>