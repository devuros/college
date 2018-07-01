$(document).ready(function()
{
	//SLIDER
	rotate(2);
});
function rotate(current)
{
	var pnumber=$('#slider-images img').length;
	current=current%pnumber;
	$('#slider-images img').eq(current).fadeOut(function()
	{
		$('#slider-images img').each(function(i)
		{
			$(this).css
			(
				'zIndex', ((pnumber-i)+current)%pnumber
			);
		});
		$(this).show();
		setTimeout(function() {rotate(++current);}, 3000);
	});
}