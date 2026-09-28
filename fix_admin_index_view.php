<?php
$f = 'resources/views/backend/index.blade.php';
$c = file_get_contents($f);

$new_html = '
    </div>
    
    <!-- Top Cities & Areas Row -->
    <div class="row">
        <!-- Top Cities -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Cities (Orders)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>City Name</th>
                                    <th>Total Orders</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($topCities) && count($topCities) > 0)
                                    @foreach($topCities as $city)
                                    <tr>
                                        <td class="font-weight-bold">{{ $city->name }}</td>
                                        <td><span class="badge badge-primary" style="font-size:14px; background-color: var(--primary-color);">{{ $city->total_orders }}</span></td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="2" class="text-center">No order data available yet.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Top Areas -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Areas (Orders)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>Area (City)</th>
                                    <th>Total Orders</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($topAreas) && count($topAreas) > 0)
                                    @foreach($topAreas as $area)
                                    <tr>
                                        <td class="font-weight-bold">{{ $area->name }} <small class="text-muted">({{ $area->city_name }})</small></td>
                                        <td><span class="badge badge-primary" style="font-size:14px; background-color: var(--primary-color);">{{ $area->total_orders }}</span></td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="2" class="text-center">No order data available yet.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  </div>
@endsection';

$c = str_replace("    <!-- Content Row -->\n    \n  </div>\n@endsection", $new_html, $c);
file_put_contents($f, $c);
echo "Added top cities and areas to the admin dashboard UI.\n";
?>
