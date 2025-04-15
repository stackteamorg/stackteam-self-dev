<!--=====================================-->
<!--=       Breadcrumb Area Start       =-->
<!--=====================================-->
<div class="breadcrum-area">
    <div class="container">
        <div class="breadcrumb">
            <ul class="list-unstyled">
                {{ $slot }}
            </ul>
            @if(isset($title))
            <h1 class="title h2">{{ $title }}</p>
            @endif
            @if(isset($description))
            <p class="description" style="text-align: justify;">{{ $description }}</p>
            @endif
        </div>
    </div>
    <ul class="shape-group-8 list-unstyled">
        <li class="shape shape-1" data-sal="slide-right" data-sal-duration="500" data-sal-delay="100"><img src="{{ asset('abstrak/media/others/bubble-9.png') }}" alt="Bubble"></li>
        <li class="shape shape-2" data-sal="slide-left" data-sal-duration="500" data-sal-delay="200"><img src="{{ asset('abstrak/media/others/bubble-11.png') }}" alt="Bubble"></li>
        <li class="shape shape-3" data-sal="slide-up" data-sal-duration="500" data-sal-delay="300"><img src="{{ asset('abstrak/media/others/line-4.png') }}" alt="Line"></li>
    </ul>
</div>