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
					<div class="jumbotron" id="titleJumbotron">
						<h2>Man(a)ger</h2>
						<p>Man(a)ger is a tool developed to help people with their daily lives.</p>
					</div>
					<ul class="list-group" id="inFridgeList">
					</ul>

					<div class="panel panel-primary" id="orderColumn">
						<div class="panel-heading">
							<h3 class="panel-title">Order More</h3>
						</div>
						<div class="row" id="orderRow">
							<div class="col-sm-2">
								<div class="dropdown" id="itemDropdown">
							  		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    		Items
							    		<span class="caret"></span>
							  		</button>
							  		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="dropdownMenu">
									</ul>
								</div>
							</div>
							<div class="col-sm-10">
								<div class="input-group" id="quantityInput">
									<span class="input-group-addon" id="basic-addon2">Item</span>
									<input type="text" class="form-control" placeholder="Quantity" id="orderQuantity" aria-describedby="basic-addon2">
									<span class="input-group-btn">
								    	<button class="btn btn-default" type="button" id="orderSubmit">Order</button>
								    </span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5" id="nutritionColumn">
					<div class="panel panel-primary" id="nutritionPanel">
						<div class="panel-heading">
							<h3 class="panel-title">Intake nutrition by mass</h3>
						</div>

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
							</tbody>
						</table>
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
	<script src="js/index.js"></script>
</body>
</html>
