<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="{{ route('admin.chart') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="{{ route('admin.tables') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>
                <div class="sb-sidenav-menu-heading">Data</div>
                <a class="nav-link" href="{{ route('student.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Student
                </a>
                @if (auth()->user()->roles->pluck('name')[0] == 'superadmin')
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Users
                    </a>
                @endif
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->roles->pluck('name')[0] }}
        </div>
    </nav>
</div>
