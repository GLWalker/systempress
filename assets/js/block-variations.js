/**
 *
 * Javascript functions used by block editor
 *
 * @package SystemPress
 *
 * wp.blocks.registerBlockStyle("core/list-group-archives", {
        name: 'green-wennie',
        label: wp.i18n.__('Green Wennie', 'textdomain')

    });
 */

wp.blocks.registerBlockVariation("core/separator", {
	name: "sp-action-hook",
	title: "SP Action Hook",
	category: "systempress-blocks",
	icon: "migrate",
	attributes: {
		className: "sp-action-hook",
	},
})

wp.blocks.registerBlockVariation("core/group", {
	name: "accordion",
	title: "Accordion",
	category: "systempress-blocks",
	description:
		'Bootstrap "kinda like" Accordion using WordPress details block',
	icon: "menu-alt2",
	attributes: {
		className: "accordion",
	},

	innerBlocks: [
		[
			"core/details",
			{
				className: "accordion-item",
				summary: "Accordion Heading 1",
			},
			[
				[
					"core/group",
					{ className: "accordion-collapse" },
					[
						[
							"core/group",
							{
								className: "accordion-body",
							},

							[
								[
									"core/paragraph",
									{
										content:
											"<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
									},
								],
							],
						],
					],
				],
			],
		],
		[
			"core/details",
			{
				className: "accordion-item",
				summary: "Accordion Heading 2",
			},
			[
				[
					"core/group",
					{ className: "accordion-collapse" },
					[
						[
							"core/group",
							{
								className: "accordion-body",
							},

							[
								[
									"core/paragraph",
									{
										content:
											"<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
									},
								],
							],
						],
					],
				],
			],
		],
		[
			"core/details",
			{
				className: "accordion-item",
				summary: "Accordion Heading 3",
			},
			[
				[
					"core/group",
					{ className: "accordion-collapse" },
					[
						[
							"core/group",
							{
								className: "accordion-body",
							},

							[
								[
									"core/paragraph",
									{
										content:
											"<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.",
									},
								],
							],
						],
					],
				],
			],
		],
	],
})

wp.blocks.registerBlockVariation("core/group", {
	name: "alert",
	title: "Alert",
	category: "systempress-blocks",
	description: "Basic BootStrap alert",
	icon: "warning",
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
	icon: "dismiss",
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
				content:
					'A simple <strong>alert</strong> with an <a href="#" class="alert-link">example link</a>. Give it a click if you like.',
			},
		],
		[
			"core/paragraph",
			{
				className: "btn-close",
				content: "&nbsp;",
			},
		],
	],
})

wp.blocks.registerBlockVariation("core/list", {
	name: "list-group",
	title: "List Group",
	category: "systempress-blocks",
	description: "Bootstrap list group",
	category: "systempress-blocks",
	icon: "list-view",
	attributes: {
		className: "list-group ps-0 list-group-item-action",
	},

	innerBlocks: [
		[
			"core/list-item",
			{ className: "list-group-item", content: "An item" },
		],
		[
			"core/list-item",
			{ className: "list-group-item", content: "A second item" },
		],
		[
			"core/list-item",
			{ className: "list-group-item", content: "A third item" },
		],
		[
			"core/list-item",
			{ className: "list-group-item", content: "A fourth item" },
		],
		[
			"core/list-item",
			{ className: "list-group-item", content: "And a fifth one" },
		],
	],
})

wp.blocks.registerBlockVariation("core/list", {
	name: "list-group-numbered",
	title: "List Group Numbered",
	category: "systempress-blocks",
	description: "Bootstrap numbered list group ",
	icon: "list-view",
	attributes: {
		ordered: true,
		className: "list-group list-group-numbered ps-0 list-group-item-action",
	},
	innerBlocks: [
		[
			"core/list-item",
			{ className: "list-group-item", content: "An item" },
		],
		[
			"core/list-item",
			{ className: "list-group-item", content: "A second item" },
		],
		[
			"core/list-item",
			{ className: "list-group-item", content: "A third item" },
		],
		[
			"core/list-item",
			{ className: "list-group-item", content: "A fourth item" },
		],
		[
			"core/list-item",
			{ className: "list-group-item", content: "And a fifth one" },
		],
	],
})

wp.blocks.registerBlockVariation("core/list", {
	name: "list-group-custom",
	title: "List Group Custom Content",
	category: "systempress-blocks",
	description: "Bootstrap list group custom layout",
	icon: "list-view",
	attributes: {
		className: "list-group p-0 list-group-item-action",
	},
	innerBlocks: [
		[
			"core/list-item",
			{
				className:
					"list-group-item d-flex justify-content-between align-items-start",
				content: "&nbsp;",
			},
			[
				[
					"core/group",
					{ className: "ms-1 me-auto" },
					[
						[
							"core/paragraph",
							{
								className: "w-100",
								content: "<strong>Subheading</strong>",
							},
						],
						[
							"core/paragraph",
							{
								content: "Content for list item",
							},
						],
					],
				],

				[
					"core/paragraph",
					{
						className: "p-0",
						content: '<span class="badge rounded-pill">14</span>',
					},
				],
			],
		],
		[
			"core/list-item",
			{
				className:
					"list-group-item d-flex justify-content-between align-items-start",
				content: "&nbsp;",
			},
			[
				[
					"core/group",
					{ className: "ms-1 me-auto" },
					[
						[
							"core/paragraph",
							{
								className: "w-100",
								content: "<strong>Subheading</strong>",
							},
						],
						[
							"core/paragraph",
							{
								content: "Content for list item",
							},
						],
					],
				],

				[
					"core/paragraph",
					{
						className: "p-0",
						content: '<span class="badge rounded-pill">14</span>',
					},
				],
			],
		],
		[
			"core/list-item",
			{
				className:
					"list-group-item d-flex justify-content-between align-items-start",
				content: "&nbsp;",
			},
			[
				[
					"core/group",
					{ className: "ms-1 me-auto" },
					[
						[
							"core/paragraph",
							{
								className: "w-100",
								content: "<strong>Subheading</strong>",
							},
						],
						[
							"core/paragraph",
							{
								content: "Content for list item",
							},
						],
					],
				],

				[
					"core/paragraph",
					{
						className: "p-0",
						content: '<span class="badge rounded-pill">14</span>',
					},
				],
			],
		],
	],
})

wp.blocks.registerBlockVariation("core/list", {
	name: "list-group-numbered-custom",
	title: "List Group Numbered Custom Content",
	category: "systempress-blocks",
	description: "Bootstrap numbered list group custom layout",
	icon: "list-view",
	attributes: {
		ordered: true,
		className: "list-group list-group-numbered p-0 list-group-item-action",
	},
	innerBlocks: [
		[
			"core/list-item",
			{
				className:
					"list-group-item d-flex justify-content-between align-items-start",
				content: "&nbsp;",
			},
			[
				[
					"core/group",
					{ className: "ms-1 me-auto" },
					[
						[
							"core/paragraph",
							{
								className: "w-100",
								content: "<strong>Subheading</strong>",
							},
						],
						[
							"core/paragraph",
							{
								content: "Content for list item",
							},
						],
					],
				],

				[
					"core/paragraph",
					{
						className: "p-0",
						content: '<span class="badge rounded-pill">14</span>',
					},
				],
			],
		],
		[
			"core/list-item",
			{
				className:
					"list-group-item d-flex justify-content-between align-items-start",
				content: "&nbsp;",
			},
			[
				[
					"core/group",
					{ className: "ms-1 me-auto" },
					[
						[
							"core/paragraph",
							{
								className: "w-100",
								content: "<strong>Subheading</strong>",
							},
						],
						[
							"core/paragraph",
							{
								content: "Content for list item",
							},
						],
					],
				],

				[
					"core/paragraph",
					{
						className: "p-0",
						content: '<span class="badge rounded-pill">14</span>',
					},
				],
			],
		],
		[
			"core/list-item",
			{
				className:
					"list-group-item d-flex justify-content-between align-items-start",
				content: "&nbsp;",
			},
			[
				[
					"core/group",
					{ className: "ms-1 me-auto" },
					[
						[
							"core/paragraph",
							{
								className: "w-100",
								content: "<strong>Subheading</strong>",
							},
						],
						[
							"core/paragraph",
							{
								content: "Content for list item",
							},
						],
					],
				],

				[
					"core/paragraph",
					{
						className: "p-0",
						content: '<span class="badge rounded-pill">14</span>',
					},
				],
			],
		],
	],
})

wp.blocks.registerBlockVariation("core/archives", {
	name: "list-group-archives",
	title: "List Group Archives",
	description: "WordPress archives widget with BootStrap list group markup",
	category: "systempress-blocks",
	attributes: {
		className: "list-group list-group-item-action stretched-link",
		displayAsDropdown: false,
		showPostCounts: true,
	},
})

wp.blocks.registerBlockVariation("core/categories", {
	name: "list-group-categories",
	title: "List Group Categories",
	description: "WordPress categories widget with BootStrap list group markup",
	category: "systempress-blocks",
	attributes: {
		className: "list-group list-group-item-action stretched-link",
		displayAsDropdown: false,
		showHierarchy: false,
		showPostCounts: true,
		showOnlyTopLevel: true,
		showEmpty: false,
	},
})

wp.blocks.registerBlockVariation("core/buttons", {
	name: "button-group",
	title: "Button Group",
	category: "systempress-blocks",
	description: "Bootstrap Button Group",
	attributes: {
		className: "btn-group",
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
	name: "button-group-vert",
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
	name: "toolbar",
	title: "Toolbar",
	category: "systempress-blocks",
	description: "Bootstrap toolbar",
	icon: "admin-tools",
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

wp.blocks.registerBlockVariation("core/group", {
	name: "breadcrumbs",
	title: "Breadcrumb",
	category: "systempress-blocks",
	description: "Example breadcrumbs markup",
	icon: "arrow-right",
	attributes: {
		className: "bs-breadcrumbs",
		layout: {
			orientation: "horizontal",
		},
		tagName: "nav",
	},
	innerBlocks: [
		[
			"core/list",
			{
				className: "breadcrumb",
				ordered: true,
			},
			[
				[
					"core/list-item",
					{
						className: "breadcrumb-item",
						content: '<a href="#">Home</a>',
					},
				],
				[
					"core/list-item",
					{
						className: "breadcrumb-item",
						content: '<a href="#">Library</a>',
					},
				],
				[
					"core/list-item",
					{
						className: "breadcrumb-item active",
						content: "Data",
					},
				],
			],
		],
		/* insert new inner block here */
	],
})

wp.blocks.registerBlockVariation("core/group", {
	name: "card",
	title: "Card Image",
	category: "systempress-blocks",
	description: "Card layout with image top",
	icon: "welcome-widgets-menus",
	attributes: {
		className: "card",
	},
	innerBlocks: [
		[
			"core/image",
			{
				className: "card-img-top",
				url: "./wp-content/themes/systempress/assets/images/thumbnail-300x300.webp",
				alt: "Click use external image on image toolbar to view image in editor",
				aspectRatio: "16/9",
				scale: "cover",
				sizeSlug: "medium",
				/*
				height: 200,
				width: 300,
				*/
			},
		],
		[
			"core/group",
			{
				className: "card-body",
			},

			[
				[
					"core/heading",
					{
						className: "h5 card-title",
						level: 3,
						/*
						placeholder: "Card Title",
						*/
						content: "Card Title",
					},
				],
				[
					"core/paragraph",
					{
						className: "card-text",
						content:
							"Some quick example text to build on the card title and make up the bulk of the card's content.",
					},
				],

				[
					"core/buttons",
					{},
					[
						[
							"core/button",
							{
								className: "btn-",
								text: "Button",
								width: "100",
							},
						],
					],
				],
			],
		],

		/* insert new inner block here */
	],
})

wp.blocks.registerBlockVariation("core/group", {
	name: "card-header",
	title: "Card with header",
	category: "systempress-blocks",
	description: "Card layout with header",
	icon: "welcome-widgets-menus",
	attributes: {
		className: "card",
	},
	innerBlocks: [
		[
			"core/heading",
			{
				className: "card-header h4",
				level: 3,
				/*
				placeholder: "Card Header",
				*/
				content: "Card Header",
			},
		],
		[
			"core/group",
			{
				className: "card-body",
			},

			[
				[
					"core/heading",
					{
						className: "card-title h5",
						level: 4,
						/*
						placeholder: "Card Title",
						*/
						content: "Card Title",
					},
				],
				[
					"core/paragraph",
					{
						className: "card-text",
						content:
							"Some quick example text to build on the card title and make up the bulk of the card's content.",
					},
				],

				[
					"core/buttons",
					{},
					[
						[
							"core/button",
							{
								className: "btn-",
								text: "Button",
								width: "100",
							},
						],
					],
				],
			],
		],

		/* insert new inner block here */
	],
})

wp.blocks.registerBlockVariation("core/group", {
	name: "card-img-overlay",
	title: "Card Image Overlay",
	category: "systempress-blocks",
	description: "Card image with overlay",
	icon: "welcome-widgets-menus",
	attributes: {
		className: "card bg-dark",
	},
	innerBlocks: [
		[
			"core/image",
			{
				className: "card-img",
				url: "./wp-content/themes/systempress/assets/images/thumbnail-300x300.webp",
				alt: "Click upload external image on toolbar to view this image in editor",
				sizeSlug: "large",
				/*
				height: 200,
				width: 300,
				*/
			},
		],
		[
			"core/group",
			{
				className: "card-img-overlay p-5",
			},

			[
				[
					"core/heading",
					{
						className:
							"card-title h5 bg-light-50 p-3 mb-3 rounded-3",
						level: 3,
						/*
						placeholder: "Card Title",
						*/
						content: "Card Title",
					},
				],
				[
					"core/paragraph",
					{
						className: "card-text bg-light-50 p-3 rounded-3",
						content:
							"This block won't look so well in the editor, but its going to rock the front end!",
					},
				],

				[
					"core/buttons",
					{},
					[
						[
							"core/button",
							{
								className: "btn-lg",
								text: "Click Me",
								width: "100",
							},
						],
					],
				],
			],
		],

		/* insert new inner block here */
	],
})

wp.blocks.registerBlockVariation("core/group", {
	name: "card-featured",
	title: "Feature Card",
	category: "systempress-blocks",
	description: "Card featured layout",
	icon: "welcome-widgets-menus",
	attributes: {
		className: "card text-center",
	},
	innerBlocks: [
		[
			"core/heading",
			{
				className: "card-header h4",
				level: 3,
				/*
				placeholder: "Card Header",
				*/
				content: "Featured",
			},
		],
		[
			"core/group",
			{
				className: "card-body",
			},

			[
				[
					"core/heading",
					{
						className: "card-title h5",
						level: 4,
						/*
						placeholder: "Card Title",
						*/
						content: "Special title treatment",
					},
				],
				[
					"core/paragraph",
					{
						className: "card-text",
						content:
							"With supporting text below as a natural lead-in to additional content.",
					},
				],

				[
					"core/buttons",
					{
						layout: {
							justifyContent: "center",
						},
					},
					[
						[
							"core/button",
							{
								text: "Go Somewhere",
							},
						],
					],
				],
			],
		],
		[
			"core/group",
			{
				className: "card-footer text-body-secondary",
			},

			[
				[
					"core/paragraph",
					{
						content: "2 days ago",
					},
				],
			],
		],

		/* insert new inner block here */
	],
})

wp.blocks.registerBlockVariation("core/group", {
	name: "dark-mode",
	title: "Dark Mode",
	description: "Dark Mode Switch",
	category: "systempress-blocks",
	icon: "star-half",
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

wp.blocks.registerBlockVariation("core/buttons", {
	name: "bs-modal-button",
	title: "Bootstrap Modal Button",
	category: "systempress-blocks",
	description:
		"A button that triggers a Bootstrap Modal. Add the class toggle-modal_* replacing * with the modal id",
	icon: "welcome-view-site",
	attributes: {
		metadata: {
			name: "BS Modal Button",
		},
		layout: {
			type: "flex",
			flexWrap: "nowrap",
		},
	},
	innerBlocks: [
		[
			"core/button",
			{
				className: "toggle-modal_spModal",
				text: "Launch Modal",
			},
		],
	],
	scope: ["inserter"],
})

wp.blocks.registerBlockVariation("core/group", {
	name: "bs-modal",
	title: "Bootstrap Modal",
	category: "systempress-blocks",
	description:
		"A fully customizable Bootstrap Modal structure. Add the class modal-label_* replacing * with the modal heading id",
	icon: "editor-table",
	attributes: {
		metadata: {
			name: "BS Modal",
		},
		anchor: "spModal", // Set the id for the modal
		className: "modal fade modal-label_spModalLabel",
		layout: {
			type: "default",
		},
	},
	innerBlocks: [
		[
			"core/group",
			{
				className: "modal-dialog",
			},
			[
				[
					"core/group",
					{
						className: "modal-content",
					},
					[
						[
							"core/group",
							{
								className: "modal-header",
							},
							[
								[
									"core/heading",
									{
										level: 3,
										className: "modal-title fs-5",
										content: "Modal title",
										anchor: "spModalLabel",
									},
								],
								[
									"core/paragraph",
									{
										className: "btn-close",
										content: "&nbsp;",
									},
								],
							],
						],
						[
							"core/group",
							{
								className: "modal-body",
							},
							[
								[
									"core/paragraph",
									{
										content: "Place content here",
									},
								],
							],
						],
						[
							"core/buttons",
							{
								className: "modal-footer",
								layout: {
									type: "flex",
									justifyContent: "right",
									flexWrap: "nowrap",
								},
							},
							[
								[
									"core/button",
									{
										className: "btn-secondary modal-close",
										text: "Close",
									},
								],
								[
									"core/button",
									{
										text: "Save changes",
									},
								],
							],
						],
					],
				],
			],
		],
	],
	scope: ["inserter"],
})
