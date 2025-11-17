var alertColorMap = {
	"alert-primary": "has-bs-primary-bg-subtle-background-color",
	"alert-secondary": "has-bs-secondary-bg-subtle-background-color",
	"alert-success": "has-bs-success-bg-subtle-background-color",
	"alert-danger": "has-bs-danger-bg-subtle-background-color",
	"alert-warning": "has-bs-warning-bg-subtle-background-color",
	"alert-info": "has-bs-info-bg-subtle-background-color",
	"alert-light": "has-bs-light-bg-subtle-background-color",
	"alert-dark": "has-bs-dark-bg-subtle-background-color",
}

// Process all elements with the `alert` class
updateElements(".alert", function (element) {
	// Remove unwanted classes
	removeClassesContainingSubstrings(element, ["is-layout-"])

	// Loop through the alertColorMap to add new classes without removing originals
	for (var oldClass in alertColorMap) {
		if (element.classList.contains(oldClass)) {
			element.classList.add(alertColorMap[oldClass]) // Add the mapped class
		}
	}
})
