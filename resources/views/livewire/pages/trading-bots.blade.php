<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-xl-2">
                            <a href="{{ route('vendor-program') }}" class="btn btn-light mb-3 mb-lg-0">
                                <i class="bx bxs-plus-square"></i> فروشنده شوید
                            </a>
                        </div>
                        <div class="col-lg-9 col-xl-10">
                            <div class="float-lg-end">
                                <div class="row row-cols-lg-auto g-2">
                                    <div class="col-12">
                                        <input
                                            wire:model.live="search"
                                            type="text"
                                            class="form-control ps-5"
                                            placeholder="جستجو کنید"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($trading_bots->count() > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
            @foreach ($trading_bots as $trading_bot)
                <div class="col">
                    <div class="card" wire:key="trading-bot-{{ $trading_bot->id }}">
                        <img
                            src="{{ asset('storage/' . $trading_bot->thumbnail) }}"
                            class="card-img-top"
                            alt="{{ $trading_bot->title }}"
                        >
                        <div class="card-body">
                            <h3 class="card-title cursor-pointer text-white">{{ $trading_bot->title }}</h3>
                            <div class="clearfix">
                                <p class="mb-0 float-start">
                                    <strong>134</strong> فروش
                                </p>
                                @if($trading_bot->price > 0)
                                    @if($trading_bot->discount_price > 0)
                                        <p class="mb-0 float-end fw-bold">
                                            <span class="me-2 text-decoration-line-through">
                                                {{$trading_bot->price}}
                                            </span>
                                            <br>
                                            <span class="text-white h2">
                                                {{$trading_bot->discount_price}}
                                                تومان
                                            </span>
                                        </p>
                                    @elseif($trading_bot->discount_price == 0)
                                        <p class="mb-0 float-end fw-bold">
                                            <span class="me-2 text-decoration-line-through">
                                                {{$trading_bot->price}}
                                            </span>
                                            <br>
                                            <span class="text-white h2">
                                                رایگان
                                            </span>
                                        </p>
                                    @elseif($trading_bot->discount_price == null)
                                        <p class="mb-0 float-end fw-bold">
                                            <span class="text-white h2">
                                                {{$trading_bot->price}}
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
                                    <livewire:elements.add-to-cart-button
                                        :modelId="$trading_bot->id"
                                        modelType="App\Models\Product\TradingBot"
                                        wire:key="add-to-cart-trading-bot-{{ $trading_bot->id }}"
                                    />
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $trading_bots->links() }}
        </div>
    @else
        <p class="text-center">هیچ رباتی یافت نشد.</p>
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
