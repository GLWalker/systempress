(function () {
	'use strict'

var inputs = document.querySelectorAll("input");
var i = inputs.length;
while (i--) {
	var input = inputs.item(i);
	switch (input.getAttribute("type")) {
	case "hidden": // Makes no sense to style hidden fields.
			break;
		case "color":
			input.style.padding="0px";
		case "text":
		case "email":
		case "number":
		case "password":
		case "search":
		case "tel":
		case "url":
		case "date":
		case "datetime-local":
		case "month":
		case "time":
		case "week":
			input.classList.add("form-control");
			break;

		case "submit":
		case "image":
		case "button":
		case "reset":
			input.classList.add("btn");
			input.classList.add("btn-primary");
			break;
		case "checkbox":
		case "radio":
			input.classList.add("form-check-input");
			break;
		case "file":
			input.classList.add("form-control");
			break;
		case "range":
			input.classList.add("form-range");
			break;
		default: // Should never run, as all HTML types have been accounted for.
			input.classList.add("form-control");
			break;
	}
}
var selects = document.querySelectorAll("select");
var i = selects.length;
while (i--) {
	var select = selects.item(i);
	select.classList.add("form-select");
}

var textareas = document.querySelectorAll("textarea");
var i = textareas.length;
while (i--) {
	var textarea = textareas.item(i);
	textarea.classList.add("form-control");
}

var checklabels = document.querySelectorAll(".comment-form-cookies-consent label");
var i = checklabels.length;
while (i--) {
	var label = checklabels.item(i);
	label.classList.add("form-check-label");
}

var labels = document.querySelectorAll("label:not(.comment-form-cookies-consent label)");
var i = labels.length;
while (i--) {
	var label = labels.item(i);
	label.classList.add("form-label");
}

var removelabels = document.querySelectorAll("label.form-check-label");
var i = removelabels.length;
while (i--) {
	var label = removelabels.item(i);
	label.classList.remove("form-label");
}

document.querySelectorAll(".wp-block-search__button-inside .wp-block-search__inside-wrapper").forEach((element) => {
	element.classList.add("input-group");
	element.classList.remove("wp-block-search__inside-wrapper");
})

document.querySelectorAll(".wp-block-search__button-inside .wp-block-search__input").forEach((element) => {
	element.classList.remove("wp-block-search__input");
})

document.querySelectorAll(".comment-form").forEach((element) => {
	  element.classList.add("needs-validation");
})


window.addEventListener('load', function() {
	// Fetch all the forms we want to apply custom Bootstrap validation styles to
	var forms = document.getElementsByClassName('needs-validation');

	// Loop over them and prevent submission
	var validation = Array.prototype.filter.call(forms, function(form) {
		form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add('was-validated');
		}, false);
	});
}, false);

})();