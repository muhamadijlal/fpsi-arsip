<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Ms_observasiKelompok;
use App\Models\Ms_anggota_observasiKelompok;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
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
                <a href="/mahasiswa/observasi_kelompok/anggota/'. $row->id .'/add" class="btn btn-icon btn-sm btn-outline-primary"><span class="tf-icons bx bx-plus-medical"></span></a>
                <a href="/mahasiswa/observasi_kelompok/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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

        if($dataValidate->count() > 0){
          return redirect('mahasiswa/observasi_kelompok')->withErrors("Dokumen $request->nama Surat Izin $request->jenis suda ada!");
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
  
        return redirect('mahasiswa/observasi_kelompok')->with('pesan','Dokumen observasi berhasil diajukan!');
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
          return redirect('mahasiswa/observasi_kelompok')->with('pesan','Dokumen observasi berhasil diupdate!');
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
  
        return redirect('mahasiswa/observasi_kelompok')->with('pesan', "Anggota Kelompok berhasil ditambahkan");
      }
  
      public function anggota_observasi_kelompok_destroy($id)
      {
        $anggota = Ms_anggota_observasiKelompok::find($id);
        $anggota->delete();
  
        return back()->with('pesan','Anggota berhasil dihapus!');
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
