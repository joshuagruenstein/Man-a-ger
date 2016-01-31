url = "php/"

function submitOrder(productUPC,quantity) {
	var result = $.ajax({
		url: url+"delivery", 
		async: false,
		method: "GET",
		data: {productUPC: productUPC, quantity: quantity}
	});

	return result.responseJSON;
}

function getEntries() {
	var result = $.ajax({
		url: url+"entry", 
		async: false,
		method: "GET",
		success: function(result) {
			//console.log(result)
		},
		error: function (xhr, ajaxOptions, thrownError) {
			//console.log(xhr.responseText)
		}
	});

	return result.responseJSON;
}

function getProduct(productID) {
	var result = $.ajax({
		url: url+"product", 
		async: false,
		method: "GET",
		data: {productID: productID},
		success: function(result) {
			//console.log(result)
		},
		error: function (xhr, ajaxOptions, thrownError) {
			//console.log(xhr.responseText)
		}
	});

	return result.responseJSON;
}

function getProducts() {
	var result = $.ajax({
		url: url+"product", 
		async: false,
		method: "GET",
		success: function(result) {
			//console.log(result)
		},
		error: function (xhr, ajaxOptions, thrownError) {
			///console.log(xhr.responseText)
		}
	});

	return result.responseJSON;
}