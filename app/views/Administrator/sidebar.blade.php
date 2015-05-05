<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
<!--         <li class="treeview">
            <a href="#"><span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="#">Link in level 2</a></li>
                <li><a href="#">Link in level 2</a></li>
            </ul>
        </li> -->
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li @if (Request::segment(2) == '') class="active" @endif><a href="{{ URL::to('administrator') }}">Dashboard <span class="sr-only">(current)</span></a></li>

            <li class="header">Webisite</li>

            <li @if (Request::segment(2) == 'post') class="active" @endif>
                <a href="{{ URL::action('PostsController@index') }}">Posts</a>
            </li>
            
            <li @if (Request::segment(2) == 'product') class="active" @endif>
                <a href="{{ URL::action('ProductsController@index') }}">Product</a>
            </li>
            
            <li @if (Request::segment(2) == 'slider') class="active" @endif>
                <a href="{{ URL::action('AdministratorController@getSlider') }}">Slider</a>
            </li>
            
            <li @if (Request::segment(2) == 'sponsor') class="active" @endif>
                <a href="{{ URL::action('AdministratorController@getSponsor') }}">Sponsor</a>
            </li>
            
            <li class="header">Users</li>    
            
            <li @if (Request::segment(2) == 'user') class="active" @endif>
                <a href="{{ URL::action('UAController@index') }}">Users</a>
            </li>
            
            <li @if (Request::segment(2) == 'prepaid') class="active" @endif>
                <a href="{{ URL::action('AdministratorController@getPrepaid') }}">Prepaid Cards</a>
            </li>
            
            <li @if (Request::segment(2) == 'order') class="active" @endif>
                <a href="{{ URL::action('AdministratorController@getOrder') }}">Customer Orders</a>
            </li>
            
            <li @if (Request::segment(2) == 'settings') class="active" @endif>
                <a href="{{ URL::action('AdministratorController@getSettings') }}">Website Settings</a>
            </li>                    
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>