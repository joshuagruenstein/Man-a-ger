String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};

function getMasses(keys, entries) {
	var masses = {}
	for(var a = 0; a < keys.length; a++) {
		masses[keys[a]] = 0
	}
	for(var a = 0; a < entries.length; a++) {
		var product = getProduct(entries[a].productID)
		var nutrition = JSON.parse(product.nutrition.replace(/\^/g, ''))

		for(var keyIndex in keys) {
			var key = keys[keyIndex]
			if(nutrition.hasOwnProperty(key) && nutrition[key].hasOwnProperty("qty") && nutrition[key]["qty"] != null) {
				console.log(nutrition[key]["qty"])
				if(nutrition[key]["qty"].includes("mg")) masses[key] += parseInt(nutrition[key]["qty"]) / 1000.0
				else masses[key] += parseInt(nutrition[key]["qty"])
			}
		}
	}
	return masses;
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
	var keys = ["Total Fat", "Sodium", "Dietary Fiber", "Protein", "Total carbohydrates"]
	var masses = getMasses(keys, entries)
	console.log(masses)
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
	console.log(currentEntries)
	for(var a in currentEntries) {
		var entry = currentEntries[a]
		console.log(alreadyIn)

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

		$("#inFridgeList").append("<li class='list-group-item'> <span class='label label-default label-pill pull-xs-left'>"+number+"</span> "+getProduct(entry.productID).description+" </li>")
		alreadyIn.push(entry)
	}
})