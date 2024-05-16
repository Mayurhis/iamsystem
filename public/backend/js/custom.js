"use strict";

$(document).ready(function(){
	$(".detail-edit").click(function(){
		$(".tab-bottom-blog").addClass("edit-open");
	});

	$(".humberger-icon").click(function(){
		$(".dash-section").toggleClass("sidebar-open");
	});

});

//   change password 

$(document).on('click', '.password_toggle', function() {

	$(this).toggleClass("eye-close");
	
	var input = $("#log_pass_id");
	input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
	});
	
	$(document).on('click', '.password_toggle1', function() {
	
	$(this).toggleClass("eye-close");
	
	var input = $("#log_pass_id1");
	input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
	});
	
	$(document).on('click', '.password_toggle2', function() {
	
	$(this).toggleClass("eye-close");
	
	var input = $("#log_pass_id2");
	input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});

// profile update 

$(document).on('click','.profileImage',function(){
	$(this).closest('.author-cion').find('span.invalid-feedback').remove();
	$('.file-input').click();
  });
  
  $('.file-input').change(function(){
	$('.image-error').remove();
	var input = $(this)[0]; 
	if (input.files && input.files[0]) {
	  var file = input.files[0];
	  var reader = new FileReader();
	  
	  var allowedExtensions = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG'];
	  var fileExtension = file.name.split('.').pop().toLowerCase();
	  var fileSizeKB = file.size / 1024;
	  if (allowedExtensions.indexOf(fileExtension) === -1) {
		$('<span class="image-error invalid-feedback d-block mt-0">Invalid file format.Please upload valid file.</span>').insertAfter($('#editprofile .author-box'));
		$(this).val('');
		return;
	  }else if (fileSizeKB > 2048) {
		$('<span class="image-error invalid-feedback d-block mt-0">File size exceeds! The maximum allowed size of 2 MB.</span>').insertAfter($('.author-box'));
		$(this).val('');
		return;
	  }
	  reader.onload = function (e) {
		$('.profileImage').attr('src', e.target.result);
	  };
	  reader.readAsDataURL(input.files[0]);
	}
});
