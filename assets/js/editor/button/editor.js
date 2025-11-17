;(function (wp) {
	var el = wp.element.createElement
	var Fragment = wp.element.Fragment
	var addFilter = wp.hooks.addFilter
	var createHigherOrderComponent = wp.compose.createHigherOrderComponent
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var SelectControl = wp.components.SelectControl

	var BTN_CLASSES = [
		{ label: "Default", value: "" },
		{ label: "Small", value: "btn-sm" },
		{ label: "Large", value: "btn-lg" },
	]

	// Add btnClass attribute to the button block
	function addBtnClassAttribute(settings, name) {
		if (name === "core/button") {
			settings.attributes = Object.assign(settings.attributes, {
				btnClass: { type: "string", default: "" },
			})
		}
		return settings
	}

	// Add a control in the block editor to change the btnClass
	var withBtnClassControl = createHigherOrderComponent(function (
		OriginalBlockEdit
	) {
		return function (blockProps) {
			if (blockProps.name === "core/button") {
				var btnClass = blockProps.attributes.btnClass

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
								title: "Bootstrap Btn Size",
								initialOpen: true,
							},
							el(SelectControl, {
								label: "Select Btn Size",
								value: btnClass,
								options: BTN_CLASSES,
								onChange: function (newClass) {
									blockProps.setAttributes({
										btnClass: newClass,
									})
								},
								__nextHasNoMarginBottom: true,
							})
						)
					)
				)
			}
			return el(OriginalBlockEdit, blockProps)
		}
	},
	"withBtnClassControl")

	// Add the btnClass to the block's wrapper props for the editor view
	function addEditorClass(BlockListBlock) {
		return function (blockProps) {
			if (blockProps.block.name === "core/button") {
				var btnClass = blockProps.block.attributes.btnClass
				if (btnClass) {
					blockProps = Object.assign({}, blockProps, {
						wrapperProps: Object.assign(
							{},
							blockProps.wrapperProps || {},
							{
								className: [
									blockProps.wrapperProps?.className || "",
									btnClass,
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

	// Ensure btnClass is applied in the saved content
	function addBtnClass(extraProps, blockType, attributes) {
		if (blockType.name === "core/button" && attributes.btnClass) {
			extraProps.className = [
				extraProps.className || "",
				attributes.btnClass,
			]
				.filter(Boolean)
				.join(" ")
		}
		return extraProps
	}

	// Register the filters
	addFilter(
		"blocks.registerBlockType",
		"systempress/btn-class-attribute",
		addBtnClassAttribute
	)
	addFilter(
		"editor.BlockEdit",
		"systempress/btn-class-control",
		withBtnClassControl
	)
	addFilter(
		"editor.BlockListBlock",
		"systempress/btn-class-editor-class",
		addEditorClass
	)
	addFilter(
		"blocks.getSaveContent.extraProps",
		"systempress/btn-class",
		addBtnClass
	)
})(window.wp)
