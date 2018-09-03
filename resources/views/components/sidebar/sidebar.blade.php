<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-default">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <div class="category-content">
                <div class="sidebar-user-material-content">
                    <a href="#"><img src="{{URL::asset('images/image.png')}}" class="img-circle img-responsive" alt=""></a>
                    <h6>{{Auth::user()->name}}</h6>
                    <span class="text-size-small">
                        @if(Auth::user()->hasRole('administrator'))
                            {{Auth::user()->staff->school->name}}
                        @else
                            Bunifu Technologies Limited
                        @endif
                    </span>
                </div>

                <div class="sidebar-user-material-menu">
                    <a href="#user-nav" data-toggle="collapse"><span>My account</span> <i class="caret"></i></a>
                </div>
            </div>
        </div>
        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <!-- Main -->
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                    @foreach($navs as $nav)
                        @component('components.sidebar.navitem', array('nav'=>$nav))
                        @endcomponent
                    @endforeach
                    <!-- /main -->
                    {{--logout--}}
                    <li>
                        <a href="{{route('logout')}}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="icon-switch2"></i><span> Logout</span>
                        </a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                            {{csrf_field()}}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
<!-- /main sidebar -->