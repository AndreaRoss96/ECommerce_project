<?php
	include('../php/functionsGalde.php');
?>
<html>
  <head>
    <title>Registrazione fornitore</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/navbar.css">
	<link rel="stylesheet" href="../css/listgroup.css">
	<!--<link rel="stylesheet" href="../css/table.css">-->
  </head>
  <body>
    <div id="nav"></div>
	<p class="text-center h1 mb-4">Inserisci le tue pietanze</p>
	<p class="text-center h2 mb-4">Compila i seguenti campi</p>
	<div class="row">
		<div class="col">
			<div class="container-fluid">
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
						<div class="col">
								<button type="button" id="btnInsertIngredient" class="btn btn-success">+</button>
						</div>
					</div>
					-->
					<div class="row">
						<div id="list-group-tags" class="col col-xs-4">
							<label for="defaultTagFood">Tag: </label>
							<div class="list-group mb-4">
							  <?php
								showTagListGroup();
							  ?>
							</div>
							<input type="text" name="tags" id="tagsFood" class="form-control mb-4">
						</div>
					</div>
					<div class="row">
						<div class="col col-xs-4">
							<label for="defaultPriceFood">Prezzo</label> 
							<input type="number" name="prezzo" id="defaultPriceFood" class="form-control mb-4" required>
					   </div>
				   </div>
				   <input type="number" name="P_IVA" id="defaultRegisterFormPIVA" class="form-control mb-4" value="1234567890" hidden>
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
		</div>
		<div class="col-sm">
			<div class="container">
				<div class="table-responsive">
					<table class="table table-bordered" id="foodTable">
						<caption>Lista delle pietanze del tuo ristorante.</caption>
						<thead>
							<tr id="headerRow">
							  <th scope="col">#</th>
							  <th scope="col">Food Name</th>
							  <th scope="col">Ingredients Food</th>
							  <th scope="col">Tag Food</th>
							  <th scope="col">Price Food</th>
							</tr>
						</thead>
						<tbody>
							<?php
									showFoodRowTable("1234567890");
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
    <div id="footer"></div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>

	<script src="../script/listgroup.js"></script>
    <script src="jquery/getNav.js"></script>
    <script src="jquery/getFooter.js"></script>
	<script src="../script/table.js"></script>
	
  </body>
</html>
