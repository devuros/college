$(document).ready(function()
{
	rotatePics(1);
});
function rotatePics(currentPhoto)
{
	var numberOfPhotos = $('#slide-slike img').length;
	currentPhoto = currentPhoto % numberOfPhotos;
	
	$('#slide-slike img').eq(currentPhoto).fadeOut(function()
	{
		$('#slide-slike img').each(function(i)
		{
			$(this).css
			(
				'zIndex', ((numberOfPhotos - i) + currentPhoto) % numberOfPhotos
			);
		});
		$(this).show();
		setTimeout(function() {rotatePics(++currentPhoto);}, 3000);
	});
}