(function () {
	'use strict'

document.querySelectorAll(".list-group li").forEach((element) => {
	element.classList.add("list-group-item")
})

document.querySelectorAll(".list-group-item-action li").forEach((element) => {
	element.classList.add("list-group-item-action")
})

document.querySelectorAll("ul.list-group-item-action").forEach((element) => {
	element.classList.remove("list-group-item-action")
})

document.querySelectorAll(".wp-block-archives.list-group li").forEach((element) => {
	element.classList.add("d-flex"),
	element.classList.add("justify-content-between"),
	element.classList.add("align-items-start")
})


var x = document.querySelectorAll(".wp-block-archives li");
var i = '';

for (i = 0; i < x.length; i++) {
    var text = x[i].innerHTML;
    x[i].innerHTML = text.replace(/\(/gi, "<span class=\"badge has-accent-background-color\">").replace(/\)/gi, "</span>");
}

})();