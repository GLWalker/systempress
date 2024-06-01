(function () {
	'use strict'

document.querySelectorAll(".alert").forEach((element) => {
	element.setAttribute("role", "alert")
})

document.querySelectorAll(".alert.alert-dismissible .btn-close").forEach((element) => {
    element.setAttribute("type", "button"),
	element.setAttribute("data-bs-dismiss", "alert"),
    element.setAttribute("aria-label", "Close")
})

})();