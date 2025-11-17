var templateUri = systempress.templateUri || "./wp-content/themes/systempress/"

wp.blocks.registerBlockVariation("core/group", {
	name: "sp-carousel",
	title: "Carousel",
	description: "A bootstrap carousel block with three slides.",
	category: "systempress-blocks", // Custom category
	icon: carouselIcon,
	attributes: {
		className: "sp-carousel alignfull", // Primary class for carousel container
		metadata: {
			name: "BS Carousel",
		},
	},
	innerBlocks: [
		[
			"core/group",
			{
				// Carousel container
				className: "carousel slide carousel-dark",
				anchor: "spCarousel",
				metadata: {
					name: "Carousel",
				},
			},
			[
				[
					"core/group",
					{
						className: "carousel-indicators",
						metadata: {
							name: "Carousel Indicators",
						},
					},
					[
						[
							"core/paragraph",
							{
								className: "slide-indicator active",
								metadata: {
									name: "Indicator",
								},
							},
						],
						[
							"core/paragraph",
							{
								className: "slide-indicator",
								metadata: {
									name: "Indicator",
								},
							},
						],
						[
							"core/paragraph",
							{
								className: "slide-indicator",
								metadata: {
									name: "Indicator",
								},
							},
						],
					],
				],
				[
					"core/group",
					{
						className: "carousel-inner",
						metadata: {
							name: "Carousel Inner",
						},
					},
					[
						// First slide
						[
							"core/group",
							{
								className: "carousel-item active",
								metadata: { name: "Carousel Item" },
							},
							[
								[
									"core/cover",
									{
										url: `${templateUri}/assets/images/blog-1200x800.webp`,
										dimRatio: 0,
										isUserOverlayColor: true,
										style: {
											color: {
												duotone:
													"var:preset|duotone|duotone-13",
											},
										},
									},
									[
										[
											"core/group",
											{
												style: {
													spacing: {
														padding: {
															top: "var:preset|spacing|30",
															bottom: "var:preset|spacing|30",
															left: "var:preset|spacing|60",
															right: "var:preset|spacing|60",
														},
													},
												},
												layout: {
													type: "flex",
													orientation: "vertical",
													justifyContent: "stretch",
													verticalAlignment: "center",
												},
											},
											[
												[
													"core/heading",
													{
														textAlign: "left",
														textColor: "bs-primary",
														content:
															"Primary Heading",
													},
												],
												[
													"core/paragraph",
													{
														content:
															"* I'm a bootstrap carousel. I'm wearing a duotone for the purpose of this example.. You can find me in the block variations. I’m built with blocks and a little bit of JavaScript!<br><br>* To edit me, open the <strong>List View</strong> in the block editor. Find my blocks called <strong>carousel-item</strong>. Remove the class name “carousel-item” so you can see and edit what|’s inside.<br><br>* When you|’re done, don|’t forget to add the “carousel-item” class name back so everything works again.<br>",
														textColor: "bs-primary",
														gradient: "light",
														className: "rounded",
													},
												],
												[
													"core/buttons",
													{},
													[
														[
															"core/button",
															{
																className:
																	"is-style-outline btn-primary",
																backgroundColor:
																	"bs-primary-bg-subtle",
																text: "Button Primary",
															},
														],
													],
												],
											],
										],
									],
								],
							],
						],
						// Second slide
						[
							"core/group",
							{
								className: "carousel-item",
								metadata: { name: "Carousel Item" },
							},
							[
								[
									"core/cover",
									{
										url: `${templateUri}/assets/images/blog-1200x800.webp`,
										dimRatio: 0,
										isUserOverlayColor: true,
										style: {
											color: {
												duotone:
													"var:preset|duotone|duotone-14",
											},
										},
									},
									[
										[
											"core/group",
											{
												style: {
													spacing: {
														padding: {
															top: "var:preset|spacing|30",
															bottom: "var:preset|spacing|30",
															left: "var:preset|spacing|60",
															right: "var:preset|spacing|60",
														},
													},
												},
												layout: {
													type: "flex",
													orientation: "vertical",
													justifyContent: "stretch",
													verticalAlignment: "center",
												},
											},
											[
												[
													"core/heading",
													{
														textAlign: "left",
														textColor:
															"bs-secondary",
														content:
															"Secondary Heading",
													},
												],
												[
													"core/paragraph",
													{
														content:
															"* I'm a bootstrap carousel. I'm wearing a duotone for the purpose of this example.. You can find me in the block variations. I’m built with blocks and a little bit of JavaScript!<br><br>* To edit me, open the <strong>List View</strong> in the block editor. Find my blocks called <strong>carousel-item</strong>. Remove the class name “carousel-item” so you can see and edit what|’s inside.<br><br>* When you|’re done, don|’t forget to add the “carousel-item” class name back so everything works again.<br>",
														textColor:
															"bs-secondary",
														gradient: "light",
														className: "rounded",
													},
												],
												[
													"core/buttons",
													{},
													[
														[
															"core/button",
															{
																className:
																	"is-style-outline btn-secondary",
																backgroundColor:
																	"bs-secondary-bg-subtle",
																text: "Button Secondary",
															},
														],
													],
												],
											],
										],
									],
								],
							],
						],
						// Third slide
						[
							"core/group",
							{
								className: "carousel-item",
								metadata: { name: "Carousel Item" },
							},
							[
								[
									"core/cover",
									{
										url: `${templateUri}/assets/images/blog-1200x800.webp`,
										dimRatio: 0,
										isUserOverlayColor: true,
										style: {
											color: {
												duotone:
													"var:preset|duotone|duotone-15",
											},
										},
									},
									[
										[
											"core/group",
											{
												style: {
													spacing: {
														padding: {
															top: "var:preset|spacing|30",
															bottom: "var:preset|spacing|30",
															left: "var:preset|spacing|60",
															right: "var:preset|spacing|60",
														},
													},
												},
												layout: {
													type: "flex",
													orientation: "vertical",
													justifyContent: "stretch",
													verticalAlignment: "center",
												},
											},
											[
												[
													"core/heading",
													{
														textAlign: "left",
														textColor: "bs-success",
														content:
															"Success Heading",
													},
												],
												[
													"core/paragraph",
													{
														content:
															"* I'm a bootstrap carousel. I'm wearing a duotone for the purpose of this example.. You can find me in the block variations. I’m built with blocks and a little bit of JavaScript!<br><br>* To edit me, open the <strong>List View</strong> in the block editor. Find my blocks called <strong>carousel-item</strong>. Remove the class name “carousel-item” so you can see and edit what|’s inside.<br><br>* When you|’re done, don|’t forget to add the “carousel-item” class name back so everything works again.<br>",
														textColor: "bs-success",
														gradient: "light",
														className: "rounded",
													},
												],
												[
													"core/buttons",
													{},
													[
														[
															"core/button",
															{
																className:
																	"is-style-outline btn-success",
																backgroundColor:
																	"bs-success-bg-subtle",
																text: "Button Success",
															},
														],
													],
												],
											],
										],
									],
								],
								//<!-- [END]--->
							],
						],
					],
				],
				[
					"core/paragraph",
					{
						className: "carousel-control-prev",
						metadata: { name: "carousel-control-prev" },
					},
				],
				[
					"core/paragraph",
					{
						className: "carousel-control-next",
						metadata: { name: "carousel-control-next" },
					},
				],
			],
		],
	],
})
