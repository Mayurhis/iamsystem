

<div class="form-fields-item mb-3">
    <label> @lang('cruds.user.fields.name_prefix')<span class="text-danger">*</span></label>
    <input type="text" name="name_prefix" id="name_prefix" value="" class="form-control valid" placeholder="Enter Name Prefix">
</div>
<div class="form-fields-item mb-3">
    <label>@lang('cruds.user.fields.first_name')<span class="text-danger">*</span></label>
    <input type="text" name="first_name" id="first_name" value="" class="form-control valid" placeholder="Enter First Name">
</div>
<div class="form-fields-item mb-3">
    <label>@lang('cruds.user.fields.middle_name')</label>
    <input type="text" name="middle_name" id="middle_name" value="" class="form-control valid" placeholder="Enter Middle Name">
</div>
<div class="form-fields-item mb-3">
    <label>@lang('cruds.user.fields.last_name')<span class="text-danger">*</span></label>
    <input type="text" name="last_name" id="last_name" value="" class="form-control valid" placeholder="Enter Last Name">
</div>

<div class="form-fields-item mb-4">
    <label>@lang('cruds.user.fields.email')<span class="text-danger">*</span></label>
    <input type="email" name="email" id="email" value="" class="form-control valid" placeholder="Enter Email Address">
</div>

<div class="form-fields-item mb-4">
    <label>@lang('cruds.user.fields.phone')<span class="text-danger">*</span></label>
    <input type="text" name="phone" id="phone" value="" class="form-control valid" placeholder="Enter Phone number">
</div>

<div class="form-fields-item mb-4">
    <label>@lang('cruds.user.fields.dob')<span class="text-danger">*</span></label>
    <input type="text" name="dob" id="dob" value="" class="form-control valid" >
</div>

<div class="form-fields-item mb-4">
    <label>@lang('cruds.user.fields.gender')<span class="text-danger">*</span></label>
    <select name="gender" id="gender" class="form-control">
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>
</div>

<div class="grid-btn">
    <button type="submit" class="btn btn-primary btn-regular w-100 submitBtn">Save</button>
    <button type="button" class="btn btn-regular w-100 btn-secondary cancel-modal">Cancel</button>
</div>
