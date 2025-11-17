document
	.querySelectorAll(".wp-block-button .wp-block-button__link")
	.forEach((element) => {
		element.classList.add("wp-element-button")
	})

/* in case btn class is accidentally added to wp-block-element */
document.querySelectorAll(".btn.wp-block-button").forEach((element) => {
	element.classList.remove("btn")
})
