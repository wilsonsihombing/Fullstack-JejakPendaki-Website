<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TripPackageRequest;
use Illuminate\Http\Request;
use App\Models\TripPackage;
use Illuminate\Support\Str;

class TripPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = TripPackage::all();

        return view('pages.admin.trip-package.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.trip-package.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(TripPackageRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        TripPackage::create($data);
        return redirect()->route('trip-package.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = TripPackage::findOrFail($id);

        return view('pages.admin.trip-package.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TripPackageRequest $request, string $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        $item = TripPackage::findOrFail($id);
        $item->update($data);

        return redirect()->route('trip-package.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = TripPackage::findOrFail($id);
        $item->delete();

        return redirect()->route('trip-package.index');
    }
}
