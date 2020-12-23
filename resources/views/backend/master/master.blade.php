<!DOCTYPE html>
<html lang="en">
    <head>

        <title> Shopules Admin </title>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Favicon-->
        <link rel="apple-touch-icon" sizes="57x57"
         href="{{ asset('favicon/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">

        <!-- iconfont CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('icon/icofont/icofont.min.css')}}">
        <!-- Boxicon CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('icon/boxicons-master/css/boxicons.min.css')}}">

        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
    </head>
    
    <body class="app sidebar-mini">

        <!-- Navbar-->
        <header class="app-header">
            <a class="app-header__logo" href="index.html">
                <img src="{{ asset('logo/logo_wh_transparent.png')}}" style="width: 50px; height: 50px">
                Shopules
            </a>
            
            <!-- Sidebar toggle button-->
            <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar">
                <i class="icofont-navigation-menu"></i>
            </a>
          
            <!-- Navbar Right Menu-->
            <ul class="app-nav">
                <li class="app-search">
                    <input class="app-search__input" type="search" placeholder="Search">
                    <button class="app-search__button">
                        <i class="icofont-search-2"></i>
                    </button>
                </li>

                <!-- User Menu-->
                <li class="dropdown">
                    <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                        <i class="icofont-user-alt-3"></i>
                </a>
                  <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li>
                        <a class="dropdown-item" href="page-user.html">
                            <i class="icofont-ui-user"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href=""
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                  </ul>
                </li>
            </ul>
        </header>


        <!-- Sidebar menu-->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>


        <aside class="app-sidebar active">
            <div class="app-sidebar__user">
                <div>
                  <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
                  <p class="app-sidebar__user-designation">
                    {{ Auth::user()->roles->first()->name }}</p>
                </div>
            </div>
            
            <ul class="app-menu">
                
                <li>
                    <a class="app-menu__item {{ Request::is('/dashboard') ? 'active' : '' }}" href="{{ route('dashboard')}}">
                        <i class="app-menu__icon icofont-dashboard"></i>
                        <span class="app-menu__label">
                            Dashboard
                        </span>
                    </a>
                </li>

                <li>
                    <a class="app-menu__item {{ Request::is('order') ? 'active' : '' }}" href="">
                        <i class="app-menu__icon icofont-prestashop"></i>
                        <span class="app-menu__label">
                            Order
                        </span>
                    </a>
                </li>

                <li>
                    <a class="app-menu__item {{ Request::is('customer') ? 'active' : '' }}" href="">
                        <i class="app-menu__icon icofont-users-social"></i>
                        <span class="app-menu__label">
                            Customer
                        </span>
                    </a>
                </li>

                <li>
                    <a class="app-menu__item {{ Request::is('brand*') ? 'active' : '' }}" href="{{route('brands.index')}}">
                        <i class="app-menu__icon icofont-ui-tag"></i>
                        <span class="app-menu__label">
                            Brands 
                        </span>
                    </a>
                </li>

                <li>
                    <a class="app-menu__item {{ Request::is('items*') ? 'active' : '' }}" href="{{route('items.index')}}">
                        <i class="app-menu__icon icofont-package"></i>
                        <span class="app-menu__label">
                            Items
                        </span>
                    </a>
                </li>

                <li>
                    <a class="app-menu__item {{ Request::is('subcategories*') ? 'active' : '' }}" href="{{ route('subcategories.index')}}">
                        <i class="app-menu__icon icofont-tags"></i>
                        <span class="app-menu__label">
                            Sub-Category 
                        </span>
                    </a>
                </li>

                <li>
                    <a class="app-menu__item {{ Request::is('categories*') ? 'active' : '' }}" href=" {{ route('categories.index')}}">
                        <i class="app-menu__icon icofont-tag"></i>
                        <span class="app-menu__label">
                            Category 
                        </span>
                    </a>
                </li>
            
                
            </ul>
        </aside>


@yield('body')

        <!-- Essential javascripts for application to work-->
        <script src="{{ asset('js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{ asset('js/popper.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('js/main.js')}}"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="{{ asset('js/plugins/pace.min.js')}}"></script>
        <!-- Page specific javascripts-->
        <!-- Data table plugin-->
        <script type="text/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/dataTables.bootstrap.min.js')}}"></script>
        <script type="text/javascript">$('#sampleTable').DataTable();$('.display').DataTable();</script>
        <!-- Google analytics script-->
        <script type="text/javascript">
          if(document.location.hostname == 'pratikborsadiya.in') {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
          }
        </script>
        @yield('script')
    </body>
</html>