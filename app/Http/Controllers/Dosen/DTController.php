<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Ms_Dosentamu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DTController extends Controller
{
        /*
    |--------------------------------------------------------------------------
    | Surat Kunjungan Dosen Tamu
    |--------------------------------------------------------------------------
    |
    | below is a collection of methods for the "SURAT KUNJUNGAN DOSEN TAMU" section
    |
    */

    // Surat Kunjungan Dosen Tamu
    // method to show index of Surat Kunjungan Dosen Tamu menu
    public function dosen_tamu() {
        return view('menu/dosen_tamu.index');
    }

    // method to show form add data
    public function dosen_tamu_create() {
        return view('menu/dosen_tamu.create');
    }

    // method to store data
    public function dosen_tamu_store(Request $request) {

      $this->validateData($request);

      Ms_Dosentamu::create([
          'pengirim' => Auth::user()->email,
          'pemohon' => $request->pemohon,
          'nama_lengkap_gelar' => $request->nama_lengkap_gelar,
          'instansi' => $request->instansi,
          'mata_kuliah' => $request->mata_kuliah,
          'semester' => $request->semester,
          'tanggal' => $request->tanggal,
          'waktu' => $request->waktu,
          'tempat' => $request->tempat,
          'jenis_pelaksanaan' => $request->jenis_pelaksanaan,
      ]);

      return redirect('/dosen/penunjang/dosen/tamu')->with('pesan', "Surat berhasil disimpan");
    }

    public function dosen_tamu_edit($id){
        
        $collection = Ms_Dosentamu::findOrFail($id);

        return view('/menu/dosen_tamu.edit', ['dosen_tamu' => $collection]);
    }

    public function dosen_tamu_update(Request $request, $id){

        $this->validateData($request);

        Ms_Dosentamu::where('id',$id)->update([
            'pemohon' => $request->pemohon,
            'nama_lengkap_gelar' => $request->nama_lengkap_gelar,
            'instansi' => $request->instansi,
            'mata_kuliah' => $request->mata_kuliah,
            'semester' => $request->semester,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'jenis_pelaksanaan' => $request->jenis_pelaksanaan,
        ]);

        return redirect('/dosen/penunjang/dosen/tamu')->with('pesan', "Surat berhasil diupdate");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_dosen_tamu(){
        $collections = Ms_Dosentamu::orderBy('id','desc')
                                    ->where('pengirim', Auth::user()->email)
                                    ->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/dosen/penunjang/dosen/tamu/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                    <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
                </div>';
            })
            ->addColumn('nomor_dokumen', function($row){
                if($row->nomor_dokumen == null){
                    return ' <span class="badge bg-label-warning">Proccess</span> ';
                }else{
                    return $row->nomor_dokumen;
                }
            })
            ->rawColumns([
                '',
                'aksi',
                'nomor_dokumen',
            ])
            ->make(true);
    }

    public function dosen_tamu_destroy($id){
        
        $collection = Ms_Dosentamu::findOrFail($id);

        $collection->delete();

        return back()->with('pesan', "Surat berhasil dihapus");
    }

    protected function validateData($request) {
        $request->validate([
            'pemohon' => ['required'],
            'nama_lengkap_gelar' => ['required'],
            'instansi' => ['required'],
            'mata_kuliah' => ['required'],
            'semester' => ['required'],
            'tanggal' => ['required'],
            'waktu' => ['required'],
            'tempat' => ['required'],
            'jenis_pelaksanaan' => ['required'],
        ]);

        return $request;
    }
}
