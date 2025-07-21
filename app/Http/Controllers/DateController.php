<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use DateTime;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function showDate(Request $request){
        // checking if the date is correct
        $validated = $request->validate([
            'date' => 'required|date_format:Y-m-d'
        ]);
        //entries for the day chosen
        $breakfastEntries=Entry::where('date',$request->date)
                ->whereHas('meal',function($query) {
                    $query->where('name','breakfast');
                })->get();
        $lunchEntries=Entry::where('date',$request->date)
                ->whereHas('meal',function($query) {
                    $query->where('name','lunch');
                })->get();
        $dinnerEntries=Entry::where('date',$request->date)
                ->whereHas('meal',function($query) {
                    $query->where('name','dinner');
                })->get();
        //creating session variables
        session(['return_to_day_params' => [
            'selectedDate'=> $request->date,
            'breakfastEntries'=>$breakfastEntries,
            'lunchEntries'=>$lunchEntries,
            'dinnerEntries'=>$dinnerEntries
        ]]);         
        // going back with creating new variables
        return view('day');
        //return view('day',[
            //'selectedDate'=> $request->date,
            //'breakfastEntries'=>$breakfastEntries,
            //'lunchEntries'=>$lunchEntries,
            //'dinnerEntries'=>$dinnerEntries
        //]);
    }
    public function showWeek(Request $request){
        // checking if the week is correct
        $validated = $request->validate([
            'week' => 'required|regex:/^\d{4}-W\d{2}$/'
        ]);

        //figuring out the dates of the week chosen
        $year = substr($request->week,0,4);
        $week = substr($request->week,6,7);
        $startDate = (new DateTime())->setISODate($year, $week)->format('Y-m-d');
        $endDate = (new DateTime())->setISODate($year, $week, 7)->format('Y-m-d');
        
        //entries for the week chosen
        $entries=Entry::whereBetween('date',[$startDate,$endDate])->get();
        //entries for each meal 
        $breakfastEntries=Entry::whereBetween('date',[$startDate,$endDate])
                ->whereHas('meal',function($query) {
                    $query->where('name','breakfast');
                })->get();
        $lunchEntries=Entry::whereBetween('date',[$startDate,$endDate])
                ->whereHas('meal',function($query) {
                    $query->where('name','lunch');
                })->get();
        $dinnerEntries=Entry::whereBetween('date',[$startDate,$endDate])
                ->whereHas('meal',function($query) {
                    $query->where('name','dinner');
                })->get();

        return view('week', [
            'selectedWeek'=>$request->week,
            'weekStart'=>$startDate,
            'weekEnd'=>$endDate,
            'entries'=>$entries,
            'breakfastEntries'=>$breakfastEntries,
            'lunchEntries'=>$lunchEntries,
            'dinnerEntries'=>$dinnerEntries
        ]);
    }


}
