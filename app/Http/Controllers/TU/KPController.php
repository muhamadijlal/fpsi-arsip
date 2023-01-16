<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Models\Ms_kerjaPraktik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KPController extends Controller
{
  public function index(){
      return view('menu/kerja_praktik.index');
  }

  public function kerja_praktik_umum(){
      return view('menu/kerja_praktik/umum.index');
  }

  public function kerja_praktik_umum_create(){
    return view('menu/kerja_praktik/umum.create');
  }

  public function kerja_praktik_umum_store(Request $request){
    $this->validateDataUmum($request);

    // Cek Data
    $dataValidate = Ms_kerjaPraktik::where('nim', $request->nim)
                                ->where('jenis_kp', 'umum')
                                ->where('deleted_at', null)
                                ->get();

    $validationNumber = Ms_kerjaPraktik::where('nomor_dokumen', $request->nomor_dokumen)
                                    ->where('jenis_kp', 'umum')
                                    ->where('deleted_at', null)
                                    ->get();

    // Cek user sudah pernah membuat data dengan jenis yang sama
    if($dataValidate->count() > 0){
      // true
      return redirect('tu/kerja/praktik/umum')->withErrors("Dokumen $request->nama kerja praktik umum sudah ada!");

    // Cek Nomor dokumen pada jenis surat tersebut (sudah digunakan/belum)
    }elseif($validationNumber->count() > 0){
      return redirect('tu/kerja/praktik/umum')->withErrors("Dokumen $request->nomor_dokumen dengan jenis dokumen $request->jenis sudah ada!");
    }else{
      Ms_kerjaPraktik::create([
        'pengirim' => Auth::user()->email,
        'nomor_dokumen' =>$request->nomor_dokumen,
        'tempat' => $request->tempat,
        'nama' => $request->nama,
        'nim' => $request->nim,
        'jenis_kp' => 'umum'
      ]);
    }

    return redirect('tu/kerja/praktik/umum')->with('pesan','Dokumen Kerja Praktik Berhasil diajukan!');
  }

  public function kerja_praktik_umum_edit($id){
    $kp = Ms_kerjaPraktik::findOrFail($id);

    return view('menu/kerja_praktik/umum.edit', compact('kp'));
  }

  public function kerja_praktik_umum_update(Request $request, $id){
    $this->validateUpdateDataUmum($request);
    
    $record = Ms_kerjaPraktik::find($id);

    $validationNumber = Ms_kerjaPraktik::where('nomor_dokumen', $request->nomor_dokumen)
                                      ->where('jenis_kp', 'umum')
                                      ->get();

    $dataValidate = Ms_kerjaPraktik::where('nim', $request->nim)
                                ->where('jenis_kp', 'umum')
                                ->where('deleted_at', null)
                                ->get();

    // update self record
    if($request->nomor_dokumen != $record->nomor_dokumen){
      if($validationNumber->count() > 0){        
        return redirect('tu/kerja/praktik/umum')->withErrors("Surat Izin $request->jenis, dengan nomor dokumen $request->nomor_dokumen sudah digunakan!");
      }
    }

    if($request->tempat != $record->tempat){
      if($dataValidate->count() > 0){
        return redirect('tu/kerja/praktik/umum')->withErrors("Dokumen Kerja Praktik $request->nama jenis $request->jenis_kp sudah ada");
      }else{
        Ms_kerjaPraktik::where('id',$id)->update([
          'nomor_dokumen' => null,
          'tempat' => $request->tempat,
          'nama' => $request->nama,
          'nim' => $request->nim,
        ]);
      }
    }else{
      Ms_kerjaPraktik::where('id',$id)->update([
        'nomor_dokumen' => $request->nomor_dokumen,
        'tempat' => $request->tempat,
        'nama' => $request->nama,
        'nim' => $request->nim,
      ]);
    }

    return redirect('tu/kerja/praktik/umum')->with('pesan','Dokumen Kerja Praktik Berhasil diupdate!');
  }

  public function kerja_praktik_umum_destroy($id){
    $kp = Ms_kerjaPraktik::findOrFail($id);

    $kp->delete();

    return redirect('tu/kerja/praktik/umum')->with('pesan','Dokumen Kerja Praktik Berhasil dihapus!');
  }

  public function kerja_praktik_dataTable_umum(){
    $collections = Ms_kerjaPraktik::where('jenis_kp','umum')
                                  ->orderBy('id','desc')
                                  ->get();

    return datatables()
        ->of($collections)
        ->addColumn('','')
        ->addColumn('aksi', function($row){
            return '
            <div class="d-flex justify-content-around">
                <a href="/tu/kerja/praktik/umum/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
                <a href="/tu/kerja/praktik/umum/print/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-primary '.isDisplay($row).'"><span class="tf-icons bx bx-printer"></span></a>
            </div>';
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
            'nomor_dokumen',
            'tanggal_upload',
        ])
        ->make(true);
  }

  // Dinas
  public function kerja_praktik_dinas(){
      return view('menu/kerja_praktik/dinas.index');
  }

  public function kerja_praktik_dinas_create(){
    return view('menu/kerja_praktik/dinas.create');
  }

  public function kerja_praktik_dinas_store(Request $request){
    $this->validateDataDinas($request);
    
    // Cek Data
    $dataValidate = Ms_kerjaPraktik::where('nim', $request->nim)
                                ->where('jenis_kp', 'dinas')
                                ->where('deleted_at', null)
                                ->get();

    $validationNumber = Ms_kerjaPraktik::where('nomor_dokumen', $request->nomor_dokumen)
                                    ->where('jenis_kp', 'dinas')
                                    ->where('deleted_at', null)
                                    ->get();

    // Cek user sudah pernah membuat data dengan jenis yang sama
    if($dataValidate->count() > 0){
      // true
      return redirect('tu/kerja/praktik/dinas')->withErrors("Dokumen $request->nama kerja praktik dinas suda ada!");

    // Cek Nomor dokumen pada jenis surat tersebut (sudah digunakan/belum)
    }elseif($validationNumber->count() > 0){
      return redirect('tu/kerja/praktik/dinas')->withErrors("Dokumen $request->nomor_dokumen dengan jenis dokumen $request->jenis sudah ada!");
    }else{
      Ms_kerjaPraktik::create([
        'pengirim' => Auth::user()->email,
        'nomor_dokumen' =>$request->nomor_dokumen,
        'tempat' => $request->tempat,
        'instansi' => $request->instansi,
        'nama' => $request->nama,
        'nim' => $request->nim,
        'jenis_kp' => 'dinas'
      ]);
    }

    return redirect('tu/kerja/praktik/dinas')->with('pesan','Dokumen Kerja Praktik Berhasil diajukan!');
  }

  public function kerja_praktik_dinas_edit($id){
    $kp = Ms_kerjaPraktik::findOrFail($id);

    return view('menu/kerja_praktik/dinas.edit', compact('kp'));
  }

  public function kerja_praktik_dinas_update(Request $request, $id){
    $this->validateUpdateDataDinas($request);

    $record = Ms_kerjaPraktik::find($id);

    $validationNumber = Ms_kerjaPraktik::where('nomor_dokumen', $request->nomor_dokumen)
                                      ->where('jenis_kp', 'dinas')
                                      ->get();    

    $dataValidate = Ms_kerjaPraktik::where('nim', $request->nim)
                                ->where('jenis_kp', 'dinas')
                                ->where('deleted_at', null)
                                ->get();

    // update self record
    if($request->nomor_dokumen != $record->nomor_dokumen){
      if($validationNumber->count() > 0){        

        return redirect('tu/kerja/praktik/dinas')->withErrors("Dokumen Kerja Praktik $request->jenis, dengan nomor dokumen $request->nomor_dokumen sudah digunakan!");
      }
    }

    if($request->tempat != $record->tempat || $request->instansi != $record->instansi){
      if($dataValidate->count() > 0){
        return redirect('tu/kerja/praktik/dinas')->withErrors("Dokumen Kerja Praktik $request->nama jenis $request->jenis_kp sudah ada");
      }else{
        Ms_kerjaPraktik::where('id',$id)->update([
          'nomor_dokumen' => null,
          'tempat' => $request->tempat,
          'instansi' => $request->instansi,
          'nama' => $request->nama,
          'nim' => $request->nim,
        ]);
      }
    }else{
      Ms_kerjaPraktik::where('id',$id)->update([
        'nomor_dokumen' => $request->nomor_dokumen,
        'tempat' => $request->tempat,
        'instansi' => $request->instansi,
        'nama' => $request->nama,
        'nim' => $request->nim,
      ]);
    }

    return redirect('tu/kerja/praktik/dinas')->with('pesan','Dokumen Kerja Praktik Berhasil diupdate!');
  }

  public function kerja_praktik_dinas_destroy($id){
    $kp = Ms_kerjaPraktik::findOrFail($id);

    $kp->delete();

    return redirect('tu/kerja/praktik/dinas')->with('pesan','Dokumen Kerja Praktik Berhasil dihapus!');
  }

  public function kerja_praktik_dataTable_dinas(){
      $collections = Ms_kerjaPraktik::where('jenis_kp','dinas')
                                    ->orderBy('id','desc')
                                    ->get();

      return datatables()
          ->of($collections)
          ->addColumn('','')
          ->addColumn('aksi', function($row){
              return '
              <div class="d-flex justify-content-around">
                  <a href="/tu/kerja/praktik/dinas/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                  <button class="btn btn-icon btn-sm btn-outline-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
                  <a href="/tu/kerja/praktik/dinas/print/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-primary '.isDisplay($row).'"><span class="tf-icons bx bx-printer"></span></a>
              </div>';
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
              'nomor_dokumen',
              'tanggal_upload',
          ])
          ->make(true);
  }

  public function kerja_praktik_umum_print($id){
    $kp = Ms_kerjaPraktik::findOrFail($id);
    return view('menu/kerja_praktik.kp_umum_pdf', compact('kp')); 
  }

  public function kerja_praktik_dinas_print($id){
    $kp = Ms_kerjaPraktik::findOrFail($id);
    return view('menu/kerja_praktik.kp_dinas_pdf', compact('kp')); 
  }

  protected function validateDataUmum($request){
    $request->validate([
      'nomor_dokumen' => ['required','numeric'],
      'tempat' => ['required'],
      'nama' => ['required'],
      'nim' => ['required','numeric','digits:14']
    ]);

    return $request;
  }

  protected function validateUpdateDataUmum($request){
    $request->validate([
      'nomor_dokumen' => ['required','numeric'],
      'tempat' => ['required'],
      'nama' => ['required'],
      'nim' => ['required','numeric','digits:14']
    ]);

    return $request;
  }

  protected function validateDataDinas($request){
    $request->validate([
      'nomor_dokumen' => ['required','numeric'],
      'tempat' => ['required'],
      'instansi' => ['required'],
      'nama' => ['required'],
      'nim' => ['required','numeric','digits:14']
    ]);

    return $request;
  }

  protected function validateUpdateDataDinas($request){
    $request->validate([
      'nomor_dokumen' => ['required','numeric'],
      'tempat' => ['required'],
      'instansi' => ['required'],
      'nama' => ['required'],
      'nim' => ['required','numeric','digits:14']
    ]);

    return $request;
  }
}
