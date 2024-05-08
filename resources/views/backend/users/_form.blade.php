
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label> @lang('cruds.user.fields.aud')<span class="text-danger">*</span></label>
            <input type="text" name="aud" id="aud" value="{{ $user['aud'] ?? ''}}" class="form-control valid" placeholder="Enter Aud" autocomplete="off">
        </div>        
    </div>

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.username')</label>
            <input type="text" name="username" id="username" value="{{ $user['username'] ?? ''}}" class="form-control valid" placeholder="Enter Username" autocomplete="off">
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.email')<span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" value="{{ $user['email'] ?? ''}}" class="form-control valid" placeholder="Enter Email Address" autocomplete="off">
        </div>
    </div>
    
    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.password')<span class="text-danger">*</span></label>
            <div class="input-password-wrap">
                <input type="password" name="password" id="password" value="{{ $user['password'] ?? ''}}" class="form-control valid" placeholder="Enter Password" autocomplete="off">
                <i class="fa fa-eye-slash text-dark" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
            </div>
            <button type="button" class="btn btn-primary mt-3" id="suggestPassword">Suggest Password</button>
            
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.type')<span class="text-danger">*</span></label>
            @php
              $type = '';
              if(isset($user)){
                $type = $user['type'];
              }
            @endphp
            <select  class="form-control" name="type" id="type">
                <option value="">Select Type</option>
                @foreach(config('constant.userType') as $value)
                    <option value="{{$value}}" {{ $value == $type ? 'selected' : ''}}>{{ ucwords($value) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.is_confirmed')<span class="text-danger">*</span></label>
            @php
              $is_confirmed = 0;
              if(isset($user)){
                $is_confirmed = $user['is_confirmed'];
              }
            @endphp
            <select  class="form-control" name="confirmed" id="confirmed">
                <option value="1" {{ $is_confirmed == 1 ? 'selected' : ''}}>Yes</option>
                <option value="0" {{ $is_confirmed == 0 ? 'selected' : ''}}>No</option>
            </select>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.status')<span class="text-danger">*</span></label>
            @php
              $status = '';
              if(isset($user)){
                $status = $user['status'];
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

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.language')<span class="text-danger">*</span></label>
            <input type="text" name="language" id="language" value="{{ $user['language'] ?? ''}}" class="form-control valid" placeholder="Enter Language">
        </div>
    </div>

</div>

<div class="grid-btn float-end">
    @if(isset($user))
        <input type="hidden" name="user_id"  value="{{ $user['id'] ?? ''}}">
        <button type="submit" class="btn btn-primary btn-regular submitBtn">@lang('global.update')</button>
    @else
        <button type="submit" class="btn btn-primary btn-regular submitBtn">@lang('global.save')</button>
    @endif
    <a href="{{ route('admin.users.index') }}" class="btn btn-regular btn-secondary">@lang('global.cancel')</a>
</div> 
