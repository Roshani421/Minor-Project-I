window.addEventListener('load', ()=> {
	var incomeDate = document.getElementById('incomeDate');
	var expenseDate = document.getElementById('expenseDate');
	var dtToday = new Date();

	var url = location.href;
	//extracting current file name
	var urlFilename = url.substring(url.lastIndexOf('/')+1);

	var month = dtToday.getMonth() + 1;
	var day = dtToday.getDate();
	var year = dtToday.getFullYear();

	if(month < 10)
		month = '0' + month.toString();
	if(day < 10)
		day = '0' + day.toString();

	var maxDate = year + '-' + month + '-' + day;
	console.log(urlFilename);
	// console.log(maxDate);
	//current date in date value
	if(urlFilename == 'addIncome.php'){
		incomeDate.valueAsDate = dtToday;
		incomeDate.max = maxDate;
	} else if(urlFilename.includes('updateIncome.php')){
		incomeDate.max = maxDate;
	} else if(urlFilename == 'addExpenses.php') {
		expenseDate.valueAsDate = dtToday;
		expenseDate.max = maxDate;
	} else if(urlFilename.includes('updateExpenses.php')) {
		expenseDate.max = maxDate;
	} else if(urlFilename == 'generateReport.php') {
		var fromDate = document.getElementById('fromDate');
		var toDate = document.getElementById('toDate');
		fromDate.valueAsDate = dtToday;
		toDate.valueAsDate = dtToday;
		fromDate.max = maxDate;
		toDate.max = maxDate;
	}
});
