<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu" style="margin-top:45px">
                <li>
                    <a href="{{route('dashboard.kheta.index')}}">
                        <i class="bx bx-layout"></i>
                        <span key="t-maps">  الخطط </span>
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
