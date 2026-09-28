<?php
$f = 'resources/views/backend/product/edit.blade.php';
$c = file_get_contents($f);

$search = '@foreach($menu as $s)
                  @if(trim($s) !== "")
                  <option value="{{$s}}" selected>{{$s}}</option>
                  @endif
              @endforeach';

$replace = '@foreach($menu as $s)
                  @php $s = trim($s); @endphp
                  @if($s !== "")
                  <option value="{{$s}}" selected>{{$s}}</option>
                  @endif
              @endforeach';

$c = str_replace($search, $replace, $c);
file_put_contents($f, $c);
echo "Fixed edit.blade.php trim.\n";

$f2 = 'resources/views/frontend/pages/product_detail.blade.php';
$c2 = file_get_contents($f2);

$search2 = '@foreach($sizes as $key => $size)
												<button type="button" class="snc-size-btn @if($key==0) active @endif" onclick="selectSncSize(this, 
\'{{$size}}\')">{{$size}}</button>
											@endforeach';

$replace2 = '@foreach($sizes as $key => $size)
                                                @php $size = trim($size); @endphp
												<button type="button" class="snc-size-btn @if($key==0) active @endif" onclick="selectSncSize(this, 
\'{{$size}}\')">{{$size}}</button>
											@endforeach';
$c2 = str_replace($search2, $replace2, $c2);
// Regex fallback just in case formatting is slightly different
$c2 = preg_replace(
    '/@foreach\(\$sizes as \$key => \$size\)\s*<button type="button" class="snc-size-btn @if\(\$key==0\) active @endif" onclick="selectSncSize\(this,\s*\'\{\{\$size\}\}\'\)"\>\{\{\$size\}\}<\/button>\s*@endforeach/is',
    '@foreach($sizes as $key => $size)
        @php $size = trim($size); @endphp
        <button type="button" class="snc-size-btn @if($key==0) active @endif" onclick="selectSncSize(this, \'{{$size}}\')">{{$size}}</button>
    @endforeach',
    $c2
);
file_put_contents($f2, $c2);
echo "Fixed product_detail.blade.php trim.\n";
?>
