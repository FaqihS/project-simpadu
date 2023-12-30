<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $subjects = DB::table('subjects')
            ->when($request->input('title'), function ($query, $title) {
                return $query->where('title', 'like', '%' . $title . '%');
            })
            ->select('id', 'title', 'semester', 'academic_year', DB::raw('DATE_FORMAT(created_at, "%d %M %Y")
             as created_at'))
            ->orderBy('id')
            ->paginate(15);
        return view('pages.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('pages.subjects.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request )
    {
        Subject::create([
            'title' => $request['title'],
            'lecturer_id' => auth()->id(),
            'semester' => $request['semester'],
            'sks' => $request['sks'],
            'academic_year' => $request['academic_year'],
            'code' => strtoupper(fake()->toUpper(Str::random(6))),
            'description' => $request['description'],
        ]);
        return redirect(route('subject.index'))->with('success','data berhasil disimpan');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        //
        $validate = $request->validated();
        $subject->save($validate);
        return redirect()->route('subject.index')->with('success', 'Edit User Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
