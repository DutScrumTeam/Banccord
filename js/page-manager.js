/**
 * Ce script récupère tous les résultat de la page
 * stocke les résultat et n'affiche qu'une portion de résultat.
 * 
 * Gère aussi l'affichage des détails des pages.
 */

/** Nombre de ligne par page. */
const linePerPage = 10;
/** Id de la table de résultat. */
const idResults = "table-result";
/** Id de la zone d'affichage du nombre de résultat. */
const idResultCount = "result-count";
/** Nom de classe spécifique aux lignes "plus d'infos". */
const classTableRowMore = "table-row-more";
/** Nom de la classe permettant de cacher une ligne. */
const classHideRow = "table-row-hidden";

/**
 * Toutes les lignes, y compris celles non-affichées.
 * @type {RowData[]}
 */
var lines = [];
/** 
 * Toutes les lignes, accessible par leur index.
 * @type {Map<string, RowData>}
 */
var linesMap = new Map();
/** Numéro de la page actuel -1. */
var currentPage = 0;
/**
 * L'élément affichant actuellement plus d'infos sur une ligne.
 * @type {HTMLElement}
 */
var openedMoreContent = null;

var orderNum = null;
var orderReverse = false;

/**
 * Permet de stocker les données d'une ligne
 * @param {Element} row 
 */
class RowData {
	/** @type {RowData} */
	static lastShowed = null;

	/** @type {Element} */
	row;
	/** @type {Element} */
	rowDetails = null;
	
	constructor(row) {
		this.row = row;
	}

	/** true si les détails sont déjà montrés. */
	isDetailsHidden() {
		return this.rowDetails !== null && this.rowDetails.classList.contains(classHideRow);
	}

	/** Cache les détails de la ligne. */
	hideDetails() {
		if (this.rowDetails === null) throw new ReferenceError("Impossible de cacher des détails qui n'existent pas.");

		if (RowData.lastShowed === this) RowData.lastShowed = null;

		if (!this.rowDetails.classList.contains(classHideRow)) {
			// Cache les détails
			this.rowDetails.classList.add(classHideRow);
		}
	}

	/** Affiche les détails de la ligne. */
	showDetails() {
		if (this.rowDetails === null) throw new ReferenceError("Impossible d'afficher des détails qui n'existent pas.");

		// Cache les détails de la ligne déjà montrée.
		if (RowData.lastShowed !== null) {
			RowData.lastShowed.hideDetails();
		}
		RowData.lastShowed = this;

		if (this.rowDetails.classList.contains(classHideRow)) {	
			// Affiche les détails
			this.rowDetails.classList.remove(classHideRow);
		}
	}
}

/** True si la page actuel est la dernière page. */
function isCurrentPageMax() {
	return currentPage >= lines.length/linePerPage -1;
}

/** Affiche la page suivante. */
function nextPage() {
	if (isCurrentPageMax()) {
		console.log("Page maximal déjà atteinte.");
		return;
	}
	currentPage++;
	loadPage();
}

/** Affiche la page précédente. */
function previousPage() {
	if (currentPage <= 0) {
		console.log("Page minimal déjà atteinte.");
		return;
	}
	currentPage--;
	loadPage();
}

/** Recharge la page. */
function loadPage() {
	// Maj affichage nombre de résultat.
	let resultCountElem = document.getElementById(idResultCount);
	resultCountElem.innerHTML = 
		`Résultats ${currentPage * linePerPage + 1} - ${isCurrentPageMax() ? lines.length : (currentPage+1) * linePerPage}<br>
		${lines.length} résultats au total.`;

	let tableElem = document.getElementById(idResults);
	
	tableElem.innerHTML = "";
	for (let i=0; i<linePerPage && i+currentPage*linePerPage < lines.length; i++) {
		let rowData = lines[i+currentPage*linePerPage];
		tableElem.appendChild(rowData.row);
		if (rowData.rowDetails !== null) {
			tableElem.appendChild(rowData.rowDetails);
			rowData.hideDetails();
		}
	}
}

/** Initialise la page de résultat. */
function initPageManager() {
	let tableElem = document.getElementById(idResults);
	/** @type RowData */
	let lastInsteredRow;
	let currentRowNum = 0;

	for (let i = 0; i < tableElem.children.length; i++) {
		let rowElem = tableElem.children[i];
		if (rowElem.classList.contains(classTableRowMore)) {
			lastInsteredRow.rowDetails = rowElem;
		} else {
			// console.log(tableElem.children[i].innerHTML);
			rowElem.id = `row_${currentRowNum++}`;
			row = new RowData(rowElem);
			lines.push(row);
			linesMap.set(rowElem.id, row);
			// console.log(linesMap);
			lastInsteredRow = row;
		}
	}
	// console.log(linesMap);
	loadPage();
}

/**
 * @param {Element} elem 
 */
function test(elem) {
	console.log(elem.id);
}

/**
 * Affiche ou cache les informations supplémentaires sur la ligne indiquée.
 * @param {string} rowId
 */
function switchDisplayMoreContent(rowId) {
	console.log(`(switchDisplayMoreContent) Clicked row: "${rowId}"`);
	let row = linesMap.get(rowId);
	if (row.isDetailsHidden()) row.showDetails();
	else row.hideDetails();
}

/** Tri le tableau selon la colonne. */
function orderBy(numColumn) {
	// Mise en forme désélectionner de l'ancienne colonne triée
	if (orderNum != null) {
		let butElem = document.getElementById(`col${orderNum}`);
		butElem.className = "order-btn";
	}

	// Mise en forme trié de la nouvelle colonne
	orderReverse = orderNum === numColumn ? !orderReverse : false;
	orderNum = numColumn;
	let butElem = document.getElementById(`col${orderNum}`);
	butElem.classList.add("order-btn-selected");
	if (orderReverse) butElem.classList.add("order-btn-reverse");
	
	// Tri de l'array
	for (let i = 0; i < lines.length; i++) {
		let minId = i;
		let minValue = stringToNumber(lines[i].children[orderNum].innerHTML);

		for (let j = i+1; j < lines.length; j++) {
			const value = stringToNumber(lines[j].children[orderNum].innerHTML);
			if (orderReverse ? value > minValue : value < minValue) {
				minValue = value;
				minId = j;
			}
		}
		//console.log(`${minValue} : ${isNaN(minValue)}`);
		const tmp = lines[i];
		lines[i] = lines[minId];
		lines[minId] = tmp;
	}
	loadPage();
}

/** Essai de transformer un valeur de tableau en nombre. */
function stringToNumber(value) {
	const regex = /[ €]/gi;
	value = value.replaceAll(regex, '');
	if (isNaN(value)) {
		return value;
	}
	return Number(value);
}