/**
 * Social Icon block variations to allow Dashicons to be used with no hyperlink. You can however, still use a hyperlink. These variations simply add an anchor for the link, then the frontend functions strip it out.
 *
 * @package SystemPress
 *
 *
 * <!-- wp:social-links {"iconColor":"current","iconColorValue":"currentcolor","showLabels":true,"size":"has-large-icon-size","className":"is-style-logos-only search-modal-trigger","layout":{"type":"flex","flexWrap":"nowrap"}} -->
<ul class="wp-block-social-links has-large-icon-size has-visible-labels has-icon-color is-style-logos-only search-modal-trigger"><!-- wp:social-link {"url":"#","service":"search-modal","label":"Toggle Search Form"} /--></ul>
<!-- /wp:social-links -->
 */

wp.blocks.registerBlockVariation("core/social-links", {
	name: "off-canvas-trigger",
	title: "Off Canvas Menu",
	category: "systempress-blocks",
	icon: "slides",

	attributes: {
		name: "Search Modal Trigger",
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

wp.blocks.registerBlockVariation("core/social-links", {
	name: "search-modal-trigger",
	title: "Search Modal",
	category: "systempress-blocks",
	icon: "search",
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

wp.blocks.registerBlockVariation("core/social-links", {
	name: "sp-dashicon-icons",
	title: "Dashicons",
	category: "systempress-blocks",
	icon: "superhero",

	attributes: {
		className: "is-style-logos-only sp-icon-group",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "book",
	title: "Book",
	category: "systempress-icons",
	icon: "book",

	attributes: {
		service: "book",
		url: "#",
		className: "svg-di-book",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "book-alt",
	title: "Book Alt",
	category: "systempress-icons",
	icon: "book-alt",

	attributes: {
		service: "book-alt",
		url: "#",
		className: "svg-di-book-alt",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "calendar",
	title: "Calendar",
	category: "systempress-icons",
	icon: "calendar",

	attributes: {
		service: "calendar",
		url: "#",
		className: "svg-di-calendar",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "calendar-alt",
	title: "Calendar Alt",
	category: "systempress-icons",
	icon: "calendar-alt",

	attributes: {
		service: "calendar-alt",
		url: "#",
		className: "svg-di-calendar-alt",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "category",
	title: "Category",
	category: "systempress-icons",
	icon: "category",

	attributes: {
		service: "category",
		url: "#",
		className: "svg-di-category",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "edit",
	title: "Edit",
	category: "systempress-icons",
	icon: "edit",

	attributes: {
		service: "edit",
		url: "#",
		className: "svg-di-edit",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "email",
	title: "Email",
	category: "systempress-icons",
	icon: "email",

	attributes: {
		service: "email",
		url: "#",
		className: "svg-di-email",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "location",
	title: "Location",
	category: "systempress-icons",
	icon: "location",

	attributes: {
		service: "location",
		url: "#",
		className: "svg-di-location",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "megaphone",
	title: "Megaphone",
	category: "systempress-icons",
	icon: "megaphone",

	attributes: {
		service: "megaphone",
		url: "#",
		className: "svg-di-megaphone",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "phone",
	title: "Phone",
	category: "systempress-icons",
	icon: "phone",

	attributes: {
		service: "phone",
		url: "#",
		className: "svg-di-phone",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "portfolio",
	title: "Portfolio",
	category: "systempress-icons",
	icon: "portfolio",

	attributes: {
		service: "portfolio",
		url: "#",
		className: "svg-di-portfolio",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "search",
	title: "Search",
	category: "systempress-icons",
	icon: "search",

	attributes: {
		service: "search",
		url: "#",
		className: "svg-di-search",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "share-alt2",
	title: "Share alt2",
	category: "systempress-icons",
	icon: "share-alt2",

	attributes: {
		service: "share-alt2",
		url: "#",
		className: "svg-di-share-alt2",
	},
})

wp.blocks.registerBlockVariation("core/social-link", {
	name: "tag",
	title: "Tag",
	category: "systempress-icons",
	icon: "tag",

	attributes: {
		service: "tag",
		url: "#",
		className: "svg-di-tag",
	},
})
