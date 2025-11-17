// Utility functions
window.removeClassesContainingSubstrings = function (element, substrings) {
	substrings.forEach(function (substring) {
		element.classList.forEach(function (cls) {
			if (cls.includes(substring)) {
				element.classList.remove(cls)
			}
		})
	})
}

window.processElementsByClass = function (prefix, callback) {
	var elements = document.querySelectorAll("[class*='" + prefix + "']")
	elements.forEach(function (element) {
		var matchedClass = Array.from(element.classList).find(function (cls) {
			return cls.startsWith(prefix)
		})

		if (matchedClass) {
			var identifier = matchedClass.split("_")[1]
			if (identifier) {
				callback(element, identifier)
			}
		}
	})
}

// Remove specific classes from modal-related elements
var modalClasses = [
	"modal",
	"modal-dialog",
	"modal-content",
	"modal-header",
	"modal-body",
	"modal-footer",
]

var substringsToRemove = ["is-layout-", "wp-block-group"]

modalClasses.forEach(function (modalClass) {
	document.querySelectorAll("." + modalClass).forEach(function (element) {
		window.removeClassesContainingSubstrings(element, substringsToRemove)
	})
})

// Process data elements
document.addEventListener("DOMContentLoaded", function () {
	// Process toggle-modal_* elements
	window.processElementsByClass(
		"toggle-modal_",
		function (element, modalTarget) {
			element.setAttribute("data-bs-target", "#" + modalTarget)
			element.setAttribute("data-bs-toggle", "modal")
		}
	)

	// Process modal-label_* elements
	window.processElementsByClass(
		"modal-label_",
		function (element, modalLabel) {
			element.setAttribute("aria-labelledby", modalLabel)
			element.setAttribute("tabindex", "-1")
			element.setAttribute("aria-hidden", "true")
		}
	)

	// Process close buttons with both .wp-block-button and .modal-close
	var closeButtons = document.querySelectorAll(".wp-block-button.modal-close")
	closeButtons.forEach(function (button) {
		button.setAttribute("data-bs-dismiss", "modal")
	})
})
