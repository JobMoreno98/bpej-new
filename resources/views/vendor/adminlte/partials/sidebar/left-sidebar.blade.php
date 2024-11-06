@php($logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout'))
@php($profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout'))
<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if (config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if (config('adminlte.sidebar_nav_animation_speed') != 300) data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif
                @if (!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>


                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')


                <li class="nav-item d-md-none">

                    {{-- Menu toggler --}}
                    <a class="nav-link d-flex text-end" href=""  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="material-symbols-outlined">logout</span>
                        <p style="padding-left:5px;">
                            {{Auth::user()->name}}                           
                        </p>
                    </a>
                </li>
                <form id="logout-form" action="{{ (!auth()->user()->hasRole('general'))? url( 'admin/logout') : route('user.logout') }}" method="POST" style="display: none;">
                    @if (config('adminlte.logout_method'))
                        {{ method_field(config('adminlte.logout_method')) }}
                    @endif
                    {{ csrf_field() }}
                </form>

            </ul>
        </nav>
    </div>

</aside>
