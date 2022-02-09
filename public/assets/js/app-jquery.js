$(document).ready(function () {
	var dateFormat = 'mm/dd/yy';
	var cityValueValid = false;
	var checkInValueValid = false;
	var checkOutValueValid = false;

	cityValue = $('#city').on('change', function () {
		if (cityValue.val() !== '0') {
			$('.city-value-error').css('display', 'none');
			cityValueValid = true;
		} else {
			$('.city-value-error').css('display', 'block');
			cityValueValid = false;
		}

		searchSubmitBtn();
	});

	(from = $('#from')
		.datepicker({ defaultDate: '+1w', changeMonth: true, numberOfMonths: 1 })
		.on('change', function () {
			to.datepicker('option', 'minDate', getDate(this));
			if (getDate !== '') {
				$('.check-in-date-error').css('display', 'none');
				checkInValueValid = true;
			} else {
				$('.check-in-date-error').css('display', 'block');
				checkInValueValid = false;
			}

			searchSubmitBtn();
		})),
		(to = $('#to')
			.datepicker({
				defaultDate: '+1w',
				changeMonth: true,
				numberOfMonths: 1,
			})
			.on('change', function () {
				from.datepicker('option', 'maxDate', getDate(this));
				if (getDate !== '') {
					$('.check-out-date-error').css('display', 'none');
					checkOutValueValid = true;
				} else {
					$('.check-out-date-error').css('display', 'block');
					checkOutValueValid = false;
				}

				searchSubmitBtn();
			}));

	function searchSubmitBtn() {
		if (cityValueValid && checkInValueValid && checkOutValueValid) {
			$('.submit-btn').removeAttr('disabled');
		} else {
			$('.submit-btn').attr('disabled');
		}
	}

	function getDate(element) {
		var date;
		try {
			date = $.datepicker.parseDate(dateFormat, element.value);
		} catch (error) {
			date = null;
		}

		return date;
	}

	//ranger slider for price in list.php
	$('#slider-range').slider({
		range: true,
		min: 0,
		max: 5000,
		values: [0, 5000],
		slide: function (event, ui) {
			$('#amount').val('€' + ui.values[0] + '  €' + ui.values[1]);
			// when the slider values change, update the hidden fields
			$('#min_amount').val(ui.values[0]);
			$('#max_amount').val(ui.values[1]);
		},
	});
	$('#amount').val(
		'€' +
			$('#slider-range').slider('values', 0) +
			' - €' +
			$('#slider-range').slider('values', 1)
	);
});
