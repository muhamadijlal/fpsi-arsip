<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Rekap Data Mahasiswa Legaliasasi Ijazah</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css"> -->
    <link rel="stylesheet" href="{{asset('/css/paper.css')}}">
  <!-- MyCSS -->
  <link rel="stylesheet" href="{{asset('/css/style.css')}}">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: F4 landscape }</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="F4 landscape">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <article>
        <!-- Header -->
            <header>
                <p>Daftar<br>legalisasi ijazah, transkip dan surat keterangan pendamping ijazah<br>Fakultas Psikologi<br>Universitas Buana Perjuangan Karawang</p>
            </header>
        <!-- Akhir Header -->

        <!-- Awal table -->
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
               <th class="no">NO</th>
               <th class="noleg">NOMOR LEGALISASI</th>
               <th style="text-align: center">
                    NO IJAZAH, TRANSKIP
                    NILAI DAN SURAT
                    KETERANGAN
                    PENDAMPING IJAZAH
               </th>
               <th class="nama">NAMA</th>
               <th class="prodi">PRODI</th>
               <th>
                   LULUSAN<br>
                   TAHUN
               </th>
               <th>TANGGAL</th>
               <th>KET</th>
            </tr>
			@foreach($legalisasi as $index => $collection)
            <tr>
                <td>{{ $index++ }}</td>
                <td>{{$collection->nomor_legalisasi}}</td>
                <td>{{$collection->nomor_ijazah}}</td>
                <td>{{$collection->nama}}</td>
                <td>Psikologi</td>
                <td>{{$collection->tahun_lulus}}</td>
                <td>{{$collection->tanggal_lulus}}</td>
                <td>{{$collection->keterangan}}</td>
            </tr>
            @endforeach
        </table>
        <!-- Akhir Table -->
        <table>

        </table>
    </article>

  </section>

</body>
<script >
    // window.print()
</script>

  
</html>