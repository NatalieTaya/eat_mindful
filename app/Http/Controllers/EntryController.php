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

    public function store(Request $request){
        $validated = $request -> validate ([
            'weight' => 'required',
            'product' => 'required',
            'meal' => 'required'
        ]);
        // looking for id of product
        $product_id=Product::firstWhere('name',$validated['product'])->id;
        $day_params=session('return_to_day_params');
        $date = new DateTime($day_params['selectedDate']);

        $entry_params=[
            'weight' => $validated['weight'],
            'product_id' => $product_id,
            'meal_id'=> $validated['meal'],
            'user_id' => 1,
            'date' => $date         
        ];
        //creating entry
        $newEntry = Entry::create($entry_params);
        //checkin which meal we are eating
        $mealType = (int)$validated['meal'];
        $entiesName = match ($mealType) {
            1=>'breakfastEntries',
            2=>'lunchEntries',
            3=>'dinnerEntries',
            default => throw new \InvalidArgumentException("Unknown meal type: {$mealType}"),
        };

        $day_params[$entiesName][]=$newEntry;
        session(['return_to_day_params' => $day_params]);

        //going back to day chosen
        return view('day');
    }
}
