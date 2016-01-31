String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

function getProductWithID(products, productID) {
	for(var a in products) {
		if(products[a].productID === productID) return products[a]
	}
}

function getMasses(keys, entries, products) {
	var masses = {}
	for(var a = 0; a < keys.length; a++) {
		masses[keys[a]] = 0
	}
	for(var a = 0; a < entries.length; a++) {
		var product = getProductWithID(products, entries[a].productID)
		var nutrition = 0
		try {
			nutrition = JSON.parse(product.nutrition.replace(/\^/g, '').replace(/\\/g, ''))
		} catch(err) {
			continue
		}

		for(var keyIndex in keys) {
			var key = keys[keyIndex]
			if(nutrition.hasOwnProperty(key) && nutrition[key].hasOwnProperty("qty") && nutrition[key]["qty"] != null) {
				if(nutrition[key]["qty"].indexOf("mg") > -1) masses[key] += parseInt(nutrition[key]["qty"]) / 1000.0
				else masses[key] += parseInt(nutrition[key]["qty"])
			}
		}
	}
	return masses;
}

function getEntriesOfThisWeek(entries) {
	var returnArray = Array()
	for(var a in entries) {
		console.log(new Date().getTime())
		console.log(new Date(entries[a].checkedIn.split(" ")[0]).getTime() - new Date().getTime())
		if(Math.abs(new Date(entries[a].checkedIn.split(" ")[0]).getTime() - new Date().getTime()) < 604800000) returnArray.push(entries[a])
	}
	return returnArray
}

function getCurrentEntries(entries) {
	var returnArray = Array()
	for(var a = 0; a < entries.length; a++) {
		if(entries[a].checkedOut == null) returnArray.push(entries[a])
	}
	return returnArray;
}

$(document).ready(function() {
	var entries = getEntries()
	var products = getProducts()

	var keys = ["Total Fat", "Sodium", "Dietary Fiber", "Protein", "Total carbohydrates"]
	var masses = getMasses(keys, entries, products)
	var total = 0
	for(var a = 0; a < keys.length; a++) {
		total += masses[keys[a]]
	}
	var colors = ["#F7464A", "#5AD3D1", "#FDB45C", "#949FB1", "#4D5360", "#5AD3D1"]
	var highlights = ["#FF5A5E", "#5AD3D1", "#A8B3C5", "#A8B3C5", "#616774", "#5AD3D1"]
	var pieData = Array()
	for(var a = 0; a < keys.length; a++) {
		pieData.push({
			value: Math.round((masses[keys[a]]/total)*100),
			color: colors[a],
			highlight: highlights[a],
			label: keys[a]
		})
	}

	var ctx = document.getElementById("canvas").getContext("2d");
	window.myPie = new Chart(ctx).Pie(pieData);

	var currentEntries = getCurrentEntries(entries)
	var alreadyIn = Array()
	for(var a in currentEntries) {
		var entry = currentEntries[a]

		// Is in
		var isAlreadyIn = false
		for(var b in alreadyIn) {
			if(alreadyIn[b].productID === entry.productID) {
				isAlreadyIn = true
				break
			}
		}
		if(isAlreadyIn) continue;

		var number = 1;
		for(var b in currentEntries) {
			if(a != b && currentEntries[b].productID === entry.productID) number++
		}

		var product = getProductWithID(products, entry.productID)
		$("#inFridgeList").append("<li class='list-group-item'> <span class='label label-default label-pill pull-xs-left'>"+number+"</span> "+product.description+" </li>")
		$("#dropdownMenu").append("<li><a href='#'>"+product.description+"</a></li>")
		alreadyIn.push(entry)
	}

	var weekEntries = getEntriesOfThisWeek(entries)
	var weekMasses = getMasses(keys, weekEntries, products)
	var dailyValues = [65*7, 2.4*7, 25*7, 50*7, 300*7]
	console.log(weekMasses)
	for(var a in keys) {
		$("#weeklyInfo").append("<tr><th>"+keys[a]+"</th><th>"+Math.round(weekMasses[keys[a]] * 100/ dailyValues[a])+"%</th></tr>")
	}
})