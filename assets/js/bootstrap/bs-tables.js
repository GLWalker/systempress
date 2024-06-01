(function () {
	'use strict'


var tables = document.querySelectorAll(".wp-block-table.table table"),
	toggles = document.querySelectorAll(".wp-block-table.table");

var i = tables.length;

while (i--) {
	var table = tables.item(i);

	table.classList.add("table");
	var toggle = toggles.item(i);
	toggle.classList.remove("table");

	if (toggle.matches(".table-bordered")) {
		table.classList.add("table-bordered");
		toggle.classList.remove("table-bordered");
	}
	if (toggle.matches(".table-striped")) {
		table.classList.add("table-striped");
		toggle.classList.remove("table-striped");
	}
	if (toggle.matches(".table-striped-columns")) {
		table.classList.add("table-striped-columns");
		toggle.classList.remove("table-striped-columns");
	}
	if (toggle.matches(".table-hover")) {
		table.classList.add("table-hover");
		toggle.classList.remove("table-hover");
	}
	if (toggle.matches(".table-borderless")) {
		table.classList.add("table-borderless");
		toggle.classList.remove("table-borderless");
	}
	if (toggle.matches(".table-sm")) {
		table.classList.add("table-sm");
		toggle.classList.remove("table-sm");
	}
}

})();