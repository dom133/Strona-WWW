pace.start();

function avatar(url, nick)
{
	document.getElementById("avatar").innerHTML = "<img title="+nick+" src="+url+" />";	
}
	
function info_profil(nick, steamid, email, czas_gry, auth)
{
	if(email=="")email="Brak";
	if(czas_gry=="sec")czas_gry="0sec";
	if(steamid=="NULL")
	{
		if(auth=="tak")
		{
			document.getElementById("info_profil").innerHTML = "<p>Nick: "+nick+"</p><p>Email: "+email+"</p><p>Czas gry: "+czas_gry+"</p><p>Steamid: <a href=\"index.php?strona=steam&auth\"><img src=\"http://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_small.png\" title=\"Steam\" /></a></p><a href=\"index.php?strona=avatar\" class=\"button\" style=\"font-size:14px; padding-left:10px; padding-right:10px; padding-top:2px; padding-bottom:2px;\">Wrzuć avatar</a>";	
		}
		else
		{
			document.getElementById("info_profil").innerHTML = "<p>Nick: "+nick+"</p><p>Email: "+email+"</p><p>Czas gry: "+czas_gry+"</p><p>Steamid: <img src=\"http://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_small.png\" title=\"Steam\" /></p>";	
		}
	}
	else
	{
		if(auth=="tak")
		{
			document.getElementById("info_profil").innerHTML = "<p>Nick: "+nick+"</p><p>Email: "+email+"</p><p>Czas gry: "+czas_gry+"</p><p>Steamid: "+steamid+"</p><a href=\"index.php?strona=avatar\" class=\"button\" style=\"font-size:14px; padding-left:10px; padding-right:10px; padding-top:2px; padding-bottom:2px;\">Wrzuć avatar</a>";	
		}
		else
		{
			document.getElementById("info_profil").innerHTML = "<p>Nick: "+nick+"</p><p>Email: "+email+"</p><p>Czas gry: "+czas_gry+"</p><p>Steamid: Niewidoczny</p>";	
		}	
	}
}
	
function userbody(nick)
{
	document.getElementById("user-body").innerHTML = "<img src=\"https://mcapi.ca/skin/2d/"+nick+"\" title=\""+nick+"\" />";
}

function zmien_title(tresc, id)
{
	document.getElementById(id).innerHTML = "<title>"+tresc+"</title>";
}

function info_edycja(nick, email, akt, p_strona, id)
{
	var info_adm = "";
	var info_email = ""; 
	var info = ""; 
	
	if(p_strona!="" | p_strona=="tak")
	{
		document.getElementById(id).innerHTML = info_adm;
	}
	else
	{
		if(akt=="tak")
		{
			document.getElementById(id).innerHTML = info_akt;
		}
		else if(email=="" | email=="your@email.com")
		{
			document.getElementById(id).innerHTML = info_email;	
		}
		else
		{
			document.getElementById(id).innerHTML = info;	
		}
	}
}

function skroc_news(pole,id)
{
	$(pole).each(function(){
			var tekst = $(this).text().substring(0,10);
			$(this).text(tekst + '...');
	});
}