// List of offcanvas-related classes to process
var offcanvasClasses = [
	"offcanvas",
	"offcanvas-xxl",
	"offcanvas-xl",
	"offcanvas-lg",
	"offcanvas-md",
	"offcanvas-sm",
	"offcanvas-backdrop",
	"offcanvas-header",
	"offcanvas-body",
	"offcanvas-title",
]

// Substrings to search for in classes to be removed
var substringsToRemove = ["is-layout-", "wp-block-group"]

offcanvasClasses.forEach((offcanvasClass) => {
	document.querySelectorAll(`.${offcanvasClass}`).forEach((element) => {
		// Remove any class containing the specified substrings
		window.removeClassesContainingSubstrings(element, substringsToRemove)
	})
})
