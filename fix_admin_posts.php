<?php
$f = 'resources/views/backend/layouts/sidebar.blade.php';
$c = file_get_contents($f);

$start_string = '<!-- Heading -->
  <div class="sidebar-heading">
    Posts
  </div>';

$end_string = '<!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">';

$start_pos = strpos($c, $start_string);
$end_pos = strpos($c, $end_string, $start_pos);

if ($start_pos !== false && $end_pos !== false) {
    // We want to comment out the block between $start_pos and $end_pos
    $block = substr($c, $start_pos, $end_pos - $start_pos);
    
    // We can just replace the block with a commented out version or remove it
    $new_block = '<!-- POSTS SECTION REMOVED AS PER REQUEST -->
  ';
    
    $c = str_replace($block, $new_block, $c);
    file_put_contents($f, $c);
    echo "Admin posts menu removed.";
} else {
    echo "Could not find the section to remove.";
}
?>
