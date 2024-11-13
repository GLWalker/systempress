;(function () {
	"use strict"

	document.querySelectorAll(".carousel.slide").forEach((element) => {
		element.classList.remove("wp-block-group"),
			element.classList.remove("is-layout-flow"),
			element.classList.remove("wp-block-group-is-layout-flow"),
			element.setAttribute("data-bs-ride", "carousel")
	})

	document
		.querySelectorAll(".wp-block-buttons.carousel-indicators")
		.forEach((element) => {
			element.classList.remove("wp-block-buttons"),
				element.classList.remove("is-content-justification-center"),
				element.classList.remove("is-nowrap"),
				element.classList.remove("is-layout-flex"),
				element.classList.remove("wp-block-buttons-is-layout-flex")
		})

	document
		.querySelectorAll(".carousel-indicators > .wp-block-button")
		.forEach((element) => {
			element.classList.remove("wp-block-buttons"),
				element.classList.remove("is-content-justification-center"),
				element.classList.remove("is-nowrap"),
				element.classList.remove("is-layout-flex"),
				element.classList.remove("wp-block-buttons-is-layout-flex")
		})

	document
		.querySelectorAll(".wp-block-group.carousel-indicators")
		.forEach((element) => {
			element.classList.remove("wp-block-group"),
				element.classList.remove("is-layout-flow"),
				element.classList.remove("wp-block-group-is-layout-flow")
		})

	document.querySelectorAll("p.slide-indicator.active").forEach((element) => {
		element.setAttribute("aria-current", "true")
	})

	/*
	document.querySelectorAll("p.slide-1").forEach((element) => {
		element.setAttribute("data-bs-target", "#myCarousel"),
			element.setAttribute("data-bs-slide-to", "0"),
			element.setAttribute("data-label", "Slide 1")
	})
*/
	/*
	document.querySelectorAll(".slide-1").forEach((element) => {
		element.outerHTML =
			'<button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">' +
			"</button>"
	})
	*/

	/*
	// Get the current element
	var currentNode = document.querySelector(".slide-1")
	// Replace the element
	currentNode.outerHTML =
		'<button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1">' +
		"</button>"
*/

	document
		.querySelectorAll(".wp-block-group.carousel-inner")
		.forEach((element) => {
			element.classList.remove("wp-block-group"),
				element.classList.remove("is-layout-flow"),
				element.classList.remove("wp-block-group-is-layout-flow")
		})
	document
		.querySelectorAll(".wp-block-group.carousel-item")
		.forEach((element) => {
			element.classList.remove("wp-block-group"),
				element.classList.remove("is-layout-flow"),
				element.classList.remove("wp-block-group-is-layout-flow")
		})

	document
		.querySelectorAll(".carousel-inner .wp-block-group.container")
		.forEach((element) => {
			element.classList.remove("wp-block-group"),
				element.classList.remove("is-layout-flow"),
				element.classList.remove("wp-block-group-is-layout-flow")
		})

	document
		.querySelectorAll(".wp-block-group.carousel-caption")
		.forEach((element) => {
			element.classList.remove("wp-block-group"),
				element.classList.remove("is-layout-flow"),
				element.classList.remove("wp-block-group-is-layout-flow")
		})
})()
