@if($getRecords)
  @foreach($getRecords as $key=>$row)

    <tr id="{{ $row['ID'] }}" class="clickRow {{($key%2 == 0) ? 'even' : 'odd' }} appened">

        <td>{{ $offset + (int)($key+1)}}</td>
        <td class="sorting_1">{{ $row['email'] }}</td>
        <td>{{ $row['username'] }}</td>
        <td>{{ ucwords($row['status']) }}</td>
        <td>{{ $row['is_confirmed'] == 1 ? 'Yes' : 'No' }}</td>
        <td>{{ strtoupper($row['language']) }}</td>
        <td>{{ $row['aud'] ?? ''}}</td>
        <td>{{ ucwords($row['type']) }}</td>
        <td class="text-center">
            @php
                $addclass = '';
                if(isset($row['metadata'])){

                    if(empty($row['metadata']) || is_null($row['metadata'])){
                        
                        $addclass = 'empty-metadata';
                    }
                }else{
                    $addclass = 'empty-metadata';
                }    
            @endphp
            <a href="{{ route('admin.users.showMetaDataEditor',$row['ID']) }}" class="action-btn bg-dark svg-icon {{$addclass}}" title="Metadata Editor">
                <x-svg-icons icon="metadata"/>
            </a>
        </td>
        <td>{{ convertDateTimeFormat($row['created_at'],'datetime') }}</td>
        <td>{{ isset($row['updated_at']) ? convertDateTimeFormat($row['updated_at'],'datetime') : '' }}</td>
        <td>{{ isset($row['last_login_at']) ? convertDateTimeFormat($row['last_login_at'],'datetime') : ''}}</td>
        <td class="text-center">
            <div class="action-grid d-flex gap-2">

                @if(!isRolePermission('user_create_access_token'))
                <a href="{{ route('admin.users.showCreateAccessToken',$row['ID']) }}" class="action-btn bg-dark" title="Create Access Token"><i class="fa fa-unlock" aria-hidden="true"></i></a>
                @endif

                @if(!isRolePermission('user_change_password'))
                <a href="{{ route('admin.users.changeUserPassword',$row['ID']) }}" class="action-btn bg-dark" title="Change User Password"><i class="fa fa-lock" aria-hidden="true"></i></a>
                @endif
                
                @if(!isRolePermission('user_edit'))
                <a href="{{ route('admin.users.edit',$row['ID']) }}" class="action-btn bg-primary" title="Edit"><i class="fi fi-rr-edit"></i></a>
                @endif

                @if(!isRolePermission('user_force_logout'))
                <a href="{{ route('admin.users.userForceLogout',$row['ID']) }}" class="action-btn bg-primary svg-icon" id="userForceLogout" data-username="user7hisexamplecom" title="User Force Logout">
                    <x-svg-icons icon="user_logout"/>
                </a>
                @endif

            </div>
        </td>

    </tr>
    
  @endforeach
@endif