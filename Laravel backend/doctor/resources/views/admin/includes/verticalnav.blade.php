<!-- ============================-->
<!-- Vertical Navigation (Default and Iconized)-->
<!-- ============================-->
<div class="vertical-navigations animated">
    <ul class="side-nav fixed animated collapsible collapsible-accordion" id="nav-default">
        <li class="logo">
            <a class="brand-logo hide-on-large-only" id="logo-container" href="{{ url('/admin') }}"></a>
        </li>
        <li class="usr-profile">
            <div class="usr-profile-header">
                <a href="#">
                    <img class="circle" src="{{ Auth::user()->pic?url('/upload/image/'.Auth::user()->pic):url('/images/square/male_6.jpg') }}" alt="Hexesis">
                </a>
            </div>
            <ul class="user-options">
                <li class="waves-effect waves-set">
                    <span class="usr-name">{{ ucwords(Auth::user()->name) }}</span>
                </li>
                <li class="user-option-item waves-effect waves-set">
                    <a class="btn-floating btn-small waves-effect waves-light" href="#">
                        <i class="material-icons">lock</i>
                    </a>
                </li>
                <li class="user-option-item waves-effect waves-set">
                    <a class="btn-floating btn-small waves-effect waves-light" href="{{ url('/admin/profile') }}">
                        <i class="material-icons">settings</i>
                    </a>
                </li>
                <li class="user-option-item waves-effect waves-set">
                    <a class="btn-floating btn-small waves-effect waves-light" href="{{ url('/admin/logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="material-icons">power_settings_new</i>
                    </a>
                    <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin') }}">
                <i class="material-icons">dashboard</i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/newdoctor') }}">
                <i class="material-icons">dashboard</i>
                <span>New Doctor</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/listdoctor') }}">
                <i class="material-icons">dashboard</i>
                <span>List Doctor</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/consultant') }}">
                <i class="material-icons">dashboard</i>
                <span>Consultant</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/menulist') }}">
                <i class="material-icons">dashboard</i>
                <span>Menulist</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/specialist') }}">
                <i class="material-icons">dashboard</i>
                <span>Specialist</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/definition') }}">
                <i class="material-icons">dashboard</i>
                <span>Definition</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/degree') }}">
                <i class="material-icons">dashboard</i>
                <span>Degree</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/country') }}">
                <i class="material-icons">dashboard</i>
                <span>Country</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/city') }}">
                <i class="material-icons">dashboard</i>
                <span>City</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/area') }}">
                <i class="material-icons">dashboard</i>
                <span>Area</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/bank') }}">
                <i class="material-icons">dashboard</i>
                <span>Bank</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/contact') }}">
                <i class="material-icons">dashboard</i>
                <span>Contact Us</span>
            </a>
        </li>
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set" href="{{ url('/admin/dcontact') }}">
                <i class="material-icons">dashboard</i>
                <span>Message</span>
            </a>
        </li>

        @if(auth()->user()->can('developerOnly') || auth()->user()->can('role') || auth()->user()->can('admin.list'))
        <li class="navigation-header">
            <span class="no-col-body">Administrating</span>
            <i class="material-icons tooltipped" data-position="right" data-delay="50" data-tooltip="ADMINISTRATING">more_horiz</i>
        </li>
        @endif

        @if(auth()->user()->can('developerOnly') || auth()->user()->can('role'))
        <li>
            <a class="collapsible-header waves-effect waves-set {{ in_array($current_route_name,['admin.roles.index','admin.permissions.index','admin.myrolepermission'])?'active current':'' }}" href="#">
                <i class="material-icons">security</i><span>Role Manager</span>
                <i class="material-icons mdi-navigation-chevron-left">keyboard_arrow_left</i>
            </a>
            <div class="collapsible-body">
              <ul>
                <li class="menu-item">
                    <a class="waves-effect waves-set {{ $current_route_name=='admin.roles.index'?'active':'' }}" href="{{ url('/admin/roles') }}"><span>Roles</span></a>
                </li>
                @can('developerOnly')
                <li class="menu-item">
                    <a class="waves-effect waves-set {{ $current_route_name=='admin.permissions.index'?'active':'' }}" href="{{ url('/admin/permissions') }}"><span>Permissions</span></a>
                </li>
                @endcan
                <li class="menu-item">
                    <a class="waves-effect waves-set {{ $current_route_name == 'admin.myrolepermission'? 'active': '' }}" href="{{ url('/admin/rolePermissions') }}">
                        <span>Assign Permissions</span>
                    </a>
                </li>
              </ul>
            </div>
        </li>
        @endif

        @if(auth()->user()->can('developerOnly') || auth()->user()->can('admin.list'))
        <li>
            <a class="collapsible-header no-col-body waves-effect waves-set {{ $current_route_name=='admin.administrator.index'?'active':'' }}"
                href="{{ url('/admin/administrator') }}">
                <i class="material-icons">verified_user</i><span>Admin User</span>
            </a>
        </li>
        @endif

        @if(auth()->user()->can('developerOnly') || auth()->user()->can('user'))
        <li>
            <a class="collapsible-header waves-effect waves-set {{ in_array($current_route_name,['admin.user.index', 'admin.user.create', 'admin.user.store', 'admin.user.update', 'admin.user.edit'])?'active current':'' }}" href="#">
                <i class="material-icons">group</i><span>Users Manager</span>
                <i class="material-icons mdi-navigation-chevron-left">keyboard_arrow_left</i>
            </a>
            <div class="collapsible-body">
              <ul>
                <li class="menu-item">
                    <a class="waves-effect waves-set {{ $current_route_name=='admin.user.index'?'active':'' }}" href="{{ url('/admin/user') }}"><span>User List</span></a>
                </li>
                <li class="menu-item">
                    <a class="waves-effect waves-set {{ $current_route_name=='admin.user.create'?'active':'' }}" href="{{ url('/admin/user/create') }}"><span>Add User</span></a>
                </li>
              </ul>
            </div>
        </li>
        @endif
    </ul>
</div>
