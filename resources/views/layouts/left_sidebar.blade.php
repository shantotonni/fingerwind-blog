<div class="sidebar">
    <div>
        <div id="logo">
            <a href="{!! route('home') !!}"><img class="img" width="180px" height="60px" src="{!! asset('img/logo1.png') !!}" alt="StatCounter"></a>
        </div>

        <ul class="nav sidenav">
            <li id="add-project-nav">
                <a href="{!! route('home') !!}"><i class="fa fa-home" aria-hidden="true"></i>
                    Dashboard</a>
            </li>

            @if(\Illuminate\Support\Facades\Auth::user()->type=='admin')
            <li id="add-project-nav">
                <a href="{{ route('category.index') }}"><i class="fa fa-gift " aria-hidden="true"></i>
                    Category
                </a>
            </li>
            @endif

            <li id="add-project-nav">
                <a href="{{ route('article.index') }}">
                    <i class="fa fa-align-justify" aria-hidden="true"></i>
                    Article
                </a>
            </li>

            @if(\Illuminate\Support\Facades\Auth::user()->type=='admin')
            <li id="add-project-nav">
                <a href="{{ route('user-list.index') }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    User List
                </a>
            </li>


            @endif


        </ul>
    </div>
</div>