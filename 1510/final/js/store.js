$(document).ready(function(){
	
	var CONFIRMATION_MESSAGE = "Items have been added to your cart.";
	
	$('#addMugsToCart').on('click', function(){
		
		addItem("0", $('#mugquantity').val());
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
		
		addItem("1", $('#shirtquantity').val());
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