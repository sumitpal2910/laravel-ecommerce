<!-- get product tags group by -->
@php
# tags english
$tags_en = App\Models\Product::groupBy('tags_en')
    ->select('tags_en')
    ->get();

# tags hindi
$tags_hin = App\Models\Product::groupBy('tags_hin')
    ->select('tags_hin')
    ->get();
@endphp

<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">
        @if (session()->get('language') === 'hindi')
            उत्पाद टैग
        @else
            Product tags
        @endif
    </h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @if (session()->get('language') === 'hindi')
                @foreach ($tags_hin as $tag)
                    <a class="item" title="Phone"
                        href="{{ route('product.tag', ['tag' => $tag->tags_hin]) }}">{{ str_replace(',', ' ', $tag->tags_hin) }}</a>
                @endforeach
            @else
                @foreach ($tags_en as $tag)
                    <a class="item" title="Phone"
                        href="{{ route('product.tag', ['tag' => $tag->tags_en]) }}">{{ str_replace(',', ' ', $tag->tags_en) }}</a>
                @endforeach
            @endif

        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
