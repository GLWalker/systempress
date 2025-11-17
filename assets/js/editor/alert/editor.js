/** Bootstrap Alert Classes for core/group *
;(function (wp) {
	var el = wp.element.createElement
	var Fragment = wp.element.Fragment
	var addFilter = wp.hooks.addFilter
	var createHigherOrderComponent = wp.compose.createHigherOrderComponent
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var SelectControl = wp.components.SelectControl
	var registerPlugin = wp.plugins.registerPlugin

	// Define Bootstrap alert classes
	var ALERT_CLASSES = [
		{ label: "Default", value: "" },
		{ label: "Primary", value: "alert-primary" },
		{ label: "Secondary", value: "alert-secondary" },
		{ label: "Success", value: "alert-success" },
		{ label: "Danger", value: "alert-danger" },
		{ label: "Warning", value: "alert-warning" },
		{ label: "Info", value: "alert-info" },
		{ label: "Light", value: "alert-light" },
		{ label: "Dark", value: "alert-dark" },
	]

	// Add a custom attribute to the group block
	function addAlertClassAttribute(settings, name) {
		if (name === "core/group") {
			settings.attributes = Object.assign(settings.attributes, {
				alertClass: {
					type: "string",
					default: "",
				},
			})
		}
		return settings
	}

	// Create a higher-order component to add the controls for alert classes
	var withAlertClassControl = createHigherOrderComponent(function (
		BlockEdit
	) {
		return function (props) {
			if (
				props.name === "core/group" &&
				props.attributes.metadata &&
				(props.attributes.metadata.name === "BS Alert" ||
					props.attributes.metadata.name === "BS Alert Dismiss")
			) {
				var alertClass = props.attributes.alertClass

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
								title: "Bootstrap Alert Classes",
								initialOpen: true,
							},
							el(SelectControl, {
								label: "Select Alert Class",
								value: alertClass,
								options: ALERT_CLASSES,
								onChange: function (newClass) {
									props.setAttributes({
										alertClass: newClass,
									})
								},
							})
						)
					)
				)
			}
			return el(BlockEdit, props)
		}
	},
	"withAlertClassControl")

	// Add the selected alert class directly to the group block in the editor
	function addEditorClass(BlockListBlock) {
		return function (props) {
			if (
				props.block.name === "core/group" &&
				props.block.attributes.metadata &&
				(props.block.attributes.metadata.name === "BS Alert" ||
					props.block.attributes.metadata.name === "BS Alert Dismiss")
			) {
				var alertClass = props.block.attributes.alertClass
				if (alertClass) {
					props = Object.assign({}, props, {
						wrapperProps: Object.assign({}, props.wrapperProps, {
							className: [
								props.wrapperProps?.className || "",
								alertClass,
							]
								.filter(Boolean)
								.join(" "),
						}),
					})
				}
			}
			return el(BlockListBlock, props)
		}
	}

	// Add the selected alert class directly to the save output
	function addAlertClass(extraProps, blockType, attributes) {
		if (
			blockType.name === "core/group" &&
			attributes.metadata &&
			(attributes.metadata.name === "BS Alert" ||
				attributes.metadata.name === "BS Alert Dismiss") &&
			attributes.alertClass
		) {
			extraProps.className = [
				extraProps.className || "",
				attributes.alertClass,
			]
				.filter(Boolean)
				.join(" ")
		}
		return extraProps
	}

	// Register filters
	addFilter(
		"blocks.registerBlockType",
		"systempress/alert-class-attribute",
		addAlertClassAttribute
	)
	addFilter(
		"editor.BlockEdit",
		"systempress/alert-class-control",
		withAlertClassControl
	)
	addFilter(
		"editor.BlockListBlock",
		"systempress/alert-class-editor-class",
		addEditorClass
	)
	addFilter(
		"blocks.getSaveContent.extraProps",
		"systempress/alert-class",
		addAlertClass
	)
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

	var ALERT_CLASSES = [
		{ label: "Default", value: "" },
		{ label: "Primary", value: "alert-primary" },
		{ label: "Secondary", value: "alert-secondary" },
		{ label: "Success", value: "alert-success" },
		{ label: "Danger", value: "alert-danger" },
		{ label: "Warning", value: "alert-warning" },
		{ label: "Info", value: "alert-info" },
		{ label: "Light", value: "alert-light" },
		{ label: "Dark", value: "alert-dark" },
	]

	function addAlertClassAttribute(settings, name) {
		if (name === "core/group") {
			settings.attributes = Object.assign(settings.attributes, {
				alertClass: { type: "string", default: "" },
			})
		}
		return settings
	}

	var withAlertClassControl = createHigherOrderComponent(function (
		OriginalBlockEdit
	) {
		return function (blockProps) {
			if (
				blockProps.name === "core/group" &&
				blockProps.attributes.metadata &&
				(blockProps.attributes.metadata.name === "BS Alert" ||
					blockProps.attributes.metadata.name === "BS Alert Dismiss")
			) {
				var alertClass = blockProps.attributes.alertClass

				return el(
					Fragment,
					null,
					el(OriginalBlockEdit, blockProps),
					el(
						InspectorControls,
						null,
						el(
							PanelBody,
							{
								title: "Bootstrap Alert Classes",
								initialOpen: true,
							},
							el(SelectControl, {
								label: "Select Alert Class",
								value: alertClass,
								options: ALERT_CLASSES,
								onChange: function (newClass) {
									blockProps.setAttributes({
										alertClass: newClass,
									})
								},
								__nextHasNoMarginBottom: true, // Opt into the new no-margin-bottom styles
							})
						)
					)
				)
			}
			return el(OriginalBlockEdit, blockProps)
		}
	},
	"withAlertClassControl")

	function addEditorClass(BlockListBlock) {
		return function (blockProps) {
			if (
				blockProps.block.name === "core/group" &&
				blockProps.block.attributes.metadata &&
				(blockProps.block.attributes.metadata.name === "BS Alert" ||
					blockProps.block.attributes.metadata.name ===
						"BS Alert Dismiss")
			) {
				var alertClass = blockProps.block.attributes.alertClass
				if (alertClass) {
					blockProps = Object.assign({}, blockProps, {
						wrapperProps: Object.assign(
							{},
							blockProps.wrapperProps || {},
							{
								className: [
									blockProps.wrapperProps?.className || "",
									alertClass,
								]
									.filter(Boolean)
									.join(" "),
							}
						),
					})
				}
			}
			return el(BlockListBlock, blockProps)
		}
	}

	function addAlertClass(extraProps, blockType, attributes) {
		if (
			blockType.name === "core/group" &&
			attributes.metadata &&
			(attributes.metadata.name === "BS Alert" ||
				attributes.metadata.name === "BS Alert Dismiss") &&
			attributes.alertClass
		) {
			extraProps.className = [
				extraProps.className || "",
				attributes.alertClass,
			]
				.filter(Boolean)
				.join(" ")
		}
		return extraProps
	}

	addFilter(
		"blocks.registerBlockType",
		"systempress/alert-class-attribute",
		addAlertClassAttribute
	)
	addFilter(
		"editor.BlockEdit",
		"systempress/alert-class-control",
		withAlertClassControl
	)
	addFilter(
		"editor.BlockListBlock",
		"systempress/alert-class-editor-class",
		addEditorClass
	)
	addFilter(
		"blocks.getSaveContent.extraProps",
		"systempress/alert-class",
		addAlertClass
	)
})(window.wp)
