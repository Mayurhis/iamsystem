
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label> @lang('cruds.user.fields.aud')<span class="text-danger">*</span></label>
            <input type="text" name="aud" id="aud" value="{{ $user['aud'] ?? ''}}" class="form-control valid" placeholder="Enter Aud">
        </div>        
    </div>

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.username')<span class="text-danger">*</span></label>
            <input type="text" name="username" id="username" value="{{ $user['username'] ?? ''}}" class="form-control valid" placeholder="Enter Username">
        </div>
    </div>

    <div class="col-6">
        
        <div class="form-group">
            <label>@lang('cruds.user.fields.email')<span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" value="{{ $user['email'] ?? ''}}" class="form-control valid" placeholder="Enter Email Address">
        </div>

    </div>
    
    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.password')<span class="text-danger">*</span></label>
            <input type="password" name="password" id="password" value="{{ $user['password'] ?? ''}}" class="form-control valid" placeholder="Enter Password">
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.status')<span class="text-danger">*</span></label>
            @php
              $status = '';
              if(isset($user)){
                if($user['status'] == 'active'){
                    $status = $user['status'];
                }else if($user['status'] == 'deactive'){
                    $status = $user['status'];
                }
              }
            @endphp
            <select  class="form-control" name="status" id="status">
                <option value="">Select Status</option>
                @foreach(config('constant.userStatus') as $value)
                    <option value="{{$value}}" {{ $value == $status ? 'selected' : ''}}>{{ ucwords($value) }}</option>
                @endforeach
            </select>
        </div>
    </div>

</div>

<div class="grid-btn float-end">
    @if(isset($user))
        <button type="submit" class="btn btn-primary btn-regular submitBtn">Update</button>
    @else
        <button type="submit" class="btn btn-primary btn-regular submitBtn">Save</button>
    @endif
    <a href="{{ route('admin.users.index') }}" class="btn btn-regular btn-secondary">@lang('global.cancel')</a>
</div> 
