<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\room_micDataTable;
use App\Http\Requests\dashboard\StoreRoomMicRequest;
use App\Http\Requests\dashboard\UpdateRoomMicRequest;
use App\Models\Room_mics;
use App\Models\User;

class Room_micController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(room_micDataTable $dataTable)
    {
       
        return $dataTable->render('dashboard.room_mics.index');
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
        //
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
        $room_mic=Room_mics::findorfail($id);
        $users= User::all();

        return view('dashboard.room_mics.edit',['room_mic'=>$room_mic,'users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomMicRequest $request, $id)
    {
        $room_mic =  Room_mics::findorfail($id);
         
        if ($room_mic)
        {
            $room_mic->update($request->all());
            return redirect(route('room_mics.index'));
       
    }
    else
        return response()->json([
            'status' => false,
            'msg' => 'هذا الميك  غير موجود',
        ]);
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
