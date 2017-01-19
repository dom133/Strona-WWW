function progress(percent, $element) {
    var progressBarWidth = percent * $element.width() / 100;
    $element.find('div').animate({ width: progressBarWidth }, 500)
}

function status_progressBar(iloscgraczy, maksgraczy)
{
	var suma=(iloscgraczy/maksgraczy)*100;
	progress(suma, $('#status-progressBar'));		
}