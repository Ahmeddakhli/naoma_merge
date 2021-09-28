<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\room_micResources;
use App\Http\Controllers\api\apiResponseTrait;
use App\Http\Requests\dashboard\UpdateRoomMicRequest;
use App\Models\Room;


use App\Models\Room_mics;


class room_micsController extends Controller
{
    use apiResponseTrait;


    
    public function index()
    {
        // $room_mics =  Room_mics::get();
        // return $this->apiResponse( room_micResources::collection($room_mics),null,201);
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

        $room =  Room::findorfail($request->room_id);

        // $room_mic =  Room_mics::findorfail($request->id);

       $room_mic= $room->mics()->where('mic_number',$request->mic_number )->first();
         
        if ($room_mic)
        {

            if($room_mic->is_locked==false){

                    if($room_mic->status==true){

                        $array = [
                            'status'=>false,
                            'mic_user_id'=>$request->user_id,
                        ];

                        $room_mic->update($array);

                        return 'is ok';

                    }else{
                        return response()->json([
                            'status' => false,
                            'msg' => 'هذا الميك  مستخدم من قبل شخص اخر',
                        ]);
                    }
            }else{
                return response()->json([
                    'status' => false,
                    'msg' => 'هذا الميك  مغلق ',
                ]);
            }



        }
    else
        return response()->json([
            'status' => false,
            'msg' => 'هذا الميك  غير موجود',
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

    // UpdateRoomMicRequest $request,
    public function update(Request $request, $id)
    {
        $room =  Room::findorfail($request->room_id);


       $room_mic= $room->mics()->where('mic_number',$request->mic_number )->first();
         
        if ($room_mic->mic_user_id==$request->user_id)
        {

            $array = [
                'status'=>true,
                'mic_user_id'=>null,
            ];

            $room_mic->update($array);
            return 'user leave mics ok';


        }
    else
        return response()->json([
            'status' => false,
            'msg' => 'انت لا تملك ذالك الميك ',
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
