<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\apiResponseTrait;
use Illuminate\Http\Request;
use App\Http\Resources\RoomResources;
use App\Models\Room;
use App\Models\Room_mics;
use App\Models\User;
use Illuminate\Support\Arr;



class RoomController extends Controller
{
    use apiResponseTrait;

    public function index(){
       $room =  Room::with('mics')->get();
        return $this->apiResponse( RoomResources::collection($room),null,201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users= User::all();
        return $this->apiResponse( RoomResources::collection($users),null,201);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }


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
    public function update(Request $request)
    {
        // add data
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
            $room_mics = Room_mics::create([
                'mic_number' =>$i  ,
                'status' => true,
                'is_locked' => false,
                'room_owner_id' => $room->room_owner,
                'mic_user_id' => null,
                'room_id'=> $room->id,
            ]);

        }

        return response()->json([
			'status' => 'Success',
			'message' => 'ok',
			'data' =>  $room->with('mics')->get(),
		], 200);
        // return $this->apiResponse( RoomResources::collection($inputss),null,201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                
        $Room = Room::find($id);

        if(!$Room){
        return $this->apiResponse(null,'the post not found',404);
        }

        $Room->delete($id);

        if($Room){
        return $this->apiResponse(null,'The room deleted',201);
        }else{
        return $this->apiResponse(null,'The room Not Save',400);
        }


    }
}
