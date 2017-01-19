<?php
$zapytanie_Inquisitor = mysqli_query($conn,"SELECT * FROM `inqplayers`;");

		echo "<p>";
		echo "<table boder=\"1\"><tr>";
		echo "<td><strong>|Gracz|</strong></td>";
		echo "<td><strong>|Ostatni zabity Gracz|</strong></td>";
		echo "<td><strong>|Ilość zabitych Entities|</strong></td>";
		echo "<td><strong>|Zginięcia|</strong></td>";
		echo "</tr>";
					
		while ( $row = mysqli_fetch_row($zapytanie_Inquisitor) ) {
			echo "</tr>";
			echo "<td><b>|" . $row[1] . "|</b></td>";
			echo "<td><b>|" . $row[56] . "|</b></td>";
			echo "<td><b>|" . $row[9] . "|</b></td>";
			echo "<td><b>|" . $row[16] . "|</b></td>";
			echo "</tr>";
		}
		echo "</table>";	
?>