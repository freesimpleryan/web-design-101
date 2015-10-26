var addItem = function(id, quantity){
	if(!Cookies.get(id)){
		Cookies.set(id, quantity);
	}
	else{
		Cookies.set(id, (parseInt(Cookies.get(id)) + parseInt(quantity)));
	}
};

var removeItem = function(id, quantity){
	if(parseInt(Cookies.get(id)) > parseInt(quantity)){
		Cookies.set(id, (parseInt(Cookies.get(id)) - parseInt(quantity)));
	}
	else{
		Cookies.set(id, 0);
	}	
};

var clearCart = function(){
	Cookies.set("0", "0"); // Mugs = 0
	Cookies.set("1", "0"); // Shirts = 1
};

var getCartTotal = function(){
	var mugs = parseInt(Cookies.get("0"));
	var shirts = parseInt(Cookies.get("1"));
	
	return ((mugs * 10) + (shirts * 15));
};

var purchase = function(){
	// Do purchase stuff here
	clearCart();
};