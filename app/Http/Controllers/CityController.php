<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::orderBy('id', 'DESC')->paginate(10);
        return view('backend.city.index', compact('cities'));
    }

    public function create()
    {
        return view('backend.city.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);
        City::create($request->all());
        return redirect()->route('city.index')->with('success', 'City created successfully');
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('backend.city.edit', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);
        $city = City::findOrFail($id);
        $city->update($request->all());
        return redirect()->route('city.index')->with('success', 'City updated successfully');
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return redirect()->route('city.index')->with('success', 'City deleted successfully');
    }
}