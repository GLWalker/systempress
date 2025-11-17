// Select all toast elements
document.querySelectorAll(".toast").forEach((toastNode) => {
	// Initialize and show each toast with autohide disabled
	new bootstrap.Toast(toastNode, { autohide: false }).show()
})
