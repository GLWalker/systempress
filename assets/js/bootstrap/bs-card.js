// List of card-related classes to process
var cardClasses = [
	"card",
	"card-header",
	"card-body",
	"card-title",
	"card-footer",
]

// Class to be removed
var classToRemove = "wp-block-group"

// Substrings to search for in classes to be removed
var substringsToRemove = ["is-layout-", "wp-block-heading"]

// Process each card-related class
cardClasses.forEach(function (cardClass) {
	var elements = document.querySelectorAll("." + cardClass)
	elements.forEach(function (element) {
		// Remove "wp-block-group" class for specific card-related elements (except "card")
		if (cardClass !== "card" && element.classList.contains(classToRemove)) {
			element.classList.remove(classToRemove)
		}

		// Remove any class containing specified substrings (e.g., "is-layout-")
		window.removeClassesContainingSubstrings(element, substringsToRemove)
	})
})
