wp.blocks.registerBlockVariation("core/buttons", {
	name: "sp-button-group",
	title: "Button Group",
	category: "systempress-blocks",
	description: "Bootstrap Button Group",
	attributes: {
		className: "btn-group",
		metadata: {
			name: "Button Group",
		},
		/*
		layout: {
			type: "flex",
			justifyContent: "right",
			orientation: "horizontal",
		  },
*/
	},

	innerBlocks: [
		[
			"core/button",
			{
				className: "btn-primary",
				text: "Button 1",
			},
		],
		[
			"core/button",
			{
				className: "btn-primary",
				text: "Button 2",
			},
		],
		[
			"core/button",
			{
				className: "btn-primary",
				text: "Button 3",
			},
		],
	],
})
wp.blocks.registerBlockVariation("core/buttons", {
	name: "sp-button-group-vert",
	title: "Button Group Vertical",
	category: "systempress-blocks",
	description: "Bootstrap Vertical Button Group",

	attributes: {
		className: "btn-group-vertical",
		/*
		layout: {
			type: "flex",
			justifyContent: "right",
			orientation: "horizontal",
		  },
*/
	},

	innerBlocks: [
		[
			"core/button",
			{
				className: "btn-primary",
				text: "Button 1",
			},
		],
		[
			"core/button",
			{
				className: "btn-primary",
				text: "Button 2",
			},
		],
		[
			"core/button",
			{
				className: "btn-primary",
				text: "Button 3",
			},
		],
	],
})

wp.blocks.registerBlockVariation("core/group", {
	name: "sp-toolbar",
	title: "Toolbar",
	category: "systempress-blocks",
	description: "Toolbar",
	icon: toolbarIcon,
	attributes: {
		className: "btn-toolbar",
		layout: {
			orientation: "horizontal",
		},
	},
	innerBlocks: [
		[
			"core/buttons",
			{
				className: "btn-group",
			},
			[
				[
					"core/button",
					{
						className: "btn-primary",
						text: "1",
					},
				],
				[
					"core/button",
					{
						className: "btn-primary",
						text: "2",
					},
				],
				[
					"core/button",
					{
						className: "btn-primary",
						text: "3",
					},
				],
				[
					"core/button",
					{
						className: "btn-primary",
						text: "4",
					},
				],
				[
					"core/button",
					{
						className: "btn-primary",
						text: "5",
					},
				],
				[
					"core/button",
					{
						className: "btn-primary",
						text: "6",
					},
				],
			],
		],
		/* insert new inner block here */
	],
})
