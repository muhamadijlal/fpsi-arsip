<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Ms_suratIzin;
use Illuminate\Http\Request;

class SuratIzinController extends Controller
{
  public function surat_izin(){
    return view('menu/surat_izin.index');
  }
  
  public function surat_izin_dataTable(){
    $collections = Ms_suratIzin::orderBy('id','desc')
                              ->get();

    return datatables()
    ->of($collections)
    ->addColumn('','')
    ->addColumn('aksi', function($row){
        return '
        <div class="d-flex justify-content-around">
          <a href="/tu/surat/izin/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
          <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
          <a href="/tu/surat/izin/print/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-primary '.isDisplay($row).'"><span class="tf-icons bx bx-printer"></span></a>
        </div>';
    })
    ->addColumn('jenjang','Sarjana (S1)')
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
        'jenjang',
        'nomor_dokumen',
        'tanggal_upload',
    ])
    ->make(true);

  }
  
  public function surat_izin_create(){
      return view('menu/surat_izin.create');
  }
  
  public function surat_izin_store(Request $request){

    $this->validateData($request);
    
    // Cek Data
    $dataValidate = Ms_suratIzin::where('nim', $request->nim)
                                ->where('jenis', $request->jenis)
                                ->where('deleted_at', null)
                                ->get();

    $validationNumber = Ms_suratIzin::where('nomor_dokumen', $request->nomor_dokumen)
                                    ->where('jenis', $request->jenis)
                                    ->get();

    
    // Cek user sudah pernah membuat data dengan jenis yang sama
    if($dataValidate->count() > 0){
      // true
      return redirect('tu/surat/izin')->withErrors("Dokumen $request->nama Surat Izin $request->jenis suda ada!");

      // Cek Nomor dokumen pada jenis surat tersebut (sudah digunakan/belum)
    }elseif($validationNumber->count() > 0){
      return redirect('tu/surat/izin')->withErrors("Dokumen $request->nomor_dokumen dengan jenis dokumen $request->jenis sudah ada!");

    }else{
      Ms_suratIzin::create([
        'pengirim' => Auth::user()->email,
        'nomor_dokumen' => $request->nomor_dokumen,
        'tujuan' => $request->tujuan,
        'nama' => $request->nama,
        'nim' => $request->nim,
        'semester' => $request->semester,
        'tanggal_awal' => $request->tanggal_awal,
        'tanggal_akhir' => $request->tanggal_akhir,
        'jenis' => $request->jenis
      ]);
    }

    return redirect('tu/surat/izin')->with('pesan','Dokumen Surat Izin berhasil diajukan!');
  }
  
  public function surat_izin_edit($id){
    $surat_izin = Ms_suratIzin::findOrFail($id);

    return view('menu/surat_izin.edit', compact('surat_izin'));
  }
  
  public function surat_izin_update(Request $request, $id){
    $this->validateData($request);

    $record = Ms_suratIzin::find($id);

    $validationNumber = Ms_suratIzin::where('nomor_dokumen', $request->nomor_dokumen)
                                    ->where('jenis', $request->jenis)
                                    ->get();

    $dataValidate = Ms_suratIzin::where('nim', $request->nim)
                                ->where('jenis', $request->jenis)
                                ->where('deleted_at', null)
                                ->get();

    // update self record
    if($request->nomor_dokumen != $record->nomor_dokumen){
      if($validationNumber->count() > 0){        
        return redirect('tu/surat/izin')->withErrors("Surat Izin $request->jenis, dengan nomor dokumen $request->nomor_dokumen sudah digunakan!");
      }
    }

    if($request->tujuan != $record->tujuan || $request->jenis != $record->jenis){
      if($dataValidate->count() > 0){
        return redirect('tu/surat/izin')->withErrors("Surat Izin $request->nama jenis $request->jenis sudah ada");
      }else{
        Ms_suratIzin::where('id',$id)->update([
          'nomor_dokumen' => null,
          'tujuan' => $request->tujuan,
          'nama' => $request->nama,
          'nim' => $request->nim,
          'semester' => $request->semester,
          'tanggal_awal' => $request->tanggal_awal,
          'tanggal_akhir' => $request->tanggal_akhir,
          'jenis' => $request->jenis
        ]);
      }
    }else{
      Ms_suratIzin::where('id',$id)->update([
        'nomor_dokumen' => $request->nomor_dokumen,
        'tujuan' => $request->tujuan,
        'nama' => $request->nama,
        'nim' => $request->nim,
        'semester' => $request->semester,
        'tanggal_awal' => $request->tanggal_awal,
        'tanggal_akhir' => $request->tanggal_akhir,
        'jenis' => $request->jenis
      ]);
    }

    return redirect('tu/surat/izin')->with('pesan',"Dokumen Surat Izin $request->jenis berhasil diupdate!");
  }
  
  public function surat_izin_destroy($id){
    $surat_izin = Ms_suratIzin::findOrFail($id);

    $surat_izin->delete();

    return redirect('tu/surat/izin')->with('pesan','Dokumen berhasil dihapus!');
  }
  
  public function surat_izin_print($id){
    $surat_izin = Ms_suratIzin::findOrFail($id);

    return view('menu/surat_izin.pdf', compact('surat_izin'));
  }
  
  protected function validateData($request){
    $request->validate([
      'nomor_dokumen' => ['required','numeric'],
      'tujuan' => ['required'],
      'nama' => ['required'],
      'nim' => ['required','digits:14','numeric'],
      'semester' => ['required','in:I (Satu),II (Dua),III (Tiga),IV (Empat),V (Lima),VI (Enam),VII (Tujuh),VIII (Delapan)'],
      'tanggal_awal' => ['required'],
      'tanggal_akhir' => ['required'],
      'jenis' => ['required'],
    ]);

      return $request;
  }
}
