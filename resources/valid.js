//javascript for sample form Validation

$('#f_name').change(function () {
	var string = $('#f_name').val();
	if (string.length > 25) {
		document.getElementById('#f_nameError').innerHTML = 'Your string is too long';}
})
