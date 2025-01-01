<div class="page-content">
    @livewire('elements.tradingview.ticker-tape')
    <div class="row align-items-center justify-content-center">
        <div class="col-md-8">
            @if(count($sliders) > 0)
                <div class="card">
                    <div class="card-body">
                        <div id="homeSlider" class="carousel carousel-dark slide" data-bs-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($sliders as $index => $slider)
                                    @if($index == 0)
                                        <li data-bs-target="#homeSlider" data-bs-slide-to="0" class="active"
                                            aria-current="true"></li>
                                    @else
                                        <li data-bs-target="#homeSlider" data-bs-slide-to="{{$index}}" class=""></li>
                                    @endif
                                @endforeach

                                {{--<li data-bs-target="#homeSlider" data-bs-slide-to="1" class=""></li>
                                <li data-bs-target="#homeSlider" data-bs-slide-to="2" class="active" aria-current="true"></li>--}}
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($sliders as $index => $slider)
                                    @if($index == 0)
                                        <div class="carousel-item active">
                                            <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100"
                                                 alt="@if($slider->alt != null) {{$slider->alt}} @else مدرن اندیشان @endif">
                                            @if($slider->title != null || $slider->description != null)
                                                <div class="carousel-caption d-none d-md-block">
                                                    @if($slider->title != null)
                                                        <h5>
                                                            {{$slider->title}}
                                                        </h5>
                                                    @endif
                                                    @if($slider->description != null)
                                                        <p>
                                                            {{$slider->description}}
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="carousel-item" data-bs-interval="2000">
                                            <img src="{{ asset('storage/' . $slider->image) }}" class="d-block w-100"
                                                 alt="@if($slider->alt != null) {{$slider->alt}} @else مدرن اندیشان @endif">
                                            @if($slider->title != null || $slider->description != null)
                                                <div class="carousel-caption d-none d-md-block">
                                                    @if($slider->title != null)
                                                        <h5>
                                                            {{$slider->title}}
                                                        </h5>
                                                    @endif
                                                    @if($slider->description != null)
                                                        <p>
                                                            {{$slider->description}}
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#homeSlider" role="button"
                               data-bs-slide="prev"> <span
                                    class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">قبل</span>
                            </a>
                            <a class="carousel-control-next" href="#homeSlider" role="button"
                               data-bs-slide="next"> <span
                                    class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">بعد</span>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center">
                    متاسفانه اسلایدر با برچسب home هیچ آیتمی ندارد...!
                </p>
            @endif
        </div>
        <div class="col-md-3">
            <div class="row">
                @if($best_offer_trading_bot != null)
                    <div class="col">
                        <div class="card position-relative">
                            <span class="badge bg-danger text-white position-absolute end-0 top-0 m-3">پیشنهاد ویژه</span>
                            <a href="{{ route('trading-bot', $best_offer_trading_bot->slug) }}">
                                <img src="{{ asset('storage/' . $best_offer_trading_bot->thumbnail) }}" class="card-img-top"
                                     alt="{{$best_offer_trading_bot->title}}">
                            </a>
                            @if($best_offer_trading_bot->discount_price != null && $best_offer_trading_bot->discount_price < $best_offer_trading_bot->price)
                                <div class="">
                                    <div class="position-absolute top-0 start-0 m-3 product-discount bg-primary">
                                    <span class="">
                                        %{{ number_format((($best_offer_trading_bot->price - $best_offer_trading_bot->discount_price) / $best_offer_trading_bot->price) * 100, 0) }}
                                    </span>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body">
                                <a href="{{ route('trading-bot', $best_offer_trading_bot->slug) }}">
                                    <h3 class="card-title cursor-pointer">{{$best_offer_trading_bot->title}}</h3>
                                </a>
                                <div class="clearfix">
                                    <p class="mb-0 float-start"><strong>134</strong> فروش</p>
                                    @if($best_offer_trading_bot->price > 0)
                                        @if($best_offer_trading_bot->discount_price > 0)
                                            <p class="mb-0 float-end fw-bold">
                                            <span class="me-2 text-decoration-line-through">
                                                {{$best_offer_trading_bot->price}}
                                            </span>
                                                <br>
                                                <span class="text-white h2">
                                                {{$best_offer_trading_bot->discount_price}}
                                                تومان
                                            </span>
                                            </p>
                                        @elseif($best_offer_trading_bot->discount_price == 0)
                                            <p class="mb-0 float-end fw-bold">
                                            <span class="me-2 text-decoration-line-through">
                                                {{$best_offer_trading_bot->price}}
                                            </span>
                                                <br>
                                                <span class="text-white h2">
                                                رایگان
                                            </span>
                                            </p>
                                        @elseif($best_offer_trading_bot->discount_price == null)
                                            <p class="mb-0 float-end fw-bold">
                                            <span class="text-white h2">
                                                {{$best_offer_trading_bot->price}}
                                                تومان
                                            </span>
                                            </p>
                                        @endif
                                    @else
                                        <p class="mb-0 float-end fw-bold">
                                        <span class="text-white h2">
                                            رایگان
                                        </span>
                                        </p>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center mt-3 fs-6">
                                    <div class="cursor-pointer">
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-light-4"></i>
                                        <i class="bx bxs-star text-light-4"></i>
                                    </div>
                                    <p class="mb-0 ms-auto">
                                        @foreach($best_offer_trading_bot->platforms as $platform)
                                            <a href="{{ route('platform', $platform->slug) }}">
                                                <img data-bs-toggle="tooltip" data-bs-placement="top"
                                                     data-bs-original-title="{{$platform->title}}"
                                                     src="{{ asset('storage/' . $platform->thumbnail) }}"
                                                     class="card-img-top" alt="{{$platform->title}}"
                                                     style="width: 25px; height: 25px">
                                            </a>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">ربات معامله گر پیشنهاد ویژه ای یافت نشد...!</div>
                @endif
            </div>
            <div class="row">
                <div class="col">
                    <div class="card radius-10 bg-success bg-gradient">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-white">کل لایسنس های فعال</p>
                                    <h4 class="my-1 text-white">{{$total_licenses}}</h4>
                                </div>
                                <div class="text-white ms-auto font-35">
                                    <i class="fadeIn animated bx bx-fingerprint"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card radius-10 bg-primary bg-gradient">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0 text-white">نرم‌افزارهای معاملاتی</p>
                                    <h4 class="my-1 text-white">{{$total_products}}</h4>
                                </div>
                                <div class="text-white ms-auto font-35">
                                    <i class="fadeIn animated bx bx-line-chart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-items-center justify-content-center">

        <div class="col-md-2">
            <div class="card bg-white text-dark">
                <div class="card-header text-center display-2">
                    {{--<i class="lni lni-support"></i>--}}
                    <img src="{{asset('assets/images/help-center.png')}}" class="w-75" alt="مرکز پشتیبانی">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-dark">مرکز سوالات</h5>
                    <p class="card-text">پاسخ هایی برای همه سوالات شما</p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card bg-white text-dark">
                <div class="card-header text-center display-2">
                    {{--<i class="lni lni-users"></i>--}}
                    <img src="{{asset('assets/images/support-forum.png')}}" class="w-75" alt="انجمن پشتیبانی">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-dark">انجمن پشتیبانی</h5>
                    <p class="card-text">پشتیبانی سریع مشتریان</p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card bg-white text-dark">
                <div class="card-header text-center display-2">
                    {{--<i class="fadeIn animated bx bx-code-curly"></i>--}}
                    <img src="{{asset('assets/images/coding-service.png')}}" class="w-75" alt="خدمات کدنویسی">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-dark">خدمات کدنویسی</h5>
                    <p class="card-text">ابزارهای تجاری ساخته شده سفارشی</p>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="card bg-white text-dark">
                <div class="card-header text-center display-2">
                    {{--<i class="fadeIn animated bx bx-meteor"></i>--}}
                    <img src="{{asset('assets/images/free-software.png')}}" class="w-75" alt="نرم افزار رایگان">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-dark">نرم افزار رایگان</h5>
                    <p class="card-text">آخرین نسل نرم افزار های مالی</p>
                </div>
            </div>
        </div>

    </div>

    <div class="row my-4">
        <h2 class="my-3 h1 text-center">
            <i class="fadeIn animated bx bx-bot"></i>
            آخرین ربات های معامله گر مدرن اندیشان
        </h2>
        @if(count($trading_bots) > 0)
            <div class="swiper tradingBotsSwiper">
                <div class="swiper-wrapper">
                    @foreach($trading_bots as $trading_bot)
                        <div class="swiper-slide">
                            <div class="col">
                                <div class="card">
                                    <a href="{{ route('trading-bot', $trading_bot->slug) }}">
                                        <img src="{{ asset('storage/' . $trading_bot->thumbnail) }}" class="card-img-top"
                                             alt="{{$trading_bot->title}}">
                                    </a>
                                    @if($trading_bot->discount_price != null && $trading_bot->discount_price < $trading_bot->price)
                                        <div class="">
                                            <div class="position-absolute top-0 start-0 m-3 product-discount">
                                    <span class="">
                                        %{{ number_format((($trading_bot->price - $trading_bot->discount_price) / $trading_bot->price) * 100, 0) }}
                                    </span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <a href="{{ route('trading-bot', $trading_bot->slug) }}">
                                            <h3 class="card-title cursor-pointer">
                                                {{$trading_bot->title}}
                                            </h3>
                                        </a>
                                        <div class="clearfix">
                                            @if($trading_bot->discount_price != null && $trading_bot->discount_price < $trading_bot->price)
                                                <p class="mb-0 float-end fw-bold">
                                            <span class="me-2 text-decoration-line-through">
                                                {{$trading_bot->price}}
                                            </span>
                                                    <br>
                                                    <span class="text-white">{{$trading_bot->discount_price}}
                                                    تومان
                                            </span>
                                                </p>
                                            @else
                                                <p class="mb-0 float-end fw-bold">
                                            <span class="text-white">{{$trading_bot->price}}
                                                    تومان
                                            </span>
                                                </p>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center mt-3 fs-6">
                                            <div class="cursor-pointer">
                                                <i class="bx bxs-star text-white"></i>
                                                <i class="bx bxs-star text-white"></i>
                                                <i class="bx bxs-star text-white"></i>
                                                <i class="bx bxs-star text-light-4"></i>
                                                <i class="bx bxs-star text-light-4"></i>
                                            </div>
                                            <p class="mb-0 ms-auto">
                                                @foreach($trading_bot->platforms as $platform)
                                                    <a href="{{ route('platform', $platform->slug) }}">
                                                        <img data-bs-toggle="tooltip" data-bs-placement="top"
                                                             data-bs-original-title="{{$platform->title}}"
                                                             src="{{ asset('storage/' . $platform->thumbnail) }}"
                                                             class="card-img-top" alt="{{$platform->title}}"
                                                             style="width: 25px; height: 25px">
                                                    </a>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <!-- Initialize Swiper -->
            @push('scripts')
                <script>
                    var swiper = new Swiper(".tradingBotsSwiper", {
                        slidesPerView: "auto",
                        loop: true,
                        //slidesPerView: 1, // مقدار پیش‌فرض
                        spaceBetween: 10, // فاصله پیش‌فرض بین اسلایدها
                        breakpoints: {
                            // برای موبایل (عرض کمتر از 640px)
                            640: {
                                slidesPerView: 1,
                                spaceBetween: 20,
                            },
                            // برای تبلت (عرض بین 640px تا 1024px)
                            768: {
                                slidesPerView: 2,
                                spaceBetween: 30,
                            },
                            // برای لپ‌تاپ و بالاتر (عرض بیشتر از 1024px)
                            1024: {
                                slidesPerView: 4,
                                spaceBetween: 4,
                            },
                        },
                        autoplay: {
                            delay: 3000, // هر 4 ثانیه تغییر اسلاید
                            //disableOnInteraction: true, // ادامه حرکت خودکار پس از تعامل
                        },
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                    });
                </script>
            @endpush
        @else
            <p class="text-center">
                ربات معامله گری هنوز در سایت ارائه نشده است...!
            </p>
        @endif
    </div>

    <div class="row my-4">
        <h2 class="my-3 h1 text-center">
            <i class="lni lni-pencil-alt"></i>
            مطالب ویژه وبلاگ مدرن اندیشان
        </h2>
        @if(count($posts) > 0)
            @foreach($posts as $post)
                <div class="col-md-3">
                    <div class="card position-relative">
                        <span class="badge bg-success position-absolute" style="top: 15px; right: 15px">
                            {{$post->category->title}}
                        </span>
                        <img src="{{ asset('storage/' . $post->thumbnail) }}" class="card-img-top" alt="{{$post->title}}">
                        <div class="card-body">
                            <h4 class="card-title">{{$post->title}}</h4>
                            <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                                استفاده از طراحان گرافیک است. </p>
                            <a href="javascript:;" class="btn btn-light w-100">ادامه
                                مطلب</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">
                ربات معامله گری هنوز در سایت ارائه نشده است...!
            </p>
        @endif
    </div>

    @livewire('elements.tradingview.forex-cross-rates')

    <div class="row my-4">
        <h2 class="my-3 h1 text-center">
            <i class="fadeIn animated bx bx-message-edit"></i>
            آخرین اندیکاتورهای مدرن اندیشان
        </h2>
        @if(count($indicators) > 0)
            <div class="swiper indicatorsSwiper">
                <div class="swiper-wrapper">
                    @foreach($indicators as $indicator)
                        <div class="swiper-slide">
                            <div class="col">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $indicator->thumbnail) }}" class="card-img-top"
                                         alt="{{$indicator->title}}">
                                    @if($indicator->discount_price != null && $indicator->discount_price < $indicator->price)
                                        <div class="">
                                            <div class="position-absolute top-0 start-0 m-3 product-discount">
                                    <span class="">
                                        %{{ number_format((($indicator->price - $indicator->discount_price) / $indicator->price) * 100, 0) }}
                                    </span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h3 class="card-title cursor-pointer">
                                            {{$indicator->title}}
                                        </h3>
                                        <div class="clearfix">
                                            @if($indicator->discount_price != null && $indicator->discount_price < $indicator->price)
                                                <p class="mb-0 float-end fw-bold">
                                            <span class="me-2 text-decoration-line-through">
                                                {{$indicator->price}}
                                            </span>
                                                    <br>
                                                    <span class="text-white">{{$indicator->discount_price}}
                                                    تومان
                                            </span>
                                                </p>
                                            @else
                                                <p class="mb-0 float-end fw-bold">
                                            <span class="text-white">{{$indicator->price}}
                                                    تومان
                                            </span>
                                                </p>
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center mt-3 fs-6">
                                            <div class="cursor-pointer">
                                                <i class="bx bxs-star text-white"></i>
                                                <i class="bx bxs-star text-white"></i>
                                                <i class="bx bxs-star text-white"></i>
                                                <i class="bx bxs-star text-light-4"></i>
                                                <i class="bx bxs-star text-light-4"></i>
                                            </div>
                                            <p class="mb-0 ms-auto">
                                                @foreach($indicator->platforms as $platform)
                                                    <img data-bs-toggle="tooltip" data-bs-placement="top"
                                                         data-bs-original-title="{{$platform->title}}"
                                                         src="{{ asset('storage/' . $platform->thumbnail) }}"
                                                         class="card-img-top" alt="{{$platform->title}}"
                                                         style="width: 25px; height: 25px">
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <!-- Initialize Swiper -->
            @push('scripts')
                <script>
                    var swiper = new Swiper(".indicatorsSwiper", {
                        slidesPerView: "auto",
                        loop: true,
                        //slidesPerView: 1, // مقدار پیش‌فرض
                        spaceBetween: 10, // فاصله پیش‌فرض بین اسلایدها
                        breakpoints: {
                            // برای موبایل (عرض کمتر از 640px)
                            640: {
                                slidesPerView: 1,
                                spaceBetween: 20,
                            },
                            // برای تبلت (عرض بین 640px تا 1024px)
                            768: {
                                slidesPerView: 2,
                                spaceBetween: 30,
                            },
                            // برای لپ‌تاپ و بالاتر (عرض بیشتر از 1024px)
                            1024: {
                                slidesPerView: 4,
                                spaceBetween: 4,
                            },
                        },
                        autoplay: {
                            delay: 3000, // هر 4 ثانیه تغییر اسلاید
                            //disableOnInteraction: true, // ادامه حرکت خودکار پس از تعامل
                        },
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                    });
                </script>
            @endpush
        @else
            <p class="text-center">
                اندیکاتوری هنوز در سایت ارائه نشده است...!
            </p>
        @endif
    </div>


</div>
@push('scripts')
    <script>
        $(function () {
            $('[data-bs-toggle="popover"]').popover();
            $('[data-bs-toggle="tooltip"]').tooltip();
        })
    </script>
@endpush
