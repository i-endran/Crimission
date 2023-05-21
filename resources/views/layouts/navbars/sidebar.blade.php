<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand mt-1 mb-1 pt-0" href="{{ route('home') }}">
            Project
            <img src="{{ URL::asset('images/favicon.png') }}" class="navbar-brand-img" alt="...">
            Crimission
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="{{ route('profile.settings') }}" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="{{ route('user.activity') }}" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="{{ route('feedback.create') }}" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            Project
                            <img src="{{ URL::asset('images/favicon.png') }}" class="navbar-brand-img" alt="...">
                            Crimission
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <!-- /////////////////////////////////////////////////////////////////////////////////// -->
            <form id='search-form' method="get" action="{{ route('post.search') }}" class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input name="post_id" type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search Post using ID') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text cursor-pointer" onclick="$('#search-form').submit();">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-world text-primary"></i> {{ __('Home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="ni ni-single-02 text-yellow"></i> {{ __('My Profile') }}
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="ni ni-bullet-list-67 text-red"></i> {{ __('User Management') }}
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('post.create') }}">
                        <i class="fas fa-file-signature text-red"></i> {{ __('Post Issues') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('casefile.index') }}">
                        <i class="fas fa-clipboard-check text-blue"></i> {{ __('Verified complaints') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('filedcases') }}">
                        <i class="ni ni-paper-diploma text-orange"></i> {{ __('Filed Cases') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">
                        <i class="ni ni-favourite-28 text-pink"></i> {{ __('About Community') }}
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <!-- <h6 class="navbar-heading text-muted">Documentation</h6> -->
            <!-- Navigation
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li>
            </ul> -->
        </div>
    </div>
</nav>