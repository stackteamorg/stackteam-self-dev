<li class="menu-item-has-children">
    <a href="javascript:void(0);">

        <img alt="Iran SVG Vector Icon" fetchpriority="high" width="32" height="32" decoding="async" data-nimg="1" src="{{ asset('abstrak/media/flags/fa.svg') }}" style="color: transparent; width: 32px; height: 32px;">
    </a>
    <ul class="axil-submenu">
        @foreach ($languages as $locate => $lang)
        <li><a href="{{ $lang['url'] }}">{{ $lang['flag'] }} {{ $lang['title'] }}</a></li>
        @endforeach
    </ul>
</li>