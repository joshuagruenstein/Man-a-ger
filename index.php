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

	<!-- <link href="style/general.css" rel="stylesheet"> -->
</head>

<body>
	<div class="container">
		<div class="pageContent">
			<div class="row">
				<div class="col-sm-8">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Products</h3>
						</div>
						<table class="table well well-sm" id="leaderTable">
							<thead>
								<tr>
									<th>Name of Product</th>
								</tr>
							</thead>
							<tbody id="products">
								<tr>
									<th>Apples</th>
									<th>Milk</th>
									<th>Oranges</th>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
		</div>
	</div>

	<?php include 'includes/footer.php'; ?>

	<script src="lib/jquery.min.js"></script>
	<script src="lib/bootstrap.min.js"></script>
</body>
</html>
