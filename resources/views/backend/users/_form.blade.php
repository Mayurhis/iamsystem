
<div class="row">
    <div class="col-3">
        <div class="form-group">
            <label> @lang('cruds.user.fields.name_prefix')<span class="text-danger">*</span></label>
            <input type="text" name="name_prefix" id="name_prefix" value="{{ $user['name_prefix'] ?? ''}}" class="form-control valid" placeholder="Enter Name Prefix">
        </div>        
    </div>

    <div class="col-3">
        <div class="form-group">
            <label>@lang('cruds.user.fields.first_name')<span class="text-danger">*</span></label>
            <input type="text" name="first_name" id="first_name" value="{{ $user['first_name'] ?? ''}}" class="form-control valid" placeholder="Enter First Name">
        </div>
    </div>

    
    <div class="col-3">
        <div class="form-group">
            <label>@lang('cruds.user.fields.middle_name')</label>
            <input type="text" name="middle_name" id="middle_name" value="{{ $user['middle_name'] ?? ''}}" class="form-control valid" placeholder="Enter Middle Name">
        </div>
    </div>

    <div class="col-3">
        <div class="form-group">
            <label>@lang('cruds.user.fields.last_name')<span class="text-danger">*</span></label>
            <input type="text" name="last_name" id="last_name" value="{{ $user['last_name'] ?? ''}}" class="form-control valid" placeholder="Enter Last Name">
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
            <label>@lang('cruds.user.fields.phone')<span class="text-danger">*</span></label>
            <input type="text" name="phone" id="phone" value="{{ $user['phone'] ?? ''}}" class="form-control valid" placeholder="Enter Phone number">
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.dob')<span class="text-danger">*</span></label>
            <input type="text" name="dob" id="dob" value="{{ $user['dob'] ?? ''}}" class="form-control valid" >
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.gender')<span class="text-danger">*</span></label>
            <select name="gender" id="gender" class="form-control">
                <option value="male">Male</option>
                <option value="female">Female</option>
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
