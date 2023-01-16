<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Ms_pendidikan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    // method to show menu of dosen => pendidikan
    public function index() {
        return view('menu/pendidikan.index');
    }

    /*
    |--------------------------------------------------------------------------
    | Pembimbing Section
    |--------------------------------------------------------------------------
    |
    | below is a collection of methods for the "PENDIDIKAN" section
    |
    */


    // Pembimbing
    // method to show index of pembimbing menu
    public function pembimbing() {
        return view('menu/pendidikan/pembimbing.index');
    }

    // method to show form add data
    public function pembimbing_create() {
        return view('menu/pendidikan/pembimbing.create');
    }

    // method to store data
    public function pembimbing_store(Request $request) {
        
        $this->validateData($request);

        $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
        $request->file->move(public_path('berkas'), $fileName);

        Ms_pendidikan::create([
            'pengirim' => Auth::user()->email,
            'nomor_dokumen' => $request->nomor_dokumen,
            'nama_dokumen' => $request->nama_dokumen,
            'perihal' => $request->perihal,
            'tanggal' => $request->tanggal,
            'file' => $fileName,
            'keterangan' => 'SK Pembimbing',
            'jenis_dokumen' => 'sk_pembimbing',
        ]);

        return redirect('/root/pendidikan/pembimbing')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
    }

    // method to show edit data
    public function pembimbing_edit($id) {
        $pembimbing = Ms_Pendidikan::findOrFail($id);
        return view('/menu/pendidikan/pembimbing.edit', ['pembimbing' => $pembimbing]);
    }

    // method to updated edit data
    public function pembimbing_update(Request $request, $id) {
        $this->validateDataUpdate($request);

        if ($request->file) {
            $pembimbing = Ms_Pendidikan::findOrFail($id);
            $file = $request->file('file');
            $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
            $request->file->move(public_path('berkas'), $fileName);
            $file->getClientOriginalName();
            $destinationPath = 'berkas';
            File::delete($destinationPath . '/' . $pembimbing->file);

            Ms_Pendidikan::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
                'file' => $fileName,

            ]);
        } else {
            Ms_Pendidikan::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
            ]);
        }
        return redirect('/root/pendidikan/pembimbing')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
    }

    // method to destory data
    public function pembimbing_destroy($id) {
        // Get data
        $pembimbing = Ms_Pendidikan::find($id);

        // Delete file
        $destinationPath = 'berkas';
        File::delete($destinationPath . '/' . $pembimbing->file);

        // Delet data in DB
        $pembimbing->delete();
        return back()->with('pesan', "SK Pembimbing berhasil dihapus");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_pembimbing(){        
        $collections = Ms_pendidikan::orderBy('id','desc')
                                    ->where("jenis_dokumen","sk_pembimbing")
                                    ->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/root/pendidikan/pembimbing/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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
    | Jadwal Kuliah Section
    |--------------------------------------------------------------------------
    |
    | below is a collection of methods for the "JADWAL KULIAH" section
    |
    */

    // Jadwal Kuliah
    // method to show index of Jadwal Kuliah menu
    public function jadwal_kuliah() {
        return view('menu/pendidikan/jadwal_kuliah.index');
    }

    // method to show form add data
    public function jadwal_kuliah_create() {
        return view('menu/pendidikan/jadwal_kuliah.create');
    }

    // method to store data
    public function jadwal_kuliah_store(Request $request) {
        
        $this->validateData($request);

        $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
        $request->file->move(public_path('berkas'), $fileName);

        Ms_pendidikan::create([
            'pengirim' => Auth::user()->email,
            'nomor_dokumen' => $request->nomor_dokumen,
            'nama_dokumen' => $request->nama_dokumen,
            'perihal' => $request->perihal,
            'tanggal' => $request->tanggal,
            'file' => $fileName,
            'keterangan' => 'SK Jadwal Kuliah',
            'jenis_dokumen' => 'sk_jadwal_kuliah',
        ]);

        return redirect('/root/pendidikan/jadwal_kuliah')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
    }

    // method to show edit data
    public function jadwal_kuliah_edit($id) {
        $jadwal_kuliah = Ms_Pendidikan::findOrFail($id);
        return view('/menu/pendidikan/jadwal_kuliah.edit', ['jadwal_kuliah' => $jadwal_kuliah]);
    }

    // method to updated edit data
    public function jadwal_kuliah_update(Request $request, $id) {

        $this->validateDataUpdate($request);

        if ($request->file) {
            $jadwal_kuliah = Ms_Pendidikan::findOrFail($id);
            $file = $request->file('file');
            $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
            $request->file->move(public_path('berkas'), $fileName);
            $file->getClientOriginalName();
            $destinationPath = 'berkas';
            File::delete($destinationPath . '/' . $jadwal_kuliah->file);

            Ms_Pendidikan::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
                'file' => $fileName,

            ]);
        } else {
            Ms_Pendidikan::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
            ]);
        }
        return redirect('/root/pendidikan/jadwal_kuliah')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
    }

    // method to destory data
    public function jadwal_kuliah_destroy($id) {
        // Get data
        $jadwal_kuliah = Ms_Pendidikan::find($id);

        // Delete file
        $destinationPath = 'berkas';
        File::delete($destinationPath . '/' . $jadwal_kuliah->file);

        // Delet data in DB
        $jadwal_kuliah->delete();
        return back()->with('pesan', "SK Jadwal Kuliah berhasil dihapus");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_jadwal_kuliah(){
        $collections = Ms_pendidikan::orderBy('id','desc')
                                    ->where("jenis_dokumen","sk_jadwal_kuliah")
                                    ->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/root/pendidikan/jadwal_kuliah/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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
    | Yudisium Section
    |--------------------------------------------------------------------------
    |
    | below is a collection of methods for the "YUDISIUM" section
    |
    */

    // Yudisium
    // method to show index of Yudisium menu
    public function yudisium() {
        return view('menu/pendidikan/yudisium.index');
    }

    // method to show form add data
    public function yudisium_create() {
        return view('menu/pendidikan/yudisium.create');
    }

    // method to store data
    public function yudisium_store(Request $request) {
        
        $this->validateData($request);

        $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
        $request->file->move(public_path('berkas'), $fileName);

        Ms_pendidikan::create([
            'pengirim' => Auth::user()->email,
            'nomor_dokumen' => $request->nomor_dokumen,
            'nama_dokumen' => $request->nama_dokumen,
            'perihal' => $request->perihal,
            'tanggal' => $request->tanggal,
            'file' => $fileName,
            'keterangan' => 'SK Yudisium',
            'jenis_dokumen' => 'sk_yudisium',
        ]);

        return redirect('/root/pendidikan/yudisium')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
    }

    // method to show edit data
    public function yudisium_edit($id) {
        $yudisium = Ms_Pendidikan::findOrFail($id);
        return view('/menu/pendidikan/yudisium.edit', ['yudisium' => $yudisium]);
    }

    // method to updated edit data
    public function yudisium_update(Request $request, $id) {

        $this->validateDataUpdate($request);

        if ($request->file) {
            $yudisium = Ms_Pendidikan::findOrFail($id);
            $file = $request->file('file');
            $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
            $request->file->move(public_path('berkas'), $fileName);
            $file->getClientOriginalName();
            $destinationPath = 'berkas';
            File::delete($destinationPath . '/' . $yudisium->file);

            Ms_Pendidikan::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
                'file' => $fileName,

            ]);
        } else {
            Ms_Pendidikan::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
            ]);
        }
        return redirect('/root/pendidikan/yudisium')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
    }

    // method to destory data
    public function yudisium_destroy($id) {
        // Get data
        $yudisium = Ms_Pendidikan::find($id);

        // Delete file
        $destinationPath = 'berkas';
        File::delete($destinationPath . '/' . $yudisium->file);

        // Delet data in DB
        $yudisium->delete();
        return back()->with('pesan', "SK Yudisium berhasil dihapus");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_yudisium(){
        $collections = Ms_pendidikan::orderBy('id','desc')
                                    ->where("jenis_dokumen","sk_yudisium")
                                    ->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/root/pendidikan/yudisium/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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
    | Koorprodi Section
    |--------------------------------------------------------------------------
    |
    | below is a collection of methods for the "KOORPRODI" section
    |
    */

    // Koorprodi
    // method to show index of Koorprodi menu
    public function koorprodi() {
        return view('menu/pendidikan/koorprodi.index');
    }

    // method to show form add data
    public function koorprodi_create() {
        return view('menu/pendidikan/koorprodi.create');
    }

    // method to store data
    public function koorprodi_store(Request $request) {
        
        $this->validateData($request);

        $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
        $request->file->move(public_path('berkas'), $fileName);

        Ms_pendidikan::create([
            'pengirim' => Auth::user()->email,
            'nomor_dokumen' => $request->nomor_dokumen,
            'nama_dokumen' => $request->nama_dokumen,
            'perihal' => $request->perihal,
            'tanggal' => $request->tanggal,
            'file' => $fileName,
            'keterangan' => 'SK Koordinator dan Program Studi',
            'jenis_dokumen' => 'sk_koordinator_prodi',
        ]);

        return redirect('/root/pendidikan/koorprodi')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
    }

    // method to show edit data
    public function koorprodi_edit($id) {
        $koorprodi = Ms_Pendidikan::findOrFail($id);
        return view('/menu/pendidikan/koorprodi.edit', ['koorprodi' => $koorprodi]);
    }

    // method to updated edit data
    public function koorprodi_update(Request $request, $id) {

        $this->validateDataUpdate($request);

        if ($request->file) {
            $koorprodi = Ms_Pendidikan::findOrFail($id);
            $file = $request->file('file');
            $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
            $request->file->move(public_path('berkas'), $fileName);
            $file->getClientOriginalName();
            $destinationPath = 'berkas';
            File::delete($destinationPath . '/' . $koorprodi->file);

            Ms_Pendidikan::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
                'file' => $fileName,

            ]);
        } else {
            Ms_Pendidikan::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
            ]);
        }
        return redirect('/root/pendidikan/koorprodi')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
    }

    // method to destory data
    public function koorprodi_destroy($id) {
        // Get data
        $koorprodi = Ms_Pendidikan::find($id);

        // Delete file
        $destinationPath = 'berkas';
        File::delete($destinationPath . '/' . $koorprodi->file);

        // Delet data in DB
        $koorprodi->delete();
        return back()->with('pesan', "SK Koorprodi berhasil dihapus");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_koorprodi(){
        $collections = Ms_pendidikan::orderBy('id','desc')
                                    ->where("jenis_dokumen","sk_koordinator_prodi")
                                    ->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/root/pendidikan/koorprodi/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                    <button class="btn btn-icon btn-sm btn-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
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

    /*
    |--------------------------------------------------------------------------
    | Lainnya Section
    |--------------------------------------------------------------------------
    |
    | below is a collection of methods for the "LAINNYA" section
    |
    */

    // lainnya
    // method to show index of lainnya menu
    public function lainnya() {
        return view('menu/pendidikan/lainnya.index');
    }

    // method to show form add data
    public function lainnya_create() {
        return view('menu/pendidikan/lainnya.create');
    }

    // method to store data
    public function lainnya_store(Request $request) {
        
        $this->validateData($request);

        $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
        $request->file->move(public_path('berkas'), $fileName);

        Ms_pendidikan::create([
            'pengirim' => Auth::user()->email,
            'nomor_dokumen' => $request->nomor_dokumen,
            'nama_dokumen' => $request->nama_dokumen,
            'perihal' => $request->perihal,
            'tanggal' => $request->tanggal,
            'file' => $fileName,
            'keterangan' => 'SK Lainnya',
            'jenis_dokumen' => 'sk_lainnya',
        ]);

        return redirect('/root/pendidikan/lainnya')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
    }

    // method to show edit data
    public function lainnya_edit($id) {
        $lainnya = Ms_Pendidikan::findOrFail($id);
        return view('/menu/pendidikan/lainnya.edit', ['lainnya' => $lainnya]);
    }

    // method to updated edit data
    public function lainnya_update(Request $request, $id) {

        $this->validateDataUpdate($request);

        if ($request->file) {
            $lainnya = Ms_Pendidikan::findOrFail($id);
            $file = $request->file('file');
            $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
            $request->file->move(public_path('berkas'), $fileName);
            $file->getClientOriginalName();
            $destinationPath = 'berkas';
            File::delete($destinationPath . '/' . $lainnya->file);

            Ms_Pendidikan::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
                'file' => $fileName,

            ]);
        } else {
            Ms_Pendidikan::where('id', $id)->update([
                'nomor_dokumen' => $request->nomor_dokumen,
                'nama_dokumen' => $request->nama_dokumen,
                'perihal' => $request->perihal,
                'tanggal' => $request->tanggal,
            ]);
        }
        return redirect('/root/pendidikan/lainnya')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
    }

    // method to destory data
    public function lainnya_destroy($id) {
        // Get data
        $lainnya = Ms_Pendidikan::find($id);

        // Delete file
        $destinationPath = 'berkas';
        File::delete($destinationPath . '/' . $lainnya->file);

        // Delet data in DB
        $lainnya->delete();
        return back()->with('pesan', "SK lainnya berhasil dihapus");
    }

    // method to keep and return data from serverside datatable to view
    protected function dataTable_lainnya(){
        $collections = Ms_pendidikan::orderBy('id','desc')
                                    ->where("jenis_dokumen","sk_lainnya")
                                    ->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/root/pendidikan/lainnya/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                    <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
                </div>';
            })
            ->addColumn('tanggal_dokumen', function($row){
                return date('d-m-Y', strtotime($row->tanggal));
            })
            ->addColumn('nomor_dokumen', function($row){
                if($row->nomor_dokumen == null){
                    return ' <span class="badge bg-label-warning">Proccess</span> ';
                }else{
                    return $row->nomor_dokumen;
                }
            })
            ->addColumn('file', function($row){
                return ' <a target="_blank" class="btn btn-md btn-outline-info"  href="' . asset('berkas') . '/' . $row->file . '"><i class="tf-icons bx bx-file"></i></a>';
            })
            ->addColumn('tanggal_upload', function($row){
                return $row->created_at->format('(D-M-Y) H:i:s');
            })
            ->rawColumns([
                '',
                'aksi',
                'nomor_dokumen',
                'file',
                'tanggal_dokumen',
                'tanggal_upload',
            ])
            ->make(true);
    }

    // Validate Section
    // method to validate request
    protected function validateData($request){
        $request->validate([
            'nomor_dokumen' => ['required'],
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
