<?php
$f = 'app/Http/Controllers/AdminController.php';
$c = file_get_contents($f);

$old_func = 'public function index()
    {
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
            ->where(\'created_at\', \'>\', Carbon::today()->subDay(6))
            ->groupBy(\'day_name\', \'day\')
            ->orderBy(\'day\')
            ->get();
        $array[] = [\'Name\', \'Number\'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->day_name, $value->count];
        }
        //  return $data;
        return view(\'backend.index\')->with(\'users\', json_encode($array));
    }';

$new_func = 'public function index()
    {
        $data = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("DAYNAME(created_at) as day_name"), \DB::raw("DAY(created_at) as day"))
            ->where(\'created_at\', \'>\', Carbon::today()->subDay(6))
            ->groupBy(\'day_name\', \'day\')
            ->orderBy(\'day\')
            ->get();
        $array[] = [\'Name\', \'Number\'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->day_name, $value->count];
        }

        // Get Top Cities for Orders
        $topCities = \DB::table(\'orders\')
            ->join(\'cities\', \'orders.city_id\', \'=\', \'cities.id\')
            ->select(\'cities.name\', \DB::raw(\'COUNT(orders.id) as total_orders\'))
            ->groupBy(\'cities.id\', \'cities.name\')
            ->orderBy(\'total_orders\', \'desc\')
            ->take(5)
            ->get();

        // Get Top Areas for Orders
        $topAreas = \DB::table(\'orders\')
            ->join(\'areas\', \'orders.area_id\', \'=\', \'areas.id\')
            ->join(\'cities\', \'areas.city_id\', \'=\', \'cities.id\')
            ->select(\'areas.name\', \'cities.name as city_name\', \DB::raw(\'COUNT(orders.id) as total_orders\'))
            ->groupBy(\'areas.id\', \'areas.name\', \'cities.name\')
            ->orderBy(\'total_orders\', \'desc\')
            ->take(5)
            ->get();

        return view(\'backend.index\', [
            \'users\' => json_encode($array),
            \'topCities\' => $topCities,
            \'topAreas\' => $topAreas
        ]);
    }';

$c = str_replace($old_func, $new_func, $c);
file_put_contents($f, $c);
echo "Admin controller updated with city/area stats.";
?>
