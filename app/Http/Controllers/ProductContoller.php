<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductContoller extends Controller
{
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        $validated = $request -> validate([
            'name' => 'required', 
            'protein'=> 'required', 
            'fats'=> 'required', 
            'carbs'=> 'required', 
            'fibre'=> 'required', 
            'kkal'=> 'required'
        ]);

        Product::create([
            'name' => $validated['name'], 
            'protein'=> $validated['protein'], 
            'fats'=> $validated['fats'], 
            'carbs'=> $validated['carbs'], 
            'fibre'=> $validated['fibre'], 
            'kkal'=> $validated['kkal']
        ]);

        return(route('show.week'));
    }
}
