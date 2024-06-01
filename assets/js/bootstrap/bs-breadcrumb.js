(function () {
	'use strict'

document.querySelectorAll(".bs-breadcrumbs").forEach((element) => {
	element.setAttribute("aria-label", "breadcrumb")
})

document.querySelectorAll(".breadcrumb-item.active").forEach((element) => {
	element.setAttribute("aria-current", "page")
})

})();