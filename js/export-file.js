function exportToPDF() {
	//var sTable = document.getElementById('tab').innerHTML;

	// Style
	// var style = "<style>";
	// style = style + "table {width: 100%;font: 17px Calibri;}";
	// style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
	// style = style + "padding: 2px 3px;text-align: center;}";
	// style = style + "</style>";

	let headElem = document.querySelector("head");
	let theadElem = document.querySelector("thead");
	let tbody = document.querySelector("tbody");
	
	// CREATE A WINDOW OBJECT.
	var win = window.open('', '', 'height=700,width=700');
	win.document.write(`
		<html>
			<head>
				<title>TABLEAU DES REMISES</title>
				<link rel="stylesheet" href="css/style.css"/>
			</head>

			<body>
				<table class="table table-striped">
					<thead>
						<tr>
							${theadElem.innerHTML}
						</tr>
					</thead>
					<tbody id="table-result">
						<tr>
							<th scope="row">36262</th>
							<td>2020-11-03</td>
							<td>2020-11-03</td>
							<td>7432 9579 2659 0269</td>
							<td>titulaire décédé</td>
							<td>-10€</td>
						</tr>
						<tr>
							<th scope="row">32023</th>
							<td>2021-11-03</td>
							<td>2021-11-03</td>
							<td>7432 9579 2659 0269</td>
							<td>titulaire décédé</td>
							<td>-99€</td>
						</tr>
						<tr>
							<th scope="row">64145</th>
							<td>2021-08-03</td>
							<td>2021-11-05</td>
							<td>7432 9579 2659 0269</td>
							<td>fraude à la carte</td>
							<td>-1€</td>
						</tr>
					</tbody>
				</table>
			</body>
		</html>
	`);
	
	win.document.close(); // CLOSE THE CURRENT WINDOW.

	win.print(); // PRINT THE CONTENTS.
}

function exportToCSV() {
	
}