function add_error(id) {
    document.getElementById(id).classList.add("has-error");
    document.getElementById(id).classList.add("has-feedback");
    var html = document.getElementById(id).innerHTML;
    document.getElementById(id).innerHTML = html+'<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
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
    var value = document.getElementById(id).innerHTML;
	if(n_alert=="success")
	{
		value += "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>"+text+"</div>";	
	}
	else if(n_alert=="info")
	{
		value +=	"<div class=\"alert alert-info alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>"+text+"</div>";
	}
	else if(n_alert=="warning")
	{
		value +=	"<div class=\"alert alert-warning alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>"+text+"</div>";
	}
	else if(n_alert=="danger")
	{
		value += "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>"+text+"</div>";
	}
    document.getElementById(id).innerHTML = value;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
	if(exdays!=null)
	{
    	d.setTime(d.getTime() + (exdays*24*60*60*1000));
    	var expires = "expires="+d.toUTCString();
	} else {
		var expires = "expires=0";
	}
    document.cookie = cname + "=" + cvalue + "; " + expires+"; patch=/";
}

function del_Cookie(name) {
    document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function changeValue(name, value){
    document.getElementById(name).value = value;
}