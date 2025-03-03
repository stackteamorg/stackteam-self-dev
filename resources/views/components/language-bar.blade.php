<li class="has-dropdown"><i class="fa-regular fa-language"></i>
    <ul class="axil-submenu">
        @foreach ($languages as $locate => $lang)
        <li><a href="{{ $lang['url'] }}">{{ $lang['flag'] }} {{ $lang['title'] }}</a></li>
        @endforeach
    </ul>
</li>
