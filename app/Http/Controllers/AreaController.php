<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\City;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with('city')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.area.index', compact('areas'));
    }

    public function create()
    {
        $cities = City::where('status','active')->get();
        return view('backend.area.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'delivery_charges' => 'nullable|numeric',
            'status' => 'required|in:active,inactive'
        ]);
        Area::create($request->all());
        return redirect()->route('area.index')->with('success', 'Area created successfully');
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        $cities = City::where('status','active')->get();
        return view('backend.area.edit', compact('area', 'cities'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'city_id' => 'required|exists:cities,id',
            'name' => 'required|string|max:255',
            'delivery_charges' => 'nullable|numeric',
            'status' => 'required|in:active,inactive'
        ]);
        $area = Area::findOrFail($id);
        $area->update($request->all());
        return redirect()->route('area.index')->with('success', 'Area updated successfully');
    }

    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        return redirect()->route('area.index')->with('success', 'Area deleted successfully');
    }
    
    // API for Frontend
    public function getAreasByCity($city_id)
    {
        $areas = Area::where('city_id', $city_id)->where('status', 'active')->get();
        return response()->json($areas);
    }
    
    // Auto save location from GPS
    public function autoSaveLocation(Request $request)
    {
        $city_name = $request->city;
        $area_name = $request->area;

        if (empty($city_name)) {
            return response()->json(['success' => false, 'message' => 'City is empty']);
        }

        // Find or create city
        $city = City::firstOrCreate(
            ['name' => $city_name],
            ['icon' => 'fa fa-map-marker', 'status' => 'active']
        );

        if (!empty($area_name)) {
            // Find or create area
            Area::firstOrCreate(
                ['city_id' => $city->id, 'name' => $area_name],
                ['delivery_charges' => 0, 'status' => 'active']
            );
        }

        return response()->json(['success' => true]);
    }
}