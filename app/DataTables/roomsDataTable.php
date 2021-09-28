<?php

namespace App\DataTables;

use App\Models\Room;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class roomsDataTable extends DataTable
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
            ->editColumn('room_name', function ($row) {
                return '<a href="">'.$row->room_name.'</a>';
            })
            ->editColumn('room_owner', function ($row) {
                return $row->user->name  ;
            })
            ->rawColumns(['action', 'room_name','room_background','room_desc' ,'room_owner'])
            ->addColumn('action',  function($row){
                $actionBtn = '
                 <a href="'. route('rooms.edit', $row->id) .'" class="edit btn btn-success btn-sm">تعديل</a>
                 <form action="'. route('rooms.destroy', $row->id) .'" method="POST">
                 '.csrf_field().'
                 '.method_field("DELETE").'
                 <button room_id="'.$row->id.'" class=" delete_btn delete btn btn-danger btn-sm"
                     onclick="return confirm(\'سوف يتم حذف المسؤل نهائينا هل تريد الحذف؟\')">حذف</a>
                 </form>';
                return $actionBtn;
            })
            ->editColumn('room_background', function ($row) {
          return '<img src="http://127.0.0.1:8000/storage/images/'. $row->room_background .'" height="50px"  width="150px"/>';
          //"<img src=\"" + data + "\" height=\"50\"/>"
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
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(room $model)
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
             Column::make('room_name')
             ->title("الاسم")
             ,
             Column::make('room_desc')
             ->title("التفاصيل")
             ,
             Column::make('room_owner')
             ->title("مالك الغرفه")
             ,  Column::make('room_background')
             ->title("الصوره")
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
        return 'rooms_' . date('YmdHis');
    }
}
