// Helper function to modify classes
var modifyListGroupClasses = function (selector, action) {
	window.modifyClasses(selector, action)
}

// Apply Bootstrap list-group item classes
modifyListGroupClasses(".list-group li", { add: ["list-group-item"] })
modifyListGroupClasses(".list-group-item-action li", {
	add: ["list-group-item-action"],
})

// Remove list-group-item-action from .list-group.list-group-item-action
modifyListGroupClasses(".list-group.list-group-item-action", {
	remove: ["list-group-item-action"],
})

// Apply .list-group-flush to .card .list-group
modifyListGroupClasses(".card .list-group", { add: ["list-group-flush"] })

// Apply .stretched-link to .list-group.stretched-link a and remove .stretched-link from .list-group.stretched-link
modifyListGroupClasses(".list-group.stretched-link a", {
	add: ["stretched-link"],
})
modifyListGroupClasses(".list-group.stretched-link", {
	remove: ["stretched-link"],
})

// Replace text inside wp-block-archives and wp-block-categories list items
var updateListItemsText = function (selector) {
	document.querySelectorAll(selector).forEach(function (element) {
		element.innerHTML = element.innerHTML
			.replace(/\(/gi, '<span class="badge">')
			.replace(/\)/gi, "</span>")
	})
}

updateListItemsText(".wp-block-archives.list-group li")
updateListItemsText(".wp-block-categories.list-group li")

// Add active class to the parent of a[aria-current="page"]
document
	.querySelectorAll('.list-group a[aria-current="page"]')
	.forEach(function (element) {
		element.parentNode.classList.add("active")
	})

// Remove unwanted classes from wp-block-navigation and wp-block-navigation-is-layout-flex
modifyListGroupClasses(".list-group.wp-block-navigation", {
	remove: ["wp-block-navigation", "wp-block-navigation__container"],
})
modifyListGroupClasses(".list-group.wp-block-navigation-is-layout-flex", {
	remove: ["is-layout-flex", "wp-block-navigation-is-layout-flex"],
})

// Remove classes from nav.list-group
modifyListGroupClasses("nav.list-group", {
	remove: ["list-group-flush", "list-group"],
})

// Clean up wp-block-navigation-item and wp-block-navigation-link classes
modifyListGroupClasses(".list-group .wp-block-navigation-item", {
	remove: ["wp-block-navigation-link", "wp-block-navigation-item"],
})

// Add d-block class to .list-group a.wp-block-navigation-item__content
modifyListGroupClasses(".list-group a.wp-block-navigation-item__content", {
	add: ["d-block"],
})

// Remove the wp-block-list class from all list groups
modifyListGroupClasses(".list-group", { remove: ["wp-block-list"] })

var listGroupColorMap = {
	"list-group-item-primary": "has-bs-primary-bg-subtle-background-color",
	"list-group-item-secondary": "has-bs-secondary-bg-subtle-background-color",
	"list-group-item-success": "has-bs-success-bg-subtle-background-color",
	"list-group-item-danger": "has-bs-danger-bg-subtle-background-color",
	"list-group-item-warning": "has-bs-warning-bg-subtle-background-color",
	"list-group-item-info": "has-bs-info-bg-subtle-background-color",
	"list-group-item-light": "has-bs-light-bg-subtle-background-color",
	"list-group-item-dark": "has-bs-dark-bg-subtle-background-color",
}

// Process all elements with the `list-group` class
updateElements(".list-group, .list-group-item", function (element) {
	// Remove unwanted classes
	removeClassesContainingSubstrings(element, ["is-layout-"])

	// Loop through the listGroupColorMap to replace classes
	for (var oldClass in listGroupColorMap) {
		if (element.classList.contains(oldClass)) {
			element.classList.add(listGroupColorMap[oldClass]) // Add the mapped class
		}
	}
})
