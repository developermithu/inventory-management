<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">

                {{-- admin-sidebar-component --}}
                <x-admin-sidebar/>

             {{-- <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{route('admin.dashboard')}}" class="{{ Route::is('admin.dashboard') ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Dashboard
                    </a>
                </li>

                <li class="app-sidebar__heading">User Management</li>

                <li>
                    <a href="{{route('admin.roles.index')}}" class="{{ Request::is('admin/roles*') ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-check"></i>
                        Roles
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.users.index')}}" class="{{ Request::is('admin/users*') ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Users
                    </a>
                </li> --}}

                {{-- dropdown --}}
                {{-- <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Elements
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="elements-buttons-standard.html">
                                <i class="metismenu-icon"></i>
                                Buttons
                            </a>
                        </li>
                        <li>
                            <a href="elements-dropdowns.html">
                                <i class="metismenu-icon">
                                </i>Dropdowns
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="app-sidebar__heading">Widgets</li>

                <li>
                    <a href="{{route('admin.backups.index')}}" class="{{ Request::is('admin/backups*') ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-cloud"></i>
                        Backups
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.pages.index')}}" class="{{ Request::is('admin/pages*') ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-news-paper"></i>
                        Pages
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.menus.index')}}" class="{{ Request::is('admin/menus*') ? 'mm-active' : ''}}">
                        <i class="metismenu-icon pe-7s-menu"></i>
                        Menus
                    </a>
                </li>   --}}

            </ul>
        </div>
    </div>
</div>