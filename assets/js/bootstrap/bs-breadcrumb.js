// Define substrings to search for in classes to be removed
var substringsToRemove = ["wp-list-group", "is-layout-"]

// remove unwanted classes
updateElements(".bs-breadcrumbs", function (element) {
	removeClassesContainingSubstrings(element, substringsToRemove)
})

// Apply ARIA attributes to active breadcrumb items and remove unwanted classes
updateElements(".breadcrumb-item.active", function (element) {
	updateAttributes(element, { "aria-current": "page" })
	removeClassesContainingSubstrings(element, substringsToRemove)
})
