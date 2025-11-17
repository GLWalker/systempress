wp.blocks.registerBlockVariation("core/list", {
	name: "sp-list-group",
	title: "List Group",
	category: "systempress-blocks",
	description: "Bootstrap list group",
	category: "systempress-blocks",
	icon: "list-view",
	attributes: {
		className: "list-group",
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
	name: "sp-list-group-numbered",
	title: "List Group Numbered",
	category: "systempress-blocks",
	description: "Bootstrap list group numbered",
	category: "systempress-blocks",
	icon: "list-view",
	attributes: {
		ordered: true,
		className: "list-group list-group-numbered",
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
	name: "sp-list-group-custom",
	title: "List Group Custom Content",
	category: "systempress-blocks",
	description: "Bootstrap list group custom layout",
	icon: "list-view",
	attributes: {
		className: "list-group",
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
					{ className: "w-100" },
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
					{ className: "w-100" },
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
					{ className: "w-100" },
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
						content: '<span class="badge rounded-pill">14</span>',
					},
				],
			],
		],
	],
})

wp.blocks.registerBlockVariation("core/list", {
	name: "sp-list-group-numbered-custom",
	title: "List Group Numbered Custom Content",
	category: "systempress-blocks",
	description: "Bootstrap numbered list group custom layout",
	icon: "list-view",
	attributes: {
		className: "list-group list-group-numbered",
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
					{ className: "w-100" },
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
					{ className: "w-100" },
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
					{ className: "w-100" },
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
						content: '<span class="badge rounded-pill">14</span>',
					},
				],
			],
		],
	],
})
