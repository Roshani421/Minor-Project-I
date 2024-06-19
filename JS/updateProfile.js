const form = document.getElementById("signUpForm");
const passwordForm = document.getElementById("passwordForm");

const firstName = document.getElementById("firstName");
const lastName = document.getElementById("lastName");
const email = document.getElementById("email");
const password = document.getElementById("password");

const newPassword = document.getElementById("newPassword");
const confirmPassword = document.getElementById("confirmPassword");
const oldPassword = document.getElementById("oldPassword");

form.addEventListener('submit',(e) => {
	if(!validateInput()){
		e.preventDefault();
	}
	validateInput();
});
passwordForm.addEventListener('submit',(e) => {
	if(!validatePassword()){
		e.preventDefault();
	}
	validatePassword();
});

function validatePassword(){
	const newPasswordValue = newPassword.value.trim();
	const confirmPasswordValue = confirmPassword.value.trim();
	const oldPasswordValue = oldPassword.value.trim();

	let valid = true;

	if(newPasswordValue === ""){
		setErrorFor(newPassword,"*Password Field cannot be blank");
		valid = false;
	}else{
		removeError(newPassword);
	}

	if(confirmPasswordValue === ""){
		setErrorFor(confirmPassword,"*Password Field cannot be blank");
		valid = false;
	}else if(!matchPassword(newPasswordValue,confirmPasswordValue)){
		setErrorFor(newPassword,"*Passwords do not match");
		setErrorFor(confirmPassword,"*Passwords do not match");
		valid = false;
	}else{
		removeError(confirmPassword);
	}

	if(oldPasswordValue === ""){
		setErrorFor(oldPassword,"*Password Field cannot be blank");
		valid = false;
	}else{
		removeError(oldPassword);
	}
	return valid;
}

function validateInput(){
	const firstNameValue = firstName.value.trim();
	const lastNameValue = lastName.value.trim();
	const emailValue = email.value.trim();
	const passwordValue = password.value.trim();

	let valid = true;

	if(firstNameValue === ""){
		setErrorFor(firstName,"*First Name Field cannot be blank");
		valid = false;
	}else if(isName(firstNameValue)){
		setErrorFor(firstName,"*Name cannot contain number");
		valid = false;
	}else{
		removeError(firstName);
	}

	if(lastNameValue === ""){
		setErrorFor(lastName,"*Last Name Field cannot be blank");
		valid = false;
	}else if(isName(lastNameValue)){
		setErrorFor(lastName,"*Name cannot contain number");
		valid = false;
	}else{
		removeError(lastName);
	}
	
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
	return valid;
}
function setErrorFor(element,message){
	const formElement = element.parentElement;
	const small = formElement.querySelector('small');

	formElement.className = "form-element update-error";
	small.innerText = message;
}
function removeError(element){
	const formElement = element.parentElement;
	formElement.className = "form-element";
}
function matchPassword(password,password2){
	return password == password2;
}
function isName(name) {
	return /\d/.test(name);
}
function isEmail(email){
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}
