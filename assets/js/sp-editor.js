// Map for both alert and list group color classes
var colorClassMap = {
	"alert-primary": "has-bs-primary-bg-subtle-background-color",
	"alert-secondary": "has-bs-secondary-bg-subtle-background-color",
	"alert-success": "has-bs-success-bg-subtle-background-color",
	"alert-danger": "has-bs-danger-bg-subtle-background-color",
	"alert-warning": "has-bs-warning-bg-subtle-background-color",
	"alert-info": "has-bs-info-bg-subtle-background-color",
	"alert-light": "has-bs-light-bg-subtle-background-color",
	"alert-dark": "has-bs-dark-bg-subtle-background-color",
	"list-group-item-primary": "has-bs-primary-bg-subtle-background-color",
	"list-group-item-secondary": "has-bs-secondary-bg-subtle-background-color",
	"list-group-item-success": "has-bs-success-bg-subtle-background-color",
	"list-group-item-danger": "has-bs-danger-bg-subtle-background-color",
	"list-group-item-warning": "has-bs-warning-bg-subtle-background-color",
	"list-group-item-info": "has-bs-info-bg-subtle-background-color",
	"list-group-item-light": "has-bs-light-bg-subtle-background-color",
	"list-group-item-dark": "has-bs-dark-bg-subtle-background-color",
}

// Apply color classes (both alert and list group) in the block editor
function applyColorClassesInEditor() {
	document
		.querySelectorAll(
			".editor-styles-wrapper .alert, .editor-styles-wrapper .list-group-item"
		)
		.forEach(function (element) {
			// Loop through the map and apply the new color class if needed
			for (var oldClass in colorClassMap) {
				if (
					element.classList.contains(oldClass) &&
					!element.classList.contains(colorClassMap[oldClass])
				) {
					element.classList.add(colorClassMap[oldClass])
				}
			}
		})
}

// Run initially and watch for changes
wp.domReady(function () {
	applyColorClassesInEditor()

	// MutationObserver to apply dynamically when blocks are added/edited
	var observer = new MutationObserver(applyColorClassesInEditor)
	observer.observe(document.body, { childList: true, subtree: true })
})
