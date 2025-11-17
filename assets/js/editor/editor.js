/** Add BS data attributes to buttons */
;(function (wp) {
	var el = wp.element.createElement
	var useState = wp.element.useState
	var Fragment = wp.element.Fragment
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var TextControl = wp.components.TextControl
	var SelectControl = wp.components.SelectControl
	var ToggleControl = wp.components.ToggleControl
	var Button = wp.components.Button
	var Modal = wp.components.Modal

	// Extend attributes for the button block
	wp.hooks.addFilter(
		"blocks.registerBlockType",
		"custom/extend-attributes",
		function (settings, name) {
			if (name === "core/button") {
				settings.attributes = Object.assign(settings.attributes, {
					dataBsTitle: { type: "string", default: "" },
					dataBsToggle: { type: "string", default: "" },
					dataBsTarget: { type: "string", default: "" },
					dataBsPlacement: { type: "string", default: "" },
					dataBsTrigger: { type: "string", default: "" },
					dataBsContent: { type: "string", default: "" },
					dataBsHtml: { type: "boolean", default: false },
					dataBsDismiss: { type: "string", default: "" },
				})
			}
			return settings
		}
	)

	// Add controls to the block editor
	wp.hooks.addFilter(
		"editor.BlockEdit",
		"custom/add-inspector-controls",
		function (BlockEdit) {
			return function (props) {
				if (props.name === "core/button") {
					var attributes = props.attributes
					var setAttributes = props.setAttributes
					var [isHelpOpen, setHelpOpen] = useState(false)

					return el(
						Fragment,
						null,
						el(BlockEdit, props),
						el(
							InspectorControls,
							{ key: "inspector-controls" },
							el(
								PanelBody,
								{
									title: "Data Attributes",
									initialOpen: false,
									key: "bs-data-btn-atts-panel",
								},
								[
									el(TextControl, {
										key: "data-bs-title",
										label: "Data BS Title",
										value: attributes.dataBsTitle || "",
										onChange: function (value) {
											setAttributes({
												dataBsTitle: value,
											})
										},
										__nextHasNoMarginBottom: true, // Disable bottom margin
									}),
									el(SelectControl, {
										key: "data-bs-toggle",
										label: "Data BS Toggle",
										value: attributes.dataBsToggle || "",
										options: [
											{ label: "", value: "" },
											{
												label: "Tooltip",
												value: "tooltip",
											},
											{
												label: "Popover",
												value: "popover",
											},
											{ label: "Modal", value: "modal" },
											{
												label: "Dropdown",
												value: "dropdown",
											},
											{
												label: "Collapse",
												value: "collapse",
											},
											{
												label: "Offcanvas",
												value: "offcanvas",
											},
											{ label: "Other", value: "other" },
										],
										onChange: function (value) {
											setAttributes({
												dataBsToggle: value,
											})
										},
										__nextHasNoMarginBottom: true, // Disable bottom margin
									}),
									el(TextControl, {
										key: "data-bs-target",
										label: "Data BS Target",
										value: attributes.dataBsTarget || "",
										onChange: function (value) {
											setAttributes({
												dataBsTarget: value,
											})
										},
										__nextHasNoMarginBottom: true, // Disable bottom margin
									}),
									el(SelectControl, {
										key: "data-bs-placement",
										label: "Data BS Placement",
										value: attributes.dataBsPlacement || "",
										options: [
											{ label: "", value: "" },
											{ label: "Top", value: "top" },
											{
												label: "Bottom",
												value: "bottom",
											},
											{ label: "Left", value: "left" },
											{ label: "Right", value: "right" },
										],
										onChange: function (value) {
											setAttributes({
												dataBsPlacement: value,
											})
										},
										__nextHasNoMarginBottom: true, // Disable bottom margin
									}),
									el(SelectControl, {
										key: "data-bs-trigger",
										label: "Data BS Trigger",
										value: attributes.dataBsTrigger || "",
										options: [
											{ label: "", value: "" },
											{ label: "Click", value: "click" },
											{ label: "Hover", value: "hover" },
											{ label: "Focus", value: "focus" },
											{
												label: "Manual",
												value: "manual",
											},
										],
										onChange: function (value) {
											setAttributes({
												dataBsTrigger: value,
											})
										},
										__nextHasNoMarginBottom: true, // Disable bottom margin
									}),
									el(TextControl, {
										key: "data-bs-content",
										label: "Data BS Content",
										value: attributes.dataBsContent || "",
										onChange: function (value) {
											setAttributes({
												dataBsContent: value,
											})
										},
										__nextHasNoMarginBottom: true, // Disable bottom margin
									}),
									el(ToggleControl, {
										key: "data-bs-html",
										label: "Enable HTML in Content",
										checked: attributes.dataBsHtml || false,
										onChange: function (value) {
											setAttributes({ dataBsHtml: value })
										},
										__nextHasNoMarginBottom: true, // Disable bottom margin
									}),
									el(SelectControl, {
										key: "data-bs-dismiss",
										label: "Data BS Dismiss",
										value: attributes.dataBsDismiss || "",
										options: [
											{ label: "", value: "" },
											{ label: "Alert", value: "alert" },
											{ label: "Modal", value: "modal" },
											{
												label: "Offcanvas",
												value: "offcanvas",
											},
											{ label: "Other", value: "other" },
										],
										onChange: function (value) {
											setAttributes({
												dataBsDismiss: value,
											})
										},
										__nextHasNoMarginBottom: true, // Disable bottom margin
									}),
									// Help Icon Button
									el(
										Button,
										{
											key: "help-button",
											icon: "editor-help",
											label: "Help",
											isSecondary: true,
											onClick: function () {
												setHelpOpen(true)
											},
										},
										"Help"
									),
								]
							)
						),
						isHelpOpen &&
							el(
								Modal,
								{
									key: "help-dialog",
									title: "Bootstrap Data Attributes Reference",
									onRequestClose: function () {
										setHelpOpen(false)
									},
								},
								el(
									"p",
									null,
									"Below is a detailed guide on various Bootstrap data attributes and their functionality."
								),
								el(
									"ol",
									null,
									el(
										"li",
										null,
										el("strong", null, "1. Tooltips"),
										el(
											"ul",
											null,
											el(
												"li",
												null,
												'data-bs-toggle="tooltip": Activates a tooltip.'
											),
											el(
												"li",
												null,
												'data-bs-placement="top" | "bottom" | "left" | "right": Specifies the tooltip\'s placement relative to the element.'
											),
											el(
												"li",
												null,
												'data-bs-title="...": Specifies the content for the tooltip.'
											),
											el(
												"li",
												null,
												'data-bs-trigger="click" | "hover" | "focus" | "manual": Defines how the tooltip will be triggered.'
											)
										)
									),
									el(
										"li",
										null,
										el("strong", null, "2. Popovers"),
										el(
											"ul",
											null,
											el(
												"li",
												null,
												'data-bs-toggle="popover": Activates a popover.'
											),
											el(
												"li",
												null,
												'data-bs-placement="top" | "bottom" | "left" | "right": Specifies the popover\'s placement.'
											),
											el(
												"li",
												null,
												'data-bs-title="...": Title for the popover.'
											),
											el(
												"li",
												null,
												'data-bs-content="...": Content for the popover.'
											),
											el(
												"li",
												null,
												'data-bs-trigger="click" | "hover" | "focus" | "manual": Defines how the popover will be triggered.'
											),
											el(
												"li",
												null,
												'data-bs-html="true": Allows HTML content inside the popover.'
											),
											el(
												"li",
												null,
												'data-bs-container="body": Defines where the popover should be appended (default is body).'
											)
										)
									),
									el(
										"li",
										null,
										el("strong", null, "3. Modals"),
										el(
											"ul",
											null,
											el(
												"li",
												null,
												'data-bs-toggle="modal": Activates a modal.'
											),
											el(
												"li",
												null,
												'data-bs-target="#modalId": Specifies the target modal element to open.'
											),
											el(
												"li",
												null,
												'data-bs-dismiss="modal": Dismisses the modal.'
											),
											el(
												"li",
												null,
												'data-bs-backdrop="true" | "false" | "static": Controls the modal backdrop behavior.'
											),
											el(
												"li",
												null,
												'data-bs-keyboard="true" | "false": Controls whether the modal can be closed with the keyboard.'
											)
										)
									),
									el(
										"li",
										null,
										el("strong", null, "4. Dropdowns"),
										el(
											"ul",
											null,
											el(
												"li",
												null,
												'data-bs-toggle="dropdown": Activates a dropdown.'
											),
											el(
												"li",
												null,
												'data-bs-display="static" | "dynamic": Specifies the dropdown behavior (static places the dropdown outside other content).'
											)
										)
									),
									el(
										"li",
										null,
										el(
											"strong",
											null,
											"5. Collapse (Accordion)"
										),
										el(
											"ul",
											null,
											el(
												"li",
												null,
												'data-bs-toggle="collapse": Activates a collapsible element.'
											),
											el(
												"li",
												null,
												'data-bs-target="#collapseId": Specifies the target element to collapse.'
											),
											el(
												"li",
												null,
												'data-bs-parent="#accordionId": Ensures only one collapsible item is open in a parent accordion.'
											)
										)
									),
									el(
										"li",
										null,
										el("strong", null, "6. Carousels"),
										el(
											"ul",
											null,
											el(
												"li",
												null,
												'data-bs-ride="carousel": Activates automatic cycling of a carousel.'
											),
											el(
												"li",
												null,
												'data-bs-slide-to="index": Sets the active slide by index.'
											),
											el(
												"li",
												null,
												'data-bs-interval="number": Configures the time interval for each slide transition.'
											)
										)
									),
									el(
										"li",
										null,
										el("strong", null, "7. Alerts"),
										el(
											"ul",
											null,
											el(
												"li",
												null,
												'data-bs-dismiss="alert": Dismisses an alert when clicked.'
											)
										)
									),
									el(
										"li",
										null,
										el("strong", null, "8. Offcanvas"),
										el(
											"ul",
											null,
											el(
												"li",
												null,
												'data-bs-toggle="offcanvas": Activates an offcanvas component.'
											),
											el(
												"li",
												null,
												'data-bs-target="#offcanvasId": Specifies the target offcanvas element.'
											),
											el(
												"li",
												null,
												'data-bs-dismiss="offcanvas": Closes the offcanvas.'
											)
										)
									),
									el(
										"li",
										null,
										el("strong", null, "9. Scrollspy"),
										el(
											"ul",
											null,
											el(
												"li",
												null,
												'data-bs-spy="scroll": Enables scrollspy on the element.'
											),
											el(
												"li",
												null,
												'data-bs-target="#navbar": Specifies the target element for scrollspy.'
											),
											el(
												"li",
												null,
												'data-bs-offset="number": Adjusts the scrollspy offset.'
											)
										)
									),
									el(
										"li",
										null,
										el("strong", null, "10. Forms"),
										el(
											"ul",
											null,
											el(
												"li",
												null,
												'data-bs-toggle="tooltip": Used for tooltips on form fields.'
											),
											el(
												"li",
												null,
												'data-bs-placement="top" | "bottom" | "left" | "right": Specifies tooltip placement.'
											)
										)
									)
								),

								el(
									"a",
									{
										href: "https://getbootstrap.com/docs/5.3/getting-started/introduction/",
										target: "_blank",
										rel: "noopener noreferrer",
									},
									"Refer to the Bootstrap documentation for advanced usage."
								)
							)
					)
				}
				return el(BlockEdit, props)
			}
		}
	)

	// Add custom attributes to the block's save output
	wp.hooks.addFilter(
		"blocks.getSaveContent.extraProps",
		"custom/apply-attributes",
		function (extraProps, blockType, attributes) {
			if (blockType.name === "core/button") {
				if (attributes.dataBsTitle) {
					extraProps["data-bs-title"] = attributes.dataBsTitle
				}
				if (attributes.dataBsToggle) {
					extraProps["data-bs-toggle"] = attributes.dataBsToggle
				}
				if (attributes.dataBsTarget) {
					extraProps["data-bs-target"] = attributes.dataBsTarget
				}
				if (attributes.dataBsPlacement) {
					extraProps["data-bs-placement"] = attributes.dataBsPlacement
				}
				if (attributes.dataBsTrigger) {
					extraProps["data-bs-trigger"] = attributes.dataBsTrigger
				}
				if (attributes.dataBsContent) {
					extraProps["data-bs-content"] = attributes.dataBsContent
				}
				if (attributes.dataBsHtml) {
					extraProps["data-bs-html"] = attributes.dataBsHtml
				}
				if (attributes.dataBsDismiss) {
					extraProps["data-bs-dismiss"] = attributes.dataBsDismiss
				}
			}
			return extraProps
		}
	)
})(window.wp)
/** Add BS data attributes to group containers */
;(function (wp) {
	var el = wp.element.createElement
	var useState = wp.element.useState
	var Fragment = wp.element.Fragment
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var TextControl = wp.components.TextControl
	var SelectControl = wp.components.SelectControl
	var Button = wp.components.Button
	var Modal = wp.components.Modal

	// Extend attributes for the group block
	wp.hooks.addFilter(
		"blocks.registerBlockType",
		"custom/extend-group-attributes",
		function (settings, name) {
			if (["core/columns", "core/column", "core/group"].includes(name)) {
				settings.attributes = Object.assign(settings.attributes, {
					dataBsTheme: { type: "string", default: "" },
					dataBsBackdrop: { type: "string", default: "" },
					dataBsKeyboard: { type: "string", default: "" },
					dataBsDisplay: { type: "string", default: "" },
					dataBsParent: { type: "string", default: "" },
					dataBsSpy: { type: "string", default: "" },
					dataBsOffset: { type: "string", default: "" },
					tabIndex: { type: "string", default: "" },
				})
			}
			return settings
		}
	)

	// Add controls to the block editor
	wp.hooks.addFilter(
		"editor.BlockEdit",
		"custom/add-group-inspector-controls",
		function (BlockEdit) {
			return function (props) {
				if (
					["core/columns", "core/column", "core/group"].includes(
						props.name
					)
				) {
					var attributes = props.attributes
					var setAttributes = props.setAttributes
					var [isHelpOpen, setHelpOpen] = useState(false)

					return el(
						Fragment,
						null,
						el(BlockEdit, props),
						el(
							InspectorControls,
							{ key: "inspector-controls" },
							el(
								PanelBody,
								{
									title: "Data Attributes",
									initialOpen: false,
									key: "bs-data-atts-panel",
								},
								[
									el(SelectControl, {
										key: "data-bs-theme",
										label: "Data BS Theme",
										value: attributes.dataBsTheme || "",
										options: [
											{ label: "", value: "" },
											{ label: "Light", value: "light" },
											{ label: "Dark", value: "dark" },
										],
										onChange: function (value) {
											setAttributes({
												dataBsTheme: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(SelectControl, {
										key: "data-bs-backdrop",
										label: "Data BS Backdrop",
										value: attributes.dataBsBackdrop || "",
										options: [
											{ label: "", value: "" },
											{ label: "True", value: "true" },
											{ label: "False", value: "false" },
											{
												label: "Static",
												value: "static",
											},
										],
										onChange: function (value) {
											setAttributes({
												dataBsBackdrop: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(SelectControl, {
										key: "data-bs-keyboard",
										label: "Data BS Keyboard",
										value: attributes.dataBsKeyboard || "",
										options: [
											{ label: "", value: "" },
											{ label: "True", value: "true" },
											{ label: "False", value: "false" },
										],
										onChange: function (value) {
											setAttributes({
												dataBsKeyboard: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(SelectControl, {
										key: "data-bs-display",
										label: "Data BS Display",
										value: attributes.dataBsDisplay || "",
										options: [
											{ label: "", value: "" },
											{
												label: "Static",
												value: "static",
											},
											{
												label: "Dynamic",
												value: "dynamic",
											},
										],
										onChange: function (value) {
											setAttributes({
												dataBsDisplay: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "data-bs-parent",
										label: "Data BS Parent",
										value: attributes.dataBsParent || "",
										onChange: function (value) {
											setAttributes({
												dataBsParent: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(SelectControl, {
										key: "data-bs-spy",
										label: "Data BS Spy",
										value: attributes.dataBsSpy || "",
										options: [
											{ label: "", value: "" },
											{
												label: "Scroll",
												value: "scroll",
											},
										],
										onChange: function (value) {
											setAttributes({
												dataBsSpy: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "data-bs-offset",
										label: "Data BS Offset",
										value: attributes.dataBsOffset || "",
										onChange: function (value) {
											setAttributes({
												dataBsOffset: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "tabindex",
										label: "Tab Index Number",
										value: attributes.tabIndex || "",
										onChange: function (value) {
											setAttributes({
												tabIndex: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(
										Button,
										{
											variant: "secondary",
											onClick: function () {
												setHelpOpen(true)
											},
											style: { marginTop: "1em" },
										},
										"Help"
									),
									isHelpOpen
										? el(
												Modal,
												{
													title: "Bootstrap Data Attributes",
													onRequestClose:
														function () {
															setHelpOpen(false)
														},
												},
												el(
													"div",
													{},
													el(
														"p",
														{},
														"This block allows you to manage Bootstrap-related data attributes directly in the editor. These attributes can be used to control behavior and styling of components in Bootstrap. Below are the attributes available:"
													),
													el("ul", {}, [
														el(
															"li",
															{},
															"data-bs-theme: Set the theme mode (light or dark)."
														),
														el(
															"li",
															{},
															"data-bs-backdrop: Manage modal backdrop behavior (true, false, static)."
														),
														el(
															"li",
															{},
															"data-bs-keyboard: Enable or disable closing modals with the keyboard (true or false)."
														),
														el(
															"li",
															{},
															"data-bs-display: Set display behavior (static or dynamic)."
														),
														el(
															"li",
															{},
															"data-bs-parent: Set the parent container selector."
														),
														el(
															"li",
															{},
															"data-bs-spy: Enable scroll-spy functionality (scroll)."
														),
														el(
															"li",
															{},
															"data-bs-offset: Specify offset values for certain components."
														),
													])
												)
										  )
										: null,
								]
							)
						)
					)
				}
				return el(BlockEdit, props)
			}
		}
	)

	// Add attributes to the frontend output
	wp.hooks.addFilter(
		"blocks.getSaveContent.extraProps",
		"custom/extend-group-save-props",
		function (extraProps, blockType, attributes) {
			if (
				["core/columns", "core/column", "core/group"].includes(
					blockType.name
				)
			) {
				if (attributes.dataBsTheme) {
					extraProps["data-bs-theme"] = attributes.dataBsTheme
				}
				if (attributes.dataBsBackdrop) {
					extraProps["data-bs-backdrop"] = attributes.dataBsBackdrop
				}
				if (attributes.dataBsKeyboard) {
					extraProps["data-bs-keyboard"] = attributes.dataBsKeyboard
				}
				if (attributes.dataBsDisplay) {
					extraProps["data-bs-display"] = attributes.dataBsDisplay
				}
				if (attributes.dataBsParent) {
					extraProps["data-bs-parent"] = attributes.dataBsParent
				}
				if (attributes.dataBsSpy) {
					extraProps["data-bs-spy"] = attributes.dataBsSpy
				}
				if (attributes.dataBsOffset) {
					extraProps["data-bs-offset"] = attributes.dataBsOffset
				}
				if (attributes.tabIndex) {
					extraProps["tabindex"] = attributes.tabIndex
				}
			}
			return extraProps
		}
	)
})(window.wp)
/** Add ARIA attributes to group containers */
;(function (wp) {
	var el = wp.element.createElement
	var useState = wp.element.useState
	var Fragment = wp.element.Fragment
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var TextControl = wp.components.TextControl
	var Button = wp.components.Button
	var Modal = wp.components.Modal

	// Extend attributes for group, button, and paragraph blocks
	wp.hooks.addFilter(
		"blocks.registerBlockType",
		"custom/extend-aria-attributes",
		function (settings, name) {
			if (
				[
					"core/group",
					"core/buttons",
					"core/button",
					"core/paragraph",
					"core/columns",
					"core/column",
					"core/heading",
				].includes(name)
			) {
				settings.attributes = Object.assign(settings.attributes, {
					ariaRole: { type: "string", default: "" },
					ariaLabel: { type: "string", default: "" },
					ariaLabelledby: { type: "string", default: "" },
					ariaDescribedby: { type: "string", default: "" },
					ariaHidden: { type: "string", default: "" },
					ariaExpanded: { type: "string", default: "" },
					ariaControls: { type: "string", default: "" },
					ariaHaspopup: { type: "string", default: "" },
					ariaLive: { type: "string", default: "" },
					ariaAtomic: { type: "string", default: "" },
					ariaValuenow: { type: "string", default: "" },
					ariaValuemin: { type: "string", default: "" },
					ariaValuemax: { type: "string", default: "" },
				})
			}
			return settings
		}
	)

	// Add controls to the block editor
	wp.hooks.addFilter(
		"editor.BlockEdit",
		"custom/add-inspector-controls",
		function (BlockEdit) {
			return function (props) {
				if (
					[
						"core/group",
						"core/buttons",
						"core/button",
						"core/paragraph",
						"core/columns",
						"core/column",
						"core/heading",
					].includes(props.name)
				) {
					var attributes = props.attributes
					var setAttributes = props.setAttributes
					var [isHelpOpen, setHelpOpen] = useState(false)

					return el(
						Fragment,
						null,
						el(BlockEdit, props),
						el(
							InspectorControls,
							{ key: "inspector-controls" },
							el(
								PanelBody,
								{
									title: "ARIA Attributes",
									initialOpen: false,
									key: "aria-attributes-panel",
								},
								[
									el(TextControl, {
										key: "arie-role",
										label: "ARIA Role Label",
										value: attributes.ariaRole || "",
										onChange: function (value) {
											setAttributes({
												ariaRole: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-label",
										label: "ARIA Label",
										value: attributes.ariaLabel || "",
										onChange: function (value) {
											setAttributes({
												ariaLabel: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-labelledby",
										label: "ARIA Labelledby",
										value: attributes.ariaLabelledby || "",
										onChange: function (value) {
											setAttributes({
												ariaLabelledby: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-describedby",
										label: "ARIA Describedby",
										value: attributes.ariaDescribedby || "",
										onChange: function (value) {
											setAttributes({
												ariaDescribedby: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-hidden",
										label: "ARIA Hidden",
										value: attributes.ariaHidden || "",
										onChange: function (value) {
											setAttributes({
												ariaHidden: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-expanded",
										label: "ARIA Expanded",
										value: attributes.ariaExpanded || "",
										onChange: function (value) {
											setAttributes({
												ariaExpanded: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-controls",
										label: "ARIA Controls",
										value: attributes.ariaControls || "",
										onChange: function (value) {
											setAttributes({
												ariaControls: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-haspopup",
										label: "ARIA Haspopup",
										value: attributes.ariaHaspopup || "",
										onChange: function (value) {
											setAttributes({
												ariaHaspopup: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-live",
										label: "ARIA Live",
										value: attributes.ariaLive || "",
										onChange: function (value) {
											setAttributes({
												ariaLive: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-atomic",
										label: "ARIA Atomic",
										value: attributes.ariaAtomic || "",
										onChange: function (value) {
											setAttributes({
												ariaAtomic: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-valuenow",
										label: "ARIA Valuenow",
										value: attributes.ariaValuenow || "",
										onChange: function (value) {
											setAttributes({
												ariaValuenow: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-valuemin",
										label: "ARIA Valuemin",
										value: attributes.ariaValuemin || "",
										onChange: function (value) {
											setAttributes({
												ariaValuemin: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(TextControl, {
										key: "aria-valuemax",
										label: "ARIA Valuemax",
										value: attributes.ariaValuemax || "",
										onChange: function (value) {
											setAttributes({
												ariaValuemax: value,
											})
										},
										__nextHasNoMarginBottom: true,
									}),
									el(
										Button,
										{
											variant: "secondary",
											onClick: function () {
												setHelpOpen(true)
											},
											style: { marginTop: "1em" },
										},
										"Help"
									),
									isHelpOpen
										? el(
												Modal,
												{
													title: "ARIA Attributes",
													onRequestClose:
														function () {
															setHelpOpen(false)
														},
												},
												el(
													"div",
													{},
													el(
														"p",
														{},
														"This block allows you to manage ARIA attributes directly in the editor. These attributes are crucial for accessibility and help define roles and behaviors for assistive technologies."
													),
													el("ul", {}, [
														el(
															"li",
															{},
															"aria-label: Define an accessible name."
														),
														el(
															"li",
															{},
															"aria-labelledby: Refer to an element that labels the current element."
														),
														el(
															"li",
															{},
															"aria-describedby: Refer to an element that provides additional description."
														),
														el(
															"li",
															{},
															"aria-hidden: Indicate whether the element is hidden."
														),
														el(
															"li",
															{},
															"aria-expanded: Indicate the expanded or collapsed state."
														),
														el(
															"li",
															{},
															"aria-controls: Refer to a controlled element."
														),
														el(
															"li",
															{},
															"aria-haspopup: Indicate the presence of a popup."
														),
														el(
															"li",
															{},
															"aria-live: Indicate live region priority."
														),
														el(
															"li",
															{},
															"aria-atomic: Specify whether updates are atomic."
														),
														el(
															"li",
															{},
															"aria-valuenow: Define the current value in a range."
														),
														el(
															"li",
															{},
															"aria-valuemin: Define the minimum value in a range."
														),
														el(
															"li",
															{},
															"aria-valuemax: Define the maximum value in a range."
														),
													])
												)
										  )
										: null,
								]
							)
						)
					)
				}
				return el(BlockEdit, props)
			}
		}
	)

	// Add attributes to the frontend output
	wp.hooks.addFilter(
		"blocks.getSaveContent.extraProps",
		"custom/extend-save-props",
		function (extraProps, blockType, attributes) {
			if (
				[
					"core/group",
					"core/buttons",
					"core/button",
					"core/paragraph",
					"core/columns",
					"core/column",
					"core/heading",
				].includes(blockType.name)
			) {
				if (attributes.ariaRole) {
					extraProps["role"] = attributes.ariaRole
				}
				if (attributes.ariaLabel) {
					extraProps["aria-label"] = attributes.ariaLabel
				}
				if (attributes.ariaLabelledby) {
					extraProps["aria-labelledby"] = attributes.ariaLabelledby
				}
				if (attributes.ariaDescribedby) {
					extraProps["aria-describedby"] = attributes.ariaDescribedby
				}
				if (attributes.ariaHidden) {
					extraProps["aria-hidden"] = attributes.ariaHidden
				}
				if (attributes.ariaExpanded) {
					extraProps["aria-expanded"] = attributes.ariaExpanded
				}
				if (attributes.ariaControls) {
					extraProps["aria-controls"] = attributes.ariaControls
				}
				if (attributes.ariaHaspopup) {
					extraProps["aria-haspopup"] = attributes.ariaHaspopup
				}
				if (attributes.ariaLive) {
					extraProps["aria-live"] = attributes.ariaLive
				}
				if (attributes.ariaAtomic) {
					extraProps["aria-atomic"] = attributes.ariaAtomic
				}
				if (attributes.ariaValuenow) {
					extraProps["aria-valuenow"] = attributes.ariaValuenow
				}
				if (attributes.ariaValuemin) {
					extraProps["aria-valuemin"] = attributes.ariaValuemin
				}
				if (attributes.ariaValuemax) {
					extraProps["aria-valuemax"] = attributes.ariaValuemax
				}
			}
			return extraProps
		}
	)
})(window.wp)
