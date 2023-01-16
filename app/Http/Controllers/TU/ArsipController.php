<?php

namespace App\Http\Controllers\TU;

use App\Models\Ms_arsiptu;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ArsipController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Arsip Tatausaha
    |--------------------------------------------------------------------------
    |
    | below is a collection of methods for the "Arsip Tatausaha" section
    |
    */

    // Arsip Tatausaha
    // method to show index of Arsip Tatausaha menu
    public function arsip() {
        return view('menu/arsip_tu.index');
    }

    // method to show form add data
    public function arsip_create() {
        return view('menu/arsip_tu.create');
    }

    // method to store data
    public function arsip_store(Request $request) {

        $this->validateData($request);

        $fileName = auth()->user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
        $request->file->move(public_path('arsip_tu'), $fileName);

        Ms_arsiptu::create([
            'pengirim' => Auth::user()->email,
            'nama_dokumen' => $request->nama_dokumen,
            'perihal' => $request->perihal,
            'file' => $fileName,
        ]);

        return redirect('/tu/arsip')->with('pesan', "Arsip berhasil disimpan");
    }

    public function arsip_edit($id){
        
        $collection = Ms_arsiptu::findOrFail($id);

        return view('/menu/arsip_tu.edit', ['arsip' => $collection]);
    }

    public function arsip_update(Request $request, $id){

        $this->validateUpdateData($request);

        if($request->file){
            $arsip_tu = Ms_arsiptu::findOrFail($id);
            $file = $request->file('file');
            $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
            $request->file->move(public_path('arsip_tu'), $fileName);
            $file->getClientOriginalName();
            $destinationPath = 'arsip_tu';
            File::delete($destinationPath . '/' . $arsip_tu->file);
            
            Ms_arsiptu::where('id',$id)->update([
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'file' => $fileName,
            ]);
        }else{
            Ms_arsiptu::where('id', $id)->update([
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
            ]);
        }

        return redirect('/tu/arsip')->with('pesan', "Arsip berhasil diupdate");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_arsip(){
        $collections = Ms_arsiptu::orderBy('id','desc')->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/tu/arsip/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                    <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
                </div>';
            })
            ->addColumn('file', function($row){
                return ' <a target="_blank" class="btn btn-md btn-outline-info" href="' . asset('arsip_tu') . '/' . $row->file . '"><i class="tf-icons bx bx-file"></i></a>';
            })
            ->addColumn('tanggal_upload', function($row){
                return $row->created_at->format('(D-M-Y) H:i:s');
            })
            ->rawColumns([
                '',
                'aksi',
                'file',
                'tanggal_upload',
            ])
            ->make(true);
    }

    public function arsip_destroy($id){
        
        // Get data
        $arsip_tu = Ms_arsiptu::find($id);

        // Delete file
        $destinationPath = 'arsip_tu';
        File::delete($destinationPath . '/' . $arsip_tu->file);

        // Delet data in DB
        $arsip_tu->delete();
        return back()->with('pesan', "Arsip berhasil dihapus!");
    }

    protected function validateData($request) {
        $request->validate([
            'nama_dokumen' => ['required'],
            'file' => ['required','max:1000','mimes:pdf']
        ]);

        return $request;
    }

    protected function validateUpdateData($request) {
        $request->validate([
            'nama_dokumen' => ['required'],
            'file' => ['max:1000','mimes:pdf']
        ]);

        return $request;
    }
}
