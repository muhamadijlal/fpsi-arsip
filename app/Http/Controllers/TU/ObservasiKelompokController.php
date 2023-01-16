<?php

namespace App\Http\Controllers\TU;

use App\Models\Ms_observasiKelompok;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Ms_anggota_observasiKelompok;
use Illuminate\Http\Request;

class ObservasiKelompokController extends Controller
{
  public function observasi_kelompok(){
      return view('menu/observasi_kelompok.index');
    }

    public function observasi_kelompok_dataTable(){
        $collections = Ms_observasiKelompok::orderBy('id','desc')
                                            ->get();

        return datatables()
        ->of($collections)
        ->addColumn('','')
        ->addColumn('aksi', function($row){
            return '
            <div class="d-flex justify-content-around">
              <a href="/tu/observasi_kelompok/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
              <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
              <a href="/tu/observasi_kelompok/anggota/'. $row->id .'/add" class="btn btn-icon btn-sm btn-outline-primary"><span class="tf-icons bx bx-plus-medical"></span></a>
              <a href="/tu/observasi_kelompok/print/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-primary '.isDisplay($row).'"><span class="tf-icons bx bx-printer"></span></a>
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

    public function observasi_kelompok_create(){
        return view('menu/observasi_kelompok.create');
    }

    public function observasi_kelompok_store(Request $request){

      $this->validateData($request);

      // Cek Data
      $dataValidate = Ms_observasiKelompok::where('nim', $request->nim)
                                  ->where('jenis', $request->jenis)
                                  ->where('deleted_at', null)
                                  ->get();

      $validationNumber = Ms_observasiKelompok::where('nomor_dokumen', $request->nomor_dokumen)
                                      ->where('jenis', $request->jenis)
                                      ->get();
      
      // Cek user sudah pernah membuat data dengan jenis yang sama
      if($dataValidate->count() > 0){
        // true
        return redirect('tu/observasi_kelompok')->withErrors("Dokumen $request->nama Observasi $request->jenis suda ada!");

        // Cek Nomor dokumen pada jenis surat tersebut (sudah digunakan/belum)
      }elseif($validationNumber->count() > 0){
        return redirect('tu/observasi_kelompok')->withErrors("Dokumen $request->nomor_dokumen dengan jenis dokumen $request->jenis sudah ada!");

      }else{
        Ms_observasiKelompok::create([
          'pengirim' => Auth::user()->email,
          'agenda' => $request->agenda,
          'tempat' => $request->tempat,
          'alamat' => $request->alamat,
          'nama' => $request->nama,
          'nim' => $request->nim,
          'semester' => $request->semester,
          'pengampu' => $request->pengampu,
          'tanggal' => $request->tanggal,
          'jenis' => $request->jenis
        ]);
      }

      return redirect('tu/observasi_kelompok')->with('pesan','Dokumen observasi berhasil diajukan!');
    }

    public function observasi_kelompok_edit($id){
      $observasi_kelompok = Ms_observasiKelompok::findOrFail($id);

      return view('menu/observasi_kelompok.edit', compact('observasi_kelompok'));
    }

    public function observasi_kelompok_update(Request $request, $id){

      $this->validatedUpdateData($request);

      $record = Ms_observasiKelompok::find($id);

      // Cek Data
      $dataValidate = Ms_observasiKelompok::where('nim', $request->nim)
                                          ->where('jenis', $request->jenis)
                                          ->where('deleted_at', null)
                                          ->get();

      $validationNumber = Ms_observasiKelompok::where('nomor_dokumen', $request->nomor_dokumen)
                                              ->where('jenis', $request->jenis)
                                              ->get();

      // update self record
      if($request->nomor_dokumen != $record->nomor_dokumen){
        if($validationNumber->count() > 0){        
          return redirect('tu/observasi_kelompok')->withErrors("Dokumen Observasu $request->jenis, dengan nomor dokumen $request->nomor_dokumen sudah digunakan!");
        }
      }

      if($request->tempat != $record->tempat || $request->jenis != $record->jenis){
        if($dataValidate->count() > 0){
          return redirect('mahasiswa/observasi_kelompok')->withErrors("Dokumen Observasi Kelompok $request->nama jenis $request->jenis sudah ada");
        }else{
          Ms_observasiKelompok::where('id',$id)->update([
            'nomor_dokumen' => null,
            'agenda' => $request->agenda,
            'tempat' => $request->tempat,
            'alamat' => $request->alamat,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'semester' => $request->semester,
            'pengampu' => $request->pengampu,
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis
          ]);
        }
      }else{
        Ms_observasiKelompok::where('id',$id)->update([
          'nomor_dokumen' => $request->nomor_dokumen,
          'agenda' => $request->agenda,
          'tempat' => $request->tempat,
          'alamat' => $request->alamat,
          'nama' => $request->nama,
          'nim' => $request->nim,
          'semester' => $request->semester,
          'pengampu' => $request->pengampu,
          'tanggal' => $request->tanggal,
          'jenis' => $request->jenis
        ]);
      }

      return redirect('tu/observasi_kelompok')->with('pesan','Dokumen observasi berhasil diupdate!');
    }

    public function observasi_kelompok_destroy($id){
      $observasi = Ms_observasiKelompok::findOrFail($id);

      $observasi->delete();

      return redirect('tu/observasi_kelompok')->with('pesan','Dokumen berhasil dihapus!');
    }

    public function anggota_observasi_kelompok_create($id){

      $observasi_kelompok = Ms_observasiKelompok::find($id);

      return view('menu/observasi_kelompok.index_anggota', compact('observasi_kelompok'));

    }

    public function anggota_observasi_kelompok_store(Request $request, $id)
    {
      $this->validate($request, [
          'nama.*' => ['required'],
          'nim.*' => ['required','digits:14','unique:anggota_observasi_kelompok,nim','unique:observasi_kelompok,nim','numeric']
      ]);

      for ($i = 0; $i < count($request->nim); $i++) {
          Ms_anggota_observasiKelompok::create([
              'observasi_kelompok_id' => $id,
              'nama' => $request->nama[$i],
              'nim' => $request->nim[$i],
          ]);
      }

      return redirect("tu/observasi_kelompok/anggota/$id/add")->with('pesan', "Anggota Kelompok berhasil ditambahkan");
    }

    public function anggota_observasi_kelompok_destroy($id)
    {
      $anggota = Ms_anggota_observasiKelompok::find($id);
      $anggota->delete();

      return back()->with('pesan','Anggota berhasil dihapus!');
    }

    public function observasi_kelompok_print($id){
      $observasi = Ms_observasiKelompok::findOrFail($id);

      if($observasi->jenis_surat === "observasi"){
        return view('/menu/observasi_kelompok/observasi_pdf', compact('observasi'));
      }
      elseif($observasi->jenis_surat === "wawancara")
      {
          return view('/menu/observasi_kelompok/wawancara_pdf', compact('observasi'));
      }
      else
      {
          return view('/menu/observasi_kelompok/survei_pdf', compact('observasi'));
      }
    }

    protected function validateData($request){
        $request->validate([
          'agenda' => ['required'],
          'tempat' => ['required'],
          'alamat' => ['required'],
          'nama' => ['required'],
          'nim' => ['required','digits:14','numeric','unique:observasi_kelompok,nim'],
          'semester' => ['required'],
          'pengampu' => ['required'],
          'tanggal' => ['required'],
          'jenis' => ['required']
        ]);

        return $request;
    }

    protected function validatedUpdateData($request){
        $request->validate([
            'nomor_dokumen' => ['required','numeric','unique:observasi_kelompok,nomor_dokumen,'.$request->id],
            'agenda' => ['required'],
            'tempat' => ['required'],
            'alamat' => ['required'],
            'nama' => ['required'],
            'nim' => ['required','digits:14','numeric','unique:observasi_kelompok,nim,'.$request->id],
            'semester' => ['required'],
            'pengampu' => ['required'],
            'tanggal' => ['required'],
            'jenis' => ['required']
        ]);
    }
}
