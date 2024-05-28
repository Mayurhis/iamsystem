<?php

namespace App\DataTables;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Services\IAMHttpService;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;


class UserDataTable extends DataTable
{
    Private $iam;

    public function __construct()
    {
        $this->iam = new IAMHttpService();
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
                $metadata_action = '';
                if(!isRolePermission('user_metadata_editor')){
                    $metaDataIcon = view('components.svg-icons', ['icon' => 'metadata'])->render();
                    $addclass = '';
                    if(isset($row['metadata'])){

                        if(empty($row['metadata']) || is_null($row['metadata'])){
                            
                            $addclass = 'empty-metadata';
                        }
                    }else{
                        $addclass = 'empty-metadata';
                    }

                    $metadata_action ='<a href="'.route('admin.users.showMetaDataEditor',$row['ID']).'" class="action-btn bg-dark svg-icon '.$addclass.'" title="Metadata Editor">'.$metaDataIcon.'</a>';
                   
                }
                return  $metadata_action;

            })
            ->editColumn('created_at',function($row){
                return convertDateTimeFormat($row['created_at'],'datetime');
            })
            ->editColumn('updated_at',function($row){
                return $row['updated_at'] ? convertDateTimeFormat($row['updated_at'],'datetime') : '';
            })
            ->editColumn('last_login_at',function($row){
                return isset($row['last_login_at']) ? convertDateTimeFormat($row['last_login_at'],'datetime') : '';
            })
            
        
            ->addColumn('action', function ($row) {
                
                $action = '<div class="action-grid d-flex gap-2">';

                if(!isRolePermission('user_create_access_token')){
                    $action .='<a href="'.route('admin.users.showCreateAccessToken',$row['ID']).'" class="action-btn bg-dark" title="Create Access Token"><i class="fa fa-unlock" aria-hidden="true"></i></a>';
                }

                if(!isRolePermission('user_change_password')){
                    $action .='<a href="'.route('admin.users.changeUserPassword',$row['ID']).'" class="action-btn bg-dark" title="Change User Password"><i class="fa fa-lock" aria-hidden="true"></i></a>';
                }
                

                if(!isRolePermission('user_edit')){
                    $action .='<a href="'.route('admin.users.edit',$row['ID']).'" class="action-btn bg-primary" title="Edit"><i class="fi fi-rr-edit"></i></a>';
                }

                if(!isRolePermission('user_force_logout')){

                    $userForceLogoutIcon = view('components.svg-icons', ['icon' => 'user_logout'])->render();

                    $action .='<a href="'.route('admin.users.userForceLogout',$row['ID']).'" class="action-btn bg-primary svg-icon" id="userForceLogout" data-username="'.$row['username'].'" title="User Force Logout">'.$userForceLogoutIcon.'</a>';
                }

                
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['action', 'metadata']);
    }
    

    public function query()
    {
        $filterParameters = [];

        $audString = authUserDetail('data.user.aud');
        if($audString){
            $filterParameters['aud'] = $audString;
        }
       
        $offset = $this->request()->get('start');
        if($offset){
            dd($offset);
            $filterParameters['offset'] = $offset;
        }

        $limit = $this->request()->get('length');
        if($limit){
            $filterParameters['limit'] = $limit;
        }

        $columns = $this->request()->get('columns');

        //Start Sort by
        $orders = $this->request()->get('order');
        if(count($orders) > 0){
            $sortArr = [];
            foreach ($orders as $keyIndex => $order) {

                $columnIndex = (int)$order['column'];
                $columnName = $columns[$columnIndex]['data'];

                $sortDir = ($order['dir'] == 'asc') ? '+' : '-';

                $sortArr[$keyIndex] = $sortDir.$columnName;
            }

            if(count($sortArr) > 0){
                $filterParameters['sort'] = implode(',',$sortArr);
            }
        }
        //End Sort by

        //Start Search Box
        
        /*
        foreach ($columns as $column) {
            $data = $column['data'];
            $searchValue = $column['search']['value'] ?? '';

            if ($searchValue) {
                if($data == 'is_confirmed'){
                    $filterParameters[$data] = strtolower($searchValue) == 'yes' ? true : false;
                }else{
                    $filterParameters[$data] = $searchValue;
                }
               
            }
        }*/

        //End Search Box


        //Start Column Search Parameter

        if($this->request()->get('email')){
            $filterParameters['email[like]'] = $this->request()->get('email').'*';
        }

        if($this->request()->get('username')){
            $filterParameters['username[like]'] = '*'.$this->request()->get('username').'*';
        }

        if($this->request()->get('status')){
            $filterParameters['status'] = $this->request()->get('status');
        }

        if($this->request()->get('is_confirmed')){
            $filterParameters['is_confirmed'] = strtolower($searchValue) == 'yes' ? true : false;
        }

        if($this->request()->get('language')){
            $filterParameters['language[like]'] = $this->request()->get('language').'*';
        }

        if($this->request()->get('aud')){
            $filterParameters['aud[like]'] = $this->request()->get('aud').'*';
        }

        if($this->request()->get('metadata')){
            $filterParameters['metadata'] = $this->request()->get('metadata');
        }

        //if (Carbon::hasFormat($this->request()->get('created_at'), 'd-m-Y H:i')) {
        if ($this->request()->get('created_at')) {
            $filterParameters['created_at[lte]'] = Carbon::parse($this->request()->get('created_at'))->format('Y-m-d H:i');
        }

        if ($this->request()->get('updated_at')) {
            $filterParameters['updated_at[lte]'] = Carbon::parse($this->request()->get('updated_at'))->format('Y-m-d H:i');
        }

        if ($this->request()->get('last_login_at')) {
            $filterParameters['last_login_at[lte]'] = Carbon::parse($this->request()->get('last_login_at'))->format('Y-m-d H:i');
        }

        //End Column search Parameter

        // dd(  $filterParameters );

       $users = [];
       $apiResponse =  $this->iam->adminUserList($filterParameters);

        if($apiResponse['code'] == 200){
            $users = $apiResponse['response']['data']['users'];
        }

        return collect($users);
    }

    public function html() : HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrt')
                    ->orderBy(1)                    
                    ->selectStyleSingle()
                    ->lengthMenu([
                        [20, 40, 60, 80, 100],
                        [20, 40, 60, 80, 100]
                    ])
                    ->parameters([

                            'searching' => false,
                            'drawCallback' => 'function(settings) {
                                $("#users-table").addClass("table-loaded");
                            }',
                            'initComplete' => "function () {
                                var table = this.api();
                                let params = {};
                                if (table.rows().count() > 0) {
                                    
                                    if ($(table.table().header()).find('tr').length === 1) {
                                        var firstRow = $('<tr>').appendTo($(table.table().header()));
                                        table.columns().every(function () {
                                            var td = $('<td>').appendTo(firstRow);

                                            var column = this;

                                            var columnIndex = column.index();

                                            if(columnIndex === 0){

                                                var h = document.createElement('span');
                                                $(h).appendTo(td);

                                            }else if(columnIndex === 3){

                                                var selectList = document.createElement('select');
                                                selectList.name = 'status';
                                                selectList.classList.add('form-control','filterInput');

                                                selectList.style.minWidth  = '75px';

                                                var option1 = document.createElement('option');
                                                option1.value = '';
                                                option1.text = 'Select';
                                                selectList.appendChild(option1);

                                                for (var key in statusOptions) {
                                                    if (statusOptions.hasOwnProperty(key)) {
                                                        var option = document.createElement('option');
                                                        option.value = statusOptions[key];
                                                        option.text = capitalizeFirstChar(statusOptions[key]);
                                                        selectList.appendChild(option);
                                                    }
                                                }

                                                $(selectList).appendTo(td).on('change', function () {
                                                  
                                                    params.status = $(this).val();
                                                   
                                                    //$('#users-table').DataTable().ajax.url(datatableUrl+'?'+$.param(params)).draw();
                                                });

                                            }else if(columnIndex === 7){

                                                var selectList = document.createElement('select');
                                                selectList.name = 'type';
                                                selectList.classList.add('form-control','filterInput');

                                                selectList.style.minWidth  = '85px';

                                                var option1 = document.createElement('option');
                                                option1.value = '';
                                                option1.text = 'Select';
                                                selectList.appendChild(option1);

                                                for (var key in typeOptions) {
                                                    if (typeOptions.hasOwnProperty(key)) {
                                                        var option = document.createElement('option');
                                                        option.value = typeOptions[key];
                                                        option.text = capitalizeFirstChar(typeOptions[key]);
                                                        selectList.appendChild(option);
                                                    }
                                                }

                                                $(selectList).appendTo(td).on('change', function () {
                                                    params.type = $(this).val();
                                                   
                                                    //$('#users-table').DataTable().ajax.url(datatableUrl+'?'+$.param(params)).draw();
                                                });

                                            }else if(columnIndex === 12){

                                                var submitBtn = document.createElement('button');
                                                submitBtn.name = 'Submit';
                                                submitBtn.classList.add('btn', 'btn-dark','filter-submit-btn');
                                                submitBtn.innerText = 'Submit';
                                        
                                                submitBtn.addEventListener('click', function() {
                                                    //console.log('Button clicked!',params);
                                                    $('#users-table').DataTable().ajax.url(datatableUrl+'?'+$.param(params)).draw();
                                                });

                                                $(submitBtn).appendTo(td);

                                                var resetBtn = document.createElement('button');
                                                resetBtn.name = 'Reset';
                                                resetBtn.classList.add('btn', 'btn-secondary','filter-reset-btn');
                                                resetBtn.innerText = 'Reset';
            
                                                resetBtn.addEventListener('click', function() {

                                                    //console.log('Reset button clicked!');

                                                    document.querySelectorAll('.filterInput').forEach(function(element) {
                                                        if (element.tagName.toLowerCase() === 'input' && element.type === 'text') {
                                                            element.value = '';
                                                        } else if (element.tagName.toLowerCase() === 'select') {
                                                            element.selectedIndex = '';
                                                        }
                                                    });

                                                    params = {}; 

                                                    $('#users-table').DataTable().ajax.url(datatableUrl).draw();
                                                });

                                                $(resetBtn).appendTo(td);
                                                
                                            }else if(columnIndex != 8){
                                               
                                                var input = document.createElement('input');

                                                if((columnIndex != 4) && (columnIndex != 5)){
                                                    input.style.minWidth  = '100px';
                                                }

                                                input.classList.add('form-control','filterInput');
                                                $(input).appendTo(td)
                                                    .on('input', function () {

                                                        if(columnIndex == 1){
                                                            params.email = $(this).val();
                                                        }

                                                        if(columnIndex == 2){
                                                            params.username = $(this).val();
                                                        }

                                                        if(columnIndex == 4){
                                                            params.is_confirmed = $(this).val();
                                                        }

                                                        if(columnIndex == 5){
                                                            params.language = $(this).val();
                                                        }

                                                        if(columnIndex == 6){
                                                            params.aud = $(this).val();
                                                        }


                                                        if(columnIndex == 9){
                                                            params.created_at = $(this).val();
                                                        }

                                                        if(columnIndex == 10){
                                                            params.updated_at = $(this).val();
                                                        }

                                                        if(columnIndex == 10){
                                                            params.last_login_at = $(this).val();
                                                        }
                                                   
                                                       // $('#users-table').DataTable().ajax.url(datatableUrl+'?'+$.param(params)).draw();
                                                    });
                                            }
                                        });
                                    }
                                }
                            }",
                            
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
        
        
        $columns[] = Column::make('metadata')->title(trans('cruds.user.fields.metadata'))->exportable(false)->printable(false)->addClass('text-center');
        
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
