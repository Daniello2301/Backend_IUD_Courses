<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
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
        $programs = Program::all();

        return response()->json([
            'code'      => 200,
            'status'    => true,
            'data'      =>$programs
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
     * @param  \App\Http\Requests\StoreProgramRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramRequest $request)
    {
        $this->authorize('create-update-all');
        $validated = $request->validated();

        $program = Program::create($request->all());
        return response()->json(
            [
                'code' => 200,
                'status' => 'true',
                'data' => $program
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = Program::find($id);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'data'=> $program->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProgramRequest  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramRequest $request, $id)
    {
        $this->authorize('create-update-all');
        $request->validated();

        $programFound = Program::find($id);

        if(empty($programFound)){
            return response()->json(
                ['code' => 404,
                'status' => 'failed',
                'message' => 'Program not found']
            );
        }
        $programFound->update($request->all());

        return response()->json([
            'code' => 202,
            'status' => 'success',
            'data' => $programFound
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('create-update-all');
        $programFound = Program::find($id);
        if(empty($programFound)){
            return response()->json([
                'code' => 404,
                'message' => 'Program not found'
            ]);
        };

        $program = Program::destroy($id);
        return response()->json(
            [
                'code' => 200,
                'status' => 'true',
                'data' => $program
            ]
        );
    }
}
