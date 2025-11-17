// Initialize Bootstrap tooltips for elements with data-bs-toggle="tooltip"
var tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]')

for (var i = 0; i < tooltips.length; i++) {
	new bootstrap.Tooltip(tooltips[i]) // eslint-disable-line no-new
}
