<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">ربات‌های معامله‌گر</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{$trading_bot->title}}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4 border-end text-center">
                <img src="{{ asset('storage/' . $trading_bot->thumbnail) }}" class="img-fluid w-100" alt="{{$trading_bot->title}}">
                @if($trading_bot->catalog_file != null)
                    <a class="btn btn-dark my-4" target="_blank" href="{{ asset('storage/' . $trading_bot->catalog_file) }}">
                        <i class="lni lni-download"></i>
                        دانلود PDF کاتالوگ <span class="text-warning">{{$trading_bot->title}}</span>
                    </a>
                @endif
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h1 class="card-title text-white">{{$trading_bot->title}}</h1>
                    <div class="d-flex gap-3 py-3">
                        <div class="cursor-pointer">
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star"></i>
                        </div>
                        <div>142 نظر</div>
                        <div class="text-white"><i class="bx bxs-cart-alt align-middle"></i> 134 سفارش</div>
                    </div>
                    <div class="mb-3">
                        @if($trading_bot->price > 0)
                            @if($trading_bot->discount_price > 0)
                                <span class="price h4">
                                    {{$trading_bot->discount_price}}
                                    تومان
                                </span>
                                /
                                <span class="text-decoration-line-through">
                                    {{$trading_bot->price}}
                                    تومان
                                </span>
                            @elseif($trading_bot->discount_price == 0)
                                <span class="price h4">
                                    رایگان
                                </span>
                                /
                                <span class="text-decoration-line-through">
                                    {{$trading_bot->price}}
                                    تومان
                                </span>
                            @elseif($trading_bot->discount_price == null)
                                <span class="price h4">
                                    {{$trading_bot->price}}
                                </span>
                            @endif
                        @else
                            <span class="price h4">
                                    رایگان
                                </span>
                        @endif

                    </div>
                    <p class="card-text fs-6" style="text-align: justify">
                        {!! $trading_bot->short_description !!}
                    </p>
                    <div class="container-fluid">
                        <dl class="row align-items-center">
                            <hr>
                            <dt class="col-sm-6 text-center fw-bolder">پلتفرم های ربات</dt>
                            <dd class="col-sm-6 text-center mb-sm-3">
                                @foreach($trading_bot->platforms as $platform)
                                    <a href="{{ route('platform', $platform->slug) }}">
                                        <img data-bs-toggle="tooltip" data-bs-placement="top"
                                             data-bs-original-title="{{$platform->title}}"
                                             src="{{ asset('storage/' . $platform->thumbnail) }}"
                                             class="card-img-top" alt="{{$platform->title}}"
                                             style="width: 40px; height: 40px">
                                    </a>
                                @endforeach
                            </dd>
                            <hr>
                            <dt class="col-sm-6 text-center fw-bolder">رمز فایل دانلودی</dt>
                            <dd class="col-sm-6 text-center mb-sm-3 text-warning">modernandishan.ir</dd>
                            <hr>
                            <dt class="col-sm-6 text-center fw-bolder">مدت زمان آماده سازی</dt>
                            <dd class="col-sm-6 text-center mb-sm-3 text-warning">بلادرنگ</dd>
                            <hr>
                            <dt class="col-sm-6 text-center fw-bolder">لایسنس</dt>
                            <dd class="col-sm-6 text-center mb-sm-3 text-warning">یکساله</dd>
                            <hr>
                            <dt class="col-sm-6 text-center fw-bolder">بروزرسانی</dt>
                            <dd class="col-sm-6 text-center mb-sm-3 text-warning">مادام‌العمر</dd>
                            <hr>
                            <dt class="col-sm-6 text-center fw-bolder">نسخه دمو</dt>
                            <dd class="col-sm-6 text-center mb-sm-3 text-warning">دارد</dd>
                        </dl>

                    </div>
                    <hr>
                    <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                        <div class="col">
                            <label class="form-label">تعداد لایسنس</label>
                            <div class="input-group input-spinner">
                                <input wire:model="quantity" type="number" class="form-control" min="1" max="5" step="1">
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">انتخاب پلتفرم</label>
                            <div class="">
                                <label class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="platform" checked="checked">
                                    <div class="form-check-label">همه ی پلتفرم ها
                                    (
                                        @foreach($trading_bot->platforms as $platform)
                                            {{$platform->title}} ,
                                        @endforeach
                                    )
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label">انتخاب مدت لایسنس</label>
                            <div class="">
                                <label class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="license" checked="checked">
                                    <div class="form-check-label">
                                        یکساله
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mt-3">
                        <button class="btn btn-white" wire:click="buyThis">خرید محصول</button>
                        <button class="btn btn-light" wire:click="addToCart" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-original-title="افزودن به سبد خرید">
                            <span class="text">افزودن به سبد خرید</span>
                            <i class="bx bxs-cart-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-2 border-start p-2">
                @if($trading_bot->is_best_offer)
                    <div class="container">
                        <img class="w-100" src="{{ asset('assets/images/best-offer.png') }}" alt="پیشنهاد ویژه مدرن اندیشان">
                    </div>
                @endif
                @if($trading_bot->is_international)
                    <div class="container">
                        <img class="w-100" src="{{ asset('assets/images/international.png') }}" alt="محصول بین المللی مدرن اندیشان">
                    </div>
                @endif
                @if(count($trading_bot->strategies) > 0)
                    <br>
                    <div class="container" style="line-height: 30px">
                        <h4>استراتژی ها:</h4>
                        @foreach($trading_bot->strategies as $strategy)
                            <a class="h3" href="{{ route('strategy', $strategy->slug) }}">
                                <span class="badge bg-primary">{{$strategy->title}}</span>
                            </a>
                        @endforeach
                    </div>
                @endif
                @if(count($trading_bot->tags) > 0)
                    <br>
                    <div class="container" style="line-height: 20px">
                        <h4>برچسب ها:</h4>
                        @foreach($trading_bot->tags as $tag)
                            <span class="badge bg-secondary">{{$tag}}</span>
                        @endforeach
                    </div>
                @endif
                @if($trading_bot->sku != null)
                    <br>
                    <div class="container" style="line-height: 20px">
                        <h4>
                            شناسه محصول (SKU):
                            {{$trading_bot->sku->sku}}
                        </h4>
                    </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="card-body">
            <ul class="nav nav-tabs mb-0" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#description" role="tab" aria-selected="true">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bx-comment-detail font-18 me-1"></i>
                            </div>
                            <div class="tab-title"> توضیحات محصول </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#versions" role="tab" aria-selected="false" tabindex="-1">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="fadeIn animated bx bx-pen font-18 me-1"></i>
                            </div>
                            <div class="tab-title">نسخه ها و تغییرات</div>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#comments" role="tab" aria-selected="false" tabindex="-1">
                        <div class="d-flex align-items-center">
                            <div class="tab-icon"><i class="bx bx-star font-18 me-1"></i>
                            </div>
                            <div class="tab-title">نظرات و امتیاز ها</div>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="tab-content pt-3">
                <div class="tab-pane fade active show" id="description" role="tabpanel">
                    {!! $trading_bot->description !!}
                </div>
                <div class="tab-pane fade" id="versions" role="tabpanel">
                    5 ستاره
                </div>
                <div class="tab-pane fade" id="comments" role="tabpanel">
                    @auth
                        @push('styles')
                            <style>
                                .star-rating {
                                    direction: rtl;
                                    display: inline-flex;
                                    font-size: 2rem;
                                }
                                .star-rating .star {
                                    color: gray;
                                    cursor: pointer;
                                    transition: color 0.2s;
                                }
                                .star-rating .star.selected {
                                    color: gold;
                                }

                                input::placeholder,
                                textarea::placeholder {
                                    color: white;
                                    font-style: italic;
                                    opacity: 1;
                                }

                                input:focus::placeholder,
                                textarea:focus::placeholder {
                                    color: lightgray;
                                }
                            </style>
                        @endpush
                            <div class="container mt-5">
                                <div class="d-flex justify-content-between">
                                    <h3 class="mb-4">ثبت نظر شما</h3>
                                    <div class="mb-3">
                                        <div class="star-rating" id="starRating">
                                            <span class="star selected" data-value="1">&#9733;</span>
                                            <span class="star selected" data-value="2">&#9733;</span>
                                            <span class="star selected" data-value="3">&#9733;</span>
                                            <span class="star selected" data-value="4">&#9733;</span>
                                            <span class="star selected" data-value="5">&#9733;</span>
                                        </div>
                                        <input type="hidden" id="ratingValue" name="rating" value="5">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">متن نظر شما...</label>
                                    <textarea class="form-control" id="comment" rows="4" placeholder="بین 25 تا 1000 کاراکتر"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">ارسال</button>
                            </div>
                        @push('scripts')
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        const stars = document.querySelectorAll('.star-rating .star');
                                        const ratingValue = document.getElementById('ratingValue');

                                        stars.forEach(star => {
                                            star.addEventListener('click', () => {
                                                const value = star.getAttribute('data-value');
                                                ratingValue.value = value; // مقدار انتخاب‌شده در اینجا ذخیره می‌شود.
                                                // همه ستاره‌ها را از حالت انتخاب‌شده پاک می‌کنیم.
                                                stars.forEach(s => s.classList.remove('selected'));
                                                // همه ستاره‌های قبل و این ستاره را انتخاب می‌کنیم.
                                                star.classList.add('selected');
                                                let previousSibling = star.previousElementSibling;
                                                while (previousSibling) {
                                                    previousSibling.classList.add('selected');
                                                    previousSibling = previousSibling.previousElementSibling;
                                                }
                                            });
                                        });
                                    });
                                </script>
                        @endpush
                    @else
                        <div class="alert border-0 alert-dismissible fade show py-2">
                            <div class="d-flex align-items-center">
                                <div class="font-35 text-white"><i class="bx bx-info-circle"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-white">
                                        ابتدا
                                        <a class="btn btn-link" target="_blank" href="{{url('astrolabe/login')}}">وارد شوید</a>
                                    </h6>
                                    <div class="text-white">برای قرار دادن نظرات خود ابتدا باید وارد شوید.</div>
                                </div>
                            </div>
                        </div>
                    @endauth
                    @if(count($comments) > 0)
                        <div class="card radius-10">
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    @foreach($comments as $comment)
                                    <li class="d-flex align-items-center">
                                        <img src="assets/images/avatars/avatar-10.png" class="rounded-circle p-1 border" width="90" height="90" alt="توضیحات تصویر">
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="mt-0 mb-1">لورم ایپسوم متن ساختگی با تولید سادگی</h5>چاپگرها و
                                            متون بلکه
                                            روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                                            مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @else
                        <p class="text-center">هیچ نظری وجود ندارد...!</p>
                    @endif

                </div>
            </div>
        </div>

    </div>
    <h6 class="text-uppercase mb-0">دیگر ربات‌های معامله‌گر</h6>
    <hr>
    @if(count($other_trading_bots) > 0)
        <div class="row row-cols-1 row-cols-lg-3">
            @foreach($other_trading_bots as $other_trading_bot)
                <div class="col">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{asset('storage/'.$other_trading_bot->thumbnail)}}" class="img-fluid" alt="{{$other_trading_bot->title}}">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h4 class="card-title">{{$other_trading_bot->title}}</h4>
                                    <div class="cursor-pointer my-2">
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-white"></i>
                                        <i class="bx bxs-star text-light-4"></i>
                                        <i class="bx bxs-star text-light-4"></i>
                                    </div>
                                    <div class="clearfix">
                                        <p class="mb-0 float-start fw-bold"><span class="me-2 text-decoration-line-through">2400000</span><span class="text-white">1990000</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center">متاسفانه ربات معامله‌گر دیگری یافت نشد...!</p>
    @endif
</div>
@push('scripts')
    <script>
        $(function () {
            $('[data-bs-toggle="popover"]').popover();
            $('[data-bs-toggle="tooltip"]').tooltip();
        })
    </script>
@endpush
