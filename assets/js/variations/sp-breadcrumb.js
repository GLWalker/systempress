wp.blocks.registerBlockVariation("core/group", {
	name: "sp-breadcrumb",
	title: "Breadcrumb",
	category: "systempress-blocks",
	description: "Example breadcrumbs markup",
	icon: breadcrumbIcon,
	attributes: {
		className: "bs-breadcrumbs",
		layout: {
			orientation: "horizontal",
		},
		tagName: "nav",
		metadata: {
			name: "BS Breadcrumbs",
		},
	},
	innerBlocks: [
		[
			"core/list",
			{
				className: "breadcrumb",
				ordered: true,
				metadata: {
					name: "Breadcrumb",
				},
			},
			[
				[
					"core/list-item",
					{
						className: "breadcrumb-item",
						content: '<a href="#">Home</a>',
						metadata: {
							name: "Breadcrumb Item",
						},
					},
				],
				[
					"core/list-item",
					{
						className: "breadcrumb-item",
						content: '<a href="#">Library</a>',
						metadata: {
							name: "Breadcrumb Item",
						},
					},
				],
				[
					"core/list-item",
					{
						className: "breadcrumb-item active",
						content: "Data",
						metadata: {
							name: "Breadcrumb Item Active",
						},
					},
				],
			],
		],
	],
})
