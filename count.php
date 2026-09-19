<?php
$c = file_get_contents('c:/xampp/htdocs/SNC_project/resources/views/frontend/index.blade.php');
echo substr_count($c, '<div class="col-sm-12 col-md-6 col-lg-3');
