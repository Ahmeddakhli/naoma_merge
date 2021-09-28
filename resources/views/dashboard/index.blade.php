@extends('layouts.app')

@section('content')


    <div class="content-wrapper">

        <section class="content-header">

            <h1>الغرف</h1>

            <ol class="breadcrumb">
                <li ><a href="#"><i class="fa fa-dashboard"></i>الرئسيه</a></li>
                <li class="active">الغرف</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title text-center" style="margin-bottom: 15px ; ">الغرف </h3>

                    <form action="#" method="get">

                        <div class="row">


                            <div class="col-md-4">
                                <a href="#" class="btn btn-primary"><i class="fa fa-plus"></i>اضافه</a>
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">
                    {!! $dataTable->table(['class' => 'table   table-striped   row-border table-hover ']) !!}

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection

@push('scripts')
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endpush
