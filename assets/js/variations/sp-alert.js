wp.blocks.registerBlockVariation("core/group", {
	name: "sp-alert",
	title: "Alert",
	category: "systempress-blocks",
	description: "Basic BootStrap alert",
	icon: alertIcon,
	attributes: {
		className: "alert",

		metadata: {
			name: "BS Alert",
		},
	},
	innerBlocks: [
		[
			"core/paragraph",
			{
				metadata: {
					name: "Alert Content",
				},
				content:
					'A simple <strong>alert</strong> with an <a href="#" class="alert-link">example link</a>. Give it a click if you like.',
			},
		],
	],
})

wp.blocks.registerBlockVariation("core/group", {
	name: "alert-dismiss",
	title: "Alert Dismiss",
	description: "Dismissible BootStrap alert",
	category: "systempress-blocks",
	icon: alertCloseIcon,
	attributes: {
		className: "alert alert-dismissible fade show",
		metadata: {
			name: "BS Alert Dismiss",
		},
	},

	innerBlocks: [
		[
			"core/paragraph",
			{
				metadata: {
					name: "Alert Content",
				},
				content:
					'A simple <strong>alert</strong> with an <a href="#" class="alert-link">example link</a>. Give it a click if you like.',
			},
		],
		[
			"core/paragraph",
			{
				metadata: {
					name: "Alert Close",
				},
				className: "btn-close",
				content: "&nbsp;",
			},
		],
	],
})
