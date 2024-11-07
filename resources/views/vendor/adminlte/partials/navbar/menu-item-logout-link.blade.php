@php($logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout'))

@if (config('adminlte.use_route_url', false))
    @php($logout_url = $logout_url ? route($logout_url) : '')
@else
    @php($logout_url = $logout_url ? url($logout_url) : '')
@endif

<li class="nav-item d-none d-md-block">
    <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <p class=" d-flex text-end">
            <span class="material-symbols-outlined">logout</span>
            {{Auth::user()->name}}   
        </p>
   
    </a>
    <form id="logout-form" action="{{ !auth()->user()->hasRole('general') ? url('admin/logout') : route('user.logout') }}"
        method="GET" style="display: none;">
        @method('GET')
        {{ csrf_field() }}
    </form>
</li>
