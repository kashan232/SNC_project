<?php
$f = 'app/Http/Controllers/AdminController.php';
$c = file_get_contents($f);

$old_func = 'public function index()
    {
        // Status Totals';

$new_func = 'public function index()
    {
        $data = \App\User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
            ->where(\'created_at\', \'>\', \Carbon\Carbon::today()->subDay(6))
            ->groupBy(\'day_name\', \'day\')
            ->orderBy(\'day\')
            ->get();
        $array[] = [\'Name\', \'Number\'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->day_name, $value->count];
        }

        // Status Totals';

$c = str_replace($old_func, $new_func, $c);

$old_return = 'return view(\'backend.index\', [
            \'newAmount\' => $newAmount,';
$new_return = 'return view(\'backend.index\', [
            \'users\' => json_encode($array),
            \'newAmount\' => $newAmount,';
            
$c = str_replace($old_return, $new_return, $c);
file_put_contents($f, $c);
echo "Restored users for pie chart.\n";
?>
