<header class="header-top" header-theme="light">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="top-menu d-flex align-items-center">
                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                <div class="header-search">
                    <div class="input-group">
                        <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                    </div>
                </div>
                <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
            </div>
            <div class="top-menu d-flex align-items-center">
                <div>
                  <a class="h6 font-weight-bold">OEMAR TECH Corporation, Ltd</a>
                </div>
                <button type="button" class="nav-link ml-10" id="apps_modal_btn" data-toggle="modal" data-target="#appsModal"><i class="ik ik-grid"></i></button>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if( auth()->user()->password  == null)
                        <img class="avatar" src="{{auth()->user()->foto}}" alt="">
                        @else
                        <img class="avatar" src="{{Storage::url(auth()->user()->foto)}}" class="user-image" alt="">
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{route('profile.index')}}"><i class="ik ik-user dropdown-icon"></i> Profile</a>
                        <a class="dropdown-item" href="#"><i class="ik ik-settings dropdown-icon"></i> Settings</a>
                        <a class="dropdown-item" href="#"><span class="float-right"><span class="badge badge-primary">6</span></span><i class="ik ik-mail dropdown-icon"></i> Inbox</a>
                        <a class="dropdown-item" href="#"><i class="ik ik-navigation dropdown-icon"></i> Message</a>
                        <form method="post" action="{{route('login.logout')}}">
                          @csrf
                          <button class="dropdown-item" type="submit"><i class="ik ik-power dropdown-icon"></i> Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
