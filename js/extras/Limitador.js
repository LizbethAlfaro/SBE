$(document).ready(function() {  
    $('#declaracion').inputlimiter({
	limit: 500,
	limitBy: 'words',
	remText: 'Quedan %n palabra%s...',
	limitText: 'de %n .'
});
});
