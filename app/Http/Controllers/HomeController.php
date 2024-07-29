<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripPackage;

class HomeController extends Controller
{
    public function index()
    {
        $items = TripPackage::with(['galleries'])->get();
        return view('pages.home', [
            'items' => $items
        ]);
    }
}
