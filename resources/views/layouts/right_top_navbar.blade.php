<nav class="navbar navbar-default navbar-static-top fixed-top shadow">
    <div class="navbar-header">
        <!-- Collapsed Hamburger -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse"
                aria-expanded="false">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">

        <!-- Right Side top Navbar -->
        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @guest
                <li><a href="{{ route('login') }}" style="font-size: 15px;color: #064685;font-weight: bold">Login</a>
                </li>
                <li><a href="{{ route('register') }}"
                       style="font-size: 15px;color: #064685;font-weight: bold">Register</a></li>
                @else


                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
                           aria-haspopup="true"
                           style="font-size: 16px;font-family: 'Source Sans Pro', sans-serif;color: #064685;">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            {{ ucfirst(Auth::user()->first_name) }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu login">
                            <li>
                                <a href="{{ route('logout') }}"
                                   style="color: black;margin-left: 20px;font-size: 14px;font-family: 'Source Sans Pro', sans-serif;"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>

                            <li>
                                <a href="{{ route('user.profile') }}"
                                   style="color: black;margin-left: 20px;font-size: 14px;font-family: 'Source Sans Pro', sans-serif;">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    Profile
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('user.create') }}"
                                   style="color: black;margin-left: 20px;font-size: 14px;font-family: 'Source Sans Pro', sans-serif;">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    Create User
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('access.control') }}"
                                   style="color: black;margin-left: 20px;font-size: 14px;font-family: 'Source Sans Pro', sans-serif;">
                                    <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                                    Access Controller
                                </a>
                            </li>

                           @if(\Illuminate\Support\Facades\Auth::user()->type!='Admin')
                                <li>
                                    <a href="{{ route('my.article') }}"
                                       style="color: black;margin-left: 20px;font-size: 14px;font-family: 'Source Sans Pro', sans-serif;">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        My Article
                                    </a>
                                </li>
                               @endif

                        </ul>
                    </li>

                    @endguest
        </ul>
    </div>
</nav>
