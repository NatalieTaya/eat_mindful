<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index() {
    }

    public function create($date, $meal) {
        $products=Product::all();
        return view('entries.create', [
            'date' => DateTime::createFromFormat('Y-m-d', $date),
            'meal'=> $meal,
            'products'=>$products
        ]);
    }

    public function store(){
        //going back to day chosen
        return view('day');
    }
}
