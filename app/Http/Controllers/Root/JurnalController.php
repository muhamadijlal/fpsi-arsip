<?php

namespace App\Http\Controllers\Root;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ms_history;
use App\Models\Ms_jurnal;

class JurnalController extends Controller
{
  public function jurnal(){
      return view('menu/jurnal.index');
  }

  public function dataTable_jurnal(){
      $collection = Ms_jurnal::orderBy('id','desc')->get();

      return datatables()
            ->of($collection)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
              return '
              <div class="d-flex justify-content-around">
                  <a href="/root/jurnal/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                  <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
                  <a href="/root/jurnal/history/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-primary" title="Tambah History"><span class="tf-icons bx bx-history"></span></a>
              </div>';
            })
            ->addColumn('tanggal_upload', function($row){
              return $row->created_at->format('(D-M-Y) H:i:s');
          })
          ->rawColumns([
              '',
              'aksi',
              'tanggal_upload',
          ])
          ->make(true);
  }

  public function jurnal_create(){
    return view('menu/jurnal.create');
  }

  public function jurnal_store(Request $request){

    $this->validateData($request);

    $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
    $request->file->move(public_path('berkas_kepala'), $fileName);

    Ms_jurnal::create([
      'pengirim' => Auth::user()->email,
      'nama_dokumen' => $request->nama_dokumen,
      'perihal' => $request->perihal,
      'tahun_akademik' => $request->tahun_akademik,
      'file' => $fileName
    ]);

    return redirect('root/jurnal')->with('pesan','Jurnal Berhasil ditambahkan');

  }

  public function jurnal_edit($id){
    $jurnal = Ms_jurnal::findOrFail($id);
    return view('menu/jurnal.edit', compact('jurnal'));
  }

  public function jurnal_update(Request $request, $id){
    
    $this->validateUpdateData($request);

    if($request->file){
      $lainnya = Ms_jurnal::findOrFail($id);
      $file = $request->file('file');
      $fileName = Auth::user()->nama . '_' . date('YmdHis') . '.' . $request->file->extension();
      $request->file->move(public_path('berkas_kepala'), $fileName);
      $file->getClientOriginalName();
      $destinationPath = 'berkas_kepala';
      File::delete($destinationPath . '/' . $lainnya->file);

      Ms_jurnal::where('id',$id)->update([
        'nama_dokumen' => $request->nama_dokumen,
        'perihal' => $request->perihal,
        'tahun_akademik' => $request->tahun_akademik,
        'file' => $fileName
      ]);
    }else{
      Ms_jurnal::where('id',$id)->update([
        'nama_dokumen' => $request->nama_dokumen,
        'perihal' => $request->perihal,
        'tahun_akademik' => $request->tahun_akademik
      ]);
    }

    return redirect('root/jurnal')->with('pesan','Jurnal Berhasil diupdate!');
  }

  public function jurnal_destroy($id){
    // Get data
    $jurnal = Ms_jurnal::find($id);
    $histories = Ms_history::where('jurnal_id',$id)->get();

    // Delete file
    $destinationPath = 'berkas_kepala';
    File::delete($destinationPath . '/' . $jurnal->file);

    // Delet data in DB
    $jurnal->delete();

    foreach($histories as $history){
      $history->delete();
    }

    return back()->with('pesan', "Jurnal berhasil dihapus");
  }

  protected function validateData($request){

    $request->validate([
      'nama_dokumen' => ['required'],
      'perihal' => ['required'],
      'tahun_akademik' => ['required'],
      'file' => ['required','max:1000','mimes:pdf']
    ]);

    return $request;

  }

  public function jurnal_history($id){
    $histories = Ms_history::where('jurnal_id', $id)->orderBy('id','desc')->get();
    
    return view('menu/jurnal.history', compact('id','histories'));
  }

  public function jurnal_history_create($id){
    $jurnal = Ms_jurnal::findOrFail($id);
    return view('menu/jurnal.create_history', compact('jurnal'));
  }

  public function jurnal_history_store(Request $request){
    $this->validateHistory($request);

    Ms_history::create([
      'jurnal_id' => $request->id,
      'pengirim' => Auth::user()->email,
      'catatan' => $request->catatan
    ]);

    return redirect("root/jurnal/history/$request->id")->with('pesan','History berhasil ditambahakan!');
  }

  protected function validateHistory($request){
    $request->validate([
      'catatan' => ['required']
    ]);

    return $request;
  }

  protected function validateUpdateData($request){

    $request->validate([
      'nama_dokumen' => ['required'],
      'perihal' => ['required'],
      'tahun_akademik' => ['required'],
      'file' => ['max:1000','mimes:pdf']
    ]);

    return $request;

  }
}
