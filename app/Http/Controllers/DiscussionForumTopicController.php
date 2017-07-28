<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiscussionForumTopic;
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;


class DiscussionForumTopicController extends Controller
{
    private $user;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $topic=DiscussionForumTopic::where('Ent_Type','<>','D')->orderBy('id','DESC')->get();
        return view('discussionforum.view')->with('topic',$topic);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        
        $this->user=Auth::user();

        $this->validate(request(),[
            'DFT_Topic'=>'required|alpha_dash',
        ]);
        $discussionforum=new DiscussionForumTopic;
        $discussionforum->DFT_Topic=$request->DFT_Topic;
        $discussionforum->DFT_User_Id=$this->user->id;
        $discussionforum->DFT_Date=Carbon::now();
        $discussionforum->Role_Type=$this->user->Role_Type;
        $discussionforum->Ent_Type='I';
        if($discussionforum->save())
            return back()->with('message','Topic Successfully Added');
        else
            return back()->with('message','Cannot add the topic');


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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
