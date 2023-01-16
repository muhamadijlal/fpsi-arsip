<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Ms_pengabdian;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PengabdianController extends Controller
{
    // method to show menu of dosen => pengabdian
    public function index()
    {
        return view('menu/pengabdian.index');
    }

    /*
    |--------------------------------------------------------------------------
    | Artikel dan Laporan Pengabdian
    |--------------------------------------------------------------------------
    |
    | below is a collection of methods for the "Artikel dan Laporan Pengabdian" section
    |
    */


    // Laporan dan artikel pengabdian
    // method to show index of Laporan dan artikel pengabdian menu
    public function laporan_artikel_pengabdian() {
        return view('menu/pengabdian/laporan_artikel_pengabdian.index');
    }

    // method to show form add data
    public function laporan_artikel_pengabdian_create() {
        return view('menu/pengabdian/laporan_artikel_pengabdian.create');
    }

    // method to store data
    public function laporan_artikel_pengabdian_store(Request $request) {
        
        $this->validateData($request);

        $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
        $request->file->move(public_path('berkas'), $fileName);

        Ms_pengabdian::create([
            'pengirim' => Auth::user()->email,
            'nomor_dokumen' => $request->nomor_dokumen,
            'nama_dokumen' => $request->nama_dokumen,
            'perihal' => $request->perihal,
            'tanggal' => $request->tanggal,
            'file' => $fileName,
            'keterangan' => 'Laporan dan Artikel Pengabdian',
            'jenis_dokumen' => 'laporan_artikel_pengabdian',
        ]);

        return redirect('/dosen/pengabdian/laporan/artikel')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
    }

    // method to show edit data
    public function laporan_artikel_pengabdian_edit($id) {
        $laporan_artikel_pengabdian = Ms_pengabdian::findOrFail($id);
        return view('/menu/pengabdian/laporan_artikel_pengabdian.edit', ['laporan_artikel_pengabdian' => $laporan_artikel_pengabdian]);
    }

    // method to updated edit data
    public function laporan_artikel_pengabdian_update(Request $request, $id) {
        $this->validateDataUpdate($request);

        if ($request->file) {
            $laporan_artikel_pengabdian = Ms_pengabdian::findOrFail($id);
            $file = $request->file('file');
            $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
            $request->file->move(public_path('berkas'), $fileName);
            $file->getClientOriginalName();
            $destinationPath = 'berkas';
            File::delete($destinationPath . '/' . $laporan_artikel_pengabdian->file);

            Ms_pengabdian::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
                'file' => $fileName,

            ]);
        } else {
            Ms_pengabdian::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
            ]);
        }
        return redirect('/dosen/pengabdian/laporan/artikel')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
    }

    // method to destory data
    public function laporan_artikel_pengabdian_destroy($id) {
        // Get data
        $laporan_artikel_pengabdian = Ms_pengabdian::find($id);

        // Delete file
        $destinationPath = 'berkas';
        File::delete($destinationPath . '/' . $laporan_artikel_pengabdian->file);

        // Delet data in DB
        $laporan_artikel_pengabdian->delete();
        return back()->with('pesan', "Laporan dan Artikel Pengabdian berhasil dihapus!");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_laporan_artikel_pengabdian(){
        if(Auth::user()->role != 'root'){
            $collections = Ms_pengabdian::orderBy('id','desc')
                                        ->where("pengirim",Auth::user()->email)
                                        ->where("jenis_dokumen","laporan_artikel_pengabdian")
                                        ->get();
        }else{
            $collections = Ms_pengabdian::orderBy('id','desc')
                                        ->where("jenis_dokumen","laporan_artikel_pengabdian")
                                        ->get();
        }

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/dosen/pengabdian/laporan/artikel/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                    <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
                </div>';
            })
            ->addColumn('tanggal_dokumen', function($row){
                return date('d-m-Y', strtotime($row->tanggal));
            })
            ->addColumn('file', function($row){
                return ' <a target="_blank" class="btn btn-md btn-outline-info" href="' . asset('berkas') . '/' . $row->file . '"><i class="tf-icons bx bx-file"></i></a>';
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

    /*
    |--------------------------------------------------------------------------
    | Laporan Tanpa Prosiding
    |--------------------------------------------------------------------------
    |
    | below is a collection of methods for the "Laporan Tanpa Prosiding" section
    |
    */


    // Laporan dan artikel pengabdian
    // method to show index of Laporan dan artikel pengabdian menu
    public function laporan_tanpa_prosiding() {
        return view('menu/pengabdian/laporan_tanpa_prosiding.index');
    }

    // method to show form add data
    public function laporan_tanpa_prosiding_create() {
        return view('menu/pengabdian/laporan_tanpa_prosiding.create');
    }

    // method to store data
    public function laporan_tanpa_prosiding_store(Request $request) {
        
        $this->validateData($request);

        $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
        $request->file->move(public_path('berkas'), $fileName);

        Ms_pengabdian::create([
            'pengirim' => Auth::user()->email,
            'nomor_dokumen' => $request->nomor_dokumen,
            'nama_dokumen' => $request->nama_dokumen,
            'perihal' => $request->perihal,
            'tanggal' => $request->tanggal,
            'file' => $fileName,
            'keterangan' => 'Laporan dan Artikel Pengabdian',
            'jenis_dokumen' => 'laporan_tanpa_prosiding',
        ]);

        return redirect('/dosen/pengabdian/laporan/tanpa/prosiding')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
    }

    // method to show edit data
    public function laporan_tanpa_prosiding_edit($id) {
        $laporan_tanpa_prosiding = Ms_pengabdian::findOrFail($id);
        return view('/menu/pengabdian/laporan_tanpa_prosiding.edit', ['laporan_tanpa_prosiding' => $laporan_tanpa_prosiding]);
    }

    // method to updated edit data
    public function laporan_tanpa_prosiding_update(Request $request, $id) {
        $this->validateDataUpdate($request);

        if ($request->file) {
            $laporan_tanpa_prosiding = Ms_pengabdian::findOrFail($id);
            $file = $request->file('file');
            $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
            $request->file->move(public_path('berkas'), $fileName);
            $file->getClientOriginalName();
            $destinationPath = 'berkas';
            File::delete($destinationPath . '/' . $laporan_tanpa_prosiding->file);

            Ms_pengabdian::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
                'file' => $fileName,

            ]);
        } else {
            Ms_pengabdian::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
            ]);
        }
        return redirect('/dosen/pengabdian/laporan/tanpa/prosiding')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
    }

    // method to destory data
    public function laporan_tanpa_prosiding_destroy($id) {
        // Get data
        $laporan_tanpa_prosiding = Ms_pengabdian::find($id);

        // Delete file
        $destinationPath = 'berkas';
        File::delete($destinationPath . '/' . $laporan_tanpa_prosiding->file);

        // Delet data in DB
        $laporan_tanpa_prosiding->delete();
        return back()->with('pesan', "Laporan tanpa Prosiding berhasil dihapus!");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_laporan_tanpa_prosiding(){
        if(Auth::user()->role != 'root'){
            $collections = Ms_pengabdian::orderBy('id','desc')
                                        ->where("pengirim",Auth::user()->email)
                                        ->where("jenis_dokumen","laporan_tanpa_prosiding")
                                        ->get();
        }else{
            $collections = Ms_pengabdian::orderBy('id','desc')
                                        ->where("jenis_dokumen","laporan_tanpa_prosiding")
                                        ->get();
        }

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/dosen/pengabdian/laporan/tanpa/prosiding/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                    <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
                </div>';
            })
            ->addColumn('tanggal_dokumen', function($row){
                return date('d-m-Y', strtotime($row->tanggal));
            })
            ->addColumn('file', function($row){
                return ' <a target="_blank" class="btn btn-md btn-outline-info" href="' . asset('berkas') . '/' . $row->file . '"><i class="tf-icons bx bx-file"></i></a>';
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
