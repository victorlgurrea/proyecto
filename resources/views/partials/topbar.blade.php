   <!-- Topbar -->
   <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>

<!-- Topbar Search -->
<form
    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="{{__('search')}}"
            aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                        placeholder="{{__('search')}}" aria-label="Search"
                        aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>


    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->

    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }} {{ Auth::user()->surname }} </span>
            <img class="img-profile rounded-circle"
                src="{{ asset('theme/img/undraw_profile.svg') }}">
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
            <a class="dropdown-item" href="#">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Settings
            </a>
            <a class="dropdown-item" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                Activity Log
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>

    <li class="nav-item dropdown no-arrow">

        <a class="nav-link dropdown-toggle" href="#" id="idiomDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" language = "{{ config('app.locale') }}">
            <img class="img-profile rounded-circle" title="seleccione idioma" src="{{URL::asset('img/' . Config('app.locale') . '.png')}}" >
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="idiomDropdown">

            @foreach (Config::get('app.languages') as $lang => $language)
                <a class="dropdown-item" href="{{route('lang_change', $language)}}">
                    <img class="img-profile rounded-circle" title="seleccione idioma"
                    src="{{URL::asset('img/' . $language . '.png')}}" widht="15px" height="15px;">
                    @switch($language)
                        @case('en')
                         {{__('english')}}
                         @break
                         @case('es')
                         {{__('spanish')}}
                         @break
                         @case('de')
                         {{__('german')}}
                         @break
                         @case('it')
                         {{__('italian')}}
                         @break
                         @case('fr')
                         {{__('french')}}
                         @break
                         @case('pt')
                         {{__('portuguese')}}
                         @break
                         @case('ru')
                         {{__('russian')}}
                         @break
                         @case('ca')
                         {{__('valencian')}}
                         @break                         
                    @endswitch
                </a>
            @endforeach
        </div>
    </li>
</ul>
</nav>
<!-- End of Topbar -->