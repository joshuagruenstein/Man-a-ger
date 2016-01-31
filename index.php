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
					<div class="input-group" id="inventoryInput">
						<span class="input-group-addon" id="basic-addon2">Food</span>
						<input type="text" class="form-control" placeholder="Yogurt" aria-describedby="basic-addon2">
						<span class="input-group-btn">
					    	<button class="btn btn-default" type="button">Enter</button>
					    </span>
					</div>
					<ul class="list-group">
						<li class="list-group-item">
							<span class="label label-default label-pill pull-xs-left">9</span>
					    	Apple
					    	<div class="pull-right"><span class="glyphicon glyphicon-remove"></span></div>
					  	</li>
					  	<li class="list-group-item">
					    	<span class="label label-default label-pill pull-xs-left">2</span>
					    	Orange
					    	<div class="pull-right"><span class="glyphicon glyphicon-remove"></span></div>
					  	</li>
					  	<li class="list-group-item">
					    	<span class="label label-default label-pill pull-xs-left">1</span>
					    	Milk
					    	<div class="pull-right"><span class="glyphicon glyphicon-remove"></span></div>
					  	</li>
					</ul>

					<div class="input-group" id="orderInput">
						<span class="input-group-addon" id="basic-addon2">Order</span>
						<input type="text" class="form-control" placeholder="Yogurt" aria-describedby="basic-addon2">
						<span class="input-group-btn">
					    	<button class="btn btn-default" type="button">Enter</button>
					    </span>
					</div>
					<ul class="list-group">
						<li class="list-group-item">
							<span class="label label-default label-pill pull-xs-left">4</span>
					    	Apple
					    	<div class="pull-right"><span class="glyphicon glyphicon-remove"></span></div>
					  	</li>
					  	<li class="list-group-item">
					    	<span class="label label-default label-pill pull-xs-left">4</span>
					    	Orange
					    	<div class="pull-right"><span class="glyphicon glyphicon-remove"></span></div>
					  	</li>
					  	<li class="list-group-item">
					    	<span class="label label-default label-pill pull-xs-left">4</span>
					    	Milk
					    	<div class="pull-right"><span class="glyphicon glyphicon-remove"></span></div>
					  	</li>
					</ul>
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

					<div class="panel panel-primary" id="dailyPanel">
						<div class="panel-heading">
							<h3 class="panel-title">Daily Values</h3>
						</div>

						<table class="table well well-sm" id="dailyTable">
							<thead>
								<tr>
									<th>Name</th>
									<th>Calories</th>
									<th>Sugar</th>
									<th>Vitamins</th>
								</tr>
							</thead>
							<tbody id="dailyInfo">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include 'includes/footer.php'; ?>

	<script src="js/customCharts.js"></script>
	<script src="lib/jquery.min.js"></script>
	<script src="lib/bootstrap.min.js"></script>
	<script src="lib/Chart.js"></script>
</body>
</html>
