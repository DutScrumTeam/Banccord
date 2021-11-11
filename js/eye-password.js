/** Change la visibilité du mot de passe, le cachant ou le révélant. */
function switchPasswordView() {
	let elem = document.getElementById("password");
	elem.type = elem.type === "password" ? "text" : "password";
}
