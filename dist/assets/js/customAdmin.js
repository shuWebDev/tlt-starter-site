/* custom jQuery functions for scoring sections */
$(document).ready(function(){


	// whatever we need to do, do it here.
	// send out reminders
	
	$('#reminders').click(function(){
		//todo: ajax call to record response
		//pick up PHP authentication variables, not form elements	
		$('#reminders').attr('disabled',true);
		$('#reminders').text('Please wait...');
		json=true;
		$.ajax({
			url: "/projects/laptops/admin/reminder.php",
			success: function(data) {
				if ( data.success === 'success' ) {
					if ( 1 == data.updates ) {
						$('#resultMessage').html('<h4>' + data.updates + ' message was sent.</h4><p>When you need to send again, please refresh the page.');
						}
					else {
						$('#resultMessage').html('<h4>' + data.updates + ' messages were sent.</h4><p>When you need to send again, please refresh the page.');
						}	
					$('#reminders').text('Sent');
		    		$('#reminders').removeClass('btn-primary');
		    		$('#reminders').addClass('btn-success');
				}
				else {
					$('#resultMessage').html('<h4>' + data.errors + '</h4>');	
		    		$('#reminders').removeAttr('disabled');
					$('#reminders').text('Retry');
				}
			},
			error: function(xhr, status, error) {
				$('#resultMessage').html("<h4>An AJAX error occured: " + status + "\nError: " + error + '</h4>');	
		    	$('#reminders').removeAttr('disabled');
				$('#reminders').text('Retry');
			}
		})
	});	

	

});	


