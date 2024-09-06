<div id="sidebar-menu" class="nav flex-column nav-pills custom-sidebar" role="tablist" aria-orientation="vertical">
    <a href="{{ route('home_admin') }}" class="nav-link {{ request()->routeIs('home_admin') ? 'active' : '' }}">
        <i class="bi bi-house me-4 ms-2"></i> DASHBOARD
    </a>
    <a href="{{ route('data_siswa') }}" class="nav-link {{ request()->routeIs('data_siswa') ? 'active' : '' }}">
        <i class="bi bi-people-fill me-4 ms-2"></i> DATA SISWA
    </a>
    <a href="{{ route('guru_pembimbing') }}" class="nav-link {{ request()->routeIs('guru_pembimbing') ? 'active' : '' }}">
        <i class="bi bi-person-rolodex me-4 ms-2"></i> GURU PEMBIMBING
    </a>
    <a href="{{ route('data_mitradudi') }}" class="nav-link {{ request()->routeIs('data_mitradudi') ? 'active' : '' }}">
        <i class="bi bi-buildings me-4 ms-2"></i> MITRA DUDI
    </a>
    <a href="{{ route('ploting_siswa') }}" class="nav-link {{ request()->routeIs('ploting_siswa') ? 'active' : '' }}">
        <i class="bi bi-diagram-3 me-4 ms-2"></i> PLOTING SISWA
    </a>
    <a href="{{ route('suratPengajuan') }}" class="nav-link {{ request()->routeIs('suratPengajuan') ? 'active' : '' }}">
        <i class="bi bi-envelope me-4 ms-2"></i> SURAT PENGAJUAN PKL MANDIRI
    </a>
</div>
