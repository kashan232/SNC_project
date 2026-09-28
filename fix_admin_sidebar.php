<?php
$f = 'resources/views/backend/layouts/sidebar.blade.php';
$c = file_get_contents($f);

// Remove Comments link
$old = '  <!-- Comments -->
  <li class="nav-item">
    <a class="nav-link" href="{{route(\'comment.index\')}}">
      <i class="fas fa-comments fa-chart-area"></i>
      <span>Comments</span>
    </a>
  </li>';

$c = str_replace($old, '', $c);
file_put_contents($f, $c);
echo "Admin sidebar comments removed.";
?>
