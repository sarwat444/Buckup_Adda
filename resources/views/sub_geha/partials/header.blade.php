<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset(PUBLIC_PATH.'/assets/admin/images/logo.svg')}}" alt="" height="22">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{asset(PUBLIC_PATH.'/assets/admin/images/logo-dark.png')}}" alt="" height="17">
                                </span>
                </a>



                <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset(PUBLIC_PATH.'/assets/admin/images/logo-light.svg')}}" alt="" height="80">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{asset(PUBLIC_PATH.'/assets/admin/images/logo-light.png')}}" style="margin-top: 54px " alt="" height="80" >
                                </span>
                </a>
                <h1 class="font-size-14 mt-2" style="color: #fff"> نظام أداء جامعه بنها </h1>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block form-search-products-users" autocomplete="off" style="    margin-top: 48px;">
                <div class="btn-group">
                    <input type="text" name="criteria" class="form-control dropdown-toggle" data-bs-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" placeholder="Search...">
                    <div class="dropdown-menu dropdown-menu-md p-3">

                        <div class="users-result-search">
                            <li class="text-center">no users result</li>
                        </div>
                        <hr>
                        <div class="products-result-search">
                            <li class="text-center">no products result</li>
                        </div>

                    </div>
                </div>
            </form>

        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                     aria-labelledby="page-header-search-dropdown">


                </div>
            </div>




            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>



            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                         src="{{asset(PUBLIC_PATH.'/assets/admin/images/users/avatar-1.jpg')}}"
                         alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{auth()->user()->name}}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <form id="logout-form" action="{{route('sub_geha.logout')}}" method="post">
                        @csrf
                    </form>
                    <a class="dropdown-item text-danger" href="javascript:void(0);"
                       onclick="event.preventDefault(); $('#logout-form').submit();"><i
                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                            key="t-logout">تسجيل الخروج</span></a>
                </div>
            </div>


        </div>
    </div>
</header>
