/*(function (wp) {
	var el = wp.element.createElement
	var Fragment = wp.element.Fragment
	var useState = wp.element.useState
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var TextControl = wp.components.TextControl
	var SelectControl = wp.components.SelectControl
	var Button = wp.components.Button
	var Modal = wp.components.Modal
	var __ = wp.i18n.__

	// List of targeted blocks
	var targetedBlocks = [
		"core/avatar",
		"core/button",
		"core/buttons",
		"core/column",
		"core/columns",
		"core/comment-author-name",
		"core/comment-content",
		"core/comment-date",
		"core/comment-template",
		"core/comments",
		"core/comments-title",
		"core/footnotes",
		"core/gallery",
		"core/group",
		"core/heading",
		"core/image",
		"core/list",
		"core/list-item",
		"core/navigation",
		"core/navigation-submenu",
		"core/paragraph",
		"core/post-author",
		"core/post-author-biography",
		"core/post-author-name",
		"core/post-comments-form",
		"core/post-content",
		"core/post-date",
		"core/post-excerpt",
		"core/quote",
		"core/row",
		"core/search",
		"core/site-logo",
		"core/site-tagline",
		"core/site-title",
		"core/social-links",
		"core/stack",
		"core/template-part",
		"core/term-description",
		"core/video",
	]

	// Common ARIA roles
	var roleOptions = [
		{ value: "", label: __("None", "systempress") },

		{ value: "alert", label: __("Alert", "systempress") },
		{ value: "alertdialog", label: __("Alert Dialog", "systempress") },
		{ value: "application", label: __("Application", "systempress") },
		{ value: "banner", label: __("Banner", "systempress") },
		{ value: "button", label: __("Button", "systempress") },
		{ value: "cell", label: __("Cell", "systempress") },
		{ value: "columnheader", label: __("Column Header", "systempress") },
		{ value: "complementary", label: __("Complementary", "systempress") },
		{ value: "contentinfo", label: __("Content Info", "systempress") },
		{ value: "dialog", label: __("Dialog", "systempress") },
		{ value: "doc-endnotes", label: __("Doc Endnotes", "systempress") },
		{ value: "form", label: __("Form", "systempress") },
		{ value: "grid", label: __("Grid", "systempress") },
		{ value: "gridcell", label: __("Grid Cell", "systempress") },
		{ value: "group", label: __("Group", "systempress") },
		{ value: "heading", label: __("Heading", "systempress") },
		{ value: "list", label: __("List", "systempress") },
		{ value: "listbox", label: __("Listbox", "systempress") },
		{ value: "listitem", label: __("List Item", "systempress") },
		{ value: "main", label: __("Main", "systempress") },
		{ value: "menu", label: __("Menu", "systempress") },
		{ value: "menubar", label: __("Menubar", "systempress") },
		{ value: "menuitem", label: __("Menu Item", "systempress") },
		{ value: "navigation", label: __("Navigation", "systempress") },
		{ value: "option", label: __("Option", "systempress") },
		{ value: "progressbar", label: __("Progress Bar", "systempress") },
		{ value: "region", label: __("Region", "systempress") },
		{ value: "row", label: __("Row", "systempress") },
		{ value: "rowgroup", label: __("Row Group", "systempress") },
		{ value: "rowheader", label: __("Row Header", "systempress") },
		{ value: "search", label: __("Search", "systempress") },
		{ value: "separator", label: __("Separator", "systempress") },
		{ value: "slider", label: __("Slider", "systempress") },
		{ value: "status", label: __("Status", "systempress") },
		{ value: "tab", label: __("Tab", "systempress") },
		{ value: "table", label: __("Table", "systempress") },
		{ value: "tablist", label: __("Tablist", "systempress") },
		{ value: "tabpanel", label: __("Tabpanel", "systempress") },
		{ value: "textbox", label: __("Textbox", "systempress") },
		{ value: "timer", label: __("Timer", "systempress") },
		{ value: "toolbar", label: __("Toolbar", "systempress") },
		{ value: "tooltip", label: __("Tooltip", "systempress") },
		{ value: "tree", label: __("Tree", "systempress") },
		{ value: "treegrid", label: __("Treegrid", "systempress") },
		{ value: "treeitem", label: __("Treeitem", "systempress") },
		// Add more roles as needed
	]

	// Extend attributes for targeted blocks
	wp.hooks.addFilter(
		"blocks.registerBlockType",
		"custom/extend-aria-attributes",
		function (settings, name) {
			if (targetedBlocks.includes(name)) {
				settings.attributes = Object.assign({}, settings.attributes, {
					role: { type: "string", default: "" },
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
				var attributes = props.attributes
				var setAttributes = props.setAttributes
				var name = props.name

				// State for help modal
				var _useState = useState(false),
					isHelpOpen = _useState[0],
					setHelpOpen = _useState[1]

				if (!targetedBlocks.includes(name)) {
					return el(BlockEdit, props)
				}

				var handleInputChange = function (attribute) {
					return function (value) {
						var update = {}
						update[attribute] = value
						setAttributes(update)
					}
				}

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
								title: __("ARIA Attributes", "systempress"),
								initialOpen: false,
							},
							el(SelectControl, {
								key: "role",
								label: __("Role", "systempress"),
								value: attributes.role || "",
								options: roleOptions,
								onChange: handleInputChange("role"),
							}),
							[
								"ariaLabel",
								"ariaLabelledby",
								"ariaDescribedby",
								"ariaControls",
								"ariaLive",
								"ariaAtomic",
								"ariaValuenow",
								"ariaValuemin",
								"ariaValuemax",
							].map(function (key) {
								return el(TextControl, {
									key: key,
									label: __(
										key.replace(/([A-Z])/g, " $1").trim(),
										"systempress"
									),
									value: attributes[key] || "",
									onChange: handleInputChange(key),
									__nextHasNoMarginBottom: true,
								})
							}),
							["ariaHidden", "ariaExpanded", "ariaHaspopup"].map(
								function (key) {
									return el(SelectControl, {
										key: key,
										label: __(
											key
												.replace(/([A-Z])/g, " $1")
												.trim(),
											"systempress"
										),
										value: attributes[key] || "",
										options: [
											{
												value: "",
												label: __(
													"None",
													"systempress"
												),
											},
											{
												value: "true",
												label: __(
													"True",
													"systempress"
												),
											},
											{
												value: "false",
												label: __(
													"False",
													"systempress"
												),
											},
										],
										onChange: handleInputChange(key),
									})
								}
							),
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
											"ARIA Attributes",
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
												"ARIA attributes are essential for making web content accessible to people with disabilities. They define roles, states, and properties that help assistive technologies understand the purpose and behavior of elements.",
												"systempress"
											)
										),
										el(
											"ul",
											{},
											[
												__(
													"role: Defines the element's role.",
													"systempress"
												),
												__(
													"aria-label: Provides an accessible name.",
													"systempress"
												),
												__(
													"aria-labelledby: References an element that labels the current element.",
													"systempress"
												),
												__(
													"aria-describedby: References an element that provides additional description.",
													"systempress"
												),
												__(
													"aria-hidden: Hides the element from assistive technologies.",
													"systempress"
												),
												__(
													"aria-expanded: Indicates if an element is expanded or collapsed.",
													"systempress"
												),
												__(
													"aria-controls: References a controlled element.",
													"systempress"
												),
												__(
													"aria-haspopup: Indicates the presence of a popup.",
													"systempress"
												),
												__(
													"aria-live: Defines live region priority.",
													"systempress"
												),
												__(
													"aria-atomic: Specifies whether updates are atomic.",
													"systempress"
												),
												__(
													"aria-valuenow: Defines the current value in a range.",
													"systempress"
												),
												__(
													"aria-valuemin: Defines the minimum value in a range.",
													"systempress"
												),
												__(
													"aria-valuemax: Defines the maximum value in a range.",
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
				var ariaAttributesMap = {
					role: "role",
					ariaLabel: "aria-label",
					ariaLabelledby: "aria-labelledby",
					ariaDescribedby: "aria-describedby",
					ariaHidden: "aria-hidden",
					ariaExpanded: "aria-expanded",
					ariaControls: "aria-controls",
					ariaHaspopup: "aria-haspopup",
					ariaLive: "aria-live",
					ariaAtomic: "aria-atomic",
					ariaValuenow: "aria-valuenow",
					ariaValuemin: "aria-valuemin",
					ariaValuemax: "aria-valuemax",
				}

				Object.entries(ariaAttributesMap).forEach(function ([
					attribute,
					htmlAttr,
				]) {
					if (attributes[attribute]) {
						extraProps[htmlAttr] = attributes[attribute]
					}
				})
			}

			return extraProps
		}
	)
})(window.wp)
*/

;(function (wp) {
	var el = wp.element.createElement
	var Fragment = wp.element.Fragment
	var useState = wp.element.useState
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var TextControl = wp.components.TextControl
	var SelectControl = wp.components.SelectControl
	var Button = wp.components.Button
	var Modal = wp.components.Modal
	var ToggleControl = wp.components.ToggleControl
	var __ = wp.i18n.__

	// List of targeted blocks
	var targetedBlocks = [
		"core/avatar",
		"core/button",
		"core/buttons",
		"core/column",
		"core/columns",
		"core/comment-author-name",
		"core/comment-content",
		"core/comment-date",
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
		"core/post-author",
		"core/post-author-biography",
		"core/post-author-name",
		"core/post-content",
		"core/post-date",
		"core/post-excerpt",
		"core/row",
		"core/stack",
		"core/term-description",
		"core/video",
	]

	// Common ARIA roles
	var commonRoles = [
		{ value: "", label: __("None", "systempress") },
		{ value: "button", label: __("Button", "systempress") },
		{ value: "navigation", label: __("Navigation", "systempress") },
		{ value: "dialog", label: __("Dialog", "systempress") },
		{ value: "banner", label: __("Banner", "systempress") },
		{ value: "main", label: __("Main", "systempress") },
		{ value: "contentinfo", label: __("Content Info", "systempress") },
	]

	// Full ARIA roles (including common roles)
	var advancedRoles = [
		...commonRoles,
		{ value: "alert", label: __("Alert", "systempress") },
		{ value: "alertdialog", label: __("Alert Dialog", "systempress") },
		{ value: "application", label: __("Application", "systempress") },
		{ value: "cell", label: __("Cell", "systempress") },
		{ value: "columnheader", label: __("Column Header", "systempress") },
		{ value: "complementary", label: __("Complementary", "systempress") },
		{ value: "dialog", label: __("Dialog", "systempress") },
		{ value: "form", label: __("Form", "systempress") },
		{ value: "grid", label: __("Grid", "systempress") },
		{ value: "group", label: __("Group", "systempress") },
		{ value: "heading", label: __("Heading", "systempress") },
		{ value: "list", label: __("List", "systempress") },
		{ value: "listbox", label: __("Listbox", "systempress") },
		{ value: "listitem", label: __("List Item", "systempress") },
		{ value: "region", label: __("Region", "systempress") },
		{ value: "search", label: __("Search", "systempress") },
		{ value: "tab", label: __("Tab", "systempress") },
		{ value: "table", label: __("Table", "systempress") },
		{ value: "tabpanel", label: __("Tabpanel", "systempress") },
		{ value: "toolbar", label: __("Toolbar", "systempress") },
		{ value: "tooltip", label: __("Tooltip", "systempress") },
	]

	// Extend attributes for targeted blocks
	wp.hooks.addFilter(
		"blocks.registerBlockType",
		"custom/extend-aria-attributes",
		function (settings, name) {
			if (targetedBlocks.includes(name)) {
				settings.attributes = Object.assign({}, settings.attributes, {
					role: { type: "string", default: "" },
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

				// State to toggle between common and advanced roles
				var _useState = useState(false),
					showAdvancedRoles = _useState[0],
					setShowAdvancedRoles = _useState[1]

				var handleInputChange = function (attribute) {
					return function (value) {
						var update = {}
						update[attribute] = value
						setAttributes(update)
					}
				}

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
								title: __("ARIA Attributes", "systempress"),
								initialOpen: false,
							},
							el(SelectControl, {
								key: "role",
								label: __("Role", "systempress"),
								value: attributes.role || "",
								options: showAdvancedRoles
									? advancedRoles
									: commonRoles,
								onChange: handleInputChange("role"),
							}),
							el(ToggleControl, {
								label: __("Show Advanced Roles", "systempress"),
								help: showAdvancedRoles
									? __("Displaying all roles.", "systempress")
									: __(
											"Displaying common roles only.",
											"systempress"
									  ),
								checked: showAdvancedRoles,
								onChange: function () {
									setShowAdvancedRoles(!showAdvancedRoles)
								},
							}),
							[
								"ariaLabel",
								"ariaLabelledby",
								"ariaDescribedby",
								"ariaControls",
								"ariaLive",
								"ariaAtomic",
								"ariaValuenow",
								"ariaValuemin",
								"ariaValuemax",
							].map(function (key) {
								return el(TextControl, {
									key: key,
									label: __(
										key.replace(/([A-Z])/g, " $1").trim(),
										"systempress"
									),
									value: attributes[key] || "",
									onChange: handleInputChange(key),
									__nextHasNoMarginBottom: true,
								})
							}),
							["ariaHidden", "ariaExpanded", "ariaHaspopup"].map(
								function (key) {
									return el(SelectControl, {
										key: key,
										label: __(
											key
												.replace(/([A-Z])/g, " $1")
												.trim(),
											"systempress"
										),
										value: attributes[key] || "",
										options: [
											{
												value: "",
												label: __(
													"None",
													"systempress"
												),
											},
											{
												value: "true",
												label: __(
													"True",
													"systempress"
												),
											},
											{
												value: "false",
												label: __(
													"False",
													"systempress"
												),
											},
										],
										onChange: handleInputChange(key),
									})
								}
							),
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
											"ARIA Attributes",
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
												"ARIA attributes are essential for making web content accessible to people with disabilities. They define roles, states, and properties that help assistive technologies understand the purpose and behavior of elements.",
												"systempress"
											)
										),
										el(
											"ul",
											{},
											[
												__(
													"role: Defines the element's role.",
													"systempress"
												),
												__(
													"aria-label: Provides an accessible name.",
													"systempress"
												),
												__(
													"aria-labelledby: References an element that labels the current element.",
													"systempress"
												),
												__(
													"aria-describedby: References an element that provides additional description.",
													"systempress"
												),
												__(
													"aria-hidden: Hides the element from assistive technologies.",
													"systempress"
												),
												__(
													"aria-expanded: Indicates if an element is expanded or collapsed.",
													"systempress"
												),
												__(
													"aria-controls: References a controlled element.",
													"systempress"
												),
												__(
													"aria-haspopup: Indicates the presence of a popup.",
													"systempress"
												),
												__(
													"aria-live: Defines live region priority.",
													"systempress"
												),
												__(
													"aria-atomic: Specifies whether updates are atomic.",
													"systempress"
												),
												__(
													"aria-valuenow: Defines the current value in a range.",
													"systempress"
												),
												__(
													"aria-valuemin: Defines the minimum value in a range.",
													"systempress"
												),
												__(
													"aria-valuemax: Defines the maximum value in a range.",
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
				var ariaAttributesMap = {
					role: "role",
					ariaLabel: "aria-label",
					ariaLabelledby: "aria-labelledby",
					ariaDescribedby: "aria-describedby",
					ariaHidden: "aria-hidden",
					ariaExpanded: "aria-expanded",
					ariaControls: "aria-controls",
					ariaHaspopup: "aria-haspopup",
					ariaLive: "aria-live",
					ariaAtomic: "aria-atomic",
					ariaValuenow: "aria-valuenow",
					ariaValuemin: "aria-valuemin",
					ariaValuemax: "aria-valuemax",
				}

				for (var key in ariaAttributesMap) {
					if (attributes[key]) {
						extraProps[ariaAttributesMap[key]] = attributes[key]
					}
				}
			}
			return extraProps
		}
	)
})(window.wp)
