document.addEventListener("DOMContentLoaded", function(event){
	//Document ready
	var btn = document.getElementsByClassName("button");
	function addToCart(){
		var price = this.getAttribute("data-price");
		//Fix current cart
    	var quantity = document.getElementsByClassName("current-quantity");
    	quantity[0].innerHTML = parseInt(quantity[0].innerHTML)+1;
    	var totalPrice = document.getElementsByClassName("total-price");
    	totalPrice[0].innerHTML = parseInt(totalPrice[0].innerHTML)+parseInt(price);    	
	}
	for (var i=0; i<btn.length; i++){
         btn[i].addEventListener("click", addToCart);
    }
});