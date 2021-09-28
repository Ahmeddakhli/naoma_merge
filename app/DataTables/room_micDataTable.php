<?php

namespace App\DataTables;

use App\Models\room_mics;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class room_micDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
           
         
            ->rawColumns(['action','room_owner_id','mic_user_id','room_id' ])
            ->editColumn('room_owner_id', function ($row) {
                return $row->room->user->name  ;
            })
            ->editColumn('room_id', function ($row) {
                return $row->room->room_name  ;
            })
            ->editColumn('mic_user_id', function ($row) {
                  
                if($row->mic_user_id!=null) {
                   $name= User::find( $row->mic_user_id)->name;
                   return $name;
                };
            })
            ->addColumn('action',  function($row){
                $actionBtn = '
                 <a href="'. route('room_mics.edit', $row->id) .'" class="edit btn btn-success btn-sm">تعديل</a>
                 <form action="'. route('room_mics.destroy', $row->id) .'" method="POST">
                 '.csrf_field().'
                 '.method_field("DELETE").'
                 <button room_id="'.$row->id.'" class=" delete_btn delete btn btn-danger btn-sm"
                     onclick="return confirm(\'سوف يتم حذف المسؤل نهائينا هل تريد الحذف؟\')">حذف</a>
                 </form>';
                return $actionBtn;
            })
         
         
       
            ->setRowId(function ($row) {
                return $row->id;
            })
            ->setRowAttr([
                'text-align' => 'center',
                
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\room_mic $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(room_mics $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('rooms-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->language([
                        'buttoms' => [
                            'Excel' =>'إكسيل',
                            'print' =>'طباعه',
                            'Export' =>'تحميل',
                            'Reload' =>'تحميل البيانات الجديده',
                            'Reset' =>'الغاء البحث',
                
                        ],
                        'url' => url('//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json')
                    ])
                    ->columnDefs(' width: "10px", targets: [0,1,2]') 
                 
                    ->parameters([
                      
                        
                        'initComplete' => "function () {
                            this.api().columns().every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('change', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                    ])
                    
                    ->responsive(true)
                    ->serverSide(true)
                    ->processing(True)
                    ->autoWidth( true)
                       
                
                    ->buttons(
                      
                        Button::make('export')
                        ->title("تحميل")
                        ,
                        Button::make('print')
                        ->title("طباعة"),
                        Button::make('reset')
                        ->title("حذف البحث"),
                        Button::make('reload')
                        ->title("تحميل المنتجات الجديدة")
                        ,

                       

                    );
    }


    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')
            ->width(10)
            ->title("رقم")
             ,
             Column::make('mic_number')
             ->title("رقم الميك")
             ,
             Column::make('status')
             ->title("الحاله")
             ,
             Column::make('is_locked')
             ->title("مغلق")
             ,
             Column::make('room_id')
             ->title("اسم الغرفه")
             ,
             Column::make('room_owner_id')
             ->title("مالك الغرفه")
             ,
             Column::make('mic_user_id')
             ->title("مستخدم الميك")
             ,
      
     Column::make('created_at')->title("تاريخ الاضافة"),
      Column::make('updated_at')->title("تاريخ التعديل"),
      Column::computed('action')
      ->title(" عمليات")
      ->width(60),
  ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'room_mic_' . date('YmdHis');
    }
}
