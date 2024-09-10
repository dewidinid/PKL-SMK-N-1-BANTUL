<div id="sidebar-menu" class="nav flex-column nav-pills custom-sidebar" role="tablist" aria-orientation="vertical">
    <a href="{{ route('home_pembimbing') }}" class="nav-link {{ request()->routeIs('home_pembimbing') ? 'active' : '' }}">
        <i class="bi bi-house me-4 ms-2"></i> DASHBOARD
    </a>
    <a href="{{ route ('monitoring') }}" class="nav-link {{ request()->routeIs('monitoring') ? 'active' : '' }}">
        <i class="bi bi-display me-4 ms-2"></i> MONITORING PKL
    </a>
    <a href="{{ route ('evaluasi') }}" class="nav-link {{ request()->routeIs('evaluasi') ? 'active' : '' }}">
        <i class="bi bi-bar-chart-line me-4 ms-2"></i> EVALUASI PKL
    </a>
    <a href="{{ route ('hasil_nilaipkl') }}" class="nav-link {{ request()->routeIs('hasil_nilaipkl') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-text me-4 ms-2"></i> NILAI SISWA PKL
    </a>
    <a href="{{ route ('pembimbing_laporanjurnal') }}" class="nav-link {{ request()->routeIs('pembimbing_laporanjurnal') ? 'active' : '' }}">
        <i class="bi bi-chat-left-text me-4 ms-2"></i> LAPORAN/JURNAL PKL
    </a>
    <a href="{{ route ('hasil_laporanakhir') }}" class="nav-link {{ request()->routeIs('hasil_laporanakhir') ? 'active' : '' }}">
        <i class="bi bi-clipboard-check me-4 ms-2"></i> LAPORAN AKHIR PKL
    </a>
    <a href="{{ route ('hasil_laporanpengimbasan') }}" class="nav-link {{ request()->routeIs('hasil_laporanpengimbasan') ? 'active' : '' }}">
        <i class="bi bi-journal-text me-4 ms-2"></i> LAPORAN PENGIMBASAN
    </a>
</div>
