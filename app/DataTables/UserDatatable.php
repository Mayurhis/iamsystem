<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;


class UserDataTable extends DataTable
{
    public function __construct()
    {
        $this->filePath = storage_path('app/users.json');
    }

    public function dataTable($query)
    {
        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                $action = '<div class="action-grid d-flex gap-2">';

                $action .='<a href="'.route('admin.user_detail').'" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>';

                $action .='<a href="javascript:void(0)" class="action-btn bg-primary" title="edit"><i class="fi fi-rr-edit"></i></i></a>';

                $action .='<a href="javascript:void(0)" class="action-btn bg-danger" title="delete"><i class="fi fi-rr-trash"></i></i></a>';

                $action .= '</div>';

                return $action;
            });
    }

    public function query()
    {
        $users = json_decode(file_get_contents($this->filePath), true);

        return collect($users);
    }

    public function html() : HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)                    
                    ->selectStyleSingle()
                    ->lengthMenu([
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, 'All']
                    ]);
    }


    /**
    * Get the dataTable columns definition.
    */
    public function getColumns(): array
    {
        $columns = [];
        $columns[] = Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false);
        $columns[] = Column::make('name')->title('Name');
        $columns[] = Column::make('email')->title('Email');
        $columns[] = Column::computed('action')->exportable(false)->printable(false)->addClass('text-center');

        return $columns;
    }
    
    /**
     * Get the filename for export.
    */
    protected function filename(): string
    {
        return 'users_' . date('YmdHis');
    }
}
