<?php

namespace App\Http\Controllers;

use App\BatchDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batches = BatchDetail::where('Ent_Type','<>','D')->get();

        return view('institutions.batch_details.show_batch_details')->with(['batches'=>$batches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('institutions.batch_details.add_new_batch');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $batch = BatchDetail::create([
                    'Batch_Code'=> $request->Batch_Code,
                    'Batch_Subject'=> $request->Batch_Subject,
                    'Ent_Type'=>'I',
                ]);

        return redirect('institution/batch-details')->with('message','Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $batch = BatchDetail::findOrFail($id);

        } catch( ModelNotFoundException $e) {
            return back()->with('message', 'No Such Batch Exists!');
        }

        return view('institutions.batch_details.edit_existing_batch')->with('batch',$batch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $batch = BatchDetail::findOrFail($id);

            $batch->fill($request->all());

            $batch->Ent_Type = 'E';

            if ($batch->save())
                return redirect('/institution/batch-details')->with('message', 'Updated Successfully!');
            else
                return back()->with('message', 'Could Not Update Data! Try Again.');

        } catch( ModelNotFoundException $e) {
            return back()->with('message', 'No Such Batch Exists!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $batch = BatchDetail::findOrFail($id);

            $batch->Ent_Type = 'D';

            if ($batch->save())
                return back()->with('message', 'Deleted Successfully!');
            else
                return back()->with('message', 'Could Not Delete Data! Try Again.');
        } catch( ModelNotFoundException $e) {
            return back()->with('message', 'No Such Batch Exists!');
        }
    }
}
