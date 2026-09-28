<?php
$f1 = 'resources/views/backend/product/create.blade.php';
$c1 = file_get_contents($f1);

// Replace size select HTML
$replace1 = '<label for="size">Sizes (Type a size and press Enter)</label>
          <select name="size[]" id="size" class="form-control select2-tags" multiple="multiple">
          </select>';

$c1 = preg_replace('/<label for="size">Size<\/label>\s*<select name="size\[\]".*?<\/select>/is', $replace1, $c1);

file_put_contents($f1, $c1);
echo "create.blade.php fixed!\n";

$f2 = 'resources/views/backend/product/edit.blade.php';
$c2 = file_get_contents($f2);

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

$c2 = preg_replace('/<label for="size">Size<\/label>\s*<select name="size\[\]".*?<\/select>/is', $replace2, $c2);

file_put_contents($f2, $c2);
echo "edit.blade.php fixed!\n";

?>
