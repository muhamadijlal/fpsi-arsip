<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Support\Facades\Auth;
use App\Models\Ms_Konseling;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KonselingController extends Controller
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
    public function konseling() {
        return view('menu/konseling.index');
    }

    // method to show form add data
    public function konseling_create() {
        return view('menu/konseling.create');
    }

    // method to store data
    public function konseling_store(Request $request) {

        $this->validateData($request);

        // Cek Data
        $dataValidate = Ms_Konseling::where('nim', $request->nim)
                                    ->where('deleted_at', null)
                                    ->get();

        if($dataValidate->count() > 0){
            return redirect('/dosen/penunjang/konseling')->withErrors("Dokumen $request->nama Konseling suda ada!");
        }else{
            Ms_konseling::create([
                'pengirim' => Auth::user()->email,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal_awal' => $request->tanggal_awal,
                'tanggal_akhir' => $request->tanggal_akhir,
            ]);
        }

        return redirect('/dosen/penunjang/konseling')->with('pesan', "Surat berhasil disimpan");
    }

    public function konseling_edit($id){
        
        $collection = Ms_konseling::findOrFail($id);

        return view('/menu/konseling.edit', ['konseling' => $collection]);
    }

    public function konseling_update(Request $request, $id){

        $this->validateData($request);

        $record = Ms_konseling::find($id);

        // Cek Data
        $dataValidate = Ms_Konseling::where('nim', $request->nim)
                                    ->where('deleted_at', null)
                                    ->get();

        if($request->perihal != $record->perihal){
          if($dataValidate->count() > 0){
            return redirect('tu/konseling')->withErrors("Dokumen Konseling $request->nama sudah ada");
          }else{
            Ms_konseling::where('id',$id)->update([
              'nomor_dokumen' => null,
              'nama_dokumen' => $request->nama_dokumen,
              'perihal' => $request->perihal,
              'tanggal_awal' => $request->tanggal_awal,
              'tanggal_akhir' => $request->tanggal_akhir,
            ]);
          }
        }else{
          Ms_konseling::where('id',$id)->update([
            'nama_dokumen' => $request->nama_dokumen,
            'perihal' => $request->perihal,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
          ]);
        }

        return redirect('/dosen/penunjang/konseling')->with('pesan', "Dokumen konseling berhasil diupdate");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_konseling(){
        $collections = Ms_konseling::orderBy('id','desc')->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/dosen/penunjang/konseling/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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
                'nomor_dokumen'
            ])
            ->make(true);
    }

    public function konseling_destroy($id){
        
        $collection = Ms_konseling::findOrFail($id);

        $collection->delete();

        return back()->with('pesan', "Surat berhasil dihapus");
    }

    protected function validateData($request) {
        $request->validate([
            'nama_dokumen' => ['required'],
            'perihal' => ['required'],
            'tanggal_akhir' => ['required'],
            'tanggal_awal' => ['required'],
        ]);

        return $request;
    }
}
