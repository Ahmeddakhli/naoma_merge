  @extends('layouts.app')

@section('content')

  

 <section class="content">
           <div class="row">
    <div class="box  box-primary" text-center>
    <div class="box-header with-border">
      <h3 class="box-title"> <h1 style="  text-align: center; background-color:gray; color:white;">الغرف 
      <a  class="btn btn-info"href="{{ route('rooms.create') }}"><i class="fa fa-plus"></i> اضافة</a>
</h1></h3>
    </div><!-- /.box-header -->
    <div class="box-body no-padding" 
>
            
  
    {!! $dataTable->table(['class' => 'table   table-striped   row-border table-hover ' ,'style'=>'
  border: 1px solid black; width:100%;text-align:center; '],true) !!}
    </div><!-- /.box-body -->
  </div>
 

 
</div>
    </section>

     
{!! $dataTable->scripts() !!}
  
@endsection