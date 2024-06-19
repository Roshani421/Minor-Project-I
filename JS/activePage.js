window.addEventListener('load',()=>{
		//getting current file location
		var url = location.href;
		//extracting current file name
		var urlFilename = url.substring(url.lastIndexOf('/')+1);
		console.log(urlFilename);
		
		if(urlFilename == 'filterIncome.php') {
			document.querySelectorAll(`a[href="manageIncome.php"]`)[0].classList.add('active');
		} else if(urlFilename == 'filterExpense.php') {
			document.querySelectorAll(`a[href="manageExpenses.php"]`)[0].classList.add('active');
		} else {
			var activePage = document.querySelectorAll(`a[href="${urlFilename}"]`);
			activePage[0].classList.add('active');
		}
		
	});