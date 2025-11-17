;(function (wp) {
	var el = wp.element.createElement
	var Fragment = wp.element.Fragment
	var InspectorControls = wp.blockEditor.InspectorControls
	var ToggleControl = wp.components.ToggleControl

	wp.hooks.addFilter(
		"editor.BlockEdit",
		"theme/list-item-group-checkbox-control",
		function (BlockEdit) {
			return function (props) {
				// Check if this is the `core/list-item` block
				if (props.name !== "core/list-item") {
					return el(BlockEdit, props)
				}

				var hasActiveClass =
					props.attributes.className &&
					props.attributes.className.includes(
						"list-group-item-action"
					)

				return el(
					Fragment,
					{},
					el(BlockEdit, props),
					el(
						InspectorControls,
						{},
						el(
							wp.components.PanelBody,
							{
								title: "List Item Group Options",
								initialOpen: true,
							},
							el(ToggleControl, {
								label: 'Add "list-group-item-action" class',
								checked: hasActiveClass,
								onChange: function (newState) {
									var newClassName =
										props.attributes.className || ""

									if (newState) {
										newClassName +=
											" list-group-item-action"
									} else {
										newClassName = newClassName.replace(
											"list-group-item-action",
											""
										)
									}

									props.setAttributes({
										className: newClassName.trim(),
									})
								},
							})
						)
					)
				)
			}
		}
	)
})(window.wp)

wp.blocks.registerBlockType("core/list-item", {
	// Block settings...
	edit: function (props) {
		var attributes = props.attributes
		var setAttributes = props.setAttributes
		var className = props.className

		// Get the parent block using wp.data.select
		var parentBlock = wp.data
			.select("core/block-editor")
			.getBlocks(props.clientId)
		var isListGroup =
			parentBlock.length &&
			parentBlock[0].attributes.className &&
			parentBlock[0].attributes.className.includes("list-group")

		return wp.element.createElement(
			wp.element.Fragment,
			null,
			wp.element.createElement(
				"div",
				{ className: className }
				// Other block editor content goes here
			),
			// Conditionally render the checkbox if the parent has list-group class
			isListGroup
				? wp.element.createElement(
						"div",
						{ className: "components-base-control" },
						wp.element.createElement(
							"label",
							{ className: "components-checkbox-control__label" },
							wp.element.createElement("input", {
								type: "checkbox",
								checked:
									attributes.className &&
									attributes.className.includes(
										"list-group-active"
									),
								onChange: function (event) {
									var updatedClassName = event.target.checked
										? "list-group-item list-group-active"
										: "list-group-item"
									setAttributes({
										className: updatedClassName,
									})
								},
							}),
							wp.element.createElement(
								"span",
								null,
								"Active Item"
							)
						)
				  )
				: null
		)
	},

	save: function (props) {
		return wp.element.createElement(
			"li",
			{ className: props.attributes.className },
			props.children
		)
	},
})
