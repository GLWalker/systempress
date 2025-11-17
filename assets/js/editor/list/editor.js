/*
;(function (wp) {
	var el = wp.element.createElement
	var Fragment = wp.element.Fragment
	var addFilter = wp.hooks.addFilter
	var createHigherOrderComponent = wp.compose.createHigherOrderComponent
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var SelectControl = wp.components.SelectControl
	var registerPlugin = wp.plugins.registerPlugin

	// Define Bootstrap list group classes
	var LIST_GROUP_CLASSES = [
		{ label: "Default", value: "" },
		{ label: "List Group", value: "list-group" },
		{ label: "Horizontal", value: "list-group list-group-horizontal" },
		{ label: "Flush", value: "list-group list-group-flush" },
		{ label: "Numbered", value: "list-group list-group-numbered" },
	]

	// Add a custom attribute to the list block
	function addListGroupAttribute(settings, name) {
		if (name === "core/list") {
			settings.attributes = Object.assign(settings.attributes, {
				listGroupClass: {
					type: "string",
					default: "",
				},
			})
		}
		return settings
	}

	// Create a higher-order component to add the controls for list group classes
	var withListGroupControl = createHigherOrderComponent(function (BlockEdit) {
		return function (props) {
			if (props.name === "core/list") {
				var listGroupClass = props.attributes.listGroupClass

				return el(
					Fragment,
					null,
					el(BlockEdit, props), // Render the block as usual
					el(
						InspectorControls,
						null,
						el(
							PanelBody,
							{
								title: "List Group Classes",
								initialOpen: true,
							},
							el(SelectControl, {
								label: "Select Bootstrap List Group Class",
								value: listGroupClass,
								options: LIST_GROUP_CLASSES,
								onChange: function (newClass) {
									props.setAttributes({
										listGroupClass: newClass,
									})
								},
							})
						)
					)
				)
			}
			return el(BlockEdit, props)
		}
	}, "withListGroupControl")

	// Add the selected list group class directly to the list (`<ul>` or `<ol>`) in the editor
	function addEditorClass(BlockListBlock) {
		return function (props) {
			if (props.block.name === "core/list") {
				var listGroupClass = props.block.attributes.listGroupClass
				if (listGroupClass) {
					props.wrapperProps = Object.assign({}, props.wrapperProps, {
						className: [
							props.wrapperProps?.className || "",
							listGroupClass,
						]
							.filter(Boolean)
							.join(" "),
					})
				}
			}
			return el(BlockListBlock, props)
		}
	}

	// Add the selected list group class directly to the save output
	function addListGroupClass(extraProps, blockType, attributes) {
		if (blockType.name === "core/list" && attributes.listGroupClass) {
			extraProps.className = [
				extraProps.className || "",
				attributes.listGroupClass,
			]
				.filter(Boolean)
				.join(" ")
		}
		return extraProps
	}

	// Register filters
	addFilter(
		"blocks.registerBlockType",
		"my-plugin/list-group-attribute",
		addListGroupAttribute
	)
	addFilter(
		"editor.BlockEdit",
		"my-plugin/list-group-control",
		withListGroupControl
	)
	addFilter(
		"editor.BlockListBlock",
		"my-plugin/list-group-editor-class",
		addEditorClass
	)
	addFilter(
		"blocks.getSaveContent.extraProps",
		"my-plugin/list-group-class",
		addListGroupClass
	)

	// Register the plugin (optional, for visibility in the plugins menu)
	registerPlugin("list-group-plugin", {
		render: function () {
			return null
		},
	})
})(window.wp)
******************
;(function (wp) {
	var el = wp.element.createElement
	var Fragment = wp.element.Fragment
	var addFilter = wp.hooks.addFilter
	var createHigherOrderComponent = wp.compose.createHigherOrderComponent
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var SelectControl = wp.components.SelectControl
	var registerPlugin = wp.plugins.registerPlugin

	// Define Bootstrap list group classes
	var LIST_GROUP_CLASSES = [
		{ label: "Default", value: "" },
		{ label: "List Group", value: "list-group" },
		{ label: "Horizontal", value: "list-group list-group-horizontal" },
		{ label: "Flush", value: "list-group list-group-flush" },
		{ label: "Numbered", value: "list-group list-group-numbered" },
	]

	// Add a custom attribute to store list group class selection
	function addListGroupAttribute(settings, name) {
		if (name === "core/list") {
			settings.attributes = Object.assign(settings.attributes, {
				className: {
					type: "string",
					default: "",
				},
			})
		}
		return settings
	}

	// Create a higher-order component to add the controls for list group classes
	var withListGroupControl = createHigherOrderComponent(function (BlockEdit) {
		return function (props) {
			if (props.name === "core/list") {
				var currentClassName = props.attributes.className || ""

				return el(
					Fragment,
					null,
					el(BlockEdit, props), // Render the block as usual
					el(
						InspectorControls,
						null,
						el(
							PanelBody,
							{
								title: "List Group Classes",
								initialOpen: true,
							},
							el(SelectControl, {
								label: "Select Bootstrap List Group Class",
								value:
									LIST_GROUP_CLASSES.find((c) =>
										currentClassName.includes(c.value)
									)?.value || "",
								options: LIST_GROUP_CLASSES,
								onChange: function (newClass) {
									// Remove any existing list-group classes before adding a new one
									var updatedClassName = currentClassName
										.split(" ")
										.filter(
											(cls) =>
												!cls.startsWith("list-group")
										)
										.join(" ")
										.trim()

									// Append the new class if it's not empty
									if (newClass) {
										updatedClassName += " " + newClass
									}

									props.setAttributes({
										className: updatedClassName.trim(),
									})
								},
							})
						)
					)
				)
			}
			return el(BlockEdit, props)
		}
	}, "withListGroupControl")

	// Register filters
	addFilter(
		"blocks.registerBlockType",
		"my-plugin/list-group-attribute",
		addListGroupAttribute
	)
	addFilter(
		"editor.BlockEdit",
		"my-plugin/list-group-control",
		withListGroupControl
	)

	// Register the plugin (optional, for visibility in the plugins menu)
	registerPlugin("list-group-plugin", {
		render: function () {
			return null
		},
	})
})(window.wp)
*/

;(function (wp) {
	var el = wp.element.createElement
	var Fragment = wp.element.Fragment
	var addFilter = wp.hooks.addFilter
	var createHigherOrderComponent = wp.compose.createHigherOrderComponent
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var SelectControl = wp.components.SelectControl
	var registerPlugin = wp.plugins.registerPlugin

	// Define Bootstrap list group classes
	var LIST_GROUP_CLASSES = [
		{ label: "Default", value: "" },
		{ label: "List Group", value: "list-group" },
		{ label: "Horizontal", value: "list-group list-group-horizontal" },
		{ label: "Flush", value: "list-group list-group-flush" },
		{ label: "Numbered", value: "list-group list-group-numbered" },
	]

	// Add a custom attribute to the list block
	function addListGroupAttribute(settings, name) {
		if (name === "core/list") {
			settings.attributes = Object.assign(settings.attributes, {
				listGroupClass: {
					type: "string",
					default: "",
				},
			})
		}
		return settings
	}

	// Create a higher-order component to add the controls for list group classes
	var withListGroupControl = createHigherOrderComponent(function (BlockEdit) {
		return function (props) {
			if (props.name === "core/list") {
				var listGroupClass = props.attributes.listGroupClass || ""
				var className = props.attributes.className || ""
				var hasActionClass = className.includes(
					"list-group-item-action"
				)

				return el(
					Fragment,
					null,
					el(BlockEdit, props), // Render the block as usual
					el(
						InspectorControls,
						null,
						el(
							PanelBody,
							{
								title: "List Group Settings",
								initialOpen: true,
							},
							el(SelectControl, {
								label: "Select Bootstrap List Group Class",
								value: listGroupClass,
								options: LIST_GROUP_CLASSES,
								onChange: function (newClass) {
									var updatedClasses = className
										.split(" ")
										.filter(
											(cls) =>
												!LIST_GROUP_CLASSES.some(
													(opt) =>
														opt.value.includes(cls)
												)
										)
										.concat(newClass)
										.filter(Boolean)
										.join(" ")

									props.setAttributes({
										listGroupClass: newClass,
										className: updatedClasses, // Ensure all classes persist
									})
								},
							}),
							// Checkbox to add/remove list-group-item-action
							el(
								"label",
								{
									className:
										"components-checkbox-control__label",
								},
								el("input", {
									type: "checkbox",
									checked: hasActionClass,
									onChange: function (event) {
										var currentClasses = className
											.split(" ")
											.filter(Boolean)
										var updatedClasses = event.target
											.checked
											? [
													...new Set([
														...currentClasses,
														"list-group-item-action",
													]),
											  ] // Add class if checked
											: currentClasses.filter(
													(cls) =>
														cls !==
														"list-group-item-action"
											  ) // Remove if unchecked

										props.setAttributes({
											className: updatedClasses.join(" "), // Preserve all existing classes
										})
									},
								}),
								el("span", null, "Enable Action Item")
							)
						)
					)
				)
			}
			return el(BlockEdit, props)
		}
	}, "withListGroupControl")

	// Add the selected list group class directly to the save output without removing other classes
	function addListGroupClass(extraProps, blockType, attributes) {
		if (blockType.name === "core/list") {
			var existingClasses = extraProps.className
				? extraProps.className.split(" ")
				: []
			var updatedClasses = [
				...new Set([
					...existingClasses,
					attributes.className || "",
					attributes.listGroupClass || "",
				]),
			]
				.filter(Boolean)
				.join(" ")

			extraProps.className = updatedClasses
		}
		return extraProps
	}

	// Register filters
	addFilter(
		"blocks.registerBlockType",
		"my-plugin/list-group-attribute",
		addListGroupAttribute
	)
	addFilter(
		"editor.BlockEdit",
		"my-plugin/list-group-control",
		withListGroupControl
	)
	addFilter(
		"blocks.getSaveContent.extraProps",
		"my-plugin/list-group-class",
		addListGroupClass
	)

	// Register the plugin (optional, for visibility in the plugins menu)
	registerPlugin("list-group-plugin", {
		render: function () {
			return null
		},
	})
})(window.wp)
