// Accordion-related classes to process
var accordionClasses = [
	"accordion",
	"accordion-item",
	"accordion-header",
	"accordion-collapse",
	"accordion-body",
]

// Transform <p class="accordion-button"> into <button class="accordion-button">
// This function processes the <p> elements with class "accordion-button" and replaces them with <button>
function transformAccordionButton() {
	document
		.querySelectorAll("p.accordion-button")
		.forEach(function (paragraph) {
			var button = document.createElement("button")

			// Copy attributes from <p> to <button>
			Array.prototype.forEach.call(paragraph.attributes, function (attr) {
				button.setAttribute(attr.name, attr.value)
			})

			// Preserve inner HTML
			button.innerHTML = paragraph.innerHTML

			// Replace <p> with <button> in the DOM
			paragraph.parentNode.replaceChild(button, paragraph)
		})
}

// Substrings in classes to be removed (e.g., layout-specific classes like is-layout-)
var substringsToRemove = ["is-layout-"]

// Iterate over each accordion class and remove specified substrings
// Uses removeClassesContainingSubstrings to clean up unnecessary classes
function cleanUpAccordionClasses() {
	accordionClasses.forEach(function (accordionClass) {
		document
			.querySelectorAll("." + accordionClass)
			.forEach(function (element) {
				// Remove classes containing specified substrings
				removeClassesContainingSubstrings(element, substringsToRemove)
			})
	})
}

// Function to process toggle-accordion_* elements
// Adds necessary attributes for proper accordion functionality
function processAccordionElements() {
	processElementsByClass(
		"toggle-accordion_",
		function (element, accordionTarget) {
			// Update attributes on the toggle-accordion_* element
			updateAttributes(element, {
				"data-bs-target": "#" + accordionTarget,
				"aria-controls": accordionTarget,
				"data-bs-toggle": "collapse",
				role: "button",
				"aria-expanded": "true",
			})
		}
	)
}

// Function to add data-bs-parent to .accordion-collapse elements
// Associates the collapsible elements with their parent accordion
function addDataBsParentToAccordionCollapse() {
	// Find all elements with class .accordion
	document
		.querySelectorAll(".accordion")
		.forEach(function (accordionElement) {
			// Get the ID of the parent accordion
			var accordionId = accordionElement.id

			// If the parent accordion has an ID, add it as data-bs-parent to all .accordion-collapse elements inside
			if (accordionId) {
				accordionElement
					.querySelectorAll(".accordion-collapse")
					.forEach(function (collapseElement) {
						updateAttributes(collapseElement, {
							"data-bs-parent": "#" + accordionId,
						})
					})
			}
		})
}

// Run the functions
transformAccordionButton()
cleanUpAccordionClasses()
processAccordionElements()
addDataBsParentToAccordionCollapse()
