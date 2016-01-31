var pieData = [
		{
			value: 12,
			color:"#F7464A",
			highlight: "#FF5A5E",
			label: "Fats"
		},
		{
			value: 34,
			color: "#46BFBD",
			highlight: "#5AD3D1",
			label: "Protein"
		},
		{
			value: 22,
			color: "#FDB45C",
			highlight: "#FFC870",
			label: "Vegetables"
		},
		{
			value: 15,
			color: "#949FB1",
			highlight: "#A8B3C5",
			label: "Carbs"
		},
		{
			value: 17,
			color: "#4D5360",
			highlight: "#616774",
			label: "Carbs"
		}

	];

	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myPie = new Chart(ctx).Pie(pieData);
	};