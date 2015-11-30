$(document).ready(function(){

	if(getCartTotal() < 1){
		$("#orderInfo").hide();
		$("#noOrders").show();
		$("#orderForm").hide();
	}
	else{		$("#noOrders").hide();		
		$("#mugQuantity").text(getTotalMugQuantity());
		$("#mugTotal").text("$"+getTotalMugCost()+".00");
		$("#shirtQuantity").text(getTotalShirtQuantity());
		$("#shirtTotal").text("$"+getTotalShirtCost()+".00");
		$("#orderTotal").text("$"+getCartTotal()+".00");
		$("#orderInfo").show();
	}
	
	$("#clearCart").on("click", function(){
		clearCart();
		location.reload();
	});

});