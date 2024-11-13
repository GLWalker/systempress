;(function () {
	"use strict"
	document.querySelectorAll(".container").forEach((element) => {
		element.classList.remove.apply(
			element.classList,
			Array.from(element.classList).filter((v) =>
				v.startsWith("wp-block-group-")
			)
		),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("is-layout-")
				)
			)
	})

	document.querySelectorAll(".container-sm").forEach((element) => {
		element.classList.remove.apply(
			element.classList,
			Array.from(element.classList).filter((v) =>
				v.startsWith("wp-block-group-")
			)
		),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("is-layout-")
				)
			)
	})

	document.querySelectorAll(".container-md").forEach((element) => {
		element.classList.remove.apply(
			element.classList,
			Array.from(element.classList).filter((v) =>
				v.startsWith("wp-block-group-")
			)
		),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("is-layout-")
				)
			)
	})

	document.querySelectorAll(".container-lg").forEach((element) => {
		element.classList.remove.apply(
			element.classList,
			Array.from(element.classList).filter((v) =>
				v.startsWith("wp-block-group-")
			)
		),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("is-layout-")
				)
			)
	})

	document.querySelectorAll(".container-xl").forEach((element) => {
		element.classList.remove.apply(
			element.classList,
			Array.from(element.classList).filter((v) =>
				v.startsWith("wp-block-group-")
			)
		),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("is-layout-")
				)
			)
	})

	document.querySelectorAll(".container-xxl").forEach((element) => {
		element.classList.remove.apply(
			element.classList,
			Array.from(element.classList).filter((v) =>
				v.startsWith("wp-block-group-")
			)
		),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("is-layout-")
				)
			)
	})
})()
