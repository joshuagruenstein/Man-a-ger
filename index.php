<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="">
	<meta name="author" content="">
	<!-- <link rel="shortcut icon" href="img/favicon.ico" /> -->

	<title>Kitchen Manager</title>

	<link href="lib/bootstrap.min.css" rel="stylesheet">

	<link href="css/general.css" rel="stylesheet">
</head>

<body>
	<div class="container">
		<div class="pageContent">
			<div class="row">
				<div class="col-sm-7" id="inventoryColumn">
					<ul class="list-group" id="inFridgeList">
					</ul>

					<div class="row">
						<div class="col-sm-2">
							<div class="dropdown" id="itemDropdown">
						  		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    		Items
						    		<span class="caret"></span>
						  		</button>
						  		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1"id="dropdownMenu">
								</ul>
							</div>
						</div>
						<div class="col-sm-10">
							<div class="input-group" id="quantityInput">
								<span class="input-group-addon" id="basic-addon2">Quantity</span>
								<input type="text" class="form-control" placeholder="3" aria-describedby="basic-addon2">
								<span class="input-group-btn">
							    	<button class="btn btn-default" type="button" id="orderSubmit">Enter</button>
							    </span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5" id="nutritionColumn">
					<div class="panel panel-primary" id="nutritionPanel">
						<div class="panel-heading">
							<h3 class="panel-title">Nutrition</h3>
						</div>

						<table class="table well well-sm" id="nutritionTable">
							<thead>
								<tr>
									<th>Name</th>
									<th>Calories</th>
									<th>Sugar</th>
									<th>Vitamins</th>
								</tr>
							</thead>
							<tbody id="nutritionInfo">
							</tbody>
						</table>

						<div class="text-center" id="chartContainer">
							<canvas id="canvas" width="200%" height="200%"></canvas>
						</div>
					</div>

					<div class="panel panel-primary" id="weeklyPanel">
						<div class="panel-heading">
							<h3 class="panel-title">Weekly Values</h3>
						</div>

						<table class="table well well-sm" id="weeklyTable">
							<thead>
								<tr>
									<th>Name</th>
									<th>Percent</th>
								</tr>
							</thead>
							<tbody id="weeklyInfo">
								<tr>
									<th>Calories</th>
									<th>22</th>
								</tr>
								<tr>
									<th>Sodium</th>
									<th>15</th>
								</tr>
								<tr>
									<th>Vitamin A</th>
									<th>67</th>
								</tr>
							</tbody>
						</table>

						<nav id="weeklyNav">
							<ul class="pager">
						    	<li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li>
						    	<li class="next"><a href="#">Newer <span aria-hidden="true">&rarr;</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include 'includes/footer.php'; ?>

	<script src="lib/jquery.min.js"></script>
	<script src="lib/bootstrap.min.js"></script>
	<script src="lib/Chart.js"></script>
	<script src="js/backend.js"></script>
	<script>
		var response = ""
		$( "#orderSubmit" ).click(function() {
			console.log("hi")
			response = $.ajax({
				url: "https://api.postmates.com/v1/customers/cus_KeswyTmbpCWYLk/delivery_quotes", 
				async: false,
				method: "POST",
				data: { dropoff_address: "799 Park Avenue, New York, NY 10021", pickup_address: "139 West 91st Street, New York, NY 10024" }
			});
			console.log(response);
		});
	</script>
</body>
</html>
