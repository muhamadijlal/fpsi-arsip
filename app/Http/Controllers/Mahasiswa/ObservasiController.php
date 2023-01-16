<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Ms_observasi;
use App\Models\Ms_anggota_observasi;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ObservasiController extends Controller
{
    public function observasi(){
        return view('menu/observasi.index');
    }

    public function observasi_dataTable(){
        $collections = Ms_observasi::where('nim', Auth::user()->nim)
                                    ->orderBy('id','desc')
                                    ->get();

        return datatables()
        ->of($collections)
        ->addColumn('','')
        ->addColumn('aksi', function($row){
            return '
            <div class="d-flex justify-content-around">
                <a href="/mahasiswa/observasi/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                <a href="/mahasiswa/observasi/anggota/'. $row->id .'/add" class="btn btn-icon btn-sm btn-outline-primary"><span class="tf-icons bx bx-plus-medical"></span></a>
            </div>';
        })
        ->addColumn('jenjang','Sarjana (S1)')
        ->addColumn('nomor_dokumen', function($row){
          if($row->nomor_dokumen == null){
              return ' <span class="badge bg-label-warning">Proccess</span> ';
          }else{
              return $row->nomor_dokumen;
          }
      })
        ->addColumn('tanggal_upload', function($row){
            return $row->created_at->format('(D-M-Y) H:i:s');
        })
        ->rawColumns([
            '',
            'aksi',
            'jenjang',
            'nomor_dokumen',
            'tanggal_upload',
        ])
        ->make(true);

    }

    public function observasi_create(){
        return view('menu/observasi.create');
    }

    public function observasi_store(Request $request){

      $this->validateData($request);

      // Cek Data
      $dataValidate = Ms_observasi::where('nim', $request->nim)
                                  ->where('jenis', $request->jenis)
                                  ->where('deleted_at', null)
                                  ->get();

      if($dataValidate->count() > 0){
        return redirect('mahasiswa/observasi')->withErrors("Dokumen $request->nama Observasi $request->jenis suda ada!");
      }else{
        Ms_observasi::create([
          'pengirim' => Auth::user()->email,
          'lokasi' => $request->lokasi,
          'kecamatan' => $request->kecamatan,
          'nama' => $request->nama,
          'nim' => $request->nim,
          'semester' => $request->semester,
          'judul' => $request->judul,
          'jenis' => $request->jenis
        ]);
      }

      return redirect('mahasiswa/observasi')->with('pesan','Dokumen observasi berhasil diajukan!');
    }

    public function observasi_edit($id){
      $observasi = Ms_observasi::findOrFail($id);


      return view('menu/observasi.edit', compact('observasi'));
    }

    public function observasi_update(Request $request, $id){

      $this->validatedUpdateData($request);

      $record = Ms_observasi::find($id);

      // Cek Data
      $dataValidate = Ms_observasi::where('nim', $request->nim)
                                  ->where('jenis', $request->jenis)
                                  ->where('deleted_at', null)
                                  ->get();

      if($request->lokasi != $record->lokasi || $request->jenis != $record->jenis){
        if($dataValidate->count() > 0){
          return redirect('mahasiswa/observasi')->withErrors("Dokumen Observasi $request->nama jenis $request->jenis sudah ada");
        }else{
          Ms_observasi::where('id',$id)->update([
            'nomor_dokumen' => null,
            'lokasi' => $request->lokasi,
            'kecamatan' => $request->kecamatan,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'semester' => $request->semester,
            'judul' => $request->judul
          ]);
        }
      }else{
        Ms_observasi::where('id',$id)->update([
          'lokasi' => $request->lokasi,
          'kecamatan' => $request->kecamatan,
          'nama' => $request->nama,
          'nim' => $request->nim,
          'semester' => $request->semester,
          'judul' => $request->judul
        ]);
      }

      return redirect('mahasiswa/observasi')->with('pesan','Dokumen observasi berhasil diupdate!');
    }

    public function anggota_observasi_create($id){

        $observasi = Ms_Observasi::find($id);
  
        return view('menu/observasi.index_anggota', compact('observasi'));
  
      }
  
      public function anggota_observasi_store(Request $request, $id)
      {
        $this->validate($request, [
            'nama.*' => ['required'],
            'nim.*' => ['required','digits:14','unique:anggota_observasi,nim','unique:observasi,nim','numeric']
        ]);
  
        for ($i = 0; $i < count($request->nim); $i++) {
            Ms_anggota_observasi::create([
                'observasi_id' => $id,
                'nama' => $request->nama[$i],
                'nim' => $request->nim[$i],
            ]);
        }
  
        return redirect("mahasiswa/observasi_kelompok/anggota/$id/add")->with('pesan', "Anggota Kelompok berhasil ditambahkan");
      }
  
      public function anggota_observasi_destroy($id)
      {
        $anggota = Ms_anggota_observasi::find($id);
        $anggota->delete();
  
        return back()->with('pesan','Anggota berhasil dihapus!');
      }

    protected function validateData($request){
        $request->validate([
            'lokasi' => ['required'],
            'kecamatan' => ['required'],
            'nama' => ['required'],
            'nim' => ['required','min:14','numeric'],
            'semester' => ['required','in:I (Satu),II (Dua),III (Tiga),IV (Empat),V (Lima),VI (Enam),VII (Tujuh),VIII (Delapan)'],
            'judul' => ['required'],
            'jenis' => ['required','in:pra penelitian,observasi,penelitian,try out'],
        ]);

        return $request;
    }

    protected function validatedUpdateData($request){
        $request->validate([
            'lokasi' => ['required'],
            'kecamatan' => ['required'],
            'nama' => ['required'],
            'nim' => ['required','min:14','numeric'],
            'semester' => ['required','in:I (Satu),II (Dua),III (Tiga),IV (Empat),V (Lima),VI (Enam),VII (Tujuh),VIII (Delapan)'],
            'judul' => ['required'],
        ]);
    }
}
