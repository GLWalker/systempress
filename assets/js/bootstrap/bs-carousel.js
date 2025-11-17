// Transform <p> elements with specific classes into <button> for controls

document
	.querySelectorAll(".carousel-control-prev, .carousel-control-next")
	.forEach(function (paragraph) {
		var button = document.createElement("button")

		// Safely find the parent carousel
		var carousel = paragraph.closest(".carousel")
		if (!carousel || !carousel.id) return // skip if no carousel or no ID

		var carouselId = carousel.id

		// Check for the appropriate class and set the button attributes accordingly
		if (paragraph.classList.contains("carousel-control-prev")) {
			button.classList.add("carousel-control-prev")
			button.setAttribute("type", "button")
			button.setAttribute("data-bs-target", "#" + carouselId)
			button.setAttribute("data-bs-slide", "prev")
			button.innerHTML = `
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            `
		} else if (paragraph.classList.contains("carousel-control-next")) {
			button.classList.add("carousel-control-next")
			button.setAttribute("type", "button")
			button.setAttribute("data-bs-target", "#" + carouselId)
			button.setAttribute("data-bs-slide", "next")
			button.innerHTML = `
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            `
		}

		// Replace <p> with <button> in the DOM
		paragraph.parentNode.replaceChild(button, paragraph)
	})

// Handle carousels
document.querySelectorAll(".carousel").forEach(function (carousel) {
	var carouselId = carousel.id

	// Update slide indicators
	var indicators = carousel.querySelectorAll(".slide-indicator")
	if (indicators.length) {
		// Create indicators container
		var indicatorsContainer = document.createElement("div")
		indicatorsContainer.classList.add("carousel-indicators")
		indicatorsContainer.setAttribute("role", "tablist")

		indicators.forEach(function (element, index) {
			// Convert <p> to <button> for accessibility
			var button = document.createElement("button")
			button.setAttribute("type", "button")
			button.setAttribute("data-bs-target", "#" + carouselId)
			button.setAttribute("data-bs-slide-to", index)
			button.setAttribute("aria-label", "Slide " + (index + 1))
			button.setAttribute("role", "tab")

			// Handle active state
			if (element.classList.contains("active")) {
				button.classList.add("active")
				button.setAttribute("aria-current", "true")
			}

			// Preserve custom classes (excluding slide-indicator)
			var customClasses = Array.from(element.classList)
				.filter((cls) => cls !== "slide-indicator" && cls !== "active")
				.join(" ")
			if (customClasses) {
				button.classList.add(...customClasses.split(" "))
			}

			// Append to container
			indicatorsContainer.appendChild(button)

			// Remove original <p>
			element.remove()
		})

		// Add indicators container to carousel
		carousel.prepend(indicatorsContainer)
	}

	// Update control buttons
	carousel
		.querySelectorAll(".carousel-control-prev, .carousel-control-next")
		.forEach(function (element) {
			updateAttributes(element, {
				"data-bs-target": "#" + carouselId,
				"data-bs-slide": element.classList.contains(
					"carousel-control-prev"
				)
					? "prev"
					: "next",
			})
		})
})

// General cleanup for carousel-related classes
var substringsToRemove = [
	/*"wp-block-group",*/
	"is-layout-flow",
	"wp-block-group-is-layout-flow",
	"wp-block-buttons",
	"is-content-justification-center",
	"is-nowrap",
	"is-layout-flex",
	"wp-block-buttons-is-layout-flex",
]
document
	.querySelectorAll(
		".carousel, .carousel-inner, .carousel-item, .carousel-caption, .carousel-indicators"
	)
	.forEach(function (element) {
		removeClassesContainingSubstrings(element, substringsToRemove)
	})

// Set additional attributes for .carousel.slide
document.querySelectorAll(".carousel.slide").forEach(function (element) {
	updateAttributes(element, { "data-bs-ride": "carousel" })
})

// Cleanup nested elements in carousel-inner
document
	.querySelectorAll(".carousel-inner .wp-block-group")
	.forEach(function (element) {
		removeClassesContainingSubstrings(element, substringsToRemove)
	})

// Utility functions (assumed to be defined elsewhere, included for completeness)
function updateAttributes(element, attributes) {
	Object.keys(attributes).forEach(function (key) {
		element.setAttribute(key, attributes[key])
	})
}

function removeClassesContainingSubstrings(element, substrings) {
	var classes = Array.from(element.classList)
	classes.forEach(function (cls) {
		if (substrings.some((sub) => cls.includes(sub))) {
			element.classList.remove(cls)
		}
	})
}
