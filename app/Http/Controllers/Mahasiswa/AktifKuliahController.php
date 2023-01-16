<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Ms_aktifKuliah;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AktifKuliahController extends Controller
{
    public function index(){
      return view('menu/aktif_kuliah.index');
    }

    public function aktif_kuliah_umum(){
      return view('menu/aktif_kuliah/umum.index');
    }

    public function aktif_kuliah_umum_create(){
      return view('menu/aktif_kuliah/umum.create');
    }

    public function aktif_kuliah_umum_store(Request $request){
      $this->validateDataUmum($request);
      
      // Cek Data
      $dataValidate = Ms_aktifKuliah::where('nim', $request->nim)
                                  ->where('jenis_surat', 'umum')
                                  ->where('deleted_at', null)
                                  ->get();

      if($dataValidate->count() > 0){
        return redirect('mahasiswa/aktif/kuliah/umum')->withErrors("Dokumen $request->nama Aktif Kuliah $request->jenis_surat suda ada!");
      }else{
        Ms_aktifKuliah::create([
          'pengirim' => Auth::user()->email,
          'nama' => $request->nama,
          'nim' => $request->nim,
          'semester' => $request->semester,
          'kota_lahir' => $request->kota_lahir,
          'tanggal_lahir' => $request->tanggal_lahir,
          'keperluan' => $request->keperluan,
          'jenis_surat' => 'umum'
        ]);
      }

      return redirect('mahasiswa/aktif/kuliah/umum')->with('pesan','Dokumen Aktif Kuliah Berhasil diajukan!');
    }

    public function aktif_kuliah_umum_edit($id){

      $aktif = Ms_aktifKuliah::findOrFail($id);

      return view('menu/aktif_kuliah/umum.edit', compact('aktif'));
    }

    public function aktif_kuliah_umum_update(Request $request, $id){

      $this->validateUpdateDataUmum($request);
      
      $record = Ms_aktifKuliah::find($id);

      // Cek Data
      $dataValidate = Ms_aktifKuliah::where('nim', $request->nim)
                                  ->where('jenis_surat', 'umum')
                                  ->where('deleted_at', null)
                                  ->get();

      if($request->keperluan != $record->keperluan){
        if($dataValidate->count() > 0){
          return redirect('mahasiswa/aktif/kuliah/umum')->withErrors("Dokumen Aktif Kuliah $request->nama jenis $request->jenis sudah ada");
        }else{
          Ms_aktifKuliah::where('id',$id)->update([
            'nomor_dokumen' => null,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'semester' => $request->semester,
            'kota_lahir' => $request->kota_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'keperluan' => $request->keperluan,
          ]);
        }
      }else{
        Ms_aktifKuliah::where('id',$id)->update([
          'nama' => $request->nama,
          'nim' => $request->nim,
          'semester' => $request->semester,
          'kota_lahir' => $request->kota_lahir,
          'tanggal_lahir' => $request->tanggal_lahir,
          'keperluan' => $request->keperluan,
        ]);
      }

      return redirect('mahasiswa/aktif/kuliah/umum')->with('pesan','Dokumen Aktif Kuliah Berhasil diupdate!');
    }

    public function aktif_kuliah_umum_destroy($id){
      $kp = Ms_aktifKuliah::findOrFail($id);

      $kp->delete();

      return redirect('mahasiswa/aktif/kuliah/umum')->with('pesan','Dokumen Aktif Kuliah Berhasil dihapus!');
    }

    public function aktif_kuliah_dataTable_umum(){
        $collections = Ms_aktifKuliah::where('nim', Auth::user()->nim)
                                      ->where('jenis_surat','umum')
                                      ->orderBy('id','desc')
                                      ->get();

        return datatables()
            ->of($collections)
            ->addColumn('','')
            ->addColumn('aksi', function($row){
                return '
                <div class="d-flex justify-content-around">
                    <a href="/mahasiswa/aktif/kuliah/umum/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
                </div>';
            })
            ->addColumn('nomor_dokumen', function($row){
              if($row->nomor_dokumen == null){
                  return ' <span class="badge bg-label-warning">Proccess</span> ';
              }else{
                  return $row->nomor_dokumen;
              }
            })
            ->addColumn('jenjang','Sarjana (S1)')
            ->addColumn('tanggal_upload', function($row){
                return $row->created_at->format('(D-M-Y) H:i:s');
            })
            ->rawColumns([
                '',
                'aksi',
                'nomor_dokumen',
                'jenjang',
                'tanggal_upload',
            ])
            ->make(true);
    }

    // Dinas
    public function aktif_kuliah_dinas(){
        return view('menu/aktif_kuliah/dinas.index');
    }

    public function aktif_kuliah_dinas_create(){
      return view('menu/aktif_kuliah/dinas.create');
    }

    public function aktif_kuliah_dinas_store(Request $request){

      $this->validateDataDinas($request);

      // Cek Data
      $dataValidate = Ms_aktifKuliah::where('nim', $request->nim)
                                    ->where('jenis_surat', 'dinas')
                                    ->where('deleted_at', null)
                                    ->get();

      if($dataValidate->count() > 0){
        return redirect('mahasiswa/aktif/kuliah/dinas')->withErrors("Dokumen $request->nama Aktif Kuliah $request->jenis_surat suda ada!");
      }else{
        Ms_aktifKuliah::create([
          'pengirim' => Auth::user()->email,
          'nama' => $request->nama,
          'nim' => $request->nim,
          'semester' => $request->semester,
          'tanggal_lahir' => $request->tanggal_lahir,
          'kota_lahir' => $request->kota_lahir,
          'alamat' => $request->alamat,
          'nama_orangtua' => $request->nama_orangtua,
          'instansi_orangtua' => $request->instansi_orangtua,
          'jabatan' => $request->jabatan,
          'nip_orangtua' => $request->nip_orangtua,
          'pangkat_golongan' => $request->pangkat_golongan,
          'keperluan' => $request->keperluan,
          'jenis_surat' => 'dinas'
        ]);
      }

      return redirect('mahasiswa/aktif/kuliah/dinas')->with('pesan','Dokumen Aktif Kuliah Berhasil diajukan!');
    }

    public function aktif_kuliah_dinas_edit($id){
      $aktif = Ms_aktifKuliah::findOrFail($id);

      return view('menu/aktif_kuliah/dinas.edit', compact('aktif'));
    }

    public function aktif_kuliah_dinas_update(Request $request, $id){
      $this->validateUpdateDataDinas($request);

      $record = Ms_aktifKuliah::find($id);

      $dataValidate = Ms_aktifKuliah::where('nim', $request->nim)
                                  ->where('jenis_surat', 'dinas')
                                  ->where('deleted_at', null)
                                  ->get();

      if($request->keperluan != $record->keperluan){
        if($dataValidate->count() > 0){
          return redirect('mahasiswa/aktif/kuliah/dinas')->withErrors("Dokumen Aktif Kuliah $request->nama jenis $request->jenis sudah ada");
        }else{
          Ms_aktifKuliah::where('id',$id)->update([
            'nomor_dokumen' => null,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'semester' => $request->semester,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kota_lahir' => $request->kota_lahir,
            'alamat' => $request->alamat,
            'nama_orangtua' => $request->nama_orangtua,
            'instansi_orangtua' => $request->instansi_orangtua,
            'jabatan' => $request->jabatan,
            'nip_orangtua' => $request->nip_orangtua,
            'pangkat_golongan' => $request->pangkat_golongan,
            'keperluan' => $request->keperluan
          ]);
        }
      }else{
        Ms_aktifKuliah::where('id',$id)->update([
          'nama' => $request->nama,
          'nim' => $request->nim,
          'semester' => $request->semester,
          'tanggal_lahir' => $request->tanggal_lahir,
          'kota_lahir' => $request->kota_lahir,
          'alamat' => $request->alamat,
          'nama_orangtua' => $request->nama_orangtua,
          'instansi_orangtua' => $request->instansi_orangtua,
          'jabatan' => $request->jabatan,
          'nip_orangtua' => $request->nip_orangtua,
          'pangkat_golongan' => $request->pangkat_golongan,
          'keperluan' => $request->keperluan
        ]);
      }

      return redirect('mahasiswa/aktif/kuliah/dinas')->with('pesan','Dokumen Aktif Kuliah Berhasil diupdate!');
    }

    public function aktif_kuliah_dinas_destroy($id){
      $kp = Ms_aktifKuliah::findOrFail($id);

      $kp->delete();

      return redirect('mahasiswa/aktif/kuliah/dinas')->with('pesan','Dokumen Aktif Kuliah Berhasil dihapus!');
    }

    public function aktif_kuliah_dataTable_dinas(){
      $collections = Ms_aktifKuliah::where('nim',Auth::user()->nim)
                                    ->where('jenis_surat','dinas')
                                    ->orderBy('id','desc')
                                    ->get();

      return datatables()
          ->of($collections)
          ->addColumn('','')
          ->addColumn('aksi', function($row){
              return '
              <div class="d-flex justify-content-around">
                  <a href="/mahasiswa/aktif/kuliah/dinas/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-outline-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
              </div>';
          })
          ->addColumn('nomor_dokumen', function($row){
            if($row->nomor_dokumen == null){
                return ' <span class="badge bg-label-warning">Proccess</span> ';
            }else{
                return $row->nomor_dokumen;
            }
          })
          ->addColumn('jenjang','Sarjana (S1)')
          ->addColumn('tanggal_upload', function($row){
              return $row->created_at->format('(D-M-Y) H:i:s');
          })
          ->rawColumns([
              '',
              'aksi',
              'nomor_dokumen',
              'jenjang',
              'tanggal_upload',
          ])
          ->make(true);
    }

    protected function validateDataUmum($request){
      $request->validate([
        'nama' => ['required'],
        'nim' => ['required','numeric','digits:14'],
        'semester' => ['required'],
        'tanggal_lahir' => ['required'],
        'kota_lahir' => ['required'],
        'keperluan' => ['required','in:umum,beasiswa karawang cerdas'],
      ]);

      return $request;
    }

    protected function validateUpdateDataUmum($request){
      $request->validate([
        'nama' => ['required'],
        'nim' => ['required','numeric','digits:14'],
        'semester' => ['required'],
        'tanggal_lahir' => ['required'],
        'kota_lahir' => ['required'],
        'keperluan' => ['required','in:umum,beasiswa karawang cerdas'],
      ]);

      return $request;
    }

    protected function validateDataDinas($request){
      $request->validate([
        'nama' => ['required'],
        'nim' => ['required','numeric','digits:14'],
        'semester' => ['required'],
        'tanggal_lahir' => ['required'],
        'kota_lahir' => ['required'],
        'alamat' => ['required'],
        'nama_orangtua' => ['required'],
        'instansi_orangtua' => ['required'],
        'jabatan' => ['required'],
        'nip_orangtua' => ['required'],
        'pangkat_golongan' => ['required'],
        'keperluan' => ['required','in:dinas,beasiswa karawang cerdas'],
      ]);

      return $request;
    }

    protected function validateUpdateDataDinas($request){
      $request->validate([
        'nama' => ['required'],
        'nim' => ['required','numeric','digits:14'],
        'semester' => ['required'],
        'tanggal_lahir' => ['required'],
        'kota_lahir' => ['required'],
        'alamat' => ['required'],
        'nama_orangtua' => ['required'],
        'instansi_orangtua' => ['required'],
        'jabatan' => ['required'],
        'nip_orangtua' => ['required'],
        'pangkat_golongan' => ['required'],
        'keperluan' => ['required','in:dinas,beasiswa karawang cerdas'],
      ]);

      return $request;
    }
}
