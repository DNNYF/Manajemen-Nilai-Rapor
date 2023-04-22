const absenButton = document.getElementById('absen');
const loginButton = document.getElementById('loginGuru');
const container = document.getElementById('container');

absenButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

loginButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});