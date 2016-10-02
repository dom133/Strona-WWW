pace.start();

function kick(nick)
{
	alert(nick+" kick");
	//window.location.replace("index.php?panel=serwer&ps=kick&gracz="+nick);	
}

function ban(nick)
{
	alert(nick+" ban");
	//window.location.replace("index.php?panel=serwer&ps=ban&gracz="+nick);	
}

function msg(nick)
{
	window.location.replace("index.php?panel=serwer&ps=msg&gracz="+nick);	
}

function Rozszerz(obj){
 if (!obj.savesize) obj.savesize=obj.size;
 obj.size=Math.max(obj.savesize,obj.value.length);
}