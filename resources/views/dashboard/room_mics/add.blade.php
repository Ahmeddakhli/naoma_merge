
     @extends('layouts.app')

@section('content')

  <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary" >
                <div class="box-header with-border " style="text-align:center" >
                  <h3 class="box-title" >اضافة غرفه  جديد</h3>
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
                    <form  method="POST" role="form" class="form-horizontal" action="{{ route('rooms.store') }}" enctype="multipart/form-data" >
                                    @csrf
                  <div class="box-body">
                    <div class="col-md-11" style=" margin: 10px;">

                    <div class="form-group">
                      <label for="exampleInputEmail1">اسم الغرفه</label>
                      <div class="input-group">
                     <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text"name="room_name" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{ old('room_name') }}" autofocus>

                      </div>
                    </div>
                  
                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">تفاصيل الغرفه والتعليمات(الوصف) </label>
                       <textarea  type="text"  row="20" name="room_desc" class="form-control" id="editor" >
                           {{ old('room_desc') }}
                          </textarea>
                      
                    </div>
        
                  
                    
              
              
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">اختر صور او اكثر من صوره المنتج  </label>
                    
                          <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                            <input type="file" name="room_background"   class="myfrm form-control" value="{{ old('img[]') }}">
                           
                    </div>
                    </div>
                        
                    <div class="col-md-6">
                        <div class="form-group">
                      <label>اختر مالك الغرفه</label>
                      <select   name="room_owner" value="{{ old('room_owner') }}" class="form-control">
                     @foreach ($users as $user)
                        <option value="{{ $user->id }}">  {{ $user->name }}</option>
                @endforeach
                        
                      </select>
                      <input type="hidden" name="user_id" value="1" >
                    </div>
                 
                    </div>
                  
              
                    </div>
                   
                 
                  </div><!-- /.box-body -->

                  <div class="box-footer" style="text-align:left">
                    <button type="submit" class="btn btn-primary" >اضافه</button>
                  </div>
                </form>
              </div><!-- /.box -->

       


        

            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
        </section>

@endsection