const form = document.getElementById("signUpForm");
const email = document.getElementById("email");
const password = document.getElementById("password");
const password2 = document.getElementById("password2");
const eye = document.getElementById("eye");
const eye2 = document.getElementById("eye2");


form.addEventListener('submit',(e) => {
	if(!validateInput()){
		e.preventDefault();
	}
	validateInput();
});

eye.addEventListener('click',(b) => {

	showPassword();
});
eye2.addEventListener('click',(b) => {

	showPassword2();
});

function validateInput(){
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();
	const password2Value = password2.value.trim();

	var valid = true;
	
	if(emailValue === ""){
		setErrorFor(email,"*Email Field cannot be blank");
		valid = false;
	}else if(!isEmail(emailValue)){
		setErrorFor(email,"*Email Format is Invalid");
		valid = false;
	}else{
		removeError(email);
	}

	if(passwordValue === ""){
		setErrorFor(password,"*Password Field cannot be blank");
		valid = false;
	}else{
		removeError(password);
	}
	if(password2Value === ""){
		setErrorFor(password2,"*Password Field cannot be blank");
		valid = false;
	}else if(!matchPassword(passwordValue,password2Value)){
		setErrorFor(password,"*Password does not match");
		setErrorFor(password2,"*Password does not match");
		valid = false;
	}else{
		removeError(password2);
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
function matchPassword(password,password2){
	return password == password2;
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
//toggle show-confirm-password button
var passwordState2 = "password";
function showPassword2(){
	if(passwordState2 == "password"){
		password2.setAttribute("type","text");
		passwordState2 = "text";
	}else if(passwordState2 == "text"){
		password2.setAttribute("type","password");
		passwordState2 = "password";
	}
}