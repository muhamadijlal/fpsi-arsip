<?php

namespace App\Http\Controllers\TU;

use App\Models\Ms_legalisasi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LegalisasiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Legalisasi Ijazah TU
    |--------------------------------------------------------------------------
    |
    | below is a collection of methods for the "Legalisasi Ijazah TU" section
    |
    */

    // Legalisasi Ijazah TU
    // method to show index of Legalisasi Ijazah TU menu
    public function legalisasi() {
        return view('menu/legalisasi_ijazah.index');
    }   

    public function legalisasi_edit($id){
        
        $collection = Ms_legalisasi::findOrFail($id);

        return view('/menu/legalisasi_ijazah.edit', ['legalisasi' => $collection]);
    }

    public function legalisasi_update(Request $request, $id){

        $this->validateData($request);

        Ms_legalisasi::where('id',$id)->update([
            'nomor_legalisasi' => $request->nomor_legalisasi,
            'nomor_ijazah' => $request->nomor_ijazah,
            'tahun_lulus' => $request->tahun_lulus,
            'tanggal_lulus' => $request->tanggal_lulus,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/tu/legalisasi/ijazah')->with('pesan', "Dokumen legalisasi berhasil diupdate!");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_legalisasi(){
        $collections = Ms_legalisasi::orderBy('id','desc')->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/tu/legalisasi/ijazah/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                    <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
                </div>';
            })
            ->addColumn('nomor_legalisasi', function($row){
                if($row->nomor_legalisasi == ''){
                    return ' <span class="badge bg-label-warning">Proccess</span> ';
                }else{
                    return $row->nomor_legalisasi;
                }
            })
            ->rawColumns([
                '',
                'aksi',
                'nomor_legalisasi',
            ])
            ->make(true);
    }

    public function legalisasi_print(){
        $legalisasi = Ms_legalisasi::all();

        if($legalisasi->count() == 0){
            return back()->with('error','Tidak dapat cetak, data tidak ditemukan!');
        }

        return view('/menu/legalisasi_ijazah.pdf', compact('legalisasi'));
    }

    public function legalisasi_destroy($id){
        
        $collection = Ms_legalisasi::findOrFail($id);

        $collection->delete();

        return back()->with('pesan', "Data dengan nomor legalisasi {$collection['nomor_legalisasi']} berhasil dihapus");
    }

    protected function validateData($request) {
        $request->validate([
            'nomor_legalisasi' => ['required','numeric','unique:legalisasi,nomor_legalisasi,'.$request->id],
            'nomor_ijazah' => ['required','unique:legalisasi,nomor_ijazah,'.$request->id],
            'tahun_lulus' => ['required','digits:4','numeric'],
            'tanggal_lulus' => ['required'],
            'keterangan' => ['required']
        ]);

        return $request;
    }
}
