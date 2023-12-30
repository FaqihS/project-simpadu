<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $schedules = DB::table('schedules')
            ->join('subjects', 'schedules.subject_id', '=', 'subjects.id')
            ->when($request->input('subject'), function ($query, $subject) {
                return $query->where('subjects.title', 'like', '%' . $subject . '%');
            })
            ->select(
                'schedules.id as id',
                'subjects.title as subject',
                DB::raw('DATE_FORMAT(schedule_date, "%d %M %Y") as schedule_date'),
                'schedule_type',
            )
            ->orderBy('id')
            ->paginate(15);
        return view('pages.schedules.index', compact('schedules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
