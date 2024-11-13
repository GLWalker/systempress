;(function () {
	"use strict"

	document.querySelectorAll(".card").forEach((element) => {
		element.classList.remove("is-layout-flow"),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("wp-block-group-")
				)
			)
	})

	document.querySelectorAll(".card-header").forEach((element) => {
		element.classList.remove("wp-block-heading"),
			element.classList.remove("is-layout-flow"),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("wp-block-group-")
				)
			)
	})

	document.querySelectorAll(".card-title").forEach((element) => {
		element.classList.remove("wp-block-heading"),
			element.classList.remove("is-layout-flow"),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("wp-block-group-")
				)
			)
	})

	document.querySelectorAll(".card-body").forEach((element) => {
		element.classList.remove("is-layout-flow"),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("wp-block-group-")
				)
			)
	})

	document.querySelectorAll(".card-footer").forEach((element) => {
		element.classList.remove("wp-block-heading"),
			element.classList.remove("is-layout-flow"),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("wp-block-group-")
				)
			)
	})
})()
