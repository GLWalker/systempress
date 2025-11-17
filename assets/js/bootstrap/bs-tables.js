;(function () {
	"use strict"

	const tables = document.querySelectorAll(".wp-block-table.table table")
	const toggles = document.querySelectorAll(".wp-block-table.table")

	tables.forEach((table, index) => {
		const toggle = toggles.item(index)

		// Add 'table' class to the table and remove from the toggle
		table.classList.add("table")
		toggle.classList.remove("table")

		// Define an array of table classes to move
		const tableClasses = [
			"table-bordered",
			"table-striped",
			"table-striped-columns",
			"table-hover",
			"table-borderless",
			"table-sm",
		]

		// Loop through each class and toggle it
		tableClasses.forEach((className) => {
			if (toggle.classList.contains(className)) {
				table.classList.add(className)
				toggle.classList.remove(className)
			}
		})
	})
})()
