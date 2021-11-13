/** Modifie les caractéristique d'un input donné. */
function changeInput(id, placeholder, type) {
	let elem = document.getElementById(id);
	elem.placeholder = placeholder;
	elem.type = type;
}