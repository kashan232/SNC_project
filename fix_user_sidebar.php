<?php
$f = 'resources/views/user/layouts/sidebar.blade.php';
$c = file_get_contents($f);

// Remove Posts heading and Comments link
$old = '    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Posts
    </div>
    <!-- Comments -->
    <li class="nav-item">
      <a class="nav-link" href="{{route(\'user.post-comment.index\')}}">
          <i class="fas fa-comments fa-chart-area"></i>
          <span>Comments</span>
      </a>
    </li>';

$c = str_replace($old, '', $c);
file_put_contents($f, $c);
echo "User sidebar comments removed.";
?>
