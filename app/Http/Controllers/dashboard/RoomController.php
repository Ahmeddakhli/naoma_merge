<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\roomsDataTable;
use App\Http\Requests\dashboard\StoreRoomRequest;
use App\Http\Requests\dashboard\UpdateRoomRequest;
use App\Models\Room;
use App\Models\User;
Use Alert;
use App\Models\Room_Mics;
use Illuminate\Support\Arr;


class RoomController extends Controller
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
    public function index(roomsDataTable $dataTable)
    {
       
        return $dataTable->render('dashboard.rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users= User::all();

        return view('dashboard.rooms.add',['users'=>$users]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        $inputss=$request->input();
        if($request->hasfile('room_background')) { 

           $file=$request->file('room_background');
           $name = time().rand(1,100).'.'.$file->extension();
           $file->storeAs('public/images', $name); 
             
          

          $inputss = Arr::add($inputss, 'room_background', $name);
      

            }
       
         
        $room= Room::create($inputss);

        for ($i = 1; $i <= 10; $i++)
        {
           
            $room_mics = $room->mics()->create([
                'mic_number' =>$i  ,
                'status' => true,
                'is_locked' => false,
                'room_owner_id' => $room->room_owner,
                'mic_user_id' => null,
                
            ]);

        }

     

    //    if($request->has('room_background')){ }
     
        if ($room)
        return redirect(route('rooms.index'));    
    else
        return response()->json([
            'status' => false,
            'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room=Room::findorfail($id);
     
        return view('dashboard.rooms.show',['room'=>$room]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room=Room::findorfail($id);
        $users= User::all();

        return view('dashboard.rooms.edit',['room'=>$room,'users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, $id)
    {
        $room =  Room::findorfail($id);
         
        if ($room)
        {
            $room->update($request->all());
            return redirect(route('rooms.index'));
       
    }
    else
        return response()->json([
            'status' => false,
            'msg' => 'هذا الغرفه  غير موجود',
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
        $room= Room::findorfail($id);
        if ($room)
        {
           
           
            $room->delete();
           


            return redirect(route('rooms.index'));
    }
    else
    return redirect(route('rooms.index'));
    
    }
}
