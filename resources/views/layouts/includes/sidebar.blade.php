<!--**********************************
            Sidebar start
        ***********************************-->
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            {{--<li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Admin</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="./index.html">Admin Type</a></li>
                            <li><a href="./index-2.html">Admin Users</a></li>
                        </ul>
                    </li>--}}
            <li>
                <a href="{{ route('admin.enquiry.index')}}" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Enquiries</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.service.index')}}" aria-expanded="false">
                    <i class="icon-badge menu-icon"></i><span class="nav-text">Services</span>
                </a>
            </li>


        </ul>
    </div>
</div>