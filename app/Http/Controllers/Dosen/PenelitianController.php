<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Support\facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Ms_penelitian;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class PenelitianController extends Controller
{
     // method to show menu of dosen => penelitian
     public function index()
     {
         return view('menu/penelitian.index');
     }
 
     /*
     |--------------------------------------------------------------------------
     | Jurnal Penelitian dan prosiding Section
     |--------------------------------------------------------------------------
     |
     | below is a collection of methods for the "PENELITIAN" section
     |
     */
 
 
     // Jurnal penleitian dan prosiding
     // method to show index of Jurnal penleitian dan prosiding menu
     public function jurnal_pelpro() {
         return view('menu/penelitian/pelpro.index');
     }
 
     // method to show form add data
     public function jurnal_pelpro_create() {
         return view('menu/penelitian/pelpro.create');
     }
 
     // method to store data
     public function jurnal_pelpro_store(Request $request) {
         
         $this->validateData($request);
 
         $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
         $request->file->move(public_path('berkas'), $fileName);
 
         Ms_penelitian::create([
             'pengirim' => Auth::user()->email,
             'nomor_dokumen' => $request->nomor_dokumen,
             'nama_dokumen' => $request->nama_dokumen,
             'perihal' => $request->perihal,
             'tanggal' => $request->tanggal,
             'file' => $fileName,
             'keterangan' => 'Jurnal Penelitian / Prosiding',
             'jenis_dokumen' => 'jurnal_penelitian_prosiding',
         ]);
 
         return redirect('/dosen/penelitian/jurnal/prosiding')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
     }
 
     // method to show edit data
     public function jurnal_pelpro_edit($id) {
         $pelpro = Ms_penelitian::findOrFail($id);
         return view('/menu/penelitian/pelpro.edit', ['pelpro' => $pelpro]);
     }
 
     // method to updated edit data
     public function jurnal_pelpro_update(Request $request, $id) {
         $this->validateDataUpdate($request);
 
         if ($request->file) {
             $pelpro = Ms_penelitian::findOrFail($id);
             $file = $request->file('file');
             $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
             $request->file->move(public_path('berkas'), $fileName);
             $file->getClientOriginalName();
             $destinationPath = 'berkas';
             File::delete($destinationPath . '/' . $pelpro->file);
 
             Ms_penelitian::where('id', $id)->update([
                 'nomor_dokumen' => $request->nomor_dokumen,
                 'nama_dokumen' => $request->nama_dokumen,
                 'perihal' => $request->perihal,
                 'tanggal' => $request->tanggal,
                 'file' => $fileName,
 
             ]);
         } else {
             Ms_penelitian::where('id', $id)->update([
                 'nomor_dokumen' => $request->nomor_dokumen,
                 'nama_dokumen' => $request->nama_dokumen,
                 'perihal' => $request->perihal,
                 'tanggal' => $request->tanggal,
             ]);
         }
         return redirect('/dosen/penelitian/jurnal/prosiding')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
     }
 
     // method to destory data
     public function jurnal_pelpro_destroy($id) {
         // Get data
         $pelpro = Ms_penelitian::find($id);
 
         // Delete file
         $destinationPath = 'berkas';
         File::delete($destinationPath . '/' . $pelpro->file);
 
         // Delet data in DB
         $pelpro->delete();
         return back()->with('pesan', "Jurnal Penelitian / Prosiding berhasil dihapus");
     }
 
     // method to keep and return data from serverside datatable to view
     protected function dataTable_jurnal_pelpro(){
        if(Auth::user()->role != 'root'){
            $collections = Ms_penelitian::orderBy('id','desc')
                                        ->where("pengrim",Auth::user()->email)
                                        ->where("jenis_dokumen","jurnal_penelitian_prosiding")
                                        ->get();
        }else{
            $collections = Ms_penelitian::orderBy('id','desc')
                                        ->where("jenis_dokumen","jurnal_penelitian_prosiding")
                                        ->get();
        }
 
         return datatables()
             ->of($collections)
             ->addColumn('','')
             ->addColumn('aksi', function($row){
                 return '
                 <div class="d-flex justify-content-around">
                     <a href="/dosen/penelitian/jurnal/prosiding/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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
     | Surat Penelitian
     |--------------------------------------------------------------------------
     |
     | below is a collection of methods for the "SURAT PENELITIAN" section
     |
     */
 
 
     // Surat Penelitian
     // method to show index of Surat Penelitian menu
     public function surat_penelitian() {
         return view('menu/penelitian/surat_penelitian.index');
     }
 
     // method to show form add data
     public function surat_penelitian_create() {
         return view('menu/penelitian/surat_penelitian.create');
     }
 
     // method to store data
     public function surat_penelitian_store(Request $request) {
         
         $this->validateData($request);
 
         $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
         $request->file->move(public_path('berkas'), $fileName);
 
         Ms_penelitian::create([
             'pengirim' => Auth::user()->email,
             'nomor_dokumen' => $request->nomor_dokumen,
             'nama_dokumen' => $request->nama_dokumen,
             'perihal' => $request->perihal,
             'tanggal' => $request->tanggal,
             'file' => $fileName,
             'keterangan' => 'Surat Penelitian',
             'jenis_dokumen' => 'surat_penelitian',
         ]);
 
         return redirect('/dosen/penelitian/surat')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
     }
 
     // method to show edit data
     public function surat_penelitian_edit($id) {
         $surat_penelitian = Ms_penelitian::findOrFail($id);
         return view('/menu/penelitian/surat_penelitian.edit', ['surat_penelitian' => $surat_penelitian]);
     }
 
     // method to updated edit data
     public function surat_penelitian_update(Request $request, $id) {
         $this->validateDataUpdate($request);
 
         if ($request->file) {
             $surat_penelitian = Ms_penelitian::findOrFail($id);
             $file = $request->file('file');
             $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
             $request->file->move(public_path('berkas'), $fileName);
             $file->getClientOriginalName();
             $destinationPath = 'berkas';
             File::delete($destinationPath . '/' . $surat_penelitian->file);
 
             Ms_penelitian::where('id', $id)->update([
                 'nomor_dokumen' => $request->nomor_dokumen,
                 'nama_dokumen' => $request->nama_dokumen,
                 'perihal' => $request->perihal,
                 'tanggal' => $request->tanggal,
                 'file' => $fileName,
 
             ]);
         } else {
             Ms_penelitian::where('id', $id)->update([
                 'nomor_dokumen' => $request->nomor_dokumen,
                 'nama_dokumen' => $request->nama_dokumen,
                 'perihal' => $request->perihal,
                 'tanggal' => $request->tanggal,
             ]);
         }
         return redirect('/dosen/penelitian/surat')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
     }
 
     // method to destory data
     public function surat_penelitian_destroy($id) {
         // Get data
         $surat_penelitian = Ms_penelitian::find($id);
 
         // Delete file
         $destinationPath = 'berkas';
         File::delete($destinationPath . '/' . $surat_penelitian->file);
 
         // Delet data in DB
         $surat_penelitian->delete();
         return back()->with('pesan', "Surat Penelitian berhasil dihapus!");
     }
 
     // method to keep and return data from serverside datatable to view
     protected function dataTable_surat_penelitian(){
			if(Auth::user()->role != 'root'){
				$collections = Ms_penelitian::orderBy('id','desc')
																		->where("pengirim",Auth::user()->email)
																		->where("jenis_dokumen","surat_penelitian")
																		->get();
			}else{
				$collections = Ms_penelitian::orderBy('id','desc')
																		->where("jenis_dokumen","surat_penelitian")
																		->get();
			}
 
         return datatables()
             ->of($collections)
             ->addColumn('','')
             ->addColumn('aksi', function($row){
                 return '
                 <div class="d-flex justify-content-around">
                     <a href="/dosen/penelitian/surat/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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
 
     /*
     |--------------------------------------------------------------------------
     | Artikel dan Laporan Penelitian
     |--------------------------------------------------------------------------
     |
     | below is a collection of methods for the "Artikel dan Laporan Penelitian" section
     |
     */
 
 
     // Surat Penelitian
     // method to show index of Surat Penelitian menu
     public function laporan_artikel_penelitian() {
         return view('menu/penelitian/laporan_artikel_penelitian.index');
     }
 
     // method to show form add data
     public function laporan_artikel_penelitian_create() {
         return view('menu/penelitian/laporan_artikel_penelitian.create');
     }
 
     // method to store data
     public function laporan_artikel_penelitian_store(Request $request) {
         
         $this->validateData($request);
 
         $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
         $request->file->move(public_path('berkas'), $fileName);
 
         Ms_penelitian::create([
             'pengirim' => Auth::user()->email,
             'nomor_dokumen' => $request->nomor_dokumen,
             'nama_dokumen' => $request->nama_dokumen,
             'perihal' => $request->perihal,
             'tanggal' => $request->tanggal,
             'file' => $fileName,
             'keterangan' => 'Laporan dan Artikel Penelitian',
             'jenis_dokumen' => 'laporan_artikel_penelitian',
         ]);
 
         return redirect('/dosen/penelitian/laporan/artikel')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
     }
 
     // method to show edit data
     public function laporan_artikel_penelitian_edit($id) {
         $laporan_artikel_penelitian = Ms_penelitian::findOrFail($id);
         return view('/menu/penelitian/laporan_artikel_penelitian.edit', ['laporan_artikel_penelitian' => $laporan_artikel_penelitian]);
     }
 
     // method to updated edit data
     public function laporan_artikel_penelitian_update(Request $request, $id) {
         $this->validateDataUpdate($request);
 
         if ($request->file) {
             $laporan_artikel_penelitian = Ms_penelitian::findOrFail($id);
             $file = $request->file('file');
             $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
             $request->file->move(public_path('berkas'), $fileName);
             $file->getClientOriginalName();
             $destinationPath = 'berkas';
             File::delete($destinationPath . '/' . $laporan_artikel_penelitian->file);
 
             Ms_penelitian::where('id', $id)->update([
                 'nomor_dokumen' => $request->nomor_dokumen,
                 'nama_dokumen' => $request->nama_dokumen,
                 'perihal' => $request->perihal,
                 'tanggal' => $request->tanggal,
                 'file' => $fileName,
 
             ]);
         } else {
             Ms_penelitian::where('id', $id)->update([
                 'nomor_dokumen' => $request->nomor_dokumen,
                 'nama_dokumen' => $request->nama_dokumen,
                 'perihal' => $request->perihal,
                 'tanggal' => $request->tanggal,
             ]);
         }
         return redirect('/dosen/penelitian/laporan/artikel')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
     }
 
     // method to destory data
     public function laporan_artikel_penelitian_destroy($id) {
         // Get data
         $laporan_artikel_penelitian = Ms_penelitian::find($id);
 
         // Delete file
         $destinationPath = 'berkas';
         File::delete($destinationPath . '/' . $laporan_artikel_penelitian->file);
 
         // Delet data in DB
         $laporan_artikel_penelitian->delete();
         return back()->with('pesan', "Laporan dan Artikel Penelitian berhasil dihapus!");
     }
 
     // method to keep and return data from serverside datatable to view
     protected function dataTable_laporan_artikel_penelitian(){
			if(Auth::user()->role == 'root'){
				$collections = Ms_penelitian::orderBy('id','desc')
																		->where("pengirim",Auth::user()->email)
																		->where("jenis_dokumen","laporan_artikel_penelitian")
																		->get();
			}else{
				$collections = Ms_penelitian::orderBy('id','desc')
																		->where("jenis_dokumen","laporan_artikel_penelitian")
																		->get();
			}
        
 
         return datatables()
             ->of($collections)
             ->addColumn('','')
             ->addColumn('aksi', function($row){
                 return '
                 <div class="d-flex justify-content-around">
                     <a href="/dosen/penelitian/laporan/artikel/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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
 
     /*
     |--------------------------------------------------------------------------
     | Surat Tugas Penelitian
     |--------------------------------------------------------------------------
     |
     | below is a collection of methods for the "SURAT TUGAS PENELITIAN" section
     |
     */
 
 
     // Surat Penelitian
     // method to show index of Surat Penelitian menu
     public function surat_tugas_penelitian() {
         return view('menu/penelitian/surat_tugas_penelitian.index');
     }
 
     // method to show form add data
     public function surat_tugas_penelitian_create() {
         return view('menu/penelitian/surat_tugas_penelitian.create');
     }
 
     // method to store data
     public function surat_tugas_penelitian_store(Request $request) {
         
         $this->validateData($request);
 
         $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
         $request->file->move(public_path('berkas'), $fileName);
 
         Ms_penelitian::create([
             'pengirim' => Auth::user()->email,
             'nomor_dokumen' => $request->nomor_dokumen,
             'nama_dokumen' => $request->nama_dokumen,
             'perihal' => $request->perihal,
             'tanggal' => $request->tanggal,
             'file' => $fileName,
             'keterangan' => 'Surat Tugas Penelitian',
             'jenis_dokumen' => 'surat_tugas_penelitian',
         ]);
 
         return redirect('/dosen/penelitian/surat/tugas')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil disimpan");
     }
 
     // method to show edit data
     public function surat_tugas_penelitian_edit($id) {
         $surat_tugas_penelitian = Ms_penelitian::findOrFail($id);
         return view('/menu/penelitian/surat_tugas_penelitian.edit', ['surat_tugas_penelitian' => $surat_tugas_penelitian]);
     }
 
     // method to updated edit data
     public function surat_tugas_penelitian_update(Request $request, $id) {
         $this->validateDataUpdate($request);
 
         if ($request->file) {
             $surat_tugas_penelitian = Ms_penelitian::findOrFail($id);
             $file = $request->file('file');
             $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
             $request->file->move(public_path('berkas'), $fileName);
             $file->getClientOriginalName();
             $destinationPath = 'berkas';
             File::delete($destinationPath . '/' . $surat_tugas_penelitian->file);
 
             Ms_penelitian::where('id', $id)->update([
                 'nomor_dokumen' => $request->nomor_dokumen,
                 'nama_dokumen' => $request->nama_dokumen,
                 'perihal' => $request->perihal,
                 'tanggal' => $request->tanggal,
                 'file' => $fileName,
 
             ]);
         } else {
             Ms_penelitian::where('id', $id)->update([
                 'nomor_dokumen' => $request->nomor_dokumen,
                 'nama_dokumen' => $request->nama_dokumen,
                 'perihal' => $request->perihal,
                 'tanggal' => $request->tanggal,
             ]);
         }
         return redirect('/dosen/penelitian/surat/tugas')->with('pesan', "Arsip dengan nomor dokumen {$request['nomor_dokumen']} berhasil diupdate");
     }
 
     // method to destory data
     public function surat_tugas_penelitian_destroy($id) {
         // Get data
         $surat_tugas_penelitian = Ms_penelitian::find($id);
 
         // Delete file
         $destinationPath = 'berkas';
         File::delete($destinationPath . '/' . $surat_tugas_penelitian->file);
 
         // Delet data in DB
         $surat_tugas_penelitian->delete();
         return back()->with('pesan', "Laporan dan Artikel Penelitian berhasil dihapus!");
     }
 
     // method to keep and return data from serverside datatable to view
     protected function dataTable_surat_tugas_penelitian(){
			if(Auth::user()->role != 'root'){
				$collections = Ms_penelitian::orderBy('id','desc')
																		->where("pengirim",Auth::user()->email)
																		->where("jenis_dokumen","surat_tugas_penelitian")
																		->get();
			}else{
				$collections = Ms_penelitian::orderBy('id','desc')
																		->where("jenis_dokumen","surat_tugas_penelitian")
																		->get();

			}
 
         return datatables()
             ->of($collections)
             ->addColumn('','')
             ->addColumn('aksi', function($row){
                 return '
                 <div class="d-flex justify-content-around">
                     <a href="/dosen/penelitian/surat/tugas/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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
