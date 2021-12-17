/**
 * Export le tableau au format PDF.
 * @param {array} lines 
 */
function exportToPDF(lines, title) {
	let headElem = document.querySelector("head");
	let theadElem = document.querySelector("thead");
	let tbodyText = "";
	lines.forEach(lineObj => {
		/** @type {HTMLElement} */
		let line = lineObj.row;
		tbodyText += `<tr>${line.innerHTML}</tr>`;
	});
	
	// Création de la fenetre d'export en PDF.
	let win = window.open('', '', 'height=700,width=700');
	win.document.write(`
		<html>
			<head>
				<title>${title}</title>
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
						${tbodyText}
					</tbody>
				</table>
			</body>
		</html>
	`);
	
	win.document.close();

	win.print();
}

/**
 * Export le tableau au format CSV.
 * @param {array} lines 
 */
function exportToCSV(lines, title) {
	// Création du contenu du fichier csv.
	let data = [];

	// Ajout des titres
	let lineArray = [];
	let theadElem = document.querySelector("thead");
	for (let i = 0; i < theadElem.children[0].children.length; i++) {
		const elem = theadElem.children[0].children[i];
		lineArray.push(elem.innerText);
	}
	data.push(lineArray.join(';') + ";");

	// Ajout du contenu
	for (const lineObj of lines) {
		/** @type {HTMLElement} */
		let line = lineObj.row;
		let lineArray = [];
		for (let i = 0; i < line.children.length; i++) {
			const elem = line.children[i];
			let txt = elem.innerHTML.replace(/<button.*<\/button>/gi, "");
			lineArray.push(txt);
		}
		data.push(lineArray.join(';') + ";");
	}
	const content = data.join('\n');
	console.log("Contenu CSV exporté:\n\n"+content);

	// Création d'une nouvelle page
	let csvFile = new Blob([content], {type: "text/csv"});
	aLink = document.createElement("a");

	// Création du lien vers la page
	aLink.href = window.URL.createObjectURL(csvFile);
	aLink.download = `${title}.csv`;
	aLink.style.display = "none";
	document.body.appendChild(aLink);
	aLink.click();
}