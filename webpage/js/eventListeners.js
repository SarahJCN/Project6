// Event listeners WITH PARAMETERS using ANONYMOUS FUNCTION
var elUsername = document.getElementById('username');						
var elMsg = document.getElementById('feedback'); 

function checkUsername(minLength) {
	if (elUsername.value.length < minLength) {
		elMsg.innerHTML = '<p>Username must be ' + minLength + ' characters or more</p>';
	} else {
		elMsg.innerHTML = '';  // Clear any error message
	}
}

elUsername.addEventListener('blur', function() {checkUsername(5)}, false);  // Anonymous function