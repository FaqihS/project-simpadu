<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\SubjectResource;
use Illuminate\Support\Str;
use App\Models\Schedule;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
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
        $result = ScheduleResource::collection($schedules->load('subject'));

        $subjects = $result->map(function($schedule){
            return $schedule->subject;
        });

        return response()->json(['data' => $subjects],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user=$request->user();
        if($user->role == 'mahasiswa'){
            return response()->json(['error'=>'Unauthorized'],401);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'semester' => 'required|numeric',
            'sks'=>'required|numeric',
            'academic_year' => 'string',
            'code' => 'string',
            'description' =>'string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $subject = Subject::create([
            'title' => $request->title,
            'semester' => $request?->semester,
            'lecturer_id'=>$user->id,
            'sks'=>$request?->sks,
            'academic_year'=>$request?->academic_year,
            'code'=> fake()->toUpper(Str::random(6)),
            'description'=>fake()->text()
        ]);

        return SubjectResource::make($subject->load('lecturer'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
