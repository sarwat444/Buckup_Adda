<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu" style="margin-top:45px">
                <li class="d-none">
                    <a href="{{route('dashboard.roles.index')}}">
                        <i class="bx bx-layout"></i>
                        <span key="t-maps">  الأدوار </span>
                    </a>
                </li>
                <li class="d-none">
                    <a href="{{route('dashboard.Permissions.index')}}">
                        <i class="bx bx-layout"></i>
                        <span key="t-maps">  الصلاحيات </span>
                    </a>
                </li>

                @if(Auth::guard('admin')->user()->supper_admin  == 1 )
                <li>
                    <a href="{{route('dashboard.users.admins')}}">
                        <i class="bx bx-briefcase"></i>
                        <span key="t-maps">مديري النظام</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
