<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label> @lang('cruds.user.fields.aud')<span class="text-danger">*</span></label>
            <input type="text" name="aud" id="aud" value="{{ $user['aud'] ?? ''}}" class="form-control valid editable" placeholder="Enter Audience" autocomplete="off"> 
        </div>        
    </div>

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.username')</label>
            <input type="text" name="username" id="username" value="{{ $user['username'] ?? ''}}" class="form-control valid editable" placeholder="Enter Username" autocomplete="off">
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.email')<span class="text-danger">*</span></label>
            @php
              $inputType = 'email';
              if($user){
                if( in_array($user['type'],array('system','machine')) ){
                    $inputType = 'text';
                }
              }
            @endphp
            <input type="{{ $inputType }}" name="email" id="email" value="{{ $user['email'] ?? ''}}" class="form-control valid editable" placeholder="Enter Email Address" autocomplete="off">
        </div>
    </div>
    
    @if(request()->route()->getName() == 'admin.users.create')
    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.password')<span class="text-danger">*</span></label>
            <div class="input-password-wrap">
                <input type="password" name="password" id="password" value="{{ $user['password'] ?? ''}}" class="form-control valid editable" placeholder="Enter Password" autocomplete="off">
                <i class="fa fa-eye-slash text-dark" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
            </div>
            <div class="text-end d-flex justify-content-end">
                <button type="button" class="btn btn-primary mt-3"  data-bs-toggle="modal" data-bs-target="#generatePasswordModal">@lang('global.suggest_password')</button>
            </div>
        </div>
    </div>
    @endif

    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.type')<span class="text-danger">*</span></label>
            @php
              $type = '';
              if(isset($user)){
                $type = $user['type'];
              }
            @endphp
            <select  class="form-control editable" name="type" id="type">
                <option value="">Select Type</option>
                @foreach(config('constant.userType') as $value)
                    <option value="{{$value}}" {{ (empty($type) && $value == 'user') ? 'selected' : ''  }} {{ ($value == $type) ? 'selected' : ''}}>{{ ucwords($value) }}</option>
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
            <select  class="form-control editable" name="confirmed" id="confirmed">
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
            <select  class="form-control editable" name="status" id="status">
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
            @php
              $selectedLang = '';
              if(isset($user)){
                $selectedLang = $user['language'];
              }
            @endphp
            <select  class="form-control editable" name="language" id="language">
                <option value="">Select Language</option>
                @foreach($languages as $language)
                    <option value="{{$language->code}}" {{ $language->code == $selectedLang ? 'selected' : ''}}>{{ strtoupper($language->code) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="col-6">
        <div class="form-group">
            <label>@lang('cruds.user.fields.role')<span class="text-danger">*</span></label>
            <select  class="form-control editable" name="role[]" id="role" multiple="multiple">
                @if($user)
                    @foreach(explode(',',$user['role']) as $role)
                        <option value="{{$role}}" selected>{{ ucwords($role) }}</option>
                    @endforeach
                @endif
            </select>
            {{-- <input type="text" name="role" id="role" value="{{ $user['role'] ?? ''}}" class="form-control valid editable" placeholder="Enter Role" autocomplete="off"> --}}
        </div>
    </div>
    
     <div class="col-12">
        <div class="form-group">
             @php
               $metadata = '';
               if($user){
                 if($user['metadata']){
                    $metadata = json_encode($user['metadata']);
                 }
               }
             @endphp
            <label>@lang('cruds.user.fields.metadata')<span class="text-danger">*</span></label>
            <textarea type="text" name="metadata" id="metadata" class="form-control valid editable" row="4" placeholder="Enter Metadata" autocomplete="off">{{ $metadata ?? ''}}</textarea>
        </div>
    </div>
    

</div>

<div class="grid-btn float-end">
    @if(isset($user))
        <input type="hidden" name="user_id"  value="{{ $user['ID'] ?? ''}}">
        <button type="button" class="btn btn-dark btn-regular text-white editBtn">@lang('global.edit')</button>
        <button type="submit" class="btn btn-primary btn-regular submitBtn" style="display:none;">@lang('global.update')</button>
    @else
        <button type="submit" class="btn btn-primary btn-regular submitBtn">@lang('global.save')</button>
    @endif
    <a href="{{ route('admin.users.index') }}" class="btn btn-regular btn-secondary cancelBtn" style="{{ request()->route()->getName() == 'admin.users.edit' ? 'display:none;' : ''}}">@lang('global.cancel')</a>
</div> 
