<?php
$f = 'resources/views/backend/index.blade.php';
$c = file_get_contents($f);

// 1. Replace Top Cards
$old_cards = '<div class="row">

      <!-- Category -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Category</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Category::countActiveCategory()}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-sitemap fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Products -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Products</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Product::countActiveProduct()}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-cubes fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Order -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Order</div>
                <div class="row no-gutters align-items-center">
                  <div class="col-auto">
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{\App\Models\Order::countActiveOrder()}}</div>
                  </div>
                  
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Posts-->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Post</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{\App\Models\Post::countActivePost()}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-folder fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';

$new_cards = '<div class="row">

      <!-- New Orders -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">New Orders (Amount)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rs. {{number_format($newAmount, 2)}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-plus-circle fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Process Orders -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Process Orders (Amount)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rs. {{number_format($processAmount, 2)}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-spinner fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Delivered Orders -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Delivered Orders (Amount)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rs. {{number_format($deliveredAmount, 2)}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Cancelled Orders -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Cancelled Orders (Amount)</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">Rs. {{number_format($cancelAmount, 2)}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-times-circle fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';

$c = str_replace($old_cards, $new_cards, $c);

// 2. Change Dollar to Rs.
$c = str_replace("return '$' + number_format(value);", "return 'Rs. ' + number_format(value);", $c);
$c = str_replace("return datasetLabel + ': $' + number_format(tooltipItem.yLabel);", "return datasetLabel + ': Rs. ' + number_format(tooltipItem.yLabel);", $c);

// 3. Replace the Top Cities / Areas HTML Tables with Pie Charts
// This is exactly the block I added previously:
$old_tables = '<!-- Top Cities & Areas Row -->
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
    </div>';

$new_charts = '<!-- City & Area Charts Row -->
    <div class="row">
        <!-- City Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Orders by City</h6>
                </div>
                <div class="card-body" style="overflow:hidden;">
                    <div id="city_pie_chart" style="width:100%; height:320px;"></div>
                </div>
            </div>
        </div>
        
        <!-- Area Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Orders by Area</h6>
                </div>
                <div class="card-body" style="overflow:hidden;">
                    <div id="area_pie_chart" style="width:100%; height:320px;"></div>
                </div>
            </div>
        </div>
    </div>';
    
$c = str_replace($old_tables, $new_charts, $c);

// 4. Add JS for city_pie_chart and area_pie_chart
$js_addition = "
  var cityDataArray = <?php echo \$cityChart; ?>;
  var areaDataArray = <?php echo \$areaChart; ?>;

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawCityAreaCharts);

  function drawCityAreaCharts()
  {
      if (cityDataArray.length > 1) {
          var cityData = google.visualization.arrayToDataTable(cityDataArray);
          var cityOptions = { title : 'Overall Orders by City' };
          var cityChart = new google.visualization.PieChart(document.getElementById('city_pie_chart'));
          cityChart.draw(cityData, cityOptions);
      } else {
          document.getElementById('city_pie_chart').innerHTML = '<p class=\"text-center mt-5\">No city data available</p>';
      }

      if (areaDataArray.length > 1) {
          var areaData = google.visualization.arrayToDataTable(areaDataArray);
          var areaOptions = { title : 'Overall Orders by Area' };
          var areaChart = new google.visualization.PieChart(document.getElementById('area_pie_chart'));
          areaChart.draw(areaData, areaOptions);
      } else {
          document.getElementById('area_pie_chart').innerHTML = '<p class=\"text-center mt-5\">No area data available</p>';
      }
  }
</script>
";

$c = str_replace("</script>\n  {{-- line chart --}}", "</script>\n<script type=\"text/javascript\">\n" . $js_addition . "\n  {{-- line chart --}}", $c);

file_put_contents($f, $c);
echo "Updated backend index view.";
?>
