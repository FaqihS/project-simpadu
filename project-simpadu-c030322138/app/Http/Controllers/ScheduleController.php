<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Models\Subject;
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

    public function create(){
        $subjects = Subject::all();
        return view('pages.schedules.create',compact('subjects'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request)
    {
        //
        Schedule::create([
            'student_id' => auth()->id(),
            'subject_id'=> $request['subject_id'],
            'schedule_date' => $request['schedule_date'],
            'schedule_type' => $request['schedule_type'],

        ]);

        return redirect(route('schedule.index'))->with('success','Schedule created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    public function edit(Schedule $schedule)
    {
        $subjects = Subject::all();
        return view('pages.schedules.edit',compact('subjects'))->with('schedule', $schedule);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $validate = $request->validated();
        $schedule->update($validate);
        return redirect()->route('schedule.index')->with('success', 'Schedule Edited Successfully');
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
