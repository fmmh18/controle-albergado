<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('dashboard.home') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="/images/logo-dark.png" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('dashboard.home') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="/images/logo.png" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item">
                <a href="{{ route('dashboard.home') }}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span> Dashboard </span>
                </a>
            </li>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#PatientPages" aria-expanded="false" aria-controls="PatientPages"
                    class="side-nav-link">
                    <i class="ri-tools-line"></i>
                    <span> Paciente </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="PatientPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{!! route('dashboard.patient.index') !!}" >Paciente</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages"
                    class="side-nav-link">
                    <i class="ri-tools-line"></i>
                    <span> Configuração </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{!! route('dashboard.user.index') !!}" >Usuário</a>
                        </li>

                    </ul>
                </div>
            </li>


        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->


