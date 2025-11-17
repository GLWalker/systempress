wp.blocks.registerBlockVariation("core/social-links", {
	name: "sp-search-modal-trigger",
	title: "Search Modal",
	category: "systempress-blocks",
	icon: searchIcon,
	attributes: {
		iconColor: "current",
		iconColorValue: "currentcolor",
		className: "is-style-logos-only search-modal-trigger sp-icon-group",
	},

	innerBlocks: [
		[
			"core/social-link",
			{
				name: "search-modal",
				title: "Search Modal",
				category: "systempress-icons",
				icon: "search-modal",

				service: "search-modal",
				url: "#",
				label: "Toggle Search Form",
			},
		],
	],
})
