<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);

// Replace the filter buttons block
$oldFilterHtml = '<button class="btn is-checked" data-filter="*">
                                All Products
                            </button>
                            @foreach($categories as $key=>$cat)

                            <button class="btn" data-filter=".{{$cat->id}}">
                                {{$cat->title}}
                            </button>
                            @endforeach';

$newFilterHtml = '<button class="btn is-checked desk-pill-mobile-circle" data-filter="*">
                                <div class="icon-wrap d-md-none"><i class="ti-layout-grid2"></i></div>
                                <span class="cat-name">All Products</span>
                            </button>
                            @foreach($categories as $key=>$cat)
                            <button class="btn desk-pill-mobile-circle" data-filter=".{{$cat->id}}">
                                <div class="icon-wrap d-md-none">
                                    @if($cat->photo)
                                        @php $cat_photos = explode(\',\', $cat->photo); @endphp
                                        <img src="{{$cat_photos[0]}}" alt="{{$cat->title}}">
                                    @else
                                        <i class="ti-tag"></i>
                                    @endif
                                </div>
                                <span class="cat-name">{{$cat->title}}</span>
                            </button>
                            @endforeach';

// Need to do a smarter replacement because spacing might differ.
$c = preg_replace('/<button class="btn is-checked" data-filter="\*">\s*All Products\s*<\/button>\s*@foreach\(\$categories as \$key=>\$cat\)\s*<button class="btn" data-filter="\.\{\{\$cat->id\}\}">\s*\{\{\$cat->title\}\}\s*<\/button>\s*@endforeach/s', $newFilterHtml, $c);

// Add CSS to the bottom
$css = '
<style>
/* MOBILE CIRCULAR CATEGORY FILTERS */
@media (max-width: 767px) {
    .filter-tope-group {
        flex-wrap: nowrap !important;
        overflow-x: auto !important;
        overflow-y: hidden !important;
        justify-content: flex-start !important;
        padding-bottom: 15px !important;
        gap: 15px !important;
        margin-bottom: 20px !important;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }
    .filter-tope-group::-webkit-scrollbar {
        height: 3px;
    }
    .filter-tope-group::-webkit-scrollbar-thumb {
        background: #ddd;
        border-radius: 4px;
    }
    .filter-tope-group .btn.desk-pill-mobile-circle {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        min-width: 70px !important;
    }
    .desk-pill-mobile-circle .icon-wrap {
        width: 60px !important;
        height: 60px !important;
        background: #fff !important;
        border-radius: 50% !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08) !important;
        border: 2px solid transparent !important;
        margin-bottom: 8px !important;
        overflow: hidden !important;
        transition: all 0.3s ease;
    }
    .desk-pill-mobile-circle.is-checked .icon-wrap, 
    .desk-pill-mobile-circle.active .icon-wrap,
    .desk-pill-mobile-circle.how-active1 .icon-wrap {
        border-color: var(--primary-color) !important;
        box-shadow: 0 4px 12px rgba(247, 148, 29, 0.25) !important;
    }
    .desk-pill-mobile-circle .icon-wrap img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }
    .desk-pill-mobile-circle .icon-wrap i {
        font-size: 22px !important;
        color: #777 !important;
    }
    .desk-pill-mobile-circle.is-checked .icon-wrap i,
    .desk-pill-mobile-circle.active .icon-wrap i,
    .desk-pill-mobile-circle.how-active1 .icon-wrap i {
        color: var(--primary-color) !important;
    }
    .desk-pill-mobile-circle .cat-name {
        font-size: 11px !important;
        font-weight: 700 !important;
        color: #444 !important;
        white-space: nowrap !important;
    }
    .desk-pill-mobile-circle.is-checked .cat-name,
    .desk-pill-mobile-circle.active .cat-name,
    .desk-pill-mobile-circle.how-active1 .cat-name {
        color: var(--primary-color) !important;
    }
}
@media (min-width: 768px) {
    .desk-pill-mobile-circle .icon-wrap { display: none !important; }
}
</style>
';

if (strpos($c, '@endpush') !== false) {
    $c = str_replace('@endpush', $css . "\n@endpush", $c);
} else {
    $c .= "\n" . $css;
}

file_put_contents($f, $c);
echo "Category filter updated!";
?>
