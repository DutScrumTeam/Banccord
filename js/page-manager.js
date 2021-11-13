/**
 * Ce script récupère tous les résultat de la page
 * stocke les résultat et n'affiche qu'une portion de résultat.
 */

/** Nombre de ligne par page. */
const linePerPage = 10;
/** Toutes les lignes, y compris celles non-affichées. */
var lines = [];
/** Numéro de la page actuel -1. */
var currentPage = 0;
/** Id de la table de résultat. */
const idResults = "table-result";
/** Id de la zone d'affichage du nombre de résultat. */
const idResultCount = "result-count";

var orderNum = null;
var orderReverse = false;

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
		tableElem.appendChild(lines[i+currentPage*linePerPage]);
	}
}

/** Initialise la page de résultat. */
function initPageManager() {
	let tableElem = document.getElementById(idResults);
	for (let i = 0; i < tableElem.children.length; i++) {
		// console.log(tableElem.children[i].innerHTML);
		lines.push(tableElem.children[i]);
	}
	loadPage();
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
	
}