;(function () {
	"use strict"

	//  Helper functions
	function escapeHtml(html) {
		return html
			.replace(/×/g, "&times;")
			.replace(/«/g, "&laquo;")
			.replace(/»/g, "&raquo;")
			.replace(/←/g, "&larr;")
			.replace(/→/g, "&rarr;")
	}

	function cleanSource(html) {
		// Escape HTML, split the lines to an Array, remove empty elements
		// and finally remove the last element
		let lines = escapeHtml(html).split("\n").filter(Boolean).slice(0, -1)
		const indentSize = lines[0].length - lines[0].trim().length
		const re = new RegExp(" {" + indentSize + "}")

		lines = lines.map((line) => {
			return re.test(line) ? line.slice(Math.max(0, indentSize)) : line
		})

		return lines.join("\n")
	}

	/* redo some image markup */
	document
		.querySelectorAll("figure.wp-block-image.d-block.w-100 > img")
		.forEach((element) => {
			element.classList.add("d-block"), element.classList.add("w-100")
		})

	document
		.querySelectorAll("figure.wp-block-image.d-block.w-100")
		.forEach((element) => {
			element.classList.remove("d-block"),
				element.classList.remove("w-100")
		})

	/* markup article elements */

	document.querySelectorAll(".site-header").forEach((element) => {
		element.setAttribute("aria-label", "Site"),
			element.setAttribute("itemtype", "https://schema.org/WPHeader"),
			element.setAttribute("itemscope", "")
	})

	document.querySelectorAll(".wp-block-site-logo").forEach((element) => {
		element.classList.add("site-logo")
	})

	document.querySelectorAll(".wp-block-site-title").forEach((element) => {
		element.classList.add("main-title"),
			element.setAttribute("itemprop", "headline")
	})

	document.querySelectorAll(".wp-block-site-tagline").forEach((element) => {
		element.classList.add("site-description"),
			element.setAttribute("itemprop", "description")
	})

	document.querySelectorAll("nav.wp-block-navigation").forEach((element) => {
		element.setAttribute(
			"itemtype",
			"https://schema.org/SiteNavigationElement"
		),
			element.setAttribute("itemscope", "")
	})

	document.querySelectorAll(".current-menu-item > a").forEach((element) => {
		element.classList.add("active")
	})

	document
		.querySelectorAll("nav.wp-block-navigation.nav-pills")
		.forEach((element) => {
			element.classList.remove("nav-pills"),
				element.classList.remove("nav"),
				element.classList.remove("wp-block-navigation"),
				element.classList.remove("is-layout-flex"),
				element.classList.remove("wp-block-navigation-is-layout-flex")
		})

	document
		.querySelectorAll("ul.wp-block-navigation.nav.nav-pills")
		.forEach((element) => {
			element.classList.remove("wp-block-navigation"),
				element.classList.remove("wp-block-navigation__container"),
				element.classList.remove("items-justified-space-between")
		})

	document.querySelectorAll("ul.nav.nav-pills li").forEach((element) => {
		element.classList.remove("wp-block-navigation-item"),
			element.classList.add("nav-item")
	})

	document.querySelectorAll("ul.nav.nav-pills li a").forEach((element) => {
		element.classList.remove("wp-block-navigation-item__content"),
			element.classList.add("nav-link")
	})

	document.querySelectorAll("article.hentry").forEach((element) => {
		element.setAttribute("itemtype", "https://schema.org/CreativeWork"),
			element.setAttribute("itemscope", "")
	})

	document
		.querySelectorAll("article div.entry-content")
		.forEach((element) => {
			element.setAttribute("itemprop", "text")
		})

	document.querySelectorAll("footer.entry-meta").forEach((element) => {
		element.setAttribute("aria-label", "Entry meta")
	})

	document.querySelectorAll("article.comment-body").forEach((element) => {
		element.setAttribute("itemtype", "https://schema.org/Comment"),
			element.setAttribute("itemscope", "")
	})

	document.querySelectorAll("footer.comment-meta").forEach((element) => {
		element.setAttribute("aria-label", "Comment meta")
	})

	document
		.querySelectorAll(".wp-block-comment-content")
		.forEach((element) => {
			element.classList.add("comment-content"),
				element.setAttribute("itemprop", "text")
		})

	/*
document.querySelectorAll(".wp-block-navigation-item.has-child.dropdown-toggle").forEach((element) => {
	element.classList.remove(".wp-block-navigation-submenu")
})
*/
})()
