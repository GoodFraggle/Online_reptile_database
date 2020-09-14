var name_max = 140;

$('#name').keyup(function() {
	var name_length = $('#name').val().length;
	var char_left = name_max - name_length
	
	$('#name_feedback').html('You have ' + char_left + ' characters remaining');
});

var email_max = 140;

$('#email').keyup(function() {
	var email_length = $('#email').val().length;
	var email_char_left = email_max - email_length
	
	$('#email_feedback').html('You have ' + email_char_left + ' characters remaining');
});

var message_max = 1100;

$('#message').keyup(function() {
	var message_length = $('#message').val().length;
	var message_char_left = message_max - message_length
	
	$('#message_feedback').html('You have ' + message_char_left + ' characters remaining');
});