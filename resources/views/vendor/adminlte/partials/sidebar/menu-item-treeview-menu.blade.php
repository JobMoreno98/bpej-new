<li @isset($item['id']) id="{{ $item['id'] }}" @endisset
    class="nav-item has-treeview {{ $item['submenu_class'] }}">

    {{-- Menu toggler --}}
    <a class="nav-link {{ $item['class'] }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
        href="" {!! $item['data-compiled'] ?? '' !!}>

        <span class="material-symbols-outlined  {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}">
            {{ $item['icon'] }}
        </span>

        <p style="padding-left:5px;">
            {{ $item['text'] }}

            <i class="fas fa-angle-left right"></i>

            @isset($item['label'])
                <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                    {{ $item['label'] }}
                </span>
            @endisset
        </p>

    </a>

    {{-- Menu items --}}
    <ul class="nav nav-treeview">
        @each('adminlte::partials.sidebar.menu-item', $item['submenu'], 'item')
    </ul>

</li>
