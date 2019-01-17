
$(document).ready(function(){

	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	//$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			required:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			date:{
				required:true,
				date: true
			},
			url:{
				required:true,
				url: true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#number_validate").validate({
		rules:{
			min:{
				required: true,
				min:10
			},
			max:{
				required:true,
				max:24
			},
			number:{
				required:true,
				number:true
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
	$("#password_validate").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required:true,
				minlength:6,
				maxlength:20
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
        
        
        $("#add_category").validate({
		rules:{
			category_name:{
				required: true,
				
			},
			
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
        $("#add_product").validate({
		rules:{
			product_name:{
				required: true,
				
			},
			category_id:{
				required: true,
				
			},
			price:{
				required: true,
                                number: true
				
			},
			buy_now_price:{
				//required: true,
                                number: true
				
			},
			
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
        
        
        //Auction Form Validation Rules
        $("#add_auction").validate({
		rules:{
			smonth:{
				required: true,
				
			},
			sdays:{
				required: true,
				
			},
			syear:{
				required: true,
				
			},
			shours:{
				required: true,
				
			},
			smin:{
				required: true,
				
			},
			ssec:{
				required: true,
				
			},
			emonth:{
				required: true,
				
			},
			edays:{
				required: true,
				
			},
			eyear:{
				required: true,
				
			},
			ehours:{
				required: true,
				
			},
			emin:{
				required: true,
				
			},
			esec:{
				required: true,
				
			},
			
			price_inc:{
//				required: true,
				number: true
			},
			time_inc:{
//				required: true,
                                number: true
				
			},
			min_real_bids:{
//				required: true,
                                number: true
				
			},
			autobid_limit:{
//				required: true,
                                number: true
				
			},
			
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
});


