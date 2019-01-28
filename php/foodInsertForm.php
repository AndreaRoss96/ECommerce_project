<?php
	include('../script/functions.php');
	include('../php/functionsGalde.php');
	secure_session_start();
	if ($_SESSION['type'] !== SUPPLIER) {
		header('location: restaurantList.php');
	}
?>
<!DOCTYPE html>
<html lang="it-IT">
  <head>
    <title>Gestione pietanze</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/navbar.css">
	<link rel="stylesheet" href="../css/listgroup.css">
	<link rel="stylesheet" href="../css/colors.css">
	<!--<link rel="stylesheet" href="../css/table.css">-->
  </head>
  <body>
  <div id="nav"></div>
  <?php if(isset($_SESSION['testoAlert'])){ ?>
 	 <div class="alert alert-success alert-dismissible" role="alert"><?php echo $_SESSION['testoAlert']; unset($_SESSION['testoAlert']); ?> </div>
  <?php } ?>
	<p class="text-center h1">Inserisci le tue pietanze</p>
	<p class="text-center h2">Compila i seguenti campi</p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm">
					<form action="../php/foodManager.php" method="post" class="border border-light p-5">
						<div class="row">
							<div class="col col-xs-4">  
								<label for="defaultFoodName">Nome pietanza</label>
								<input type="text" name="nomePietanza" id="defaultFoodName" class="form-control mb-4" placeholder="Bucatini all'amatriciana" required>
								<input type="text" name="nomePietanzaVecchio" id="defaultFoodOldName" class="form-control mb-4" hidden>
							</div>
						</div>
						<div class="row">
							<div class="col col-xs-4">
								<div class="form-group">
									<label for="defaultIngredientsFood">Ingredienti:</label>
									<textarea name="ingredienti" class="form-control" rows="3" id="defaultIngredientsFood" required></textarea>
								</div>
							</div>
						</div>
						<!--
						<div class="row">
							<div class="col col-xs-4">
								<input type="text" name="nomeIngrediente" id="defaultIngredientFood" class="form-control mb-4" placeholder="singolo ingrediente">
							</div>
							<div class="col-sm">
									<button type="button" id="btnInsertIngredient" class="btn btn-success">+</button>
							</div>
						</div>
						-->
						<div class="row">
							<div id="list-group-tags" class="col col-xs-4">
								<label for="defaultTagFood">Tag: </label>
								<div class="list-group mb-4">
								<?php
									showTagListGroup(false);
								?>
								</div>
								<input type="text" name="tags" id="tagsFood" class="form-control mb-4" hidden>
							</div>
						</div>
						<div class="row">
							<div class="col col-xs-4">
								<label for="defaultPriceFood">Prezzo</label> 
								<input type="number" name="prezzo" id="defaultPriceFood" class="form-control mb-4" required>
						</div>
					</div>
					<input type="number" name="P_IVA" id="defaultRegisterFormPIVA" class="form-control mb-4" value=<?php echo $_SESSION['P_IVA'];?> hidden>
					<div class="row">
							<div class="col col-xs-4">
								<button class="btn btn-info my-4 btn-block bg-success" name="aggiungi" type="submit">
									<i class="fa fa-plus-circle" > Aggiungi</i> 
								</button>
							</div>
							<div class="col col-xs-4">
								<button class="btn btn-info my-4 btn-block" name="modifica" type="submit">
									<i class="fa fa-pencil-square" > Modifica</i> 
								</button>
							</div>
							<div class="col col-xs-4">
								<button class="btn btn-info my-4 btn-block bg-danger" name="elimina" type="submit">
									<i class="fa fa-trash"> Elimina</i>
								</button>
							</div>
					</div>
				</form>
			</div>
			<div class="col-sm pt-5">
				<table class="table table-responsive table-bordered" id="foodTable">
					<caption>Lista delle pietanze del tuo ristorante.</caption>
					<thead>
						<tr id="headerRow">
						<th scope="col-sm">#</th>
						<th scope="col-sm">Nome portata</th>
						<th scope="col-sm">Ingredienti</th>
						<th scope="col-sm">Tag</th>
						<th scope="col-sm">Prezzo</th>
						</tr>
					</thead>
					<tbody>
						<?php
								showFoodRowTable($_SESSION['P_IVA']);
						?>
					</tbody>
				</table>
			</div>
		</div>
    </div>
    <div id="footer"></div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
	 <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>

	<script>
		  $(document).ready(function(){
			$(".alert").fadeOut(2000);
		  });
	</script>
	<script src="../script/listgroup.js"></script>
    <script src="../html/jquery/getNav.js"></script>
	<script src="../script/table.js"></script>
	
  </body>
</html>
