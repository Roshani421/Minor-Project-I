var leftContainer = document.querySelectorAll('.body-left-container')[0];
function myFunction(x) {
	if (x.matches) { // If media query matches
		leftContainer.classList.add('width-zero');
	} else {
		leftContainer.classList.remove('width-zero');
	}
}

var x = window.matchMedia("(max-width: 1060px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction)
