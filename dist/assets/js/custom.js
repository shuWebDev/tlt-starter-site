/* custom jQuery functions for scoring sections */
$(document).ready(function(){


	// whatever we need to do, do it here.
	// terms and conditions form
	$('#accept').click(function(){
		if ( $("#accept").prop('checked') )  {
		    	//alert('complete');
		    	$('#verification').removeAttr('disabled');
		    	$('#verification').removeClass('btn-primary');
		    	$('#verification').addClass('btn-success');
		    	$('#verification').text('Continue');
		    }
		else {
		    	//alert('incomplete');
		    	$('#verification').removeClass('btn-success');
		    	$('#verification').addClass('btn-primary');
		    	$('#verification').text('Please Check The Box');
		    	$('#verification').attr('disabled',true);
		    }    
	});

	$('#verification').click(function(){
		//todo: ajax call to record response
		//pick up PHP authentication variables, not form elements
		json=true;
		var myForm = location.pathname.split('/').slice(-1)[0]  ;
		$.ajax({
			url: "/projects/laptops/students/ajaxy/confirm.php",
			data: { form: myForm },
			success: function(data) {
				if ( data.response === 'success' ) {
					$('#resultMessage').html('<h4>Thank you for your submission</h4>');
					$('#verification').text('Complete');
		    		$('#verification').removeClass('btn-primary');
		    		$('#verification').addClass('btn-success');	
		    		$('#verification').attr('disabled',true);
		    		$('#accept').attr('disabled',true);
				}
				else {
					$('#resultMessage').html('<h4>' + data.errors + '</h4>');
				}
			},
			error: function(xhr, status, error) {
				$('#resultMessage').html("<h4>An AJAX error occured: " + status + "\nError: " + error + '</h4>');
			}
		})
	});	

	// end terms and conditions etc.

	// parental permission
	$('#permissionForm input').change(function(){
		if ( $("#parentName").val().length>0 && $('#sigDate').val().length>0 && $('#studentName').val().length>0 ) {
				//alert('complete');
		    	$('#permissionGranted').removeAttr('disabled');
		    	$('#permissionGranted').removeClass('btn-primary');
		    	$('#permissionGranted').addClass('btn-success');
		    	$('#permissionGranted').text('Continue');
		    }
		else {
		    	//alert('incomplete');
		    	$('#permissionGranted').removeClass('btn-success');
		    	$('#permissionGranted').addClass('btn-primary');
		    	$('#permissionGranted').text('Please Complete Above');
		    	$('#permissionGranted').attr('disabled',true);
		    }    
		
		
	});

	$('#permissionGranted').click(function(){
		//todo: ajax call to record response
		json = true;
		var myForm = location.pathname.split('/').slice(-1)[0]  ;
		$.ajax({
			url: "/projects/laptops/students/ajaxy/confirm.php",
			data: { form: myForm, parentSignature: $("#parentName").val() },
			success: function(data) {
				if ( data.response === 'success' ) {
					$('#resultMessage').html('<h4>Thank you for your submission</h4>');
					$('#permissionGranted').text('Complete');
		    		$('#permissionGranted').removeClass('btn-primary');
		    		$('#permissionGranted').addClass('btn-success');	
		    		$('#permissionGranted').attr('disabled',true);
				}
				else {
					$('#resultMessage').html('<h4>' + data.errors + '</h4>');
				}
			},
			error: function(xhr, status, error) {
				$('#resultMessage').html("<h4>An AJAX error occured: " + status + "\nError: " + error + '</h4>');
			}
		})
	});	

	//This handles the laptop selection form
	$('form#selectorForm').submit(function() { 
	//alert('clicked');
	json = true;
	var formdata = $('form#selectorForm').serialize();
	$.ajax({
			   	type: "POST",
				url: "/projects/laptops/students/ajaxy/recordSelection.php",
				data: formdata,
				success: function(data) { 
					//alert('data is ' + data);
					var reply = JSON.parse(JSON.stringify(data));
					//alert('reply is ') + reply;
					if ( reply.success=='success' ) {
						//alert('success: ' + data);
						//alert( $('#makeSelection').text() + ' changes' );
						$('#makeSelection').text('Thank you for making your selection');
						$('#makeSelection').removeClass('btn-primary');
						$('#makeSelection').addClass('btn-success');
						$('#makeSelection').attr('disabled','disabled');
						}
					else {
						var reply = JSON.parse(data);
						var message = "Uh-oh, something went wrong. " +  reply.errors + ". Try again?";
						alert('fail: ' + reply.errors);
					}
				},
				error: function(data) { 
					alert('failure: ' + JSON.parse(data));
				}
			   });
	return false;
});

});	


