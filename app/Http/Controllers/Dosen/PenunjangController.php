<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Ms_penunjang;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PenunjangController extends Controller
{
    // method to show menu of dosen => penunjang
    public function index()
    {
        return view('menu/penunjang.index');
    }

    /*
    |--------------------------------------------------------------------------
    | Sertifikat Penunjang
    |--------------------------------------------------------------------------
    |
    | below is a collection of methods for the "Sertifikat Penunjang" section
    |
    */


    // Sertifikat Penunjang
    // method to show index of Sertifikat Penunjang menu
    public function sertifikat() {
        return view('menu/penunjang/sertifikat.index');
    }

    // method to show form add data
    public function sertifikat_create() {
        return view('menu/penunjang/sertifikat.create');
    }

    // method to store data
    public function sertifikat_store(Request $request) {
        $this->validateData($request);

        $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
        $request->file->move(public_path('berkas'), $fileName);

        Ms_penunjang::create([
            'pengirim' => Auth::user()->email,
            'nomor_dokumen' => $request->nomor_dokumen,
            'nama_dokumen' => $request->nama_dokumen,
            'perihal' => $request->perihal,
            'tanggal' => $request->tanggal,
            'file' => $fileName,
            'keterangan' => 'Sertifikat',
            'jenis_dokumen' => 'sertifikat',
        ]);

        return redirect('/dosen/penunjang/sertifikat')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
    }

    // method to show edit data
    public function sertifikat_edit($id) {
        $sertifikat = Ms_penunjang::findOrFail($id);
        return view('/menu/penunjang/sertifikat.edit', ['sertifikat' => $sertifikat]);
    }

    // method to updated edit data
    public function sertifikat_update(Request $request, $id) {
        $this->validateDataUpdate($request);

        if ($request->file) {
            $sertifikat = Ms_penunjang::findOrFail($id);
            $file = $request->file('file');
            $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
            $request->file->move(public_path('berkas'), $fileName);
            $file->getClientOriginalName();
            $destinationPath = 'berkas';
            File::delete($destinationPath . '/' . $sertifikat->file);

            Ms_penunjang::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
                'file' => $fileName,

            ]);
        } else {
            Ms_penunjang::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
            ]);
        }
        return redirect('/dosen/penunjang/sertifikat')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
    }

    // method to destory data
    public function sertifikat_destroy($id) {
        // Get data
        $sertifikat = Ms_penunjang::find($id);

        // Delete file
        $destinationPath = 'berkas';
        File::delete($destinationPath . '/' . $sertifikat->file);

        // Delet data in DB
        $sertifikat->delete();
        return back()->with('pesan', "Sertifikat Penunjang berhasil dihapus!");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_sertifikat(){
        $collections = Ms_penunjang::orderBy('id','desc')->where("jenis_dokumen","sertifikat")->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/dosen/penunjang/sertifikat/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                    <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
                </div>';
            })
            ->addColumn('tanggal_dokumen', function($row){
                return date('d-m-Y', strtotime($row->tanggal));
            })
            ->addColumn('file', function($row){
                return ' <a target="_blank" class="btn btn-md btn-outline-info"  href="' . asset('berkas') . '/' . $row->file . '"><i class="tf-icons bx bx-file"></i></a>';
            })
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
                'file',
                'nomor_dokumen',
                'tanggal_dokumen',
                'tanggal_upload',
            ])
            ->make(true);
    }

    // Validate Section
    // method to validate request
    protected function validateData($request){
        $request->validate([
            'nomor_dokumen' => ['required','numeric'],
            'nama_dokumen' => ['required'],
            'tanggal' => ['required'],
            'file' => ['required','max:1000','mimes:pdf']
        ]);

        return $request;
    }

    // method to validate request
    protected function validateDataUpdate($request){
        $request->validate([
            'nomor_dokumen' => ['required','numeric'],
            'nama_dokumen' => ['required'],
            'tanggal' => ['required'],
            'file' => ['max:1000','mimes:pdf']
        ]);

        return $request;
    }
}
