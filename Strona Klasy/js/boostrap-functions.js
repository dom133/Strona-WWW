function alerts(id, text, n_alert)
{
	if(n_alert=="success")
	{
		document.getElementById(id).innerHTML = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>"+text+"</div>";	
	}
	else if(n_alert=="info")
	{
		document.getElementById(id).innerHTML =	"<div class=\"alert alert-info alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>"+text+"</div>";
	}
	else if(n_alert=="warning")
	{
		document.getElementById(id).innerHTML =	"<div class=\"alert alert-warning alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>"+text+"</div>";
	}
	else if(n_alert=="danger")
	{
		document.getElementById(id).innerHTML = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>"+text+"</div>";
	}
}