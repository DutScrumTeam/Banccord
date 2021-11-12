/** Change la visibilité du mot de passe, le cachant ou le révélant. */
function switchPasswordView() {
	switchPasswordViewName("password");
}
function switchPasswordViewName(name) {
	let elem = document.getElementById(name);
    elem.type = elem.type === "password" ? "text" : "password";
}