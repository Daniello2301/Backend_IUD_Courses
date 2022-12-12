<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Semester;

class CourseController extends Controller
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
        $courses = Course::with(['Semester'])->get();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'data'      => $courses
        ]);
    }


    public function getByIdSemester($id)
    {
        $courses = Course::where('semester_id', $id)->get();
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
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $this->authorize('create-update-all');
        $request->validated();

        $semester = Semester::find($request->semester_id);
        if (empty($semester)) {
            return response()->json([
                'code' => 404,
                'message' => 'Semester not found'
            ]);
        };

        $course = Course::create($request->all());

        return response()->json(
            [
                'code' => 200,
                'status' => 'true',
                'data' => $course
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        if (empty($course)) {
            return response()->json([
                'code'      => 404,
                'status'    => 'failed',
                'message'   => 'course not found'
            ]);
        }
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'data'   => $course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request,  $id)
    {
        $this->authorize('create-update-all');
        $request->validated();

        $courseFound = Course::find($id);
        if (empty($courseFound)) {
            return response()->json([
                'code'      => 404,
                'status'    => 'failed',
                'message'   => 'course not found'
            ]);
        }

        $courseFound->update($request->all());

        return response()->json([
            'code'      => 202,
            'status'    => 'success',
            'message'   => $courseFound
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( $this->authorize('create-update-all'))
        {
            $courseFound = Course::find($id);
            if (empty($courseFound)) {
                return response()->json([
                    'code'      => 404,
                    'status'    => 'failed',
                    'message'   => 'course not found'
                ]);
            }

            Course::destroy($id);
            return response()->json(
                [
                    'code' => 200,
                    'status' => 'true',
                    'data' => $courseFound
                ]
            );
        }else{
            return response()->json([
                'code'      => 500,
                'status'    => 'failed',
                'message'   => 'unauthorized'
            ]);
        }
    }


    public function search($name)
    {

        $course = Course::where('name', 'like', '%' . $name . '%')->get();
        if (empty($course)) {
            return response()->json([
                'code'      => 404,
                'status'    => 'failed',
                'message'   => 'course not found'
            ]);
        }

        return response()->json(
            [
                'code' => 200,
                'status' => 'true',
                'data' => $course
            ]
        );
    }
}
