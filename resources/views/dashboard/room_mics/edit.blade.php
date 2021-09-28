
     @extends('layouts.app')

@section('content')

  <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary" >
                <div class="box-header with-border " style="text-align:center" >
                  <h3 class="box-title" >تعديل الغرفه </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form  method="POST" role="form" class="form-horizontal" action="{{ route('room_mics.update',$room_mic->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    
                                    @method("PUT")
                  <div class="box-body">
                    <div class="col-md-11" style=" margin: 10px;">

                    <div class="form-group">
                      <label for="exampleInputEmail1">رقم الميك</label>
                      <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text"name="mic_number" class="form-control" id="exampleInputEmail1"  value="{{ $room_mic->mic_number }}" autofocus>

                      </div>
                    </div>
                          <div class="form-group">
                      <label>  تغير حالة الميك  </label>
                      <select   name="status"class="form-control">
                       
                        <option value="true"> متاح</option>
                       <option value="false">  غير متاح </option>

                        
                      </select>
                    </div>
                  
                         <div class="form-group">
                      <label>  اغلاق او فتح الميك </label>
                      <select   name="is_locked"class="form-control">
                       
                        <option value=0> متاح</option>
                       <option value=1>  غير متاح </option>

                        
                      </select>
                    </div>
                 
                        <div class="form-group">
                      <label> تغيرمستخدم الميك  </label>
                      <select   name="mic_user_id"class="form-control">
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">  {{ $user->name }}</option>
                @endforeach
                        
                      </select>
                    </div>
                       <div class="form-group">
                      <label>  تغير  مالك الغرفه  </label>
                      <select   name="room_owner_id"class="form-control">
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">  {{ $user->name }}</option>
                @endforeach
                        
                      </select>
                    </div>
                 

               
                    </div>
                   
      

              
          
                  
                
                 
                
              
                  
              
                 
                   
                 
                  </div><!-- /.box-body -->

                  <div class="box-footer" style="text-align:left">
                    <button type="submit" class="btn btn-primary" >تعديل</button>
                  </div>
                </form>
              </div><!-- /.box -->

       


        

            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
        </section>

@endsection