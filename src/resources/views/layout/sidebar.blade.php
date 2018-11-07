<div class="sidebar" data-color="{{ $color_sidebar }}" style="--sidebar-color: {{ $color_sidebar }};">
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
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li {!! route('admin.dashboard') == URL::current() ? 'class="active"' : ''  !!}>
                <a href="{{ route('admin.dashboard')  }}">
                    <i class="now-ui-icons design_app"></i>
                    <p>Главная</p>
                </a>
            </li>
            <li>
                <a href="./icons.html">
                    <i class="now-ui-icons education_atom"></i>
                    <p>Иконки</p>
                </a>
            </li>
            <li {!! route('admin.map') == URL::current() ? 'class="active"' : ''  !!}>
                <a href="{{ route('admin.map')  }}">
                    <i class="now-ui-icons location_map-big"></i>
                    <p>Карта</p>
                </a>
            </li>
            <li>
                <a href="./notifications.html">
                    <i class="now-ui-icons ui-1_bell-53"></i>
                    <p>Уведомления</p>
                </a>
            </li>
            <li>
                <a href="./user.html">
                    <i class="now-ui-icons users_single-02"></i>
                    <p>Профиль пользователя</p>
                </a>
            </li>
            <li>
                <a href="./tables.html">
                    <i class="now-ui-icons design_bullet-list-67"></i>
                    <p>Список таблиц</p>
                </a>
            </li>
            <li>
                <a href="./typography.html">
                    <i class="now-ui-icons text_caps-small"></i>
                    <p>Типография</p>
                </a>
            </li>
            <li {!! route('admin.setting.index') == URL::current() ? 'class="active"' : ''  !!}>
                <a href="{{  route('admin.setting.index') }}">
                    <i class="now-ui-icons ui-2_settings-90"></i>
                    <p>Настройки</p>
                </a>
            </li>
        </ul>
    </div>
</div>
