;(function () {
	"use strict"

	// Initialize tooltips
	const tooltipElements = document.querySelectorAll(
		'[data-bs-toggle="tooltip"]'
	)
	for (const tooltip of tooltipElements) {
		new bootstrap.Tooltip(tooltip) // eslint-disable-line no-new
	}
})()
