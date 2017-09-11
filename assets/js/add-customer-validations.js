$(document).ready(function(){
	
	$( "#dob" ).datepicker({ dateFormat: 'yy-mm-dd', changeMonth: true, changeYear: true});
	
	$("#customer_name").focus();
	 jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z ]+$/i.test(value);
}, "Enter letters only please"); 
				   

	var validator = $("#save_customer_info").validate({
		errorElement: 'div',
		rules: {
			customer_name:{
					required:true,
					minlength: 2,
					maxlength: 100,
					lettersonly: true,
				},
			email:{
					required: true,
					email: true,
				},
			address:{
					required:true,
				},
			zip:{
					required:true,
					minlength: 4,
					maxlength: 10,
				},
			telephone:{
					required:true,
					maxlength: 15,
				},
			dob:{
					required:true,
				},
		},
		messages: {
			customer_name:{
					required:"Please enter customer name.",
				},
			email:{
					required: "Please enter email id.",
					email: "Please enter valid email address.",
				},
			address:{
					required: "Please enter address.",
				},
			zip:{
					required: "Please enter zip code.",
				},
			telephone:{
					required: "Please enter telephone number.",
				},
			dob:{
					required: "Please select birthdate.",
				}
		},
		errorPlacement: function(error, element) {
			error.appendTo( element.parent() );
		}		
	});
	
	
});

