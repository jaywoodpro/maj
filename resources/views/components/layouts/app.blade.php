<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'مدرن اندیشان' }}</title>

    <!--favicon-->
    <link rel="icon" href="{{asset('assets/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link rel="stylesheet" href="{{asset('assets/plugins/notifications/css/lobibox.min.css')}}">
    <link href="{{asset('assets/plugins/simplebar/css/simplebar.css" rel="stylesheet')}}" />
    <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/fonts/vazir/Farsi-Digits/Vazirmatn-FD-font-face.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/rtl.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    @stack('styles')
    @livewireStyles
</head>
<body class="bg-theme bg-theme2">
<header>
    {{--@include('')--}}
</header>
<main>
    <!--wrapper-->
    <div class="wrapper">
        @livewire('elements.header')

        <!--start page wrapper -->
        <div class="page-wrapper">
            {{ $slot }}
        </div>
        <!--end page wrapper -->
        @livewire('elements.footer')
    </div>
    <!--end wrapper-->
        <!--start switcher-->
        {{--<div class="switcher-wrapper">
            <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
            </div>
            <div class="switcher-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-uppercase">سفارشی سازی ظاهر</h5>
                    <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
                </div>
                <hr />
                <p class="mb-0">پس زمینه گاوسی</p>
                <hr>
                <ul class="switcher">
                    <li id="theme1"></li>
                    <li id="theme2"></li>
                    <li id="theme3"></li>
                    <li id="theme4"></li>
                    <li id="theme5"></li>
                    <li id="theme6"></li>
                </ul>
                <hr>
                <p class="mb-0">رنگ های گرادیانت</p>
                <hr>
                <ul class="switcher">
                    <li id="theme7"></li>
                    <li id="theme8"></li>
                    <li id="theme9"></li>
                    <li id="theme10"></li>
                    <li id="theme11"></li>
                    <li id="theme12"></li>
                    <li id="theme13"></li>
                    <li id="theme14"></li>
                    <li id="theme15"></li>
                </ul>
            </div>
        </div>--}}
        <!--end switcher-->
    <div class="lobibox-notify-wrapper top right"></div>
    <div class="modal fade" id="loginAttemptsModal" tabindex="-1" aria-labelledby="loginAttemptsModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginAttemptsModalLabel">ابتدا وارد شوید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    برای افزودن یک محصول به سبد خرید ابتدا در سایت ثبت نام کنید یا در صورتی که از قبل ثبت نام کرده اید وارد شوید
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    <a href="{{url('astrolabe/login')}}" type="button" class="btn btn-primary">ورود</a>
                </div>
            </div>
        </div>
    </div>
</main>
<footer>
    {{--@include('')--}}
</footer>
<!-- Bootstrap JS -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/plugins/notifications/js/lobibox.min.js')}}"></script>
<script src="{{asset('assets/plugins/notifications/js/notifications.min.js')}}"></script>
<script src="{{asset('assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('cartUpdated', () => {
            add_to_cart_success_noti();
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('fullOfProduct', () => {
            full_of_product_noti();
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('totalExceedingAllowedLimit', () => {
            total_exceeding_allowed_limit_noti();
        });
    });
    document.addEventListener('click', function (event) {
        const dropdown = document.querySelector('#cart-dropdown .dropdown-menu');
        const toggle = document.querySelector('#cart-dropdown-toggle');

        // اگر دراپ‌داون باز است و کلیک خارج از آن بود
        if (dropdown.classList.contains('show') && !dropdown.contains(event.target) && !toggle.contains(event.target)) {
            toggle.dispatchEvent(new Event('click')); // بستن دراپ‌داون
        }
    });
</script>
{{--<script src="assets/js/index.js"></script>--}}
<!--app JS-->
<script src="{{asset('assets/js/app.js')}}"></script>
<script>
/*    new PerfectScrollbar('.product-list');*/
/*
    new PerfectScrollbar('.customers-list');
*/
</script>
<script src="{{asset('assets/plugins/swiper/swiper-bundle.min.js')}}"></script>
@stack('scripts')
@livewireScripts
</body>
</html>
