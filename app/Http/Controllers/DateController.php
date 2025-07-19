<?php

namespace App\Http\Controllers;

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
        $startDate = (new DateTime())->setISODate($year, $week)->format('d.m.Y');
        $endDate = (new DateTime())->setISODate($year, $week, 7)->format('d.m.Y');
        // going back with creating new session variables
        return back()
            ->with('selectedWeek', $request->week)
            ->with('weekStart', $startDate)
            ->with('weekEnd', $endDate);
;
    }
}
