function zmien_title(tresc, id)
{
	document.getElementById(id).innerHTML = "<title>"+tresc+"</title>";
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

function style_change(style)
{
	if(style=="dark")
	{
		var navbar_top = document.getElementById("navbar-top");
		navbar_top.classList.add("navbar-inverse");
		var navbar_bottom = document.getElementById("navbar-bottom");
		navbar_bottom.classList.add("navbar-inverse");
		$(document).ready(function() {
        	$('body').css('background-image', 'url(img/background-dark.png)');
			$('body').css('color', '#FFF');
    	});
		setCookie("style", "dark", 366);
	}
	else
	{
		var navbar_top = document.getElementById("navbar-top");
		navbar_top.classList.remove("navbar-inverse");
		var navbar_bottom = document.getElementById("navbar-bottom");
		navbar_bottom.classList.remove("navbar-inverse");
		$(document).ready(function() {
        	$('body').css('background-image', 'url(img/background-light.png)');
			$('body').css('color', '#000');
    	});
		setCookie("style", "light", 366);
	}
}

function wyloguj(id)
{
	change_login_form(id, "nick", "false", "nologin", "none");	
	del_Cookie("session_id");
	alerts("alert", "Wylogowanie przebiegło pomyślnie", "success");
}


function change_login_form(id, nick, admin1, action, img)
{
	var nologin = "<form class=\"navbar-form\" method=\"post\" action=\"zaloguj\" role=\"login\"><div class=\"form-group\"><input type=\"text\" name=\"login\" placeholder=\"Login\" class=\"form-control\" /> <input type=\"password\" name=\"haslo\" placeholder=\"Haslo\" class=\"form-control\" /></div> <input type=\"submit\" name=\"login_button\" class=\"btn btn-success btn-sm\" value=\"Zaloguj się\" /> <a href=\"zarejestruj\" class=\"btn btn-success btn-sm\" role=\"button\">Zarejestruj się</a></form>";
	
	var login = "<div class=\"navbar-form\"><img src="+img+" style=\"height:30px; width:40px;padding-right: 10px;\" /><div class=\"form-group\"><a href=\"profil\">"+nick+" "+"</a><a href=\"edycja_profilu\" role=\"button\" class=\"btn btn-success btn-sm\">Edycja profilu</a> <button onclick=\"wyloguj('"+id+"')\" class=\"btn btn-success btn-sm\">Wyloguj</button></div></div>";
	
	var admin = "<div class=\"navbar-form\"><div class=\"form-group\"><img src="+img+" style=\"height:30px; width:40px;padding-right: 10px;\" /><a href=\"profil\">"+nick+" "+"</a><a href=\"edycja_profilu\" role=\"button\" class=\"btn btn-success btn-sm\">Edycja profilu</a> <a href=\"#\" role=\"button\" class=\"btn btn-success btn-sm\">Panel</a> <button onclick=\"wyloguj('"+id+"')\" class=\"btn btn-success btn-sm\">Wyloguj</button></div></div>";
	
	if(admin1=="true")
	{
		document.getElementById(id).innerHTML = admin;	
		return true;
	}
	else
	{
		if(action=="login")
		{
			document.getElementById(id).innerHTML = login;	
		}
		else
		{
			document.getElementById(id).innerHTML = nologin;
		}		
	}
}