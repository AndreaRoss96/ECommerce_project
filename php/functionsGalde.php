<?php
	function showTagListGroup($withSpan) {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "progettotweb";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$result = $conn->query('SELECT * from tag');
		
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$str = '<a href="#" id="defaultTagFood" class="py-1 list-group-item list-group-item-action" ' . 'value="' . $row["id"] . '">' . $row["nomeTag"] . '';
				if ($withSpan) {
					$str = str_replace("#", "restaurantList.php?tag=" . $row["id"], $str);
					$result2 = $conn->query('SELECT DISTINCT COUNT(*) AS num FROM tagportata WHERE idTag = ' . $row["id"]);
					$count = $result2->fetch_assoc()['num'];
					$str .= '<span class="badge badge-primary badge-pill">  ' . $count . '  </span>';
				}
				echo $str . '</a>';
			}
		} else {
			echo 'error table database or query.';
		}
	}
	
	/*
	function showTagListGroup() {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "progettotweb";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$result = $conn->query('SELECT * from tag');
		
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$result2 = $conn->query('SELECT DISTINCT COUNT(*) AS num FROM tagportata WHERE idTag = ' . $row["id"]);
				$count = $result2->fetch_assoc()['num'];
				echo '<a href="#" id="defaultTagFood" class="py-1 list-group-item list-group-item-action" ' . 'value="' . $row["id"] . '">' . $row["nomeTag"] . '<span class="badge badge-primary badge-pill">  ' . $count . '  </span></a>';
			}
		} else {
			echo 'error table database or query.';
		}
	}*/
	
	function showRestaurantCard($arraySupplier) {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "progettotweb";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		if(!isset($arraySupplier)) {
			$tot = 0;
		} else {
			$tot = count($arraySupplier);
		}
		if ($tot > 0) {
			$query = 'SELECT * FROM fornitori WHERE P_IVA = "' . $arraySupplier[0] . '"';
			for ($i=1; $i < $tot-1; $i++) {
				$query .= ' AND P_IVA = "' . $arraySupplier[$i] . '"';
			}
			$result = $conn->query($query);
		} else {
			$result = $conn->query('SELECT * from fornitori');
		}
		$i=0;
		while ($row = $result->fetch_assoc()) {
			$str = '<div id="restaurantCard" class="col-sm"> <div class="card" style="width: 18rem;"> <img class="card-img-top" src="../res/1.jpg" alt="Card image cap"> <div class="card-body"> <h5 class="card-title">' . $row["nomeRistorante"] . '</h5> <p class="card-text">' . $row["descrizione"] . '</p> <a href="#" class="btn btn-primary">Visita</a> </div> </div> </div>';
			if ($i % 2 == 0 && $i != 0) {
				$str = '</div> <div class="row"> <div class="col-sm"></div>' . $str;
			}
			echo $str;
			$i++;
		}
		if ($i % 2 != 0) {
			echo '<div class="col-sm"></div>';
		} else {
			echo '</div>';
		}
	}
	function showFoodRowTable($P_IVA) {
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "progettotweb";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$stmt = $conn->prepare('SELECT * from portata WHERE ristP_IVA=?');
		$stmt_tag = $conn->prepare('SELECT nomeTag FROM tagportata JOIN tag ON tag.id = tagportata.idTag WHERE idPortata = ? AND ristP_IVA = ?');
		$stmt->bind_param("s", $P_IVA);
		$stmt->execute();
		$result = $stmt->get_result();
		$i = 1;
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$stmt_tag->bind_param("ss", $row["id"], $row["ristP_IVA"]);
				$stmt_tag->execute();
				$result_tag = $stmt_tag->get_result();
				echo '<tr class="clickable-row">' . '<br/>';
				echo '<th scope="row">' . $i++ . '</th>';
				echo '<td>' . $row['nome'] . '</td>';
				echo '<td>' . $row['descrizione'] . '</td>';
				echo '<td>';
				while ($rowTags = $result_tag->fetch_assoc()) {
					echo $rowTags["nomeTag"] . ";";
				}
				echo '</td>';
				echo '<td>' . $row['prezzo'] . '</td>';
				echo '</tr>';
			}
		} else {
			echo 'error table database or query.';
		}
	}
	
	function filterRestaurantByTag($tag) {
		if (!isset($tag)) {
			return;
		}
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "progettotweb";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$aResult = array();
		$result = $conn->query('SELECT ristP_IVA from tagportata WHERE idTag = ' . $tag);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
					array_push($aResult, $row['ristP_IVA']);
				}
			return $aResult;
		} else {
			echo 'error table database or query.';
		}
	}
?>