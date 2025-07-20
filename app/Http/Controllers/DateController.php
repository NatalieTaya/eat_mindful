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
            'date' => 'required|date'
        ]);
        // going back with creating new session variable
        return back()->with('selectedDate', $request->date);
    }
    public function showWeek(Request $request){
        // checking if the week is correct
        $validated = $request->validate([
            'week' => 'required'
        ]);

        $year = substr($request->week,0,4);
        $week = substr($request->week,6,7);
        $startDate = (new DateTime())->setISODate($year, $week)->format('Y-m-d');
        $endDate = (new DateTime())->setISODate($year, $week, 7)->format('Y-m-d');
        
        $entries=Entry::whereBetween('date',[$startDate,$endDate])->get();
        // 
        return view('week', [
            'selectedWeek'=>$request->week,
            'weekStart'=>$startDate,
            'weekEnd'=>$endDate,
            'entries'=>$entries
        ]);
    }
}
