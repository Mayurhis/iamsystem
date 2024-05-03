"use strict";

$(document).ready(function(){
	$(".detail-edit").click(function(){
		$(".tab-bottom-blog").addClass("edit-open");
	});

	$(".humberger-icon").click(function(){
		$(".dash-section").toggleClass("sidebar-open");
	});

	// data tables 
	let table = new DataTable('#fieldtable');

});

$(document).on('change', "#uploadidPic .input-file",function(e){
	if ($(this).val()) {
		var filename = $(this).val().split("\\");
		filename = filename[filename.length-1];
		$('#uploadidPic .image-name').text(filename);
	}
	var files = e.target.files;
	for (var i = 0; i < files.length; i++) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('#previewImg1 img').attr('src', e.target.result);
			// $('#upload_submit').text('Submit');
			$('#upload_submit').html('Submit <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.29356 2.63052L4.17356 6.51052L0.29356 10.3905C-0.0964404 10.7805 -0.0964404 11.4105 0.29356 11.8005C0.68356 12.1905 1.31356 12.1905 1.70356 11.8005L6.29356 7.21052C6.68356 6.82052 6.68356 6.19052 6.29356 5.80052L1.70356 1.21052C1.31356 0.820519 0.68356 0.820519 0.29356 1.21052C-0.0864404 1.60052 -0.0964404 2.24052 0.29356 2.63052Z" fill="white"/> <path d="M6.87657 2.79434L10.7566 6.67434L6.87657 10.5543C6.48657 10.9443 6.48657 11.5743 6.87657 11.9643C7.26657 12.3543 7.89657 12.3543 8.28657 11.9643L12.8766 7.37434C13.2666 6.98434 13.2666 6.35434 12.8766 5.96434L8.28657 1.37434C7.89657 0.984337 7.26657 0.984337 6.87657 1.37434C6.49657 1.76434 6.48657 2.40434 6.87657 2.79434Z" fill="white"/></svg>');
			$('#upload_submit').addClass('submit_btn');
		};
		reader.readAsDataURL(files[i]);
	}
});
$(document).on('change', "#uploadfacepic .input-file",function(e){
	if ($(this).val()) {
		var filename = $(this).val().split("\\");
		filename = filename[filename.length-1];
		$('#uploadfacepic .image-name').text(filename);
	}
	var files = e.target.files;
	for (var i = 0; i < files.length; i++) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('#previewImg2 img').attr('src', e.target.result);
			$('#upload_submit2').html('Submit <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.29356 2.63052L4.17356 6.51052L0.29356 10.3905C-0.0964404 10.7805 -0.0964404 11.4105 0.29356 11.8005C0.68356 12.1905 1.31356 12.1905 1.70356 11.8005L6.29356 7.21052C6.68356 6.82052 6.68356 6.19052 6.29356 5.80052L1.70356 1.21052C1.31356 0.820519 0.68356 0.820519 0.29356 1.21052C-0.0864404 1.60052 -0.0964404 2.24052 0.29356 2.63052Z" fill="white"/> <path d="M6.87657 2.79434L10.7566 6.67434L6.87657 10.5543C6.48657 10.9443 6.48657 11.5743 6.87657 11.9643C7.26657 12.3543 7.89657 12.3543 8.28657 11.9643L12.8766 7.37434C13.2666 6.98434 13.2666 6.35434 12.8766 5.96434L8.28657 1.37434C7.89657 0.984337 7.26657 0.984337 6.87657 1.37434C6.49657 1.76434 6.48657 2.40434 6.87657 2.79434Z" fill="white"/></svg>');
			$('#upload_submit2').addClass('submit_btn');
		};
		reader.readAsDataURL(files[i]);
	}
});
$(document).on('change', "#uploadaddproof .input-file",function(e){
	if ($(this).val()) {
		var filename = $(this).val().split("\\");
		filename = filename[filename.length-1];
		$('#uploadaddproof .image-name').text(filename);
	}
	var files = e.target.files;
	for (var i = 0; i < files.length; i++) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('#previewImg3 img').attr('src', e.target.result);
			$('#upload_submit3').html('Submit <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.29356 2.63052L4.17356 6.51052L0.29356 10.3905C-0.0964404 10.7805 -0.0964404 11.4105 0.29356 11.8005C0.68356 12.1905 1.31356 12.1905 1.70356 11.8005L6.29356 7.21052C6.68356 6.82052 6.68356 6.19052 6.29356 5.80052L1.70356 1.21052C1.31356 0.820519 0.68356 0.820519 0.29356 1.21052C-0.0864404 1.60052 -0.0964404 2.24052 0.29356 2.63052Z" fill="white"/> <path d="M6.87657 2.79434L10.7566 6.67434L6.87657 10.5543C6.48657 10.9443 6.48657 11.5743 6.87657 11.9643C7.26657 12.3543 7.89657 12.3543 8.28657 11.9643L12.8766 7.37434C13.2666 6.98434 13.2666 6.35434 12.8766 5.96434L8.28657 1.37434C7.89657 0.984337 7.26657 0.984337 6.87657 1.37434C6.49657 1.76434 6.48657 2.40434 6.87657 2.79434Z" fill="white"/></svg>');
			$('#upload_submit3').addClass('submit_btn');
		};
		reader.readAsDataURL(files[i]);
	}
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
