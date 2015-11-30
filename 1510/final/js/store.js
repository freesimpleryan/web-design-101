$(document).ready(function(){
	
	var CONFIRMATION_MESSAGE = "Items have been added to your cart.";
	
	$('#addMugsToCart').on('click', function(){
				var mugs = $('#mugquantity').val();		if(!mugs)			mugs = 1;
		addItem("0", mugs);
		$('#mugquantity').val("1");
		
		$('#addMugsToCart').popover({
			trigger: 'focus',
			placement: 'right',
			content: function(){
				return CONFIRMATION_MESSAGE;
			}
		});
		
		$('#addMugsToCart').popover('show');
	});
	
	$('#addShirtsToCart').on('click', function(){
				var shirts = $('#shirtquantity').val();		if(!shirts)			shirts = 1;
		addItem("1", shirts);
		$('#shirtquantity').val("1");
		
		$('#addShirtsToCart').popover({
			trigger: 'focus',
			placement: 'right',
			content: function(){
				return CONFIRMATION_MESSAGE;
			}
		});
		
		$('#addShirtsToCart').popover('show');
	});
	
});