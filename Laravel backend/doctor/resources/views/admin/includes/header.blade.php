<!-- ============================-->
<!-- TOP NAV-->
<!-- ============================-->
<div class="navbar-fixed full-top-nav">
<div id="current-menu" data-menu="default">
    <nav>
        <a class="morph menu small mob-menu button-collapse top-nav waves-effect waves-light circle hide-on-large-only" href="javascript:void(0)" id="sidebar-default-collapse" data-activates="nav-default">
            <span>
                <span class="s1"></span>
                <span class="s2"></span>
                <span class="s3"></span>
            </span>
        </a>
    <div class="nav-wrapper">
        <!-- LOGO Set-->
        <a class="animated brand-logo hide-on-large-only nav-logo" href="javascript:void(0)">
            <i class="material-icons logo-icon left base-text">whatshot</i>
            <span class="left" style="margin-left:20px;">FORGE</span>
        </a>

        <a class="animated brand-logo hide-on-med-and-down defaultMenu-logo" href="javascript:void(0)">
            <i class="material-icons logo-icon left white-text">whatshot</i>
            <span class="left" style="margin-left:20px;">FORGE</span>
        </a>

        <!-- Left menu options at top-nav-->
        <ul class="left topnav-Menu-ls hide-on-med-and-down">
            <li>
                <a class="morph small iconizedToggle waves-effect waves-light" href="javascript:void(0)">
                    <span>
                        <span class="s1"></span>
                        <span class="s2"></span>
                        <span class="s3"></span>
                    </span>
                </a>
            </li>
            {{-- <li><a href="#">Sass</a></li> --}}
        </ul>
        <!-- Right Menu-->
        <ul class="right">

            <!-- ADMIN SETTINGS SECTION-->
            <li>
                <a class="dropdown-button waves-effect waves-set" href="#" data-beloworigin="true" data-activates="top-nav-userProfile">
                    <img class="circle admin-profile-img-small" src="{{ Auth::user()->pic?url('/upload/image/'.Auth::user()->pic):url('/images/square/male_6.jpg') }}" alt="">
                </a>
            </li>
        </ul>
        <!-- DROP-DOWN-->
        <div class="drop-down-bucket">

            <ul class="collection dropdown-content" id="top-nav-userProfile">
                <li class="collection-item">
                    <div class="admin-profile-content">
                        <img class="circle user-profile-img"
                            src="{{ Auth::user()->pic?url('/upload/image/'.Auth::user()->pic):url('/images/square/male_6.jpg') }}" alt="">
                        <p class="user-name primary-text">{{ ucwords(Auth::user()->name) }}</p>
                        <p class="user-designation secondary-text">{{ ucwords(Auth::user()->designation) }}</p>
                        <div class="divider"></div>
                        <ul class="profile-ul">
                            <li class="profile-li">
                                <a class="btn waves-light collection-item" href="{{ url('/admin/profile') }}">
                                    <i class="material-icons left">settings</i>
                                    <span class="text-items">Profile</span>
                                </a>
                            </li>
                            <li class="profile-li">
                                <a class="btn waves-light collection-item" href="#">
                                    <i class="material-icons left">inbox</i>
                                    <span class="badge right secondary-bg lighten-2 new">0</span>
                                    <span class="text-items">Inbox</span>
                                </a>
                            </li>
                            <li class="profile-li">
                                <a class="btn waves-light collection-item" href="{{ url('/admin/logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="material-icons left">power_settings_new</i><span class="text-items">Sign Out</span>
                                </a>
                                <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Searchbar-->
        <form class="inactive animated" id="app-search">
            <div class="input-field">
                <input type="search" id="search">
                <label class="label-icon" for="search">
                    <i class="material-icons">search</i>
                </label>
                <i class="material-icons app-search-Cls">close</i>
            </div>
        </form>
    </div>
    </nav>
</div>
</div>
