// Initialize all popovers
var popoverElements = document.querySelectorAll('[data-bs-toggle="popover"]')

popoverElements.forEach((popover) => {
	new bootstrap.Popover(popover) // eslint-disable-line no-new
})
