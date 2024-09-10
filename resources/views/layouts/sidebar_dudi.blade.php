<div id="sidebar-menu" class="nav flex-column nav-pills custom-sidebar" role="tablist" aria-orientation="vertical">
    <a href="{{ route('home_dudi') }}" class="nav-link {{ request()->routeIs('home_dudi') ? 'active' : '' }}">
        <i class="bi bi-house me-4 ms-2"></i> DASHBOARD
    </a>
    <a href="{{ route ('nilai_pkl') }}" class="nav-link {{ request()->routeIs('nilai_pkl') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-text me-4 ms-2"></i> NILAI PKL
    </a>
    <a href="{{ route ('dudi_laporanjurnal') }}" class="nav-link {{ request()->routeIs('dudi_laporanjurnal') ? 'active' : '' }}">
        <i class="bi bi-chat-left-text me-4 ms-2"></i> LAPORAN/JURNAL PKL
    </a>
</div>
