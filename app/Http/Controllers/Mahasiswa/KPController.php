<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Ms_kerjaPraktik;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    if($dataValidate->count() > 0){
      return redirect('mahasiswa/kerja/praktik/umum')->withErrors("$request->nama sudah mengajukan dokumen kerja praktik!");
    }else{
      Ms_kerjaPraktik::create([
        'pengirim' => Auth::user()->email,
        'tempat' => $request->tempat,
        'nama' => $request->nama,
        'nim' => $request->nim,
        'jenis_kp' => 'umum'
      ]);
    }

    return redirect('mahasiswa/kerja/praktik/umum')->with('pesan','Dokumen Kerja Praktik Berhasil diajukan!');
  }

  public function kerja_praktik_umum_edit($id){
    $kp = Ms_kerjaPraktik::findOrFail($id);

    return view('menu/kerja_praktik/umum.edit', compact('kp'));
  }

  public function kerja_praktik_umum_update(Request $request, $id){
    
    $this->validateUpdateDataUmum($request);
    
    $record = Ms_kerjaPraktik::find($id);

    $dataValidate = Ms_kerjaPraktik::where('nim', $request->nim)
                                ->where('jenis_kp', 'umum')
                                ->where('deleted_at', null)
                                ->get();
    
    if($record->tempat != $request->tempat){
      if($dataValidate->count() > 0){
        return redirect('mahasiswa/kerja/praktik/umum')->withErrors("Dokumen Kerja Praktik $request->nama jenis $request->jenis_kp sudah ada");
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
        'tempat' => $request->tempat,
        'nama' => $request->nama,
        'nim' => $request->nim,
      ]);
    }

    return redirect('mahasiswa/kerja/praktik/umum')->with('pesan','Dokumen Kerja Praktik Berhasil diupdate!');
  }

    public function kerja_praktik_dataTable_umum(){
        $collections = Ms_kerjaPraktik::where('nim', Auth::user()->nim)
                                      ->where('jenis_kp','umum')
                                      ->orderBy('id','desc')
                                      ->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/mahasiswa/kerja/praktik/umum/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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

    if($dataValidate->count() > 0){
      return redirect('mahasiswa/kerja/praktik/dinas')->withErrors("$request->nama sudah mengajukan dokumen kerja praktik dinas!");
    }else{
      Ms_kerjaPraktik::create([
        'pengirim' => Auth::user()->email,
        'tempat' => $request->tempat,
        'instansi' => $request->instansi,
        'nama' => $request->nama,
        'nim' => $request->nim,
        'jenis_kp' => 'dinas'
      ]);
    }

    return redirect('mahasiswa/kerja/praktik/dinas')->with('pesan','Dokumen Kerja Praktik Dinas Berhasil diajukan!');
  }

  public function kerja_praktik_dinas_edit($id){
    $kp = Ms_kerjaPraktik::findOrFail($id);

    return view('menu/kerja_praktik/dinas.edit', compact('kp'));
  }

  public function kerja_praktik_dinas_update(Request $request, $id){
    
    $this->validateUpdateDataDinas($request);
    $record = Ms_kerjaPraktik::find($id);
    $dataValidate = Ms_kerjaPraktik::where('nim', $request->nim)
                                ->where('jenis_kp', 'dinas')
                                ->where('deleted_at', null)
                                ->get();

    if($record->tempat != $request->tempat || $record->instansi != $request->instansi){
      if($dataValidate->count() > 0){
        return redirect('mahasiswa/kerja/praktik/umum')->withErrors("Dokumen Kerja Praktik $request->nama jenis $request->jenis_kp sudah ada");
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
        'tempat' => $request->tempat,
        'instansi' => $request->instansi,
        'nama' => $request->nama,
        'nim' => $request->nim,
      ]);
    }

    return redirect('mahasiswa/kerja/praktik/dinas')->with('pesan','Dokumen Kerja Praktik Dinas  Berhasil diupdate!');
  }

  public function kerja_praktik_dataTable_dinas(){
      $collections = Ms_kerjaPraktik::where('nim', Auth::user()->nim)
                                    ->where('jenis_kp','dinas')
                                    ->orderBy('id','desc')
                                    ->get();

      return datatables()
          ->of($collections)
          ->addColumn('','')
          ->addColumn('aksi', function($row){
              return '
              <div class="d-flex justify-content-around">
                  <a href="/mahasiswa/kerja/praktik/dinas/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
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

  protected function validateDataUmum($request){
    $request->validate([
      'tempat' => ['required'],
      'nama' => ['required'],
      'nim' => ['required','numeric','digits:14']
    ]);

    return $request;
  }

  protected function validateUpdateDataUmum($request){
    $request->validate([
      'tempat' => ['required'],
      'nama' => ['required'],
      'nim' => ['required','numeric','digits:14']
    ]);

    return $request;
  }

  protected function validateDataDinas($request){
    $request->validate([
      'tempat' => ['required'],
      'instansi' => ['required'],
      'nama' => ['required'],
      'nim' => ['required','numeric','digits:14']
    ]);

    return $request;
  }

  protected function validateUpdateDataDinas($request){
    $request->validate([
      'tempat' => ['required'],
      'instansi' => ['required'],
      'nama' => ['required'],
      'nim' => ['required','numeric','digits:14']
    ]);

    return $request;
  }

}
