<!--start header wrapper-->
<div class="header-wrapper">
    <!--start header -->
    <header>
        <div class="topbar d-flex align-items-center">
            <nav class="navbar navbar-expand gap-3">
                <div class="topbar-logo-header d-none d-lg-flex">
                    <div class="">
                        <img src="{{asset('assets/images/ModernAndishanLogo-1.svg')}}" style="width: 100px; height: 100px" class="logo-icon" alt="توضیح تصویر">
                    </div>
                    <div class="">
                        <h4 class="logo-text">مدرن اندیشان</h4>
                    </div>
                </div>
                <div class="mobile-toggle-menu d-block d-lg-none" data-bs-toggle="offcanvas"
                     data-bs-target="#offcanvasNavbar"><i class='bx bx-menu'></i></div>
                <div class="search-bar flex-grow-1">
                    <div class="position-relative search-bar-box">
                        <input type="text" class="form-control search-control" placeholder="جست و جو در مدرن اندیشان...">
                        <span class="position-absolute top-50 search-show translate-middle-y"><i
                                class='bx bx-search'></i></span>
                        <span class="position-absolute top-50 search-close translate-middle-y"><i
                                class='bx bx-x'></i></span>
                    </div>
                </div>
                <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center gap-1">
                        <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal"
                            data-bs-target="#SearchModal">
                            <a class="nav-link" href="javascript:;"><i class='bx bx-search'></i>
                            </a>
                        </li>
                        {{--<li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                               data-bs-toggle="dropdown"><img src="assets/images/county/02.png" width="22"
                                                              alt="توضیح تصویر">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item d-flex align-items-center py-2"
                                       href="javascript:;"><img src="assets/images/county/01.png" width="20"
                                                                alt="توضیح تصویر"><span class="ms-2">انگلیسی</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2"
                                       href="javascript:;"><img src="assets/images/county/02.png" width="20"
                                                                alt="توضیح تصویر"><span class="ms-2">فارسی</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2"
                                       href="javascript:;"><img src="assets/images/county/03.png" width="20"
                                                                alt="توضیح تصویر"><span class="ms-2">فرانسوی</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2"
                                       href="javascript:;"><img src="assets/images/county/04.png" width="20"
                                                                alt="توضیح تصویر"><span class="ms-2">ایتالیایی</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2"
                                       href="javascript:;"><img src="assets/images/county/05.png" width="20"
                                                                alt="توضیح تصویر"><span class="ms-2">کلمبیا</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2"
                                       href="javascript:;"><img src="assets/images/county/06.png" width="20"
                                                                alt="توضیح تصویر"><span class="ms-2">اسپانیایی</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2"
                                       href="javascript:;"><img src="assets/images/county/07.png" width="20"
                                                                alt="توضیح تصویر"><span class="ms-2">گرجی</span></a>
                                </li>
                                <li><a class="dropdown-item d-flex align-items-center py-2"
                                       href="javascript:;"><img src="assets/images/county/08.png" width="20"
                                                                alt="توضیح تصویر"><span class="ms-2">هندی</span></a>
                                </li>
                            </ul>
                        </li>--}}
                        @if(count($socials) > 0)
                            <li class="nav-item dropdown dropdown-app">
                                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret"
                                   data-bs-toggle="dropdown" href="javascript:;"><i class='bx bx-grid-alt'></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-0">
                                    <div class="app-container p-2 my-2">
                                        <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
                                        @foreach($socials as $socail)

                                        @endforeach
                                            <div class="col">
                                                <a href="{{$socail->link}}" target="_blank">
                                                    <div class="app-box text-center">
                                                        <div class="app-icon">

                                                            <img src="{{ asset('storage/' . $socail->logo) }}" width="30"
                                                                 alt="{{$socail->title}}">
                                                        </div>
                                                        <div class="app-name">
                                                            <p class="mb-0 mt-1">{{$socail->title}}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif

                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                               href="#" data-bs-toggle="dropdown"><span class="alert-count">7</span>
                                <i class='bx bx-bell'></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">اعلانها</p>
                                        <p class="msg-header-badge">8 جدید</p>
                                    </div>
                                </a>
                                <div class="header-notifications-list">
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{asset('assets/images/avatars/avatar-1.png')}}" class="msg-avatar"
                                                     alt="توضیح تصویر">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">دنیا اوحدی<span
                                                        class="msg-time float-end">5 ثانیه قبل</span></h6>
                                                <p class="msg-info">لورم ایپسوم متن ساختگی</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <a href="javascript:;">
                                    <div class="text-center msg-footer">
                                        <button class="btn btn-primary w-100">نمایش همه اعلان ها</button>
                                    </div>
                                </a>
                            </div>
                        </li>
                        @auth
                            @livewire('elements.cart-menu')
                        @endauth
                    </ul>
                </div>
                <div class="user-box dropdown px-3">

                    @auth
                        <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('assets/images/Astrolabe.png')}}" class="user-img" alt="سامانه اسطرلاب">
                            <div class="user-info">
                                <p class="user-name mb-0">
                                    {{auth()->user()->name . ' ' . auth()->user()->last_name}}
                                </p>
                                <p class="designattion mb-0">
                                    {{auth()->user()->getRoleNames()->join(', ')}}
                                </p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item d-flex align-items-center" href="{{url('/astrolabe')}}"><i
                                        class="bx bx-home-circle fs-5"></i><span>داشبورد</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-user fs-5"></i><span>پروفایل</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-cog fs-5"></i><span>تنظیمات</span></a>
                            </li>

                            <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-dollar-circle fs-5"></i><span>درآمدها</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-download fs-5"></i><span>دانلودها</span></a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                        class="bx bx-log-out-circle"></i><span>خروج</span></a>
                            </li>
                        </ul>
                    @else
                        <a class="d-flex align-items-center nav-link gap-3 dropdown-toggle-nocaret"
                           href="{{url('/astrolabe/login')}}">
                            <img src="{{asset('assets/images/Astrolabe.png')}}" class="user-img" alt="سامانه اسطرلاب">
                            <div class="user-info">
                                <p class="user-name mb-0">
                                    ورود / ثبت نام
                                </p>
                                <p class="designattion mb-0">
                                    سامانه اسطرلاب
                                </p>
                            </div>
                        </a>
                    @endauth



                </div>
            </nav>
        </div>
    </header>
    <!--end header -->
    <!--navigation-->
    <div class="primary-menu">
        <nav class="navbar navbar-expand-lg align-items-center">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                 aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header border-bottom">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="توضیح تصویر">
                        </div>
                        <div class="">
                            <h4 class="logo-text">دش ترنس</h4>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav align-items-center flex-grow-1">
                        <li class="nav-item dropdown">
                            <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{route('home')}}">

                                <div class="parent-icon"><i class='bx bx-home-alt'></i></div>
                                <div class="menu-title d-flex align-items-center">صفحه نخست</div>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret {{ (Route::currentRouteName() == 'trading-bots' || Route::currentRouteName() == 'indicators') ? 'active' : '' }}" href=""
                               data-bs-toggle="dropdown">
                                <div class="parent-icon"><i class="lni lni-dropbox"></i></i>
                                </div>
                                <div class="menu-title d-flex align-items-center">ابزار های معاملاتی</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item {{ Route::currentRouteName() == 'trading-bots' ? 'active' : '' }}" href="{{route('trading-bots')}}">
                                        <i class="fadeIn animated bx bx-bot"></i>
                                        ربات های معامله گر
                                    </a>
                                    <a class="dropdown-item {{ Route::currentRouteName() == 'indicators' ? 'active' : '' }}" href="{{route('indicators')}}">
                                        <i class="fadeIn animated bx bx-message-edit"></i>
                                        اندیکاتور ها
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link {{ Route::currentRouteName() == 'courses' ? 'active' : '' }}" href="{{route('courses')}}">

                                <div class="parent-icon">
                                    <i class="fadeIn animated bx bx-book-bookmark"></i>
                                </div>
                                <div class="menu-title d-flex align-items-center">دوره ها</div>
                            </a>
                        </li>








                        <li class="nav-item dropdown">
                            <a class="nav-link {{ Route::currentRouteName() == 'blog' ? 'active' : '' }}" href="{{route('blog')}}">

                                <div class="parent-icon">
                                    <i class="lni lni-pencil-alt"></i>
                                </div>
                                <div class="menu-title d-flex align-items-center">وبلاگ</div>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}" href="{{route('contact')}}">
                                <div class="menu-title d-flex align-items-center">ارتباط</div>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link {{ Route::currentRouteName() == 'about' ? 'active' : '' }}" href="{{route('about')}}">
                                <div class="menu-title d-flex align-items-center">درباره</div>
                            </a>
                        </li>
                        {{--<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                               data-bs-toggle="dropdown">
                                <div class="parent-icon"><i class='bx bx-cube'></i>
                                </div>
                                <div class="menu-title d-flex align-items-center">اپ ها و صفحات</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="app-emailbox.html"><i
                                            class='bx bx-envelope'></i>ایمیل</a></li>
                                <li><a class="dropdown-item" href="app-chat-box.html"><i
                                            class='bx bx-conversation'></i>اپلیکیشن چت</a></li>
                                <li><a class="dropdown-item" href="app-file-manager.html"><i
                                            class='bx bx-file'></i>مدیریت فایلها</a></li>
                                <li><a class="dropdown-item" href="app-contact-list.html"><i
                                            class='bx bx-microphone'></i>مخاطبین</a></li>
                                <li><a class="dropdown-item" href="app-to-do.html"><i
                                            class='bx bx-check-shield'></i>لیست انجام</a></li>
                                <li><a class="dropdown-item" href="app-invoice.html"><i
                                            class='bx bx-printer'></i>فاکتور</a></li>
                                <li class="nav-item dropend">
                                    <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                       href="javascript:;"><i class='bx bx-file'></i>صفحات</a>
                                    <ul class="dropdown-menu submenu">
                                        <li class="nav-item dropend"><a
                                                class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                                href="javascript:;"><i class='bx bx-radio-circle'></i>خطا</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="errors-404-error.html"><i
                                                            class='bx bx-radio-circle'></i>خطای 404</a></li>
                                                <li><a class="dropdown-item" href="errors-500-error.html"><i
                                                            class='bx bx-radio-circle'></i>خطای 500</a></li>
                                                <li><a class="dropdown-item" href="errors-coming-soon.html"><i
                                                            class='bx bx-radio-circle'></i>بزودی</a></li>
                                                <li><a class="dropdown-item" href="error-blank-page.html"><i
                                                            class='bx bx-radio-circle'></i>صفحه خالی</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="dropdown-item" href="user-profile.html"><i
                                                    class='bx bx-radio-circle'></i>پروفایل کاربر</a></li>
                                        <li><a class="dropdown-item" href="timeline.html"><i
                                                    class='bx bx-radio-circle'></i>تایم لاین</a></li>
                                        <li><a class="dropdown-item" href="faq.html"><i
                                                    class='bx bx-radio-circle'></i>سوالات متداول</a></li>
                                        <li><a class="dropdown-item" href="pricing-table.html"><i
                                                    class='bx bx-radio-circle'></i>قیمت ها</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                               data-bs-toggle="dropdown">
                                <div class="parent-icon"><i class='bx bx-message-square-edit'></i>
                                </div>
                                <div class="menu-title d-flex align-items-center">فرمها</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li> <a class="dropdown-item" href="form-elements.html"><i
                                            class='bx bx-message-square-dots'></i>المان های فرم</a>
                                </li>
                                <li> <a class="dropdown-item" href="form-input-group.html"><i
                                            class='bx bx-book-content'></i>گروه های ورودی</a>
                                </li>
                                <li> <a class="dropdown-item" href="form-layouts.html"><i
                                            class='bx bx-layer'></i>لایه های فرم</a>
                                </li>
                                <li> <a class="dropdown-item" href="form-validations.html"><i
                                            class='bx bx-file-blank'></i>اعتبارسنجی فرم</a>
                                </li>
                                <li> <a class="dropdown-item" href="form-wizard.html"><i
                                            class='bx bx-glasses'></i>فرم مرحله ایی</a>
                                </li>
                                <li> <a class="dropdown-item" href="form-text-editor.html"><i
                                            class='bx bx-edit'></i>ویرایشگر متن</a>
                                </li>
                                <li> <a class="dropdown-item" href="form-file-upload.html"><i
                                            class='bx bx-upload'></i>آپلود فایل</a>
                                </li>
                                <li> <a class="dropdown-item" href="form-date-time-pickes.html"><i
                                            class='bx bx-calendar-check'></i>انتخابگر تاریخ</a>
                                </li>
                                <li> <a class="dropdown-item" href="form-select2.html"><i
                                            class='bx bx-check-double'></i>پلاگین Select2</a>
                                </li>
                                <li> <a class="dropdown-item" href="form-repeater.html"><i
                                            class='bx bx-directions'></i>تکرار کننده فرم</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                               data-bs-toggle="dropdown">
                                <div class="parent-icon"><i class='bx bx-lock'></i>
                                </div>
                                <div class="menu-title d-flex align-items-center">احراز هویت</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item dropend">
                                    <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                       href="javascript:;"><i class='bx bx-receipt'></i>ساده</a>
                                    <ul class="dropdown-menu submenu">
                                        <li><a class="dropdown-item" href="auth-basic-signin.html"><i
                                                    class='bx bx-radio-circle'></i>ورود</a></li>
                                        <li><a class="dropdown-item" href="auth-basic-signup.html"><i
                                                    class='bx bx-radio-circle'></i>ثبت نام</a></li>
                                        <li><a class="dropdown-item" href="auth-basic-forgot-password.html"><i
                                                    class='bx bx-radio-circle'></i>فراموشی رمز ورود</a></li>
                                        <li><a class="dropdown-item" href="auth-basic-reset-password.html"><i
                                                    class='bx bx-radio-circle'></i>بازنشانی رمز</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropend">
                                    <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                       href="javascript:;"><i class='bx bx-cylinder'></i>کاور</a>
                                    <ul class="dropdown-menu submenu">
                                        <li><a class="dropdown-item" href="auth-cover-signin.html"><i
                                                    class='bx bx-radio-circle'></i>ورود</a></li>
                                        <li><a class="dropdown-item" href="auth-cover-signup.html"><i
                                                    class='bx bx-radio-circle'></i>ثبت نام</a></li>
                                        <li><a class="dropdown-item" href="auth-cover-forgot-password.html"><i
                                                    class='bx bx-radio-circle'></i>فراموشی رمز ورود</a></li>
                                        <li><a class="dropdown-item" href="auth-cover-reset-password.html"><i
                                                    class='bx bx-radio-circle'></i>بازنشانی رمز</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropend">
                                    <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                       href="javascript:;"><i class='bx bx-aperture'></i>سربرگ و پابرگ</a>
                                    <ul class="dropdown-menu submenu">
                                        <li><a class="dropdown-item" href="auth-header-footer-signin.html"><i
                                                    class='bx bx-radio-circle'></i>ورود</a></li>
                                        <li><a class="dropdown-item" href="auth-header-footer-signup.html"><i
                                                    class='bx bx-radio-circle'></i>ثبت نام</a></li>
                                        <li><a class="dropdown-item"
                                               href="auth-header-footer-forgot-password.html"><i
                                                    class='bx bx-radio-circle'></i>فراموشی رمز ورود</a></li>
                                        <li><a class="dropdown-item"
                                               href="auth-header-footer-reset-password.html"><i
                                                    class='bx bx-radio-circle'></i>بازنشانی رمز</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                               data-bs-toggle="dropdown">
                                <div class="parent-icon"><i class='bx bx-briefcase-alt'></i>
                                </div>
                                <div class="menu-title d-flex align-items-center">المان های یوآی</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li> <a class="dropdown-item" href="widgets.html"><i class='bx bx-wine'></i>ویجت
                                        ها</a></li>
                                <li class="nav-item dropend">
                                    <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                       href="javascript:;"><i class='bx bx-cart'></i>فروشگاهی</a>
                                    <ul class="dropdown-menu submenu">
                                        <li><a class="dropdown-item" href="ecommerce-products.html"><i
                                                    class='bx bx-radio-circle'></i>محصولات</a></li>
                                        <li><a class="dropdown-item" href="ecommerce-products-details.html"><i
                                                    class='bx bx-radio-circle'></i>جزئیات محصول</a></li>
                                        <li><a class="dropdown-item" href="ecommerce-add-new-products.html"><i
                                                    class='bx bx-radio-circle'></i>افزودن محصول جدید</a></li>
                                        <li><a class="dropdown-item" href="ecommerce-orders.html"><i
                                                    class='bx bx-radio-circle'></i>سفارشات</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropend">
                                    <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                       href="javascript:;"><i class='bx bx-ghost'></i>کامپوننت ها</a>
                                    <ul class="dropdown-menu scroll-menu">
                                        <li><a class="dropdown-item" href="component-alerts.html"><i
                                                    class='bx bx-radio-circle'></i>هشدارها</a></li>
                                        <li><a class="dropdown-item" href="component-accordions.html"><i
                                                    class='bx bx-radio-circle'></i>آکاردیون</a></li>
                                        <li><a class="dropdown-item" href="component-badges.html"><i
                                                    class='bx bx-radio-circle'></i>بج ها</a></li>
                                        <li><a class="dropdown-item" href="component-buttons.html"><i
                                                    class='bx bx-radio-circle'></i>دکمه ها</a></li>
                                        <li><a class="dropdown-item" href="component-cards.html"><i
                                                    class='bx bx-radio-circle'></i>کارت ها</a></li>
                                        <li><a class="dropdown-item" href="component-carousels.html"><i
                                                    class='bx bx-radio-circle'></i>اسلایدرها</a></li>
                                        <li><a class="dropdown-item" href="component-list-groups.html"><i
                                                    class='bx bx-radio-circle'></i>لیست ها</a></li>
                                        <li><a class="dropdown-item" href="component-media-object.html"><i
                                                    class='bx bx-radio-circle'></i>آبجکت های رسانه</a></li>
                                        <li><a class="dropdown-item" href="component-modals.html"><i
                                                    class='bx bx-radio-circle'></i>مودالها</a></li>
                                        <li><a class="dropdown-item" href="component-navs-tabs.html"><i
                                                    class='bx bx-radio-circle'></i>تب و نو ها</a></li>
                                        <li><a class="dropdown-item" href="component-navbar.html"><i
                                                    class='bx bx-radio-circle'></i>نوبار</a></li>
                                        <li><a class="dropdown-item" href="component-paginations.html"><i
                                                    class='bx bx-radio-circle'></i>صفحه شماری</a></li>
                                        <li><a class="dropdown-item" href="component-popovers-tooltips.html"><i
                                                    class='bx bx-radio-circle'></i>پاپ آپ و تولتیپ ها</a></li>
                                        <li><a class="dropdown-item" href="component-progress-bars.html"><i
                                                    class='bx bx-radio-circle'></i>میله پیشرفت</a></li>
                                        <li><a class="dropdown-item" href="component-spinners.html"><i
                                                    class='bx bx-radio-circle'></i>اسپینرها</a></li>
                                        <li><a class="dropdown-item" href="component-notifications.html"><i
                                                    class='bx bx-radio-circle'></i>اعلانها</a></li>
                                        <li><a class="dropdown-item" href="component-avtars-chips.html"><i
                                                    class='bx bx-radio-circle'></i>آواتار</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropend">
                                    <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                       href="javascript:;"><i class='bx bx-card'></i>محتوا</a>
                                    <ul class="dropdown-menu submenu">
                                        <li><a class="dropdown-item" href="content-grid-system.html"><i
                                                    class='bx bx-radio-circle'></i>سیستم شبکه ای</a></li>
                                        <li><a class="dropdown-item" href="content-typography.html"><i
                                                    class='bx bx-radio-circle'></i>تایپوگرافی</a></li>
                                        <li><a class="dropdown-item" href="content-text-utilities.html"><i
                                                    class='bx bx-radio-circle'></i>ابزارهای متن</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropend">
                                    <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                       href="javascript:;"><i class='bx bx-droplet'></i>آیکن ها</a>
                                    <ul class="dropdown-menu submenu">
                                        <li><a class="dropdown-item" href="icons-line-icons.html"><i
                                                    class='bx bx-radio-circle'></i>آیکن خطی</a></li>
                                        <li><a class="dropdown-item" href="icons-boxicons.html"><i
                                                    class='bx bx-radio-circle'></i>باکس آیکن</a></li>
                                        <li><a class="dropdown-item" href="icons-feather-icons.html"><i
                                                    class='bx bx-radio-circle'></i>فیدر آیکن</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                               data-bs-toggle="dropdown">
                                <div class="parent-icon"><i class='bx bx-line-chart'></i>
                                </div>
                                <div class="menu-title d-flex align-items-center">چارت ها</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="charts-apex-chart.html"><i
                                            class='bx bx-bar-chart-alt-2'></i>اپکس</a></li>
                                <li><a class="dropdown-item" href="charts-chartjs.html"><i
                                            class='bx bx-line-chart'></i>چارت جی اس</a></li>
                                <li><a class="dropdown-item" href="charts-highcharts.html"><i
                                            class='bx bx-pie-chart-alt'></i>هایچارتز</a></li>
                                <li class="nav-item dropend">
                                    <a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret"
                                       href="javascript:;"><i class='bx bx-map-pin'></i>نقشه ها</a>
                                    <ul class="dropdown-menu submenu">
                                        <li><a class="dropdown-item" href="map-google-maps.html"><i
                                                    class='bx bx-radio-circle'></i>نقشه گوگل</a></li>
                                        <li><a class="dropdown-item" href="map-vector-maps.html"><i
                                                    class='bx bx-radio-circle'></i>نقشه های وکتور</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                               data-bs-toggle="dropdown">
                                <div class="parent-icon"><i class="bx bx-grid-alt"></i>
                                </div>
                                <div class="menu-title d-flex align-items-center">جداول</div>
                                <div class="ms-auto dropy-icon"><i class='bx bx-chevron-down'></i></div>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="table-basic-table.html"><i
                                            class='bx bx-table'></i>جدول ساده</a></li>
                                <li><a class="dropdown-item" href="table-datatable.html"><i
                                            class='bx bx-data'></i>جدول داده </a></li>
                            </ul>
                        </li>--}}
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--end navigation-->
</div>
<!--end header wrapper-->
