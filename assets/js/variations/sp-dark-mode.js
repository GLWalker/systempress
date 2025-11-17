wp.blocks.registerBlockVariation("core/group", {
	name: "dark-mode",
	title: "Dark Mode",
	description: "Dark Mode Switch",
	category: "systempress-blocks",
	icon: darkModeIcon,
	attributes: {
		className: "dropdown dark-mode",
		layout: {
			type: "flex",
			orientation: "horizontal",
		},
	},

	innerBlocks: [
		[
			"core/separator",
			{
				className: "sp-action-hook sp_hook_dark_mode",
			},
		],
	],
})
