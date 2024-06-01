(function () {
	'use strict'

  document.querySelectorAll(".toast").forEach((toastNode) => {
		const toast = new bootstrap.Toast(toastNode, {
			autohide: false,
		})

		toast.show()
	})

})();