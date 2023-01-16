<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Ms_legalisasi;
use Illuminate\Support\Facades\Auth;
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

    public function legalisasi_create(){
        return view('menu/legalisasi_ijazah.create');
    }

    public function legalisasi_store(Request $request){

        $this->validateData($request);

        Ms_legalisasi::create([
            'pengirim' => Auth::user()->email,
            'nomor_ijazah' => $request->nomor_ijazah,
            'tahun_lulus' => $request->tahun_lulus,
            'tanggal_lulus' => $request->tanggal_lulus,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/mahasiswa/legalisasi/ijazah')->with('pesan','Permintaan legalisasi ijazah berhasil diajukan!');
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
            'nama' => $request->nama,
            'keterangan' => $request->keterangan
        ]);

        return redirect('/mahasiswa/legalisasi/ijazah')->with('pesan', "Dokumen legalisasi berhasil diupdate!");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_legalisasi(){
        $collections = Ms_legalisasi::where('pengirim', Auth::user()->email)->orderBy('id','desc')->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/mahasiswa/legalisasi/ijazah/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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

    protected function validateData($request) {
        $request->validate([
            'nomor_ijazah' => ['required','unique:legalisasi,nomor_ijazah,'.$request->id],
            'tahun_lulus' => ['required','digits:4','numeric'],
            'tanggal_lulus' => ['required'],
            'nama' => ['required'],
            'keterangan' => ['required']
        ]);

        return $request;
    }
}
