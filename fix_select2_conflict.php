<?php
function fixConflict($f) {
    $c = file_get_contents($f);

    $js = '
<script src="{{asset(\'frontend/js/select2/js/select2.min.js\')}}"></script>
<script>
    $(document).ready(function() {
        // Forcefully remove bootstrap-select if it hijacked the element
        setTimeout(function() {
            try {
                if ($("#size").parent().hasClass("bootstrap-select")) {
                    $("#size").selectpicker("destroy");
                }
            } catch(e) {}
            
            $(".select2-tags").select2({
                tags: true,
                tokenSeparators: [","],
                placeholder: "Type a size and press Enter...",
                allowClear: true
            });
            
            $(".select2-tags").on("select2:select select2:unselect", function (e) {
                $(this).trigger("change");
            });
        }, 150); // delay slightly to let any global initializers finish first
    });
</script>
';

    // We will replace the old initialization
    $search = '<script src="{{asset(\'frontend/js/select2/js/select2.min.js\')}}"></script>
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
</script>';

    if (strpos($c, $search) !== false) {
        $c = str_replace($search, $js, $c);
    } else {
        // Regex fallback
        $c = preg_replace('/<script src="\{\{asset\(\'frontend\/js\/select2\/js\/select2\.min\.js\'\)\}\}"\><\/script>.*?<\/script>/is', $js, $c);
    }

    file_put_contents($f, $c);
}

fixConflict('resources/views/backend/product/create.blade.php');
fixConflict('resources/views/backend/product/edit.blade.php');
echo "Applied conflict resolution for Select2 vs Bootstrap-Select.\n";
?>
