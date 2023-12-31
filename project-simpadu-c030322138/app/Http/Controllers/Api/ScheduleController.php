<?php

namespace App\Http\Controllers\Api;
use App\Models\Schedule;
use App\Http\Resources\ScheduleResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $schedules = Schedule::where('student_id', '=', $user->id)->get();
        if (!$schedules) {
            return response()->json(['errors' => "Not Found"], 404);
        }
        return ScheduleResource::collection($schedules->load('subject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'required|numeric',
            'schedule_date' => 'required|string',
            'schedule_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $request->user();

        $schedule = Schedule::create([
            'subject_id'=>$request['subject_id'],
            'schedule_date' => $request['schedule_date'],
            'schedule_type' => $request['schedule_type'],
            'student_id' => $user->id,
        ]);

        return ScheduleResource::make($schedule->load('subject'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {
        $user = $request->user();
        $schedule = Schedule::where('student_id', '=', $user->id)
        ->where('id','=',$id)
        ->first();

        if (!$schedule) {
            return response()->json(['errors' => "Not Found"], 404);
        }
        return ScheduleResource::make($schedule->load('subject'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => 'numeric',
            'schedule_date' => 'string',
            'schedule_type' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $request->user();

        $schedule = Schedule::where('student_id', '=', $user->id)
            ->where('id', '=', $id)
            ->first();

        if (!$schedule) {
            return response()->json(['errors' => "Not Found"], 404);
        }

        $schedule->update($request->only(['subject_id', 'schedule_date', 'schedule_type']));

        return ScheduleResource::make($schedule->load('subject'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        //
        $user = $request->user();
        $schedule = Schedule::where('student_id', '=', $user->id)
            ->where('id', '=', $id)
            ->first();
        if (!$schedule) {
            return response()->json(['errors' => "Not Found"], 404);
        }

        $schedule->delete();

        return response()->json(['message' => "Schedule deleted Successfully"], 203);
    }
}
