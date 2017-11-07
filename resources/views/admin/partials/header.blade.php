<div class="page-header-inner">
    <div class="page-header-inner">
        {{--<div class="navbar-header">--}}
        {{--<a href="{{ url('/') }}" class="navbar-brand" style="padding: 5px 0;">--}}
        {{--<img style="max-width: 100%; width: 60px; padding: 10px" class="img_logo" src="http://www.sassyinfotech.com/images/logo2.png" />--}}
        {{--<img style="max-width: 100%; width: 60px; padding: 10px" class="img_logo" src="{{ asset('public/quickadmin/images/admin-logo.png') }}" />--}}
        {{--</a>--}}
        {{--</div>--}}
        <div class="navbar-header">
            <a  href="{{ url('/') }}" class="navbar-brand logo-brand">
                {{--<img style="max-width: 100%; width: 60px; padding: 10px" class="img_logo" src="{{ asset('public/quickadmin/images/admin-logo.png') }}" />--}}
                <img class="img_logo" src="{{ asset('public/quickadmin/images/admin-logo.png') }}" />
            </a>
        </div>
        <a href="javascript:;"
           class="menu-toggler responsive-toggler"
           data-toggle="collapse"
           data-target=".navbar-collapse">
        </a>
        
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                {{--<li>
                  <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">Logout</span>
                  </a>
                </li>--}}
                <li class="dropdown">
                    <?php //use Helpers; ?>
                    <?php $data = Helpers::getemplprofile(); ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#C5C5C5;">
                        <?php if($data['profile_pic'] != ""){ ?>
                        <img style="width: 24px; margin: 0 5px; border-radius: 50% !important;" src="{!! url('/').'/public/uploads/profile_pic/'.$data['profile_pic'] !!}" />
                        <?php }else{ ?>
                        <img style="width: 24px; margin: 0 5px;" src="{{ asset('public/uploads/demo_user.png') }}" />
                        <?php } ?>
                        <strong><?php echo $data['name']; ?></strong>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="text-center"><strong><?php echo $data['name']; ?></strong></p>
                                        <p class="text-center small"><?php echo $data['email']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li class="user-footer">
                            <div class="col-sm-5">
                                <div class="pull-left">
                                    <a href="{{ url('/admin') }}/users/<?php echo $data['id']; ?>/edit" style="color:#3c8dbc; border-color: #3c8dbc;" class="btn btn-default btn-flat"><i class="fa fa-user" style="color:#3c8dbc;" title="User Profile"></i></a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/admin/change-password') }}" style="color:#3c8dbc; border-color: #3c8dbc;" class="btn btn-default btn-flat"><i class="fa fa-lock" style="color:#3c8dbc;" title="Change Password"></i></a>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="pull-right">
                                    <a href="#logout" onclick="$('#logout').submit();" style="color:#3c8dbc; border-color: #3c8dbc;" class="btn btn-default btn-flat"><i class="fa fa-power-off" style="color:#3c8dbc;" title="Logout"></i></a>
                                </div>
                            </div>
                        </li>
                        <li class="user-footer">&nbsp;</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>