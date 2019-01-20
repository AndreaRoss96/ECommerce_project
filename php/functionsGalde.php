<?php
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
				echo '<a href="#" id="defaultTagFood" class="py-1 list-group-item list-group-item-action" ' . 'value="' . $row["id"] . '">' . $row["nomeTag"] . '</a>';
			}
		} else {
			echo 'error table database or query.';
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
?>