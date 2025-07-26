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
        return redirect()->route('show.day', [
            'date' => $day_params['selectedDate']
        ]);
    }
    public function edit($date, $meal, $entry){
        $products=Product::all();
        
        return view('entries.edit', [
            'date' => DateTime::createFromFormat('Y-m-d', $date),
            'meal'=> $meal,
            'products'=>$products,
            'entry'=>$entry
        ]);
    }
    public function update(){
        
    }
    public function destroy(Entry $entry, $meal){
        $day_params=session('return_to_day_params');
        
        $mealType = (int)$meal;
        $entriesMeal = match ($mealType) {
            1=>'breakfastEntries',
            2=>'lunchEntries',
            3=>'dinnerEntries',
            default => throw new \InvalidArgumentException("Unknown meal type: {$mealType}"),
        };

        if (isset($day_params[$entriesMeal])) {
            if (is_object($day_params[$entriesMeal]) && method_exists($day_params[$entriesMeal], 'toArray')) {
                $day_params[$entriesMeal] = $day_params[$entriesMeal]->toArray();
            }
            
            $day_params[$entriesMeal] = array_filter($day_params[$entriesMeal], function($item) use ($entry) {
                $itemId = is_array($item) ? $item['id'] : $item->id;
                return $itemId != $entry->id;
            });
            
            session(['return_to_day_params' => json_decode(json_encode($day_params), true)]);
        }

        $entry->delete();
        //dd(route('show.day')); // Посмотрите какой URL генерируется
            return redirect()->route('show.day', [
            'date' => $day_params['selectedDate']
        ]);
    }
}
