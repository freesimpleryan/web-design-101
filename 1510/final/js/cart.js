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
	return (getTotalMugCost() + getTotalShirtCost());
};

var purchase = function(){
	// Do purchase stuff here
	clearCart();
};

var getTotalMugQuantity = function(){
	var tmp = 0;
	if(Cookies.get("0"))
		tmp = Cookies.get("0");
	return tmp;
	}
var getTotalMugCost = function(){return parseInt(getTotalMugQuantity()) * 10;}

var getTotalShirtQuantity = function(){
	var tmp = 0;
	if(Cookies.get("1"))
		tmp = Cookies.get("1");
	return tmp;
	}
var getTotalShirtCost = function(){return parseInt(getTotalShirtQuantity()) * 15;}