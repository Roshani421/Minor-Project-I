var slider = document.getElementById('slideBar');
var leftContainer = document.getElementsByClassName('body-left-container')[0];

slider.addEventListener('mousedown',() => {
	leftContainer.classList.toggle('width-zero');
});