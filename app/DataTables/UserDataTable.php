<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Support\Str;

class UserDataTable extends DataTable
{
    private $filePath;
    
    public function __construct()
    {
        $this->filePath = public_path('backend/json/users.json');
    }

    public function dataTable($query)
    {
        return datatables()
            ->of($query)
            ->setRowClass(function ($row) {
                return 'clickRow';
            })
            ->setRowId(function ($row) {
                return $row['ID'];
            })
            ->addIndexColumn()
            ->editColumn('username',function($row){
                return $row['username'];
            })
            ->editColumn('status',function($row){
                return ucwords($row['status']);
            })
            ->editColumn('is_confirmed',function($row){
                return $row['is_confirmed'] == 1 ? 'Yes' : 'No';
            })
            ->editColumn('language',function($row){
                return strtoupper($row['language']);
            })
            ->editColumn('aud',function($row){
                return $row['aud'];
            })
            ->editColumn('type',function($row){
                return ucwords($row['type']);
            })
            
            ->editColumn('metadata',function($row){
                return  $row['metadata'] ? Str::limit($row['metadata'], 50) : '';
            })
            ->editColumn('created_at',function($row){
                return convertDateTimeFormat($row['created_at']);
            })
            ->editColumn('updated_at',function($row){
                return $row['updated_at'] ? convertDateTimeFormat($row['updated_at']) : '';
            })
            ->editColumn('last_login_at',function($row){
                return $row['last_login_at'] ? convertDateTimeFormat($row['last_login_at']) : '';
            })
            
           
            
            ->addColumn('action', function ($row) {
                
                $action = '<div class="action-grid d-flex gap-2">';

                if(!isRolePermission('user_create_access_token')){
                    $action .='<a href="'.route('admin.users.showCreateAccessToken',$row['ID']).'" class="action-btn bg-dark" title="Create Access Token"><i class="fa fa-unlock" aria-hidden="true"></i></a>';
                }

                if(!isRolePermission('user_change_password')){
                    $action .='<a href="'.route('admin.users.changeUserPassword',$row['ID']).'" class="action-btn bg-dark" title="Change User Password"><i class="fa fa-lock" aria-hidden="true"></i></a>';
                }

                
                if(!isRolePermission('user_metadata_editor')){

                    $metaDataIcon = view('components.svg-icons', ['icon' => 'metadata'])->render();

                    $action .='<a href="'.route('admin.users.showMetaDataEditor',$row['ID']).'" class="action-btn bg-dark svg-icon" title="Metadata Editor">'.$metaDataIcon.'</a>';
                }
                
                /*if(!isRolePermission('user_view')){
                    $action .='<a href="'.route('admin.users.show',$row['ID']).'" class="action-btn bg-dark" title="View"><i class="fi fi-rr-eye"></i></i></a>';
                }*/

                if(!isRolePermission('user_edit')){
                    $action .='<a href="'.route('admin.users.edit',$row['ID']).'" class="action-btn bg-primary" title="Edit"><i class="fi fi-rr-edit"></i></a>';
                }
                $action .= '</div>';

                return $action;
            });
    }
    

    public function query()
    {
        $users = json_decode(file_get_contents($this->filePath), true);

        $audString = authUserDetail('data.user.aud');

        if($audString && authUserDetail('data.user.type') == 'auditor'){
            $users = array_filter($users, function($user) use ($audString) {
                return isset($user['aud']) && $user['aud'] == $audString;
            });
        }

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
                        [20, 40, 60, 80, 100],
                        [20, 40, 60, 80, 100]
                    ]);
    }
  

    /**
    * Get the dataTable columns definition.
    */
    public function getColumns(): array
    {
        $columns = [];
        $columns[] = Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false);
        $columns[] = Column::make('email')->title(trans('cruds.user.fields.email'));
        $columns[] = Column::make('username')->title(trans('cruds.user.fields.username'));
        $columns[] = Column::make('status')->title(trans('cruds.user.fields.status'));
        $columns[] = Column::make('is_confirmed')->title(trans('cruds.user.fields.is_confirmed'));
        $columns[] = Column::make('language')->title(trans('cruds.user.fields.language'));

        if(authUserDetail('data.user.type') == 'admin'){
            $columns[] = Column::make('aud')->title(trans('cruds.user.fields.aud'));
            $columns[] = Column::make('type')->title(trans('cruds.user.fields.type'));
        }
        
        
        $columns[] = Column::make('metadata')->title(trans('cruds.user.fields.metadata'));
        
        $columns[] = Column::make('created_at')->title(trans('cruds.user.fields.created_at'));
        $columns[] = Column::make('updated_at')->title(trans('cruds.user.fields.updated_at'));
        $columns[] = Column::make('last_login_at')->title(trans('cruds.user.fields.last_login_at'));

        if(authUserDetail('data.user.type') == 'admin'){
            $columns[] = Column::computed('action')->exportable(false)->printable(false)->addClass('text-center');
        }

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
