
function changeType() {
	let typeElem = document.getElementById("type");

	let clientElems = document.querySelectorAll(".client-only");
	if (typeElem.value === "client") {
		for (const formElem of clientElems) {
			formElem.style.display = "block";
		}
	} else {
		for (const formElem of clientElems) {
			formElem.style.display = "none";
		}
	}

	console.log("Maj du formulaire selon le type du compte terminé");
}