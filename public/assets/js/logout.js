document.addEventListener('DOMContentLoaded', () => {
	const $logOutSubmit = document.querySelector('#logOutBtn');

	$logOutSubmit.addEventListener('click', (e) => {
		document.cookie =
			'user_token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
		window.location.href =
			'http://hotel.collegelink.localhost/public/login.php';
	});
});
