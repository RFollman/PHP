// JavaScript Document
// demo scripts for client-side validation
// Author: Rebecca Follman
// Date: 06/16/18

$(document).ready(function() {
	//define form elements

	//trim input, test length

});

	var f_name = ['25', 'First name must be 25 characters or less.'];
	var l_name = ['35', 'Last name must be 35 characters or less.'];
	var address1 = ['100', 'Address lines must be 100 characters or less.'];

	function validText(text, name) {	
		console.log(window[name][1]);
	};
