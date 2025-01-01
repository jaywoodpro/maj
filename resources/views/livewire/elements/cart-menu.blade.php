<li class="nav-item dropdown dropdown-large" id="cart-dropdown">
    <span id="cart-dropdown-toggle" data-bs-auto-close="false" class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
            class="alert-count">
            {{$totalQuantity}}
        </span>
        <i class='bx bx-shopping-bag'></i>
    </span>
    <div class="dropdown-menu dropdown-menu-end">
        <a href="{{route('filament.astrolabe.pages.cart')}}">
            <div class="msg-header">
                <p class="msg-header-title">سبد خرید</p>
                <p class="msg-header-badge">{{count($cartItems)}} مورد</p>
            </div>
        </a>
        <div class="header-message-list">
            @foreach($cartItems as $cartItem)
                <span class="dropdown-item">
                    <div class="d-flex align-items-center gap-3">
                        <div class="position-relative">
                            <div class="cart-product rounded-circle bg-light overflow-hidden p-0">
                                <img src="{{ asset('storage/' . $cartItem->model->thumbnail) }}" style="width: 50px; height: 50px" alt="توضیح تصویر">
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="cart-product-title mb-0">{{$cartItem->model->title}}</h6>
                            <p class="cart-product-price mb-0">
                                {{$cartItem->quantity}}
                                *
                                @if($cartItem->model->discount_price > 0)
                                    {{$cartItem->model->discount_price}}
                                @else
                                    {{$cartItem->model->price}}
                                @endif
                            </p>
                        </div>
                        <div class="">
                            <p class="cart-price mb-0">
                                @if($cartItem->model->discount_price > 0)
                                    {{$cartItem->model->discount_price * $cartItem->quantity}} تومان
                                @else
                                    {{$cartItem->model->price * $cartItem->quantity}} تومان
                                @endif
                            </p>
                        </div>
                        <div class="cart-product-cancel cursor-pointer">
                            <i class="bx bx-x" wire:click.prevent="decreaseQuantity({{ $cartItem->id }})"></i>
                        </div>
                    </div>
                </span>
            @endforeach
        </div>
        <div class="text-center msg-footer">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="mb-0">مجموع سبد خرید</h5>
                <h5 class="mb-0 ms-auto">
                    {{$totalPrice}}
                    تومان
                </h5>
            </div>
            <a href="{{route('filament.astrolabe.pages.checkout')}}" class="btn btn-primary w-100">تسویه حساب</a>
        </div>
    </div>
</li>
