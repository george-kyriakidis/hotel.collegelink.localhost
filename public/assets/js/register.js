document.addEventListener('DOMContentLoaded', () => {
	const $fullName = document.querySelector('#full-name');
	const $email = document.querySelector('#email');
	const $secondEmail = document.querySelector('#second-email');
	const $password = document.querySelector('#password');

	const $registerSubmit = document.querySelector('#register');

	const $fullNameError = document.querySelector('.full-name-error');
	const $emailError = document.querySelector('.email-error');
	const $secondEmailError = document.querySelector('.second-email-error');
	const $passwordError = document.querySelector('.password-error');

	let fullNameIsValid = false;
	let emailIsValid = false;
	let secondEmailIsVerify = false;
	let passwordIsValid = false;

	const getFullNameValidation = (fullName) => {
		if (fullName !== '' && /^[A-Za-z]+$/.test(fullName)) {
			fullNameIsValid = true;
		} else {
			fullNameIsValid = false;
		}
	};

	const getEmailIsValid = (email) => {
		if (
			email !== '' &&
			/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)
		) {
			emailIsValid = true;
		} else {
			emailIsValid = false;
		}
	};

	const getsecondEmailIsValid = (secondEmail) => {
		const emailValue = $email.value;

		if (
			secondEmail !== '' &&
			/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(secondEmail) &&
			emailValue === secondEmail
		) {
			secondEmailIsVerify = true;
		} else {
			secondEmailIsVerify = false;
		}
	};

	const getPasswordIsValid = (password) => {
		if (password !== '' && password.length > 8) {
			passwordIsValid = true;
		} else {
			passwordIsValid = false;
		}
	};

	const checkSigninBtn = () => {
		if (
			fullNameIsValid &&
			emailIsValid &&
			secondEmailIsVerify &&
			passwordIsValid
		) {
			$registerSubmit.removeAttribute('disabled');
		} else {
			$registerSubmit.setAttribute('disabled', 'disabled');
		}
	};

	$fullName.addEventListener('input', (e) => {
		getFullNameValidation(e.target.value);

		if (fullNameIsValid) {
			$fullNameError.style.display = 'none';
		} else {
			$fullNameError.style.display = 'block';
		}

		checkSigninBtn();
	});

	$email.addEventListener('input', (e) => {
		getEmailIsValid(e.target.value);

		if (emailIsValid) {
			$emailError.style.display = 'none';
		} else {
			$emailError.style.display = 'block';
		}

		checkSigninBtn();
	});

	$secondEmail.addEventListener('input', (e) => {
		getsecondEmailIsValid(e.target.value);

		if (secondEmailIsVerify) {
			$secondEmailError.style.display = 'none';
		} else {
			$secondEmailError.style.display = 'block';
		}

		checkSigninBtn();
	});

	$password.addEventListener('input', (e) => {
		getPasswordIsValid(e.target.value);

		if (passwordIsValid) {
			$passwordError.style.display = 'none';
		} else {
			$passwordError.style.display = 'block';
		}

		checkSigninBtn();
	});
});
