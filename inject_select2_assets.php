<?php
$css = '
<link href="{{asset(\'frontend/js/select2/css/select2.min.css\')}}" rel="stylesheet" />
<style>
.select2-container .select2-selection--multiple { min-height: 40px; border-color: #d1d3e2; }
.select2-container--default .select2-selection--multiple .select2-selection__choice { background-color: #4e73df; color: white; border: none; padding: 2px 8px; margin-top: 6px; }
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove { color: white; margin-right: 5px; }
</style>
';

$js = '
<script src="{{asset(\'frontend/js/select2/js/select2.min.js\')}}"></script>
<script>
    $(document).ready(function() {
        $(".select2-tags").select2({
            tags: true,
            tokenSeparators: [","],
            placeholder: "Type a size and press Enter..."
        });
        
        $(".select2-tags").on("select2:select select2:unselect", function (e) {
            $(this).trigger("change");
        });
    });
</script>
';

function injectAssets($f, $css, $js) {
    $c = file_get_contents($f);
    
    // Check if already injected to prevent duplication
    if (strpos($c, 'select2.min.js') === false) {
        // Inject CSS at the first @endpush
        $c = preg_replace('/@endpush/', $css . "\n@endpush", $c, 1);
        
        // Inject JS at the last @endpush
        $pos = strrpos($c, '@endpush');
        if ($pos !== false) {
            $c = substr_replace($c, $js . "\n@endpush", $pos, strlen('@endpush'));
        }
        
        file_put_contents($f, $c);
        echo "Injected assets into $f\n";
    } else {
        echo "Assets already in $f\n";
    }
}

injectAssets('resources/views/backend/product/create.blade.php', $css, $js);
injectAssets('resources/views/backend/product/edit.blade.php', $css, $js);
?>
