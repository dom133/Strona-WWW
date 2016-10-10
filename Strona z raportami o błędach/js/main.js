function add_error(id) {
    document.getElementById(id).classList.add("has-error");
    document.getElementById(id).classList.add("has-feedback");
    var html = document.getElementById(id).innerHTML;
    document.getElementById(id).innerHTML = html+'<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
}

function view(id) {
    window.location.href = "index.php?action=zobacz&id="+id;
}

function show_modal(title, content, type) {
    var title2;
    if(type==0) {title2 = "<b>[BUG]</b>"+title;}
    else {title2 = "<b>[PROPOZYCJA]</b>"+title;}
    document.getElementById("ModalTitle").innerHTML = title2;
    document.getElementById("ModalContent").innerHTML = "<p>"+content+"</p>";
}

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