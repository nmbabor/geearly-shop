<div class="tpproduct mb-30 product-item border rounded"
    data-product-id="{{ $product->id }}"
    data-product-name="{{ $product->name }}"
    data-product-price="{{ $product->price }}"
    data-product-sku="{{ $product->sku }}"
    @if($product->brand)
    data-product-brand="{{ $product->brand->name }}"
    @endif
    @if($product->categories->isNotEmpty())
    data-product-categories="{{ $product->categories->pluck('name')->implode(',') }}"
    @endif
>
    <div class="tpproduct__thumb p-relative">
        <div class="product__badge-list">
            @if ($product->isOutOfStock())
                <span class="tpproduct__thumb-topsall" style="background-color: #ff0000">
                    <span class="product__badge-item">{{ __('Out of stock') }}</span>
                </span>
            @else
                @if ($product->isOnSale() && $product->sale_percent)
                    <span class="tpproduct__thumb-topsall" style="background-color: #328f0a">
                        <span class="product__badge-item">{{ __(':percent% off', ['percent' => $product->sale_percent]) }}</span>
                    </span>
                @endif
                @if ($product->productLabels->isNotEmpty())
                    @foreach ($product->productLabels as $label)
                        <span class="tpproduct__thumb-topsall" {!! $label->css_styles !!}>
                            <span class="product__badge-item">{{ $label->name }}</span>
                        </span>
                    @endforeach
                @endif
            @endif
        </div>
        <a href="{{ $product->url }}" data-bb-toggle="product-link">
            <img src="{{ RvMedia::getImageUrl($product->image, 'small', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
            <img class="product-thumb-secondary" src="{{ RvMedia::getImageUrl(Arr::get($product->images, 1, $product->image), 'small', false, RvMedia::getDefaultImage()) }}" alt="{{ $product->name }}">
        </a>
        @if (EcommerceHelper::isCompareEnabled() || theme_option('enable_quick_view', 'yes') === 'yes' || EcommerceHelper::isWishlistEnabled())
            <div class="tpproduct__thumb-action">
           
                @if (theme_option('enable_quick_view', 'yes') === 'yes')
                    <a class="quickview" href="#" data-url="{{ route('public.ajax.quick-view', $product->id) }}"><i class="fal fa-eye"></i></a>
                @endif
            </div>
        @endif
    </div>
    <div class="tpproduct__content p-2">
        <h3 class="tpproduct__title text-truncate">
            <a href="{{ $product->url }}" title="{{ $product->name }}" data-bb-toggle="product-link">{{ $product->name }}</a>
        </h3>

        @if (EcommerceHelper::isReviewEnabled())
            <div class="mb-2" style="margin-top: -0.75rem">
                <div class="product-rating-wrapper">
                    <div class="product-rating" style="width: {{ $product->reviews_avg * 20 }}%"></div>
                </div>
                <a class="tpproduct-details__reviewers" href="{{ $product->url }}#reviews">({{ $product->reviews_count }})</a>
            </div>
        @endif

        <div class="tpproduct__priceinfo p-relative">
            <div class="tpproduct__priceinfo-lists">
                @include(EcommerceHelper::viewPath('includes.product-price'), [
                    'product' => $product,
                    'priceOriginalClassName' => 'tpproduct__priceinfo-list-oldprice',
                ])
            </div>
            
        </div>
    </div>
</div>
