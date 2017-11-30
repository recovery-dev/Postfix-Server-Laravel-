<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/') }}" class="site_title"><i class="fa fa-paw"></i> <span><i>Email Parsing</i></span></a>
        </div>
        
        <div class="clearfix"></div>
        
        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="https://colorlib.com/polygon/gentelella/images/img.jpg" alt="Avatar of {{ Auth::user()->name }}" class="img-circle profile_img">
                <!-- <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle profile_img"> -->
            </div>
            <div class="profile_info">
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        
        <br />
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Member</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> IMAP <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/imap/config">Configuration</a></li>
                            <li><a href="/contents">Mailbox</a></li>
                            <li><a href="/task">Task</a></li>
                            <li><a href="/history">History</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/summary">
                            <i class="fa fa-cog"></i>
                            Summary
                            <span class="label label-success pull-right">Status</span>
                        </a>
                    </li>
                    <li><a><i class="fa fa-user"></i> User <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/user/profile">Profile</a></li>
                            <li><a href="/user/update">Update</a></li>
                            <li><a href="/user/roles">Roles</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        
        </div>
        <!-- /sidebar menu -->
        
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>