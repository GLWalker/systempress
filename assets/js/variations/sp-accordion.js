/**
 * Register block variations for Accordions.
 */
wp.blocks.registerBlockVariation("core/group", {
	name: "sp-accordion-details",
	title: "Accordion WP",
	category: "systempress-blocks",
	description: 'Bootstrap "Like" Accordion from Details block',
	icon: accordionIcon,
	attributes: {
		className: "accordion",
		anchor: "spWPaccordion",
		metadata: {
			name: "WP Accordion",
		},
	},

	innerBlocks: [
		[
			"core/details",
			{
				className: "accordion-item",
				summary: "Accordion Heading 1",
				metadata: {
					name: "Accordion Item",
				},
			},
			[
				[
					"core/group",
					{
						className: "accordion-collapse",
						metadata: {
							name: "Accordion Collapse",
						},
					},
					[
						[
							"core/group",
							{
								className: "accordion-body",
								metadata: {
									name: "Accordion Body",
								},
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
				metadata: {
					name: "Accordion Item",
				},
			},
			[
				[
					"core/group",
					{
						className: "accordion-collapse",
						metadata: {
							name: "Accordion Collapse",
						},
					},
					[
						[
							"core/group",
							{
								className: "accordion-body",
								metadata: {
									name: "Accordion Body",
								},
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
				metadata: {
					name: "Accordion Item",
				},
			},
			[
				[
					"core/group",
					{
						className: "accordion-collapse",
						metadata: {
							name: "Accordion Collapse",
						},
					},
					[
						[
							"core/group",
							{
								className: "accordion-body",
								metadata: {
									name: "Accordion Body",
								},
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
	name: "bs-accordion",
	title: "Accordion",
	category: "systempress-blocks",
	description: "Bootstrap Accordion from block markup",
	icon: accordionIcon,
	attributes: {
		className: "accordion",
		anchor: "spAccordion",
		metadata: {
			name: "BS Accordion",
		},
	},

	innerBlocks: [
		{
			name: "core/group",
			attributes: {
				className: "accordion-item",
				metadata: {
					name: "Accordion Item",
				},
			},
			innerBlocks: [
				{
					name: "core/group",
					attributes: {
						className: "accordion-header",
						metadata: {
							name: "Accordion Header",
						},
					},
					innerBlocks: [
						{
							name: "core/paragraph",
							attributes: {
								className:
									"accordion-button toggle-accordion_collapseOne",
								/*
									dataBsToggle: "collapse",
									dataBsTarget: "#collapseOne",
									role: "button",
									ariaExpanded: "true",
									ariaControls: "collapseOne",
									*/
								content: "Accordion Item #1",
								metadata: {
									name: "Accordion Button",
								},
							},
						},
					],
				},
				{
					name: "core/group",
					attributes: {
						className: "accordion-collapse collapse show",
						/* dataBsParent: "#spAccordion",*/
						anchor: "collapseOne",
						metadata: {
							name: "Accordion Collapse",
						},
					},
					innerBlocks: [
						{
							name: "core/group",
							attributes: {
								className: "accordion-body",
								metadata: {
									name: "Accordion Body",
								},
							},
							innerBlocks: [
								{
									name: "core/paragraph",
									attributes: {
										content: `<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.`,
									},
								},
							],
						},
					],
				},
			],
		},
		{
			name: "core/group",
			attributes: {
				className: "accordion-item",
				metadata: {
					name: "Accordion Item",
				},
			},
			innerBlocks: [
				{
					name: "core/group",
					attributes: {
						className: "accordion-header",
						metadata: {
							name: "Accordion Header",
						},
					},
					innerBlocks: [
						{
							name: "core/paragraph",
							attributes: {
								className:
									"accordion-button toggle-accordion_collapseTwo",
								/*
									dataBsToggle: "collapse",
									dataBsTarget: "#collapseOne",
									role: "button",
									ariaExpanded: "true",
									ariaControls: "collapseOne",
									*/
								content: "Accordion Item #2",
								metadata: {
									name: "Accordion Button",
								},
							},
						},
					],
				},
				{
					name: "core/group",
					attributes: {
						className: "accordion-collapse collapse",
						/* dataBsParent: "#spAccordion",*/
						anchor: "collapseTwo",
						metadata: {
							name: "Accordion Collapse",
						},
					},
					innerBlocks: [
						{
							name: "core/group",
							attributes: {
								className: "accordion-body",
								metadata: {
									name: "Accordion Body",
								},
							},
							innerBlocks: [
								{
									name: "core/paragraph",
									attributes: {
										content: `<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.`,
									},
								},
							],
						},
					],
				},
			],
		},
		{
			name: "core/group",
			attributes: {
				className: "accordion-item",
				metadata: {
					name: "Accordion Item",
				},
			},
			innerBlocks: [
				{
					name: "core/group",
					attributes: {
						className: "accordion-header",
						metadata: {
							name: "Accordion Header",
						},
					},
					innerBlocks: [
						{
							name: "core/paragraph",
							attributes: {
								className:
									"accordion-button toggle-accordion_collapseThree",
								/*
									dataBsToggle: "collapse",
									dataBsTarget: "#collapseOne",
									role: "button",
									ariaExpanded: "true",
									ariaControls: "collapseOne",
									*/
								content: "Accordion Item #3",
								metadata: {
									name: "Accordion Button",
								},
							},
						},
					],
				},
				{
					name: "core/group",
					attributes: {
						className: "accordion-collapse collapse",
						/* dataBsParent: "#spAccordion",*/
						anchor: "collapseThree",
						metadata: {
							name: "Accordion Collapse",
						},
					},
					innerBlocks: [
						{
							name: "core/group",
							attributes: {
								className: "accordion-body",
								metadata: {
									name: "Accordion Body",
								},
							},
							innerBlocks: [
								{
									name: "core/paragraph",
									attributes: {
										content: `<strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.`,
									},
								},
							],
						},
					],
				},
			],
		},
	],
})
