<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::latest()->get();

        return view('admin.sectors.index', compact('sectors'));
    }

    public function create()
    {
        return view('admin.sectors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'sector_name' => 'required|string|max:255|unique:sectors,sector_name',
    ],[
        'sector_name.unique' => 'Sector already exists.',
    ]);


        Sector::create([
            'sector_name' => $request->sector_name,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('sectors.index')
            ->with('success', 'Sector Created Successfully');
    }

    public function edit(Sector $sector)
    {
        return view('admin.sectors.edit', compact('sector'));
    }

    public function update(Request $request, Sector $sector)
    {
        $request->validate([
            'sector_name' => 'required|string|max:255',
        ]);

        $sector->update([
            'sector_name' => $request->sector_name,
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('sectors.index')
            ->with('success', 'Sector Updated Successfully');
    }

    public function destroy(Sector $sector)
    {
        $sector->delete();

        return redirect()->route('sectors.index')
            ->with('success', 'Sector Deleted Successfully');
    }
}