wp.blocks.registerBlockVariation("core/social-links", {
	name: "sp-off-canvas-trigger",
	title: "Off Canvas Menu",
	category: "systempress-blocks",
	icon: offCanvasIcon,

	attributes: {
		iconColor: "current",
		iconColorValue: "currentcolor",
		className: "is-style-logos-only off-canvas-trigger sp-icon-group",
	},

	innerBlocks: [
		[
			"core/social-link",
			{
				name: "off-canvas",
				title: "Off Canvas",
				category: "systempress-icons",
				icon: "off-canvas",

				service: "off-canvas",
				url: "#",
				label: "Toggle Off Canvas Menu",
			},
		],
	],
})
