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
				</div>
			</div>
		</div>
	</div>

	<?php include 'includes/footer.php'; ?>

	<script src="lib/jquery.min.js"></script>
	<script src="lib/bootstrap.min.js"></script>
</body>
</html>
