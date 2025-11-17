;(function () {
	"use strict"

	// Array of container classes to process
	var containerClasses = [
		".container",
		".container-fluid",
		".container-sm",
		".container-md",
		".container-lg",
		".container-xl",
		".container-xxl",
	]

	// Substrings to search for in classes to be removed
	var substringsToRemove = ["wp-block-group", "is-layout-", "has-global-"]

	// Iterate over each container class
	containerClasses.forEach((containerClass) => {
		document.querySelectorAll(containerClass).forEach((element) => {
			// Remove classes containing specified substrings
			window.removeClassesContainingSubstrings(
				element,
				substringsToRemove
			)
		})
	})
})()
