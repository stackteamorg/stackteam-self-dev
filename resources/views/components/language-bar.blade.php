<li class="has-dropdown"><a href="#">{{ $current['flag'] }} {{ $current['title'] }}</i></a>
    <ul class="axil-submenu">
        @foreach ($languages as $locate => $lang)
        <li><a href="{{ $lang['url'] }}">{{ $lang['flag'] }} {{ $lang['title'] }}</a></li>
        @endforeach
    </ul>
</li>