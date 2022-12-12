<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Http\Requests\StoreSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;
use App\Models\Program;

class SemesterController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $programs = Program::all(); */
        $semesters = Semester::with(['Program'])->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'data'      =>$semesters
        ]);
    }

    public function getByIdProgram($id)
    {
        $courses = Semester::where('program_id', $id)->get()->sortBy('name');
        if(empty($courses))
        {
            return response()->json([
                'code'      => 404,
                'status'    => 'failed',
                'message'   => 'Courses no found'
            ]);
        }
        return response()->json([
            'code'      => 200,
            'status'    => true,
            'data'      => $courses
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSemesterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSemesterRequest $request)
    {
        $this->authorize('create-update-all');
        $validated = $request->validated();

        $programFound = Program::find($request->program_id);
        if(empty($programFound)){
            return response()->json([
                'code' => 404,
                'message' => 'Program not found'
            ]);
        };
        $semester = Semester::create($request->all());

        return response()->json(
            [
                'code' => 200,
                'status' => 'true',
                'data' => $semester
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $semesterFound = Semester::find($id);

        if(empty($semesterFound))
        {
            return response()->json([
                'code' => 404,
                'status' => 'failed',
                'message' => 'Semester not found'
            ]);
        }

        return response()->json([
            'code' => 200,
            'status' => 'Success',
            'data' => $semesterFound
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSemesterRequest  $request
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSemesterRequest $request, $id)
    {
        $this->authorize('create-update-all');
        $request->validated();

        $semesterFound = Semester::find($id);
        if(empty($semesterFound)){
            return response()->json([
                'code' => 404,
                'message' => 'Semester not found'
            ]);
        };
        $programFound = Program::find($request->program_id);
        if(empty($programFound)){
            return response()->json([
                'code' => 404,
                'message' => 'Program not found'
            ]);
        };
        $semesterFound ->update($request->all());

        return response()->json(
            [
                'code' => 200,
                'status' => 'true',
                'data' => $semesterFound
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete-all');
        $semesterFound = Semester::find($id);
        if(empty($semesterFound)){
            return response()->json([
                'code' => 404,
                'message' => 'Semester not found'
            ]);
        };

        $semesterDestroyed = Semester::destroy($id);
        return response()->json(
            [
                'code' => 200,
                'status' => 'true',
                'destroyed' => $semesterDestroyed,
                'data' => $semesterFound
            ]
        );
    }
}
