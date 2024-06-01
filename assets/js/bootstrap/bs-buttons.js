(function () {
	'use strict'

document.querySelectorAll(".wp-block-button .wp-block-button__link").forEach((element) => {
	element.classList.add("wp-element-button")
})

/* in case btn class is accidentally added to wp-block-element */
document.querySelectorAll(".btn.wp-block-button").forEach((element) => {
	element.classList.remove("btn")
})

document.querySelectorAll(".btn-toolbar").forEach((element) => {
	element.setAttribute("role", "toolbar"),
	element.setAttribute("aria-label", "Toolbar with button groups")
})

document.querySelectorAll(".btn-group").forEach((element) => {
	element.setAttribute("role", "group"),
	element.setAttribute("aria-label", "Button Group")
})

/*
document.querySelectorAll(".btn:not(.wp-block-button), .wp-element-button:not(.dropdown-toggle)").forEach((element) => {
	element.setAttribute("role", "button")
})
*/

document.querySelectorAll(".btn:not(.wp-block-button)").forEach((element) => {
	element.setAttribute("role", "button")
})

document.querySelectorAll(".wp-element-button").forEach((element) => {
	element.setAttribute("role", "button")
})


document.querySelectorAll(".disabled, disabled").forEach((element) => {
	element.setAttribute("aria-disabled", "true")
})

})();