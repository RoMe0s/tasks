@if(isset($user))
    <ul class="nav navbar-nav ml-auto flex-row">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" href="#" id="navbarDropdownMenuLink"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i>
                <span class="hidden-sm-down">Аккаунт</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item waves-effect waves-light" {!! check_current_url(route('profile')) !!}>Настройки</a>
                @can('users.write')
                    <a class="dropdown-item waves-effect waves-light" {!! check_current_url(route('users.index')) !!}>Пользователи</a>
                @endcan
                <a class="dropdown-item waves-effect waves-light" href="{!! route('logout') !!}">Выйти</a>
            </div>
        </li>
    </ul>
@endif
