<div>
    @auth
        <button data-bs-toggle="tooltip" data-bs-placement="top"
                data-bs-original-title="افزودن به سبد خرید"
            class="btn btn-primary"
            wire:click="addToCart"
        >
            <i class="fadeIn animated bx bx-cart-alt"></i>
            <i class="fadeIn animated bx bx-plus"></i>
        </button>
    @else
        <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#loginAttemptsModal">
            <i class="fadeIn animated bx bx-cart-alt"></i>
            <i class="lni lni-ban"></i>
        </button>
    @endauth
</div>
