<?php
$f = 'resources/views/backend/layouts/sidebar.blade.php';
$c = file_get_contents($f);

$tab = '
    <!-- Complaints -->
  <li class="nav-item">
    <a class="nav-link" href="{{route(\'message.index\')}}">
      <i class="fas fa-envelope"></i>
      <span>Complaints</span></a>
  </li>
';

// Add it right after the Reviews tab
$c = str_replace("<span>Reviews</span></a>\n  </li>", "<span>Reviews</span></a>\n  </li>\n".$tab, $c);

file_put_contents($f, $c);
echo "Sidebar tab added.\n";
?>
