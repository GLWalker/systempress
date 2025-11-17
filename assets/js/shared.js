;(function () {
	"use strict"

	// Helper function to remove classes containing specific substrings
	function removeClassesContainingSubstrings(element, substrings) {
		element.classList.remove.apply(
			element.classList,
			Array.from(element.classList).filter(function (className) {
				return substrings.some(function (substring) {
					return className.includes(substring)
				})
			})
		)
	}

	// Unified function to modify classes for elements
	function modifyClasses(selector, config) {
		var elements = document.querySelectorAll(selector)
		elements.forEach(function (element) {
			if (config.add)
				element.classList.add.apply(element.classList, config.add)
			if (config.remove)
				element.classList.remove.apply(element.classList, config.remove)
		})
	}

	// Helper function to add or remove classes in the DOM
	function toggleClass(element, addClass, removeClass) {
		if (addClass) {
			element.classList.add(addClass)
		}
		if (removeClass) {
			element.classList.remove(removeClass)
		}
	}

	// Update attributes for a given element
	function updateAttributes(element, attributes) {
		Object.keys(attributes).forEach(function (key) {
			element.setAttribute(key, attributes[key])
		})
	}

	// Unified function for updating multiple elements
	function updateElements(selector, callback) {
		document.querySelectorAll(selector).forEach(callback)
	}

	// Process elements by prefix and apply a callback
	function processElementsByClass(prefix, callback) {
		document
			.querySelectorAll("[class*='" + prefix + "']")
			.forEach(function (element) {
				var matchedClass = Array.from(element.classList).find(function (
					cls
				) {
					return cls.startsWith(prefix)
				})
				if (matchedClass) {
					var identifier = matchedClass.split("_")[1]
					if (identifier) callback(element, identifier)
				}
			})
	}

	// Capitalize the first letter of each word in a string
	function capitalizeFirstLetterOfEachWord(inputString) {
		return inputString.replace(/\b\w+/g, function (match) {
			return match.charAt(0).toUpperCase() + match.slice(1)
		})
	}

	// Apply specific modifications to elements
	function updateImageMarkup() {
		;[
			["figure.wp-block-image.d-block > img", "d-block"],
			["figure.wp-block-image.w-100 > img", "w-100"],
			["figure.img-fluid img", "img-fluid"],
			["div.img-fluid img", "img-fluid"],
		].forEach(function ([selector, className]) {
			document.querySelectorAll(selector).forEach(function (img) {
				img.classList.add(className)
				img.parentNode.classList.remove(className)
			})
		})
	}

	function updateSiteHeader() {
		modifyClasses(".site-header > .is-position-sticky", {
			add: ["is-position-sticky"],
			remove: ["is-position-sticky"],
		})
	}

	function updateNavigation() {
		modifyClasses(".current-menu-item > a", { add: ["active"] })
		modifyClasses("nav.wp-block-navigation.nav-pills", {
			remove: ["nav-pills", "wp-block-navigation"],
		})
		modifyClasses("ul.nav.nav-pills li", {
			add: ["nav-item"],
			remove: ["wp-block-navigation-item"],
		})
		modifyClasses("ul.nav.nav-pills li a", {
			add: ["nav-link"],
			remove: ["wp-block-navigation-item__content"],
		})
	}

	function addColorSwatchTooltips() {
		document
			.querySelectorAll(".color-swatches p a")
			.forEach(function (anchor) {
				var titleValue = capitalizeFirstLetterOfEachWord(
					anchor
						.getAttribute("href")
						.replace("#", "")
						.replace("-", " ")
				)
				updateAttributes(anchor, {
					title: titleValue,
					"data-bs-toggle": "tooltip",
					"data-bs-title": titleValue,
				})
			})
	}

	function updateJumbotron() {
		modifyClasses(".jumbotron-place-holder", { add: ["alert"] })
		modifyClasses(".jumbotron-place-holder .btn-close", {
			add: ["btn-close"],
		})
	}

	// Utility: Remove exact class names
	function removeExactClassNames(el, classes) {
		classes.forEach(function (cls) {
			if (el.classList.contains(cls)) el.classList.remove(cls)
		})
	}

	// Cleanup: remove ONLY WordPress block classes (exact match)
	function cleanUpWPBlockClasses(targetSelectors) {
		var wpBlockClasses = [
			"is-layout-flow",
			"is-layout-constrained",
			"is-layout-flex",
			"is-layout-grid",
			"is-horizontal",
			"is-vertical",
			"is-content-justification-left",
			"is-content-justification-center",
			"is-content-justification-right",
			"is-content-justification-space-between",
			"wp-block-group-is-layout-flow",
			"wp-block-buttons-is-layout-flex",
		]

		if (!targetSelectors || !targetSelectors.length) return

		/*
		targetSelectors.forEach(function (selector) {
			document
				.querySelectorAll(selector + ", " + selector + " *")
				.forEach(function (el) {
					removeExactClassNames(el, wpBlockClasses)
				})
		}) */

		targetSelectors.forEach(function (selector) {
			document.querySelectorAll(selector).forEach(function (el) {
				removeExactClassNames(el, wpBlockClasses)
			})
		})
	}

	function applyClassesToInputs(inputs) {
		Array.from(inputs).forEach(function (input) {
			var inputType = input.getAttribute("type")
			var classToAdd = null
			switch (inputType) {
				case "hidden":
				case "submit":
					break
				case "color":
					input.style.padding = "0px"
					break
				case "checkbox":
				case "radio":
					classToAdd = "form-check-input"
					break
				case "range":
					classToAdd = "form-range"
					break
				default:
					classToAdd = "form-control"
					break
			}
			if (classToAdd) input.classList.add(classToAdd)
		})
	}

	function applyFormClasses() {
		modifyClasses("select", { add: ["form-select"] })
		modifyClasses("textarea", { add: ["form-control"] })
		modifyClasses(".comment-form-cookies-consent label", {
			add: ["form-check-label"],
		})
		modifyClasses("label:not(.comment-form-cookies-consent label)", {
			add: ["form-label"],
		})
		modifyClasses("label.form-check-label", { remove: ["form-label"] })

		modifyClasses('input[type="submit"]', { add: ["btn"] })

		modifyClasses(".wp-block-navigation > button", { remove: ["btn"] })
	}

	function enhanceSearchElements() {
		modifyClasses(
			".wp-block-search__button-inside .wp-block-search__inside-wrapper",
			{
				add: ["input-group"],
				remove: ["wp-block-search__inside-wrapper"],
			}
		)
		modifyClasses(
			".wp-block-search__button-inside .wp-block-search__input",
			{
				remove: ["wp-block-search__input"],
			}
		)
		modifyClasses(".wp-block-search__button-inside .wp-element-button", {
			add: ["btn"],
		})
	}

	function applyFormValidation() {
		modifyClasses(".comment-form", { add: ["needs-validation"] })
		document.querySelectorAll(".needs-validation").forEach(function (form) {
			form.addEventListener("submit", function (event) {
				if (!form.checkValidity()) {
					event.preventDefault()
					event.stopPropagation()
				}
				form.classList.add("was-validated")
			})
		})
	}

	function initWOW() {
		if (typeof WOW === "function") {
			new WOW({
				boxClass: "wow",
				animateClass: "animate__animated",
				offset: 20,
				mobile: true,
				live: true,
			}).init()
		}
	}

	// Main initialization
	function init() {
		updateImageMarkup()
		updateSiteHeader()
		updateNavigation()
		addColorSwatchTooltips()
		updateJumbotron()
		applyClassesToInputs(document.querySelectorAll("input"))
		applyFormClasses()
		enhanceSearchElements()
		applyFormValidation()
		cleanUpWPBlockClasses([
			".media-object",
			".accordion",
			".accordion-body",
			".accordion-collapse",
			".accordion-item",
			".accordion-header",
			".alert",
			".bs-breadcrumbs",
			".btn-group",
			".btn-group-vertical",
			".btn-toolbar",
			".card",
			".card-body",
			".card-header",
			".card-img-overlay",
			".card-footer",
			".col",
			".col-auto",
			".col-1",
			".col-2",
			".col-3",
			".col-4",
			".col-5",
			".col-6",
			".col-7",
			".col-8",
			".col-9",
			".col-10",
			".col-11",
			".col-12",
			".col-sm",
			".col-sm-auto",
			".col-sm-1",
			".col-sm-2",
			".col-sm-3",
			".col-sm-4",
			".col-sm-5",
			".col-sm-6",
			".col-sm-7",
			".col-sm-8",
			".col-sm-9",
			".col-sm-10",
			".col-sm-11",
			".col-sm-12",
			".col-md",
			".col-md-auto",
			".col-md-1",
			".col-md-2",
			".col-md-3",
			".col-md-4",
			".col-md-5",
			".col-md-6",
			".col-md-7",
			".col-md-8",
			".col-md-9",
			".col-md-10",
			".col-md-11",
			".col-md-12",
			".col-lg",
			".col-lg-auto",
			".col-lg-1",
			".col-lg-2",
			".col-lg-3",
			".col-lg-4",
			".col-lg-5",
			".col-lg-6",
			".col-lg-7",
			".col-lg-8",
			".col-lg-9",
			".col-lg-10",
			".col-lg-11",
			".col-lg-12",
			".col-xl",
			".col-xl-auto",
			".col-xl-1",
			".col-xl-2",
			".col-xl-3",
			".col-xl-4",
			".col-xl-5",
			".col-xl-6",
			".col-xl-7",
			".col-xl-8",
			".col-xl-9",
			".col-xl-10",
			".col-xl-11",
			".col-xl-12",
			".col-xxl",
			".col-xxl-auto",
			".col-xxl-1",
			".col-xxl-2",
			".col-xxl-3",
			".col-xxl-4",
			".col-xxl-5",
			".col-xxl-6",
			".col-xxl-7",
			".col-xxl-8",
			".col-xxl-9",
			".col-xxl-10",
			".col-xxl-11",
			".col-xxl-12",
			".container",
			".container-fluid",
			".container-sm",
			".container-md",
			".container-lg",
			".container-xl",
			".container-xxl",
			".d-inline",
			".d-inline-block",
			".d-block",
			".d-grid",
			".d-inline-grid",
			".d-table",
			".d-table-cell",
			".d-table-row",
			".d-flex",
			".d-inline-flex",
			".d-sm-inline",
			".d-sm-inline-block",
			".d-sm-block",
			".d-sm-grid",
			".d-sm-inline-grid",
			".d-sm-table",
			".d-sm-table-cell",
			".d-sm-table-row",
			".d-sm-flex",
			".d-sm-inline-flex",
			".d-md-inline",
			".d-md-inline-block",
			".d-md-block",
			".d-md-grid",
			".d-md-inline-grid",
			".d-md-table",
			".d-md-table-cell",
			".d-md-table-row",
			".d-md-flex",
			".d-md-inline-flex",
			".d-lg-inline",
			".d-lg-inline-block",
			".d-lg-block",
			".d-lg-grid",
			".d-lg-inline-grid",
			".d-lg-table",
			".d-lg-table-cell",
			".d-lg-table-row",
			".d-lg-flex",
			".d-lg-inline-flex",
			".d-xl-inline",
			".d-xl-inline-block",
			".d-xl-block",
			".d-xl-grid",
			".d-xl-inline-grid",
			".d-xl-table",
			".d-xl-table-cell",
			".d-xl-table-row",
			".d-xl-flex",
			".d-xl-inline-flex",
			".d-xxl-inline",
			".d-xxl-inline-block",
			".d-xxl-block",
			".d-xxl-grid",
			".d-xxl-inline-grid",
			".d-xxl-table",
			".d-xxl-table-cell",
			".d-xxl-table-row",
			".d-xxl-flex",
			".d-xxl-inline-flex",
			".fixed-bottom",
			".fixed-top",
			".flex-grow-1",
			".flex-grow-0",
			".flex-row",
			".flex-column",
			".flex-row-reverse",
			".flex-column-reverse",
			".flex-wrap",
			".flex-nowrap",
			".flex-wrap-reverse",
			".flex-sm-row",
			".flex-sm-column",
			".flex-sm-row-reverse",
			".flex-sm-column-reverse",
			".flex-sm-wrap",
			".flex-sm-nowrap",
			".flex-sm-wrap-reverse",
			".flex-md-row",
			".flex-md-column",
			".flex-md-row-reverse",
			".flex-md-column-reverse",
			".flex-md-wrap",
			".flex-md-nowrap",
			".flex-md-wrap-reverse",
			".flex-lg-row",
			".flex-lg-column",
			".flex-lg-row-reverse",
			".flex-lg-column-reverse",
			".flex-lg-wrap",
			".flex-lg-nowrap",
			".flex-lg-wrap-reverse",
			".flex-xl-row",
			".flex-xl-column",
			".flex-xl-row-reverse",
			".flex-xl-column-reverse",
			".flex-xl-wrap",
			".flex-xl-nowrap",
			".flex-xl-wrap-reverse",
			".flex-xxl-row",
			".flex-xxl-column",
			".flex-xxl-row-reverse",
			".flex-xxl-column-reverse",
			".flex-xxl-wrap",
			".flex-xxl-nowrap",
			".flex-xxl-wrap-reverse",
			".float-start",
			".float-end",
			".float-none",
			".float-sm-start",
			".float-sm-end",
			".float-sm-none",
			".float-md-start",
			".float-md-end",
			".float-md-none",
			".float-lg-start",
			".float-lg-end",
			".float-lg-none",
			".float-xl-start",
			".float-xl-end",
			".float-xl-none",
			".float-xxl-start",
			".float-xxl-end",
			".float-xxl-none",
			".gap-0",
			".gap-1",
			".gap-2",
			".gap-3",
			".gap-4",
			".gap-5",
			".gap-sm-0",
			".gap-sm-1",
			".gap-sm-2",
			".gap-sm-3",
			".gap-sm-4",
			".gap-sm-5",
			".gap-md-0",
			".gap-md-1",
			".gap-md-2",
			".gap-md-3",
			".gap-md-4",
			".gap-md-5",
			".gap-lg-0",
			".gap-lg-1",
			".gap-lg-2",
			".gap-lg-3",
			".gap-lg-4",
			".gap-lg-5",
			".gap-xl-0",
			".gap-xl-1",
			".gap-xl-2",
			".gap-xl-3",
			".gap-xl-4",
			".gap-xl-5",
			".gap-xxl-0",
			".gap-xxl-1",
			".gap-xxl-2",
			".gap-xxl-3",
			".gap-xxl-4",
			".gap-xxl-5",
			".hstack",
			".navbar",
			".position-static",
			".position-relative",
			".position-absolute",
			".position-fixed",
			".position-sticky",
			".progress",
			".ratio",
			".row",
			".sp-carousel",
			".spinner-border",
			".spinner-grow",
			".sticky-bottom",
			".sticky-sm-bottom",
			".sticky-md-bottom",
			".sticky-lg-bottom",
			".sticky-xl-bottom",
			".sticky-xxl-bottom",
			".sticky-top",
			".sticky-sm-top",
			".sticky-md-top",
			".sticky-lg-top",
			".sticky-xl-top",
			".sticky-xxl-top",
			".toast",
			".tooltip",
			".vstack",
		])
	}

	init()
	initWOW()

	// Export functions for external use
	window.removeClassesContainingSubstrings = removeClassesContainingSubstrings
	window.modifyClasses = modifyClasses
	window.updateAttributes = updateAttributes
	window.updateElements = updateElements
	window.processElementsByClass = processElementsByClass
})()
