<?php
// Fix create.blade.php
$f1 = 'resources/views/backend/product/create.blade.php';
$c1 = file_get_contents($f1);

// Replace size select HTML
$search1 = '<label for="size">Size</label>
          <select name="size[]" id="size" class="form-control selectpicker"  multiple data-live-search="true">
              <option value="">--Select any size--</option>
              <option value="S">Small (S)</option>
              <option value="M">Medium (M)</option>
              <option value="L">Large (L)</option>
              <option value="XL">Extra Large (XL)</option>
          </select>';

$replace1 = '<label for="size">Sizes (Type a size and press Enter)</label>
          <select name="size[]" id="size" class="form-control select2-tags" multiple="multiple">
          </select>';

$c1 = str_replace($search1, $replace1, $c1);

// Inject Select2 CSS
$css = '<link href="{{asset(\'frontend/js/select2/css/select2.min.css\')}}" rel="stylesheet" />';
if (strpos($c1, 'select2.min.css') === false) {
    $c1 = str_replace('@endpush', $css . "\n@endpush", $c1);
}

// Inject Select2 JS
$js = '
<script src="{{asset(\'frontend/js/select2/js/select2.min.js\')}}"></script>
<script>
    $(document).ready(function() {
        $(".select2-tags").select2({
            tags: true,
            tokenSeparators: [","]
        });
        
        // Change event needs to fire manually sometimes for Select2 to sync with our custom script
        $(".select2-tags").on("select2:select select2:unselect", function (e) {
            $(this).trigger("change");
        });
    });
</script>
';
if (strpos($c1, 'select2.min.js') === false) {
    // Append to scripts
    $pos = strrpos($c1, '@endpush');
    if ($pos !== false) {
        $c1 = substr_replace($c1, $js . "\n@endpush", $pos, strlen('@endpush'));
    }
}
file_put_contents($f1, $c1);


// Fix edit.blade.php
$f2 = 'resources/views/backend/product/edit.blade.php';
$c2 = file_get_contents($f2);

$search2 = '<label for="size">Size</label>
          <select name="size[]" id="size" class="form-control selectpicker"  multiple data-live-search="true">
              @php 
              $menu=explode(\',\',$product->size);
              @endphp
              <option value="S"  @if(in_array( "S",$menu)) selected @endif>Small (S)</option>
              <option value="M"  @if(in_array( "M",$menu)) selected @endif>Medium (M)</option>
              <option value="L"  @if(in_array( "L",$menu)) selected @endif>Large (L)</option>
              <option value="XL"  @if(in_array( "XL",$menu)) selected @endif>Extra Large (XL)</option>
          </select>';

$replace2 = '<label for="size">Sizes (Type a size and press Enter)</label>
          <select name="size[]" id="size" class="form-control select2-tags" multiple="multiple">
              @php 
              $menu = explode(\',\', $product->size);
              @endphp
              @foreach($menu as $s)
                  @if(trim($s) !== "")
                  <option value="{{$s}}" selected>{{$s}}</option>
                  @endif
              @endforeach
          </select>';

$c2 = preg_replace('/<label for="size">Size<\/label>\s*<select name="size\[\]" id="size" class="form-control selectpicker".*?<\/select>/is', $replace2, $c2);

if (strpos($c2, 'select2.min.css') === false) {
    $c2 = str_replace('@endpush', $css . "\n@endpush", $c2); // Assuming first @endpush is styles, this might be risky. Let's do it safely.
}
// For edit.blade.php, let's inject CSS safely at first endpush
$c2 = preg_replace('/@endpush/', $css . "\n@endpush", $c2, 1);

if (strpos($c2, 'select2.min.js') === false) {
    $pos = strrpos($c2, '@endpush');
    if ($pos !== false) {
        $c2 = substr_replace($c2, $js . "\n@endpush", $pos, strlen('@endpush'));
    }
}
file_put_contents($f2, $c2);

echo "Replaced sizes with dynamic Select2 tags!";
?>
