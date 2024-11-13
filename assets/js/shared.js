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

	/* tool tip auto generate value
	querySelectorAll("[href]")
	*/
	function capitalizeFirstLetterOfEachWord(inputString) {
		return inputString.replace(
			/\b\w+/g,
			(match) => match.charAt(0).toUpperCase() + match.slice(1)
		)
	}

	/* redo some image markup */
	document
		.querySelectorAll("figure.wp-block-image.d-block > img")
		.forEach((element) => {
			element.classList.add("d-block"),
				element.parentNode.classList.remove("d-block")
		})
	document
		.querySelectorAll("figure.wp-block-image.w-100 > img")
		.forEach((element) => {
			element.classList.add("w-100"),
				element.parentNode.classList.remove("w-100")
		})

	document.querySelectorAll("figure.img-fluid img").forEach((element) => {
		element.classList.add("img-fluid"),
			element.parentNode.classList.remove("img-fluid")
	})

	document.querySelectorAll("div.img-fluid img").forEach((element) => {
		element.classList.add("img-fluid"),
			element.parentNode.classList.remove("img-fluid")
	})

	/* markup article elements */
	/*
	document.querySelectorAll(".site-header").forEach((element) => {
		element.setAttribute("id", "masthead"),
			element.setAttribute("aria-label", "Site"),
			element.setAttribute("itemtype", "https://schema.org/WPHeader"),
			element.setAttribute("itemscope", "")
	})
*/
	document
		.querySelectorAll(".site-header > .is-position-sticky")
		.forEach((element) => {
			element.classList.remove("is-position-sticky"),
				element.parentNode.classList.add("is-position-sticky")
		})

	document.querySelectorAll(".wp-block-site-logo").forEach((element) => {
		element.classList.add("site-logo")
	})
	/*
	document.querySelectorAll(".wp-block-site-title").forEach((element) => {
		element.classList.add("main-title"),
			element.setAttribute("itemprop", "headline")
	})
*/
	/*	document.querySelectorAll(".wp-block-site-tagline").forEach((element) => {
		element.classList.add("site-description"),
			element.setAttribute("itemprop", "description")
	})
*/
	/*	document.querySelectorAll("nav.wp-block-navigation").forEach((element) => {
		element.setAttribute(
			"itemtype",
			"https://schema.org/SiteNavigationElement"
		),
			element.setAttribute("itemscope", "")
	})
*/
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

	/*
	document.querySelectorAll("article.hentry").forEach((element) => {
		element.setAttribute("itemtype", "https://schema.org/CreativeWork"),
			element.setAttribute("itemscope", "")
	})
*/
	/* this is for the query loop *
	document
		.querySelectorAll(".wp-block-post.hentry > article")
		.forEach((element) => {
			element.setAttribute("itemtype", "https://schema.org/CreativeWork"),
				element.setAttribute("itemscope", "")
		})
*/
	/*
	document.querySelectorAll("article .entry-content").forEach((element) => {
		element.setAttribute("itemprop", "text")
	})
		*/
	/*
	document.querySelectorAll("article .entry-summary").forEach((element) => {
		element.setAttribute("itemprop", "text")
	})
*/
	/*
	document.querySelectorAll(".entry-meta").forEach((element) => {
		element.setAttribute("aria-label", "Entry meta")
	})
*/
	/*
	document
		.querySelectorAll(".entry-meta .taxonomy-category a")
		.forEach((element) => {
			element.setAttribute("rel", "category")
		})
*/
	/*
	document.querySelectorAll("article.comment-body").forEach((element) => {
		element.setAttribute("itemtype", "https://schema.org/Comment"),
			element.setAttribute("itemscope", "")
	})
*/
	/*
	document.querySelectorAll("footer.comment-meta").forEach((element) => {
		element.sestAttribute("aria-label", "Comment meta")
	})
*/ /*
	document
		.querySelectorAll(".wp-block-comment-content")
		.forEach((element) => {
			element.classList.add("comment-content"),
				element.setAttribute("itemprop", "text")
		})
*/
	/*
document.querySelectorAll(".wp-block-navigation-item.has-child.dropdown-toggle").forEach((element) => {
	element.classList.remove(".wp-block-navigation-submenu")
})
*/

	document.querySelectorAll(".jumbotron-placeholder").forEach((element) => {
		element.setAttribute("role", "alert")
	})

	document
		.querySelectorAll(".jumbotron-placeholder .btn-close")
		.forEach((element) => {
			element.setAttribute("type", "button"),
				element.setAttribute("data-bs-dismiss", "alert"),
				element.setAttribute("aria-label", "Close")
		})

	document.querySelectorAll(".media-object").forEach((element) => {
		element.classList.remove("is-nowrap"),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("is-content-justification")
				)
			),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("is-layout-")
				)
			),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("wp-block-group-")
				)
			),
			element.classList.remove.apply(
				element.classList,
				Array.from(element.classList).filter((v) =>
					v.startsWith("wp-container-core")
				)
			)
	})

	document
		.querySelectorAll(".media-object .flex-grow-1")
		.forEach((element) => {
			element.classList.remove("wp-block-group-is-layout-flow"),
				element.classList.remove("is-layout-flow")
		})

	document.querySelectorAll(".navsearch a").forEach((element) => {
		element.setAttribute("data-bs-toggle", "collapse"),
			element.setAttribute("data-bs-target", "navbarSearch"),
			element.setAttribute("aria-controls", "navbarSearch"),
			element.setAttribute("aria-expanded", "false"),
			element.setAttribute("aria-label", "Toggle search")
	})

	/**
	 * will add tool tip markup to the colors pattern color swatches. Need to add class .color-swatches to containing element then taget the object ,rounded-circle a.  Also need to place a class of use-tooltip somewhere in page markup to force the bs-tooltip css and js to load.
	 **/

	const anchors = document.querySelectorAll(
		".color-swatches .rounded-circle a"
	)
	anchors.forEach((anchor) => {
		const hrefValue = anchor.getAttribute("href")
		let titleValue = hrefValue
		titleValue = titleValue.replace("#", "")
		titleValue = titleValue.replace("-", " ")
		anchor.title = capitalizeFirstLetterOfEachWord(titleValue)
		anchor.setAttribute("data-bs-toggle", "tooltip")
		anchor.setAttribute("data-bs-title", anchor.title)
	})
})()

new WOW().init()
