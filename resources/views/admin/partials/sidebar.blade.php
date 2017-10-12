@inject('request', 'Illuminate\Http\Request')
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu"
            data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200" id="#accordion1">
            <?php //print_r(Auth::user()->role_id);die;//$menu = json_decode(Auth::user()->role->permissions,true); ?>

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }} ">
                <a href="{{ url('/admin/dashboard') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            @if(Helpers::getCurrentUserDetails( 'international' , 'TRUE' ))
            <li class="menu-item ">

                <span><i class="fa fa-group"></i>International Lead</span>
                <ul class="sub-menu-item">
                    <li class="{{ $request->segment(1) == 'international' ? 'active active-sub' : '' }}">
                       @if(Helpers::getCurrentUserDetails('permissions.view','false','true') == 'TRUE')
                        <a href="{{ route('international.index') }}">
                            <i class="fa fa-key"></i>
                            <span class="title"> View Lead </span>
                        </a>
                        @endif
                        @if(Helpers::getCurrentUserDetails('permissions.add','false','true') == 'TRUE')
                        <a href="{{ route('international.create') }}">
                            <i class="fa fa-key"></i>
                            <span class="title"> Add Lead </span>
                        </a>
                        @endif
                    </li>

                </ul>
            </li>
            @endif
            @if(Helpers::getCurrentUserDetails( 'local' , 'TRUE' ))
            <li class="menu-item ">
    
                <span><i class="fa fa-group"></i>Local Lead</span>
                <ul class="sub-menu-item">
                    <li class="{{ $request->segment(1) == 'local' ? 'active active-sub' : '' }}">
                        @if(Helpers::getCurrentUserDetails('permissions.view','false','true') == 'TRUE')
                        <a href="{{ route('local.index') }}">
                            <i class="fa fa-key"></i>
                            <span class="title"> View Lead </span>
                        </a>
                        @endif
                        @if(Helpers::getCurrentUserDetails('permissions.add','false','true') == 'TRUE')
                        <a href="{{ route('local.create') }}">
                            <i class="fa fa-key"></i>
                            <span class="title"> Add Lead </span>
                        </a>
                        @endif
                    </li>
    
                </ul>
            </li>
            @endif
            @if(Helpers::getCurrentUserDetails( 'cold' , 'TRUE' ))
            <li class="menu-item ">
    
                <span><i class="fa fa-group"></i>Cold Lead</span>
                <ul class="sub-menu-item">
                    <li class="{{ $request->segment(1) == 'cold' ? 'active active-sub' : '' }}">
                        @if(Helpers::getCurrentUserDetails('permissions.view','false','true') == 'TRUE')
                        <a href="{{ route('cold.index') }}">
                            <i class="fa fa-key"></i>
                            <span class="title"> View Lead </span>
                        </a>
                        @endif
                        @if(Helpers::getCurrentUserDetails('permissions.add','false','true') == 'TRUE')
                        <a href="{{ route('cold.create') }}">
                            <i class="fa fa-key"></i>
                            <span class="title"> Add Lead </span>
                        </a>
                        @endif
                    </li>
    
                </ul>
            </li>
            @endif
            {{--@if(Helpers::isAdmin() == 1)--}}
            @if(true)
            <li class="menu-item ">

                <span><i class="fa fa-user"></i>Admin User</span>
                <ul class="sub-menu-item">
                    <li class="{{ $request->segment(1) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('roles.index') }}">
                            <i class="fa fa-key"></i>
                            <span class="title">
                                Roles and Permission
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(1) == 'users' ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="title">Sub Admins</span>
                        </a>
                    </li>

                </ul>
            </li>
            @endif
            @if(Helpers::getAdminPermission('transaction.manage')=='true' ||
            Helpers::getAdminPermission('transaction.view')=='true')
            <li class="{{ $request->segment(1) == 'transactions' ? 'active' : '' }}">
                <a href="{{ route('transactions.index') }}">
                    <i class="fa fa-credit-card"></i>
                    <span class="title">Transactions</span>
                </a>
            </li>
            @endif
            @if(Helpers::getAdminPermission('transaction.manage')=='true' ||
            Helpers::getAdminPermission('transaction.view')=='true')
            <li class="{{ $request->segment(1) == 'departments' ? 'active' : '' }}">
                <a href="{{ route('departments.index') }}">
                    <i class="fa fa-credit-card"></i>
                    <span class="title">Transactions</span>
                </a>
            </li>
            @endif
            {{--@if(Helpers::getAdminPermission('template.manage')=='true' ||--}}
            {{--Helpers::getAdminPermission('template.view')=='true' || Auth::guard('admin')->user()->role_id == 1)--}}
            {{--<li class="menu-item">--}}
                {{--<span><i class="fa fa-cog"></i>CMS Managment</span>--}}
                {{--<ul class="sub-menu-item">--}}

                    {{--<li class="{{ Request::is('cms*')? 'active' : '' }}">--}}
                        {{--<a href="{{ route('cms.index') }}">--}}
                            {{--<i class="fa fa-users"></i>--}}
                            {{--<span class="title">CMS</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="{{ Request::is('block*')? 'active' : '' }}">--}}
                        {{--<a href="{{ route('block.index') }}">--}}
                            {{--<i class="fa fa-users"></i>--}}
                            {{--<span class="title">Block</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="{{ Request::is('messages*')? 'active' : '' }}">--}}
                        {{--<a href="{{ route('messages.index') }}">--}}
                            {{--<i class="fa fa-users"></i>--}}
                            {{--<span class="title">Messages</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    
                    {{--<li class="{{ Request::is('notification*')? 'active' : '' }}">--}}
                        {{--<a href="{{ route('notification.index') }}">--}}
                            {{--<i class="fa fa-users"></i>--}}
                            {{--<span class="title">Notification</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    

                    <!--                    @if(Helpers::getAdminPermission('template.manage')=='true' || Helpers::getAdminPermission('template.view')=='true'|| Helpers::getAdminPermission('template.delete')=='true')-->
                    {{--<li class="{{ $request->segment(1) == 'emailtemplate' ? 'active' : '' }}">--}}
                        {{--<a href="{{ route('emailtemplate.index') }}">--}}
                            {{--<i class="fa fa-credit-card"></i>--}}
                            {{--<span class="title">Email Template</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    <!--@endif-->


                {{--</ul>--}}

            {{--</li>--}}
            {{--@endif--}}
            {{--@if(Helpers::getAdminPermission('faq.manage')=='true' || Helpers::getAdminPermission('faq.view')=='true'||--}}
            {{--Helpers::getAdminPermission('faq.delete')=='true')--}}
            {{--<li class="menu-item">--}}
                {{--<span><i class="fa fa-cog"></i>Faq</span>--}}
                {{--<ul class="sub-menu-item">--}}
                    {{--<li class="{{ $request->segment(1) == 'faqcategorys' ? 'active' : '' }}">--}}
                        {{--<a href="{{ route('faqcategorys.index') }}">--}}
                            {{--<i class="fa fa-bar-chart"></i>--}}
                            {{--<span class="title">Categorys</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="{{ $request->segment(1) == 'faqmodule' ? 'active' : '' }}">--}}
                        {{--<a href="{{ route('faqmodule.index') }}">--}}
                            {{--<i class="fa fa-bar-chart"></i>--}}
                            {{--<span class="title">Module</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--@endif--}}
            {{--@if(Helpers::isAdmin() == 1)--}}
            @if(true)
            <li class="menu-item">
                <span><i class="fa fa-cog"></i>Entities</span>
                <ul class="sub-menu-item">
                    {{--<li class="{{ Request::is('storeLanguage*')? 'active' : '' }}">--}}
                        {{--<a href="{{ route('storeLanguage.index') }}">--}}
                            {{--<i class="fa fa-users"></i>--}}
                            {{--<span class="title">Language</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="{{ Request::is('country*')? 'active' : '' }}">--}}
                        {{--<a href="{{ route('country.index') }}">--}}
                            {{--<i class="fa fa-users"></i>--}}
                            {{--<span class="title">Country</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    <li class="{{ Request::is('currency*')? 'active' : '' }}">
                        <a href="{{ route('currency.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="title">Currency</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('follow_up*')? 'active' : '' }}">
                        <a href="{{ route('follow_up.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="title">Follow Up</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('source*')? 'active' : '' }}">
                        <a href="{{ route('source.index') }}">
                            <i class="fa fa-users"></i>
                            <span class="title">Source</span>
                        </a>
                    </li>
                </ul>

            </li>
            @endif
                {{----}}
            {{--@if(Helpers::isAdmin() == 1)--}}
            {{--<li class="menu-item">--}}
                {{--<span><i class="fa fa-cog"></i>Setting</span>--}}
                {{--<ul class="sub-menu-item">--}}
                    {{--<li>--}}
                        {{--<a href="{{ url('admin/readSettingData') }}">--}}
                            {{--<i class="fa fa-users"></i>--}}
                            {{--<span class="title">System Configuration</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="{{ $request->segment(1) == 'meta' ? 'active active-sub' : '' }}">--}}
                        {{--<a href="{{ route('meta.index') }}">--}}
                            {{--<i class="fa fa-users"></i>--}}
                            {{--<span class="title">Website meta</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}

                {{--</ul>--}}
            {{--</li>--}}
            {{--@endif--}}

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</div>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}
