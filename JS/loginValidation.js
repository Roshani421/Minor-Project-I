const form = document.getElementById("login-id");
const email = document.getElementById("email");
const password = document.getElementById("password")
const eye = document.getElementById("eye");


form.addEventListener('submit',(e) => {
	if(!validateInput()){
		e.preventDefault();
	}
	validateInput();
}) 

eye.addEventListener('click',(b) => {
	b.preventDefault();

	showPassword();
})


function validateInput(){
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();
	
	var valid = true;

	if(emailValue === ""){
		setErrorFor(email,"*Email Field cannot be blank");
		valid = false;
	}else if(!isEmail(emailValue)){
		setErrorFor(email,"*Email Format is Invalid");
		valid = false;
	}else {
		removeError(email);
	}

	if(passwordValue == ""){
		setErrorFor(password,"*Password Field cannot be blank");
		valid = false;
	}else{
		removeError(password);
	}
	return valid;
}
function setErrorFor(element,message){
	const input = element.parentElement;
	const small = input.querySelector('small');

	input.className = "input error";
	small.innerText = message;
}
function removeError(element){
	const input = element.parentElement;
	input.className = "input";
}
function isEmail(email){
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
	
}
//toggle show-password button
var passwordState = "password";
function showPassword(){
	if(passwordState == "password"){
		password.setAttribute("type","text");
		passwordState = "text";
	}else if(passwordState == "text"){
		password.setAttribute("type","password");
		passwordState = "password";
	}
}