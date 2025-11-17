var templateUri = systempress.templateUri || "./wp-content/themes/systempress/"

wp.blocks.registerBlockVariation("core/group", {
	name: "sp-card",
	title: "Card Image",
	category: "systempress-blocks",
	description: "Card layout with image top",
	icon: cardIcon,
	attributes: {
		className: "card",
		metadata: {
			name: "BS Card",
		},
	},
	innerBlocks: [
		[
			"core/image",
			{
				className: "card-img-top",
				url: `${templateUri}/assets/images/thumbnail-300x300.webp`,
				alt: "Placeholder Image",
				aspectRatio: "16/9",
				scale: "cover",
				sizeSlug: "medium",
				/*
				height: 200,
				width: 300,
				*/
				metadata: {
					name: "Card Img",
				},
			},
		],
		[
			"core/group",
			{
				className: "card-body",
				metadata: {
					name: "Card Body",
				},
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
						metadata: {
							name: "Card Title",
						},
					},
				],
				[
					"core/paragraph",
					{
						className: "card-text",
						content:
							"Some quick example text to build on the card title and make up the bulk of the card's content.",
						metadata: {
							name: "Card Text",
						},
					},
				],

				[
					"core/buttons",
					{},
					[
						[
							"core/button",
							{
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
	name: "sp-card-header",
	title: "Card with header",
	category: "systempress-blocks",
	description: "Card layout with header",
	icon: cardHeaderIcon,
	attributes: {
		className: "card",
		metadata: {
			name: "BS Card",
		},
	},
	innerBlocks: [
		[
			"core/heading",
			{
				className: "card-header h4",
				level: 3,
				content: "Card Header",
				metadata: {
					name: "Card Header",
				},
			},
		],
		[
			"core/group",
			{
				className: "card-body",
				metadata: {
					name: "Card Body",
				},
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
						metadata: {
							name: "Card Title",
						},
					},
				],
				[
					"core/paragraph",
					{
						className: "card-text",
						content:
							"Some quick example text to build on the card title and make up the bulk of the card's content.",
						metadata: {
							name: "Card Text",
						},
					},
				],

				[
					"core/buttons",
					{},
					[
						[
							"core/button",
							{
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
	name: "sp-card-featured",
	title: "Feature Card",
	category: "systempress-blocks",
	description: "Card featured layout",
	icon: cardFeaturedIcon,
	attributes: {
		className: "card text-center",
		metadata: {
			name: "BS Card",
		},
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
				metadata: {
					name: "Card Header",
				},
			},
		],
		[
			"core/group",
			{
				className: "card-body",
				metadata: {
					name: "Card Body",
				},
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
						metadata: {
							name: "Card Title",
						},
					},
				],
				[
					"core/paragraph",
					{
						className: "card-text",
						content:
							"With supporting text below as a natural lead-in to additional content.",
						metadata: {
							name: "Card Text",
						},
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
				metadata: {
					name: "Card Footer",
				},
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
