<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="#" class="app-brand-link">             
      <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ config('app.name') }}</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner mb-5">
    <!-- Dashboard -->
    @if(Auth::user()->role == 'root')
      <li class="menu-item {{ Request::is('root/dashboard') ? 'active' : ''}}">
        <a href="{{ route('root.dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>
    @elseif(Auth::user()->role == 'dosen')
      <li class="menu-item {{ Request::is('dosen/dashboard') ? 'active' : ''}}">
        <a href="{{ url('dosen/dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>
    @elseif(Auth::user()->role == 'tu')
      <li class="menu-item {{ Request::is('tu/dashboard') ? 'active' : '' }}">
        <a href="{{ url('tu/dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>
    @else
      <li class="menu-item {{ Request::is('mahasiswa/dashboard') ? 'active' : '' }}">
        <a href="{{ route('mahasiswa.dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>
    @endif
    {{-- End dashboard --}}

    @if(Auth::user()->role == 'kepala' || Auth::user()->role == 'root')
    {{-- Menu Kepala --}} 
    <li class="menu-item {{ Request::is('kepala/*') || Request::is('root/*') ? 'active' : ''}}">
      <a href="{{ Auth::user()->role == 'kepala' ? route('kepala.jurnal') : route('root.jurnal') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Analytics">Jurnal</div>
      </a>
    </li>
    {{-- Menu Kepala --}}
    @endif

    @if(Auth::user()->role == 'dosen' || Auth::user()->role == 'root')
      <li class="menu-item {{ !Request::is('dosen/dashboard') && Request::is('dosen/*') ? 'open active' : ''}}">
        <a href="javascript: void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Menu Dosen</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('dosen/pendidikan') || Request::is('dosen/pendidikan/*') ? 'active' : ''}}">
            <a href="{{ url('/dosen/pendidikan/') }}" class="menu-link">
              <div data-i18n="Without menu">Pendidikan</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('dosen/penelitian') || Request::is('dosen/penelitian/*') ? 'active' : ''}}">
            <a href="{{ url('/dosen/penelitian/') }}" class="menu-link">
              <div data-i18n="Without menu">Penelitian</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('dosen/pengabdian') || Request::is('dosen/pengabdian/*') ? 'active' : ''}}">
            <a href="{{ url('/dosen/pengabdian/') }}" class="menu-link">
              <div data-i18n="Without menu">Pengabdian</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('dosen/penunjang') || Request::is('dosen/penunjang/*') ? 'active' : ''}}">
            <a href="{{ url('/dosen/penunjang/') }}" class="menu-link">
              <div data-i18n="Without menu">Penunjang</div>
            </a>
          </li>
        </ul>
      </li>
    @endif

    @if(Auth::user()->role == 'tu' || Auth::user()->role == 'root')
    
      <li class="menu-item {{ !Request::is('tu/dashboard') && Request::is('tu/*') ? 'open active' : ''}}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Menu Tatausaha</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('tu/surat/izin') || Request::is('tu/surat/izin/*') ? 'active' : ''}}">
            <a href="{{ route('tu.surat_izin') }}" class="menu-link">
              <div data-i18n="Without menu">Surat Izin</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('tu/arsip') || Request::is('tu/arsip/*') ? 'active' : ''}}">
            <a href="{{ route('tu.arsip') }}" class="menu-link">
              <div data-i18n="Without menu">Arsip Tatausaha</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('tu/legalisasi/ijazah') || Request::is('tu/legalisasi/ijazah/*') ? 'active' : ''}}">
            <a href="{{ route('tu.legalisasi') }}" class="menu-link">
              <div data-i18n="Without menu">Legalisasi Ijazah</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('tu/kerja/praktik') || Request::is('tu/kerja/praktik/*') ? 'active' : ''}}">
            <a href="{{ url('tu/kerja/praktik') }}" class="menu-link">
              <div data-i18n="Without menu">Kerja Praktik</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('tu/aktif/kuliah') || Request::is('tu/aktif/kuliah/*') ? 'active' : ''}}">
            <a href="{{ route('tu.aktif_kuliah') }}" class="menu-link">
              <div data-i18n="Without menu">Aktif Kuliah</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('tu/observasi') || Request::is('tu/observasi/*') ? 'active' : ''}}">
            <a href="{{ route('tu.observasi') }}" class="menu-link">
              <div data-i18n="Without menu">Observasi</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('tu/observasi_kelompok') || Request::is('tu/observasi_kelompok/*') ? 'active' : ''}}">
            <a href="{{ route('tu.observasi_kelompok') }}" class="menu-link">
              <div data-i18n="Without menu">Observasi Kelompok</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('tu/dosen/tamu') || Request::is('tu/dosen/tamu/*') ? 'active' : ''}}">
            <a href="{{ route('tu.dosen_tamu') }}" class="menu-link">
              <div data-i18n="Without menu">Dosen Tamu</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('tu/konseling') || Request::is('tu/konseling/*') ? 'active' : ''}}">
            <a href="{{ route('tu.konseling') }}" class="menu-link">
              <div data-i18n="Without menu">Pelayanan Konseling</div>
            </a>
          </li>
        </ul>
      </li>
    @endif

    @if(Auth::user()->role == 'mahasiswa' || Auth::user()->role == 'mahasiswa')
    
      <li class="menu-item {{ !Request::is('mahasiswa/dashboard') && Request::is('mahasiswa/*') ? 'open active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Layouts">Menu Mahasiswa</div>
        </a>

        <ul class="menu-sub">
          <li class="menu-item {{ Request::is('mahasiswa/surat/izin') || Request::is('mahasiswa/surat/izin/*') ? 'active' : ''}}">
            <a href="{{ route('mahasiswa.surat_izin') }}" class="menu-link">
              <div data-i18n="Without menu">Surat Izin</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('mahasiswa/legalisasi/ijazah') || Request::is('mahasiswa/legalisasi/ijazah/*') ? 'active' : ''}}">
            <a href="{{ route('mahasiswa.legalisasi') }}" class="menu-link">
              <div data-i18n="Without menu">Legalisasi Ijazah</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('mahasiswa/kerja/praktik') || Request::is('mahasiswa/kerja/praktik/*') ? 'active' : ''}}">
            <a href="{{ url('mahasiswa/kerja/praktik') }}" class="menu-link">
              <div data-i18n="Without menu">Kerja Praktik</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('mahasiswa/aktif/kuliah') || Request::is('mahasiswa/aktif/kuliah/*') ? 'active' : ''}}">
            <a href="{{ route('mahasiswa.aktif_kuliah') }}" class="menu-link">
              <div data-i18n="Without menu">Aktif Kuliah</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('mahasiswa/observasi') || Request::is('mahasiswa/observasi/*') ? 'active' : ''}}">
            <a href="{{ route('mahasiswa.observasi') }}" class="menu-link">
              <div data-i18n="Without menu">Observasi</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('mahasiswa/observasi_kelompok') || Request::is('mahasiswa/observasi_kelompok/*') ? 'active' : ''}}">
            <a href="{{ route('mahasiswa.observasi_kelompok') }}" class="menu-link">
              <div data-i18n="Without menu">Observasi Kelompok</div>
            </a>
          </li>
        </ul>
      </li>
    @endif
    
  </ul>
</aside> 