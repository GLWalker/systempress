;(function () {
	"use strict"

	document.querySelectorAll(".list-group li").forEach((element) => {
		element.classList.add("list-group-item")
	})

	document
		.querySelectorAll(".list-group-item-action li")
		.forEach((element) => {
			element.classList.add("list-group-item-action")
		})

	document
		.querySelectorAll(".list-group.list-group-item-action")
		.forEach((element) => {
			element.classList.remove("list-group-item-action")
		})

	document.querySelectorAll(".card .list-group").forEach((element) => {
		element.classList.add("list-group-flush")
	})

	document
		.querySelectorAll(".list-group.stretched-link a")
		.forEach((element) => {
			element.classList.add("stretched-link")
		})

	document
		.querySelectorAll(".list-group.stretched-link")
		.forEach((element) => {
			element.classList.remove("stretched-link")
		})

	document
		.querySelectorAll(".wp-block-archives.list-group li")
		.forEach((element) => {
			element.classList.add("d-flex"),
				element.classList.add("justify-content-between"),
				element.classList.add("align-items-start")
		})

	var x = document.querySelectorAll(".wp-block-archives.list-group li")
	var i = ""

	for (i = 0; i < x.length; i++) {
		var text = x[i].innerHTML
		x[i].innerHTML = text
			.replace(/\(/gi, '<span class="badge">')
			.replace(/\)/gi, "</span>")
	}

	document
		.querySelectorAll(".wp-block-categories.list-group li")
		.forEach((element) => {
			element.classList.add("d-flex"),
				element.classList.add("justify-content-between"),
				element.classList.add("align-items-start")
		})

	var x = document.querySelectorAll(".wp-block-categories.list-group li")
	var i = ""

	for (i = 0; i < x.length; i++) {
		var text = x[i].innerHTML
		x[i].innerHTML = text
			.replace(/\(/gi, '<span class="badge">')
			.replace(/\)/gi, "</span>")
	}

	document
		.querySelectorAll('.list-group a[aria-current="page"]')
		.forEach((element) => {
			element.parentNode.classList.add("active")
		})

	document
		.querySelectorAll(".list-group.wp-block-navigation")
		.forEach((element) => {
			element.classList.remove("wp-block-navigation"),
				element.classList.remove("wp-block-navigation__container")
		})

	document
		.querySelectorAll(".list-group.wp-block-navigation-is-layout-flex")
		.forEach((element) => {
			element.classList.remove("is-layout-flex"),
				element.classList.remove("wp-block-navigation-is-layout-flex")
		})

	document.querySelectorAll("nav.list-group").forEach((element) => {
		element.classList.remove("list-group-flush"),
			element.classList.remove("list-group")
	})

	document
		.querySelectorAll(".list-group .wp-block-navigation-item")
		.forEach((element) => {
			element.classList.remove("wp-block-navigation-link"),
				element.classList.remove("wp-block-navigation-item")
		})

	document
		.querySelectorAll(".list-group a.wp-block-navigation-item__content")
		.forEach((element) => {
			element.classList.add("d-block")
		})
})()
