<?php
$f = 'resources/views/frontend/index.blade.php';
$c = file_get_contents($f);
// Restore explore-card to column
$c = str_replace('
  .explore-card {
      background: #fff;
      border-radius: 24px;
      padding: 20px 15px;
      display: flex;
      flex-direction: row;', '
  .explore-card {
      background: #fff;
      border-radius: 24px;
      padding: 20px 15px;
      display: flex;
      flex-direction: column;', $c);
      
// Also append a fail-safe CSS at the bottom to guarantee Explore card is fixed
$append = '
<style>
/* REPAIR EXPLORE CARD FLEX DIRECTION */
.explore-card {
    flex-direction: column !important;
}
</style>
';
$c .= $append;
file_put_contents($f, $c);
echo "Explore card fixed to column.\n";
?>
