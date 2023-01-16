<?php

namespace App\Http\Controllers\TU;

use App\Models\Ms_Dosentamu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'nomor_dokumen' => $request->nomor_dokumen,
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

        return redirect('/tu/dosen/tamu')->with('pesan', "Surat berhasil disimpan");
    }

    public function dosen_tamu_edit($id){
        
        $collection = Ms_Dosentamu::findOrFail($id);

        return view('/menu/dosen_tamu.edit', ['dosen_tamu' => $collection]);
    }

    public function dosen_tamu_update(Request $request, $id){

        $this->validateUpdateData($request);

        Ms_Dosentamu::where('id',$id)->update([
            'nomor_dokumen' => $request->nomor_dokumen,
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

        return redirect('/tu/dosen/tamu')->with('pesan', "Surat berhasil diupdate");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_dosen_tamu(){
        $collections = Ms_Dosentamu::orderBy('id','desc')->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/tu/dosen/tamu/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                    <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
                    <a href="/tu/dosen/tamu/print/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-primary '.isDisplay($row).'"><span class="tf-icons bx bx-printer"></span></a>
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

    public function dosen_tamu_print($id){
        $dosen_tamu = Ms_Dosentamu::findOrFail($id);

        return abort(404);
    }

    protected function validateData($request) {
        $request->validate([
            'nomor_dokumen' => ['required','numeric','unique:dosen_tamu,nomor_dokumen'],
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

    protected function validateUpdateData($request) {
        $request->validate([
            'nomor_dokumen' => ['required','numeric','unique:dosen_tamu,nomor_dokumen,'.$request->id],
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
