<x-web-layout>
        <!--=====================================-->
        <!--=       بخش تماس شروع می‌شود        =-->
        <!--=====================================-->
        <section class="section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="contact-form-box shadow-box mb--30">
                            <h3 class=" h4" style="text-align: justify;">{{ __('brief.get_free_quote') }}</h3>
                            @if(session('success'))
                                <div class="alert alert-success mb-4">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('brief.store', ['locale' => app()->getLocale()]) }}" class="axil-brief-form">
                                @csrf
                                <div class="form-group">
                                    <label>{{ __('brief.name') }}</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('brief.mobile') }}</label>
                                    <input type="tel" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}">
                                    @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb--40">
                                    <label>{{ __('brief.how_can_we_help') }}</label>
                                    <textarea name="message" id="contact-message" class="form-control textarea @error('message') is-invalid @enderror" cols="30" rows="4">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="axil-btn btn-fill-primary btn-fluid btn-primary">{{ __('brief.get_price_now') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 offset-xl-1">
                        <div class="contact-info mb--100 mb_md--30 mt_md--0 mt--150">
                            <h4 class="title"><i class="fa-duotone fa-solid fa-phone-office"></i></i> تلفن دفتر دبی</h4>
                            <p>{{ __('brief.customer_service_hours') }}</p>
                            <h4 class="phone-number">
                                <img src="{{ asset('abstrak/media/flags/ar.svg') }}" alt="واتساپ" style="width: 60px; height: 60px;">
                                <a href="tel:1234567890" style="direction: ltr;">(+971) 58 155 4476</a>
                            </h4>                        </div>
                        <div class="contact-info mb--100 mb_md--30 mt_md--0 mt--150">
                            <h4 class="title"><i class="fa-duotone fa-solid fa-phone-office"></i></i> تلفن دفتر تهران</h4>
                            <p>{{ __('brief.customer_service_hours') }}</p>
                            <h4 class="phone-number">
                                <img src="{{ asset('abstrak/media/flags/fa.svg') }}" alt="واتساپ" style="width: 60px; height: 60px;">
                                <a href="tel:1234567890" style="direction: ltr;">(+98) 912 0186 223</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="list-unstyled shape-group-12">
                <li class="shape shape-1"><img src="{{ asset('abstrak/media/others/bubble-2.png') }}" alt="حباب"></li>
                <li class="shape shape-2"><img src="{{ asset('abstrak/media/others/bubble-1.png') }}" alt="حباب"></li>
                <li class="shape shape-3"><img src="{{ asset('abstrak/media/others/circle-3.png') }}" alt="دایره"></li>
            </ul>
        </section>

        <!--=====================================-->
        <!--=       بخش مکان شروع می‌شود        =-->
        <!--=====================================-->
        {{-- <section class="section section-padding bg-color-dark overflow-hidden">
            <div class="container">
                <div class="section-heading heading-light-left">
                    <span class="subtitle">{{ __('brief.find_us') }}</span>
                    <h2 class="title">{{ __('brief.our_office') }}</h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="office-location">
                            <div class="thumbnail">
                                <img src="{{ asset('abstrak/media/others/location-3.png') }}" alt="دفتر">
                            </div>
                            <div class="content">
                                <h4 class="title">{{ __('brief.tehran') }}</h4>
                                <p>{{ __('brief.tehran_address') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="office-location">
                            <div class="thumbnail">
                                <img src="{{ asset('abstrak/media/others/location-4.png') }}" alt="دفتر">
                            </div>
                            <div class="content">
                                <h4 class="title">{{ __('brief.dubai') }}</h4>
                                <p>{{ __('brief.dubai_address') }}</p>
                            </div>
                        </div>
                    </div>
            </div>
            <ul class="shape-group-11 list-unstyled">
                <li class="shape shape-1"><img src="{{ asset('abstrak/media/others/line-6.png') }}" alt="خط"></li>
                <li class="shape shape-2"><img src="{{ asset('abstrak/media/others/circle-3.png') }}" alt="خط"></li>
            </ul>
        </section> --}}
</x-web-layout>