function daysInMonth( /* int */ monthNum, /* int* */ yearNum )
/*
	Author: Matthias Dailey		March 30, 2009

	this code is freely distributable and modifiable as
	long as the author's name is kept unmodified in this header.

	Preconditions:
		monthNum is a whole number representing a month
		yearNum is a whole number representing a yearNum
		for example, monthNum = 1 for January, 12 for December, etc.

	Postconditions:
		returns a number- the last day in the specified month

	Notes:
		if monthNum is unspecified, monthNum is made to be the current month.
		if monthNum or yearNum are invalid values, the value false is returned
		some ideas taken from http://javascript.about.com/library/bllday.htm
*/
{
	// if monthNum or yearNum are not specified, set them to the current month/yearNum
	if( monthNum==undefined && yearNum==undefined )
	{
		now = new Date();
		monthNum = now.getMonth()+1;
		yearNum = now.getFullYear();
	}
	else if( monthNum || yearNum || monthNum=="" || yearNum == "" )
	{
		now = new Date();
		if( monthNum==undefined || monthNum=="" )
			monthNum = now.getMonth()+1;
		if( yearNum==undefined || yearNum=="" )
			yearNum = now.getFullYear();
	}
	// turn 01 into 1
	monthNum = Number(monthNum);
	yearNum = Number(yearNum);

	// check if monthNum and yearNum are numbers and whole numbers and monthNum is between 1 and 12
	if( isNaN(monthNum) || isNaN(yearNum) || monthNum%1!=0 || yearNum%1!=0 || monthNum<1 || monthNum>12 ){
		return false;
	}
	// create date
	var d = new Date(yearNum, monthNum, 0);
	return d.getDate();
}
function submitManuaChosers()
{
	//A = eval(document.frmOne.txtFirstNumber.value);
	days=daysInMonth(document.ManuaChosers.areamonth.value,document.ManuaChosers.areayear.value);
	if(eval(document.ManuaChosers.areaday.value) > days){
		alert('You have set a wrong date\n This month has only '+days);
		document.getElementById("xx").disabled=true;
		return false;
	}
	else document.ManuaChosers.submit();
}

