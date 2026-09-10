<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::orderBy('id', 'DESC')->paginate(10);
        return view('backend.outlet.index', compact('outlets'));
    }

    public function create()
    {
        return view('backend.outlet.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'status' => 'required|in:active,inactive'
        ]);

        Outlet::create($request->all());
        return redirect()->route('outlet.index')->with('success', 'Outlet created successfully');
    }

    public function edit($id)
    {
        $outlet = Outlet::findOrFail($id);
        return view('backend.outlet.edit', compact('outlet'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'status' => 'required|in:active,inactive'
        ]);

        $outlet = Outlet::findOrFail($id);
        $outlet->update($request->all());
        return redirect()->route('outlet.index')->with('success', 'Outlet updated successfully');
    }

    public function destroy($id)
    {
        $outlet = Outlet::findOrFail($id);
        $outlet->delete();
        return redirect()->route('outlet.index')->with('success', 'Outlet deleted successfully');
    }
}