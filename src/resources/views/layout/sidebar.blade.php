<div class="sidebar" data-color="{{ $color_sidebar }}" >
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
  -->
    <div class="logo">
        <a href="{{ route('admin.dashboard')  }}" class="simple-text logo-mini">
            MC
        </a>
        <a href="{{ route('admin.dashboard')  }}" class="simple-text logo-normal">
            {{ config('app.name') }}
        </a>
        {{--<div class="navbar-minimize">--}}
            {{--<button id="minimizeSidebar" class="btn btn-simple btn-icon btn-neutral btn-round">--}}
                {{--<i class="now-ui-icons text_align-center visible-on-sidebar-regular"></i>--}}
                {{--<i class="now-ui-icons design_bullet-list-67 visible-on-sidebar-mini"></i>--}}
            {{--</button>--}}
        {{--</div>--}}
    </div>
    <div class="sidebar-wrapper">
        @if(isset($MainMenu))
            @include($prefix.'menu.build', ['items' => $MainMenu->roots()])
        @endif
    </div>
</div>

