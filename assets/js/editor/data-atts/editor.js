/*;(function (wp) {
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
	var addFilter = wp.hooks.addFilter
	var __ = wp.i18n.__

	// Extend attributes for the 'core/button' block
	const extendAttributes = (settings, name) => {
		const commonAttributes = {
			dataBsTitle: { type: "string", default: "" },
			dataBsToggle: { type: "string", default: "" },
			dataBsTarget: { type: "string", default: "" },
			dataBsPlacement: { type: "string", default: "" },
			dataBsTrigger: { type: "string", default: "" },
			dataBsContent: { type: "string", default: "" },
			dataBsHtml: { type: "boolean", default: false },
			dataBsDismiss: { type: "string", default: "" },
		}

		// Apply to only 'core/button' block
		if (name === "core/button") {
			settings.attributes = Object.assign(
				{},
				settings.attributes,
				commonAttributes
			)
		}

		return settings
	}

	// Add the filter to extend the block attributes
	addFilter(
		"blocks.registerBlockType",
		"custom/extend-attributes",
		extendAttributes
	)

	// Add controls to the block editor for 'core/button'
	addFilter(
		"editor.BlockEdit",
		"custom/add-inspector-controls",
		function (BlockEdit) {
			return function (props) {
				const { name, attributes, setAttributes } = props

				// Only add inspector controls to 'core/button' block
				if (name !== "core/button") {
					return el(BlockEdit, props)
				}

				const isHelpOpenState = useState(false)
				const isHelpOpen = isHelpOpenState[0]
				const setHelpOpen = isHelpOpenState[1]

				// Enhanced validation functions
				const validatePlacement = (value) => {
					const validValues = ["", "top", "bottom", "left", "right"]
					if (!validValues.includes(value)) {
						alert(
							"Invalid placement value. Use one of: top, bottom, left, right."
						)
						return attributes.dataBsPlacement
					}
					return value
				}

				const validateTrigger = (value) => {
					const validValues = [
						"",
						"click",
						"hover",
						"focus",
						"manual",
					]
					if (!validValues.includes(value)) {
						alert(
							"Invalid trigger value. Use one of: click, hover, focus, manual."
						)
						return attributes.dataBsTrigger
					}
					return value
				}

				return el(
					Fragment,
					null,
					el(BlockEdit, props),
					el(
						InspectorControls,
						null,
						el(
							PanelBody,
							{
								title: "Data Link Attributes",
								initialOpen: false,
							},
							[
								el(TextControl, {
									label: __("Data BS Title", "my-plugin"),
									value: attributes.dataBsTitle || "",
									onChange: function (value) {
										setAttributes({ dataBsTitle: value })
									},
								}),
								el(SelectControl, {
									label: __("Data BS Toggle", "my-plugin"),
									value: attributes.dataBsToggle || "",
									options: [
										{ label: "", value: "" },
										{ label: "Tooltip", value: "tooltip" },
										{ label: "Popover", value: "popover" },
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
									],
									onChange: function (value) {
										setAttributes({ dataBsToggle: value })
									},
								}),
								el(TextControl, {
									label: __("Data BS Target", "my-plugin"),
									value: attributes.dataBsTarget || "",
									onChange: function (value) {
										setAttributes({ dataBsTarget: value })
									},
								}),
								el(SelectControl, {
									label: __("Data BS Placement", "my-plugin"),
									value: attributes.dataBsPlacement || "",
									options: [
										{ label: "", value: "" },
										{ label: "Top", value: "top" },
										{ label: "Bottom", value: "bottom" },
										{ label: "Left", value: "left" },
										{ label: "Right", value: "right" },
									],
									onChange: function (value) {
										setAttributes({
											dataBsPlacement:
												validatePlacement(value),
										})
									},
								}),
								el(SelectControl, {
									label: __("Data BS Trigger", "my-plugin"),
									value: attributes.dataBsTrigger || "",
									options: [
										{ label: "", value: "" },
										{ label: "Click", value: "click" },
										{ label: "Hover", value: "hover" },
										{ label: "Focus", value: "focus" },
										{ label: "Manual", value: "manual" },
									],
									onChange: function (value) {
										setAttributes({
											dataBsTrigger:
												validateTrigger(value),
										})
									},
								}),
								el(TextControl, {
									label: __("Data BS Content", "my-plugin"),
									value: attributes.dataBsContent || "",
									onChange: function (value) {
										setAttributes({ dataBsContent: value })
									},
								}),
								el(ToggleControl, {
									label: __(
										"Enable HTML in Content",
										"my-plugin"
									),
									checked: attributes.dataBsHtml || false,
									onChange: function (value) {
										setAttributes({ dataBsHtml: value })
									},
								}),
								el(SelectControl, {
									label: __("Data BS Dismiss", "my-plugin"),
									value: attributes.dataBsDismiss || "",
									options: [
										{ label: "", value: "" },
										{ label: "Alert", value: "alert" },
										{ label: "Modal", value: "modal" },
										{
											label: "Offcanvas",
											value: "offcanvas",
										},
									],
									onChange: function (value) {
										setAttributes({ dataBsDismiss: value })
									},
								}),
								el(
									Button,
									{
										icon: "editor-help",
										label: __("Help", "my-plugin"),
										isSecondary: true,
										onClick: function () {
											setHelpOpen(true)
										},
									},
									__("Help", "my-plugin")
								),
							]
						)
					),
					isHelpOpen &&
						el(
							Modal,
							{
								title: __(
									"Bootstrap Data Attributes Reference",
									"my-plugin"
								),
								onRequestClose: function () {
									setHelpOpen(false)
								},
							},
							el(
								"p",
								null,
								__(
									"Use the following data attributes for Bootstrap components:",
									"my-plugin"
								)
							),
							el(
								"ul",
								null,
								[
									"data-bs-toggle: Toggles elements (e.g., tooltips, modals).",
									"data-bs-target: Target selector for the element.",
									"data-bs-placement: Placement for tooltips/popovers.",
									"data-bs-trigger: Event(s) triggering visibility.",
									"data-bs-dismiss: Controls dismissible elements.",
								].map((desc) =>
									el("li", null, __(desc, "my-plugin"))
								)
							),
							el(
								"p",
								null,
								__(
									"For more information, visit the official Bootstrap documentation:",
									"my-plugin"
								)
							),
							el(
								"a",
								{
									href: "https://getbootstrap.com/docs/5.3/getting-started/introduction/",
									target: "_blank",
									rel: "noopener noreferrer",
								},
								__("Bootstrap Documentation", "my-plugin")
							)
						)
				)
			}
		}
	)

	// Add custom attributes to the block's save output
	addFilter(
		"blocks.getSaveContent.extraProps",
		"custom/apply-attributes",
		function (extraProps, blockType, attributes) {
			if (blockType.name === "core/button") {
				Object.keys(attributes).forEach(function (key) {
					if (key.startsWith("dataBs") && attributes[key]) {
						extraProps["data-bs-" + key.slice(6).toLowerCase()] =
							attributes[key]
					}
				})
			}
			return extraProps
		}
	)
})(window.wp)*/
;(function (wp) {
	"use strict"

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
	var addFilter = wp.hooks.addFilter
	var __ = wp.i18n.__

	// List of supported blocks
	const supportedBlocks = ["core/button", "core/paragraph"]

	// Extend attributes for supported blocks
	const extendAttributes = (settings, name) => {
		if (!supportedBlocks.includes(name)) {
			return settings
		}

		const commonAttributes = {
			dataBsTitle: { type: "string", default: "" },
			dataBsToggle: { type: "string", default: "" },
			dataBsTarget: { type: "string", default: "" },
			dataBsPlacement: { type: "string", default: "" },
			dataBsTrigger: { type: "string", default: "" },
			dataBsContent: { type: "string", default: "" },
			dataBsHtml: { type: "boolean", default: false },
			dataBsDismiss: { type: "string", default: "" },
		}

		settings.attributes = Object.assign(
			{},
			settings.attributes,
			commonAttributes
		)

		return settings
	}

	addFilter(
		"blocks.registerBlockType",
		"custom/extend-attributes",
		extendAttributes
	)

	// Add inspector controls to supported blocks
	addFilter(
		"editor.BlockEdit",
		"custom/add-inspector-controls",
		function (BlockEdit) {
			return function (props) {
				const { name, attributes, setAttributes } = props

				// Only add inspector controls to supported blocks
				if (!supportedBlocks.includes(name)) {
					return el(BlockEdit, props)
				}

				const isHelpOpenState = useState(false)
				const isHelpOpen = isHelpOpenState[0]
				const setHelpOpen = isHelpOpenState[1]

				const validatePlacement = (value) => {
					const validValues = ["", "top", "bottom", "left", "right"]
					if (!validValues.includes(value)) {
						alert(
							"Invalid placement value. Use one of: top, bottom, left, right."
						)
						return attributes.dataBsPlacement
					}
					return value
				}

				const validateTrigger = (value) => {
					const validValues = [
						"",
						"click",
						"hover",
						"focus",
						"manual",
					]
					if (!validValues.includes(value)) {
						alert(
							"Invalid trigger value. Use one of: click, hover, focus, manual."
						)
						return attributes.dataBsTrigger
					}
					return value
				}

				return el(
					Fragment,
					null,
					el(BlockEdit, props),
					el(
						InspectorControls,
						null,
						el(
							PanelBody,
							{
								title: "Data Link Attributes",
								initialOpen: false,
							},
							[
								el(TextControl, {
									label: __("Data BS Title", "my-plugin"),
									value: attributes.dataBsTitle || "",
									onChange: function (value) {
										setAttributes({ dataBsTitle: value })
									},
								}),
								el(SelectControl, {
									label: __("Data BS Toggle", "my-plugin"),
									value: attributes.dataBsToggle || "",
									options: [
										{ label: "", value: "" },
										{ label: "Tooltip", value: "tooltip" },
										{ label: "Popover", value: "popover" },
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
									],
									onChange: function (value) {
										setAttributes({ dataBsToggle: value })
									},
								}),
								el(TextControl, {
									label: __("Data BS Target", "my-plugin"),
									value: attributes.dataBsTarget || "",
									onChange: function (value) {
										setAttributes({ dataBsTarget: value })
									},
								}),
								el(SelectControl, {
									label: __("Data BS Placement", "my-plugin"),
									value: attributes.dataBsPlacement || "",
									options: [
										{ label: "", value: "" },
										{ label: "Top", value: "top" },
										{ label: "Bottom", value: "bottom" },
										{ label: "Left", value: "left" },
										{ label: "Right", value: "right" },
									],
									onChange: function (value) {
										setAttributes({
											dataBsPlacement:
												validatePlacement(value),
										})
									},
								}),
								el(SelectControl, {
									label: __("Data BS Trigger", "my-plugin"),
									value: attributes.dataBsTrigger || "",
									options: [
										{ label: "", value: "" },
										{ label: "Click", value: "click" },
										{ label: "Hover", value: "hover" },
										{ label: "Focus", value: "focus" },
										{ label: "Manual", value: "manual" },
									],
									onChange: function (value) {
										setAttributes({
											dataBsTrigger:
												validateTrigger(value),
										})
									},
								}),
								el(TextControl, {
									label: __("Data BS Content", "my-plugin"),
									value: attributes.dataBsContent || "",
									onChange: function (value) {
										setAttributes({ dataBsContent: value })
									},
								}),
								el(ToggleControl, {
									label: __(
										"Enable HTML in Content",
										"my-plugin"
									),
									checked: attributes.dataBsHtml || false,
									onChange: function (value) {
										setAttributes({ dataBsHtml: value })
									},
								}),
								el(SelectControl, {
									label: __("Data BS Dismiss", "my-plugin"),
									value: attributes.dataBsDismiss || "",
									options: [
										{ label: "", value: "" },
										{ label: "Alert", value: "alert" },
										{ label: "Modal", value: "modal" },
										{
											label: "Offcanvas",
											value: "offcanvas",
										},
									],
									onChange: function (value) {
										setAttributes({ dataBsDismiss: value })
									},
								}),
								el(
									Button,
									{
										icon: "editor-help",
										label: __("Help", "my-plugin"),
										isSecondary: true,
										onClick: function () {
											setHelpOpen(true)
										},
									},
									__("Help", "my-plugin")
								),
							]
						)
					),
					isHelpOpen &&
						el(
							Modal,
							{
								title: __(
									"Bootstrap Data Attributes Reference",
									"my-plugin"
								),
								onRequestClose: function () {
									setHelpOpen(false)
								},
							},
							el(
								"p",
								null,
								__(
									"Use the following data attributes for Bootstrap components:",
									"my-plugin"
								)
							),
							el(
								"ul",
								null,
								[
									"data-bs-toggle: Toggles elements (e.g., tooltips, modals).",
									"data-bs-target: Target selector for the element.",
									"data-bs-placement: Placement for tooltips/popovers.",
									"data-bs-trigger: Event(s) triggering visibility.",
									"data-bs-dismiss: Controls dismissible elements.",
								].map((desc) =>
									el("li", null, __(desc, "my-plugin"))
								)
							),
							el(
								"p",
								null,
								__(
									"For more information, visit the official Bootstrap documentation:",
									"my-plugin"
								)
							),
							el(
								"a",
								{
									href: "https://getbootstrap.com/docs/5.3/getting-started/introduction/",
									target: "_blank",
									rel: "noopener noreferrer",
								},
								__("Bootstrap Documentation", "my-plugin")
							)
						)
				)
			}
		}
	)

	// Add custom attributes to the block's save output
	addFilter(
		"blocks.getSaveContent.extraProps",
		"custom/apply-attributes",
		function (extraProps, blockType, attributes) {
			if (supportedBlocks.includes(blockType.name)) {
				Object.keys(attributes).forEach(function (key) {
					if (key.startsWith("dataBs") && attributes[key]) {
						extraProps["data-bs-" + key.slice(6).toLowerCase()] =
							attributes[key]
					}
				})
			}
			return extraProps
		}
	)
})(window.wp)

/** Add BS data attributes to group containers */
;(function (wp) {
	var el = wp.element.createElement
	var Fragment = wp.element.Fragment
	var useState = wp.element.useState
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var SelectControl = wp.components.SelectControl
	var TextControl = wp.components.TextControl
	var Button = wp.components.Button
	var Modal = wp.components.Modal
	var __ = wp.i18n.__

	// List of targeted blocks
	var targetedBlocks = [
		"core/buttons",
		"core/column",
		"core/columns",
		"core/comments",
		"core/comments-title",
		"core/gallery",
		"core/group",
		"core/heading",
		"core/image",
		"core/list",
		"core/list-item",
		"core/navigation",
		"core/navigation-submenu",
		"core/paragraph",
		"core/row",
		"core/stack",
		"core/video",
	]

	// Data attribute options for SelectControls
	var dataAttributes = {
		"data-bs-keyboard": [
			{ value: "", label: __("None", "systempress") },
			{ value: "true", label: __("True", "systempress") },
			{ value: "false", label: __("False", "systempress") },
		],
		"data-bs-display": [
			{ value: "", label: __("None", "systempress") },
			{ value: "block", label: __("Block", "systempress") },
			{ value: "flex", label: __("Flex", "systempress") },
			// Additional display options
		],
		"data-bs-backdrop": [
			{ value: "", label: __("None", "systempress") },
			{ value: "true", label: __("True", "systempress") },
			{ value: "false", label: __("False", "systempress") },
			{ value: "static", label: __("Static", "systempress") },
		],
		"data-bs-spy": [
			{ value: "", label: __("None", "systempress") },
			{ value: "scroll", label: __("Scroll", "systempress") },
			{ value: "affix", label: __("Affix", "systempress") },
		],
		"data-bs-theme": [
			{ value: "", label: __("None", "systempress") },
			{ value: "dark", label: __("Dark", "systempress") },
			{ value: "light", label: __("Light", "systempress") },
		],
	}

	// Extend attributes for targeted blocks
	wp.hooks.addFilter(
		"blocks.registerBlockType",
		"custom/extend-data-attributes",
		function (settings, name) {
			if (targetedBlocks.includes(name)) {
				settings.attributes = Object.assign({}, settings.attributes, {
					tabindex: { type: "string", default: "" },
					"data-bs-offset": { type: "string", default: "" },
					"data-bs-parent": { type: "string", default: "" },
					"data-bs-keyboard": { type: "string", default: "" },
					"data-bs-display": { type: "string", default: "" },
					"data-bs-backdrop": { type: "string", default: "" },
					"data-bs-spy": { type: "string", default: "" },
					"data-bs-theme": { type: "string", default: "" },
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
				var attributes = props.attributes
				var setAttributes = props.setAttributes
				var name = props.name

				// State for help modal
				var _useHelpState = useState(false),
					isHelpOpen = _useHelpState[0],
					setHelpOpen = _useHelpState[1]

				if (!targetedBlocks.includes(name)) {
					return el(BlockEdit, props)
				}

				// Handle input change for each data attribute
				var handleInputChange = function (attribute) {
					return function (value) {
						var update = {}
						update[attribute] = value
						setAttributes(update)
					}
				}

				// Render the controls with relevant Select or TextControl
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
								title: __("Data Attributes", "systempress"),
								initialOpen: false,
							},
							// Render each attribute
							[
								"tabindex",
								"data-bs-offset",
								"data-bs-parent",
								"data-bs-keyboard",
								"data-bs-display",
								"data-bs-backdrop",
								"data-bs-spy",
								"data-bs-theme",
							].map(function (attribute) {
								if (
									attribute === "tabindex" ||
									attribute === "data-bs-offset" ||
									attribute === "data-bs-parent"
								) {
									// If it's a text field (tabindex, data-bs-offset, or data-bs-parent)
									return el(TextControl, {
										key: attribute,
										label: __(attribute, "systempress"),
										value: attributes[attribute] || "",
										onChange: handleInputChange(attribute),
									})
								}

								// Otherwise, use a SelectControl for predefined options
								return el(SelectControl, {
									key: attribute,
									label: __(attribute, "systempress"),
									value: attributes[attribute] || "",
									options: dataAttributes[attribute],
									onChange: handleInputChange(attribute),
								})
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
								__("Help", "systempress")
							),
							isHelpOpen &&
								el(
									Modal,
									{
										title: __(
											"Data Attributes",
											"systempress"
										),
										onRequestClose: function () {
											setHelpOpen(false)
										},
									},
									el(
										"div",
										{},
										el(
											"p",
											{},
											__(
												"Data attributes are used to store extra information on elements. Bootstrap utilizes these attributes to enhance the functionality of various components, such as modals, tooltips, and dropdowns.",
												"systempress"
											)
										),
										el(
											"ul",
											{},
											[
												__(
													"tabindex: Defines the tab order.",
													"systempress"
												),
												__(
													"data-bs-offset: Adjusts the positioning offset.",
													"systempress"
												),
												__(
													"data-bs-parent: Defines the parent element for nested elements.",
													"systempress"
												),
												__(
													"data-bs-keyboard: Enables or disables keyboard interaction.",
													"systempress"
												),
												__(
													"data-bs-display: Specifies the display option for a component.",
													"systempress"
												),
												__(
													"data-bs-backdrop: Controls the backdrop visibility.",
													"systempress"
												),
												__(
													"data-bs-spy: Enables scroll-spy functionality.",
													"systempress"
												),
												__(
													"data-bs-theme: Specifies the theme for components.",
													"systempress"
												),
											].map(function (item) {
												return el("li", {}, item)
											})
										)
									)
								)
						)
					)
				)
			}
		}
	)

	// Add attributes to the frontend output
	wp.hooks.addFilter(
		"blocks.getSaveContent.extraProps",
		"custom/extend-save-props",
		function (extraProps, blockType, attributes) {
			if (targetedBlocks.includes(blockType.name)) {
				var dataAttributesMap = {
					tabindex: "tabindex",
					"data-bs-offset": "data-bs-offset",
					"data-bs-parent": "data-bs-parent",
					"data-bs-keyboard": "data-bs-keyboard",
					"data-bs-display": "data-bs-display",
					"data-bs-backdrop": "data-bs-backdrop",
					"data-bs-spy": "data-bs-spy",
					"data-bs-theme": "data-bs-theme",
				}

				for (var key in dataAttributesMap) {
					if (attributes[key]) {
						extraProps[dataAttributesMap[key]] = attributes[key]
					}
				}
			}
			return extraProps
		}
	)
})(window.wp)
