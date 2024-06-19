var filterDropdown = document.getElementById('filterDropdown');
var filterOption = document.querySelectorAll('.filter-option')[0];
var filterOptionElement = document.querySelectorAll('.filter-option-element');
var filterSubmit = document.getElementById('filterSubmit');
window.addEventListener('load',() =>{
	while(filterOption.hasChildNodes()) {
		filterOption.removeChild(filterOption.firstChild);
	}
	filterOption.appendChild(filterOptionElement[0]);
});

filterDropdown.addEventListener('change',() => {
	while(filterOption.hasChildNodes()) {
		filterOption.removeChild(filterOption.firstChild);
	}
		filterOption.appendChild(filterOptionElement[filterDropdown.selectedIndex]); //selectedIndex returns index of selected option
	});

filterSubmit.addEventListener('click', () => {
	let value = filterDropdown.value;
	if(value == 'day') {
		let filterDate = document.getElementById('filterDate').value;
		document.cookie = "select="+value+";";
		document.cookie = "filterDate="+filterDate+";";
	} else if(value == 'month') {
		let filterMonth = document.getElementById('filterMonth').value;
		document.cookie = "select="+value+";";
		document.cookie = "filterMonth="+filterMonth+";";

	} else if(value == 'year') {
		let filterYear = document.getElementById('filterYear').value;
		document.cookie = "select="+value+";";
		document.cookie = "filterYear="+filterYear+";";

	} else if(value == 'custom') {
		let filterFromDate = document.getElementById('filterFromDate').value;
		let filterToDate = document.getElementById('filterToDate').value;
		document.cookie = "select="+value+";";
		document.cookie = "filterFromDate="+filterFromDate+";";
		document.cookie = "filterToDate="+filterToDate+";";

	}
});