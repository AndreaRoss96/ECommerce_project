<?php include('../php/functionsGalde.php'); ?>
<!DOCTYPE html>
<html lang="it-IT">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ristoranti</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/navbar.css">
	<link rel="stylesheet" href="../css/colors.css">
  </head>
  <body>
	<div id="nav"></div>
    <section id="filterFoods">
		<div class="container">
			<h2>Scegli cosa vuoi mangiare e seleziona il ristorante</h2>
			<div class="row">
				<div class="col-sm">
					<div class="list-group">
						<?php
							showTagListGroup(true);
						?>

					</div>
				</div>
				<?php
					if (isset($_GET['tag'])) {
						showRestaurantCard(filterRestaurantByTag($_GET['tag']));
					} else {
						showRestaurantCard(array());
					}

				?>
    </section>
	<div id="footer"></div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="../html/jquery/getNav.js"></script>
    <script src="../html/jquery/getFooter.js"></script>
  </body>
</html>
