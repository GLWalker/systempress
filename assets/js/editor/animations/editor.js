;(function (wp) {
	var el = wp.element.createElement
	var Fragment = wp.element.Fragment
	var addFilter = wp.hooks.addFilter
	var createHigherOrderComponent = wp.compose.createHigherOrderComponent
	var InspectorControls = wp.blockEditor.InspectorControls
	var PanelBody = wp.components.PanelBody
	var SelectControl = wp.components.SelectControl
	var useEffect = wp.element.useEffect

	// Define targeted blocks
	var targetedBlocks = [
		"core/buttons",
		"core/column",
		"core/columns",
		"core/gallery",
		"core/group",
		"core/heading",
		"core/image",
	]

	// Define animation categories and their classes
	var ANIMATION_CATEGORIES = {
		"Attention Seekers": [
			"animate__bounce",
			"animate__flash",
			"animate__pulse",
			"animate__rubberBand",
			"animate__shakeX",
			"animate__shakeY",
			"animate__headShake",
			"animate__swing",
			"animate__tada",
			"animate__wobble",
			"animate__jello",
			"animate__heartBeat",
		],
		"Back Entrances": [
			"animate__backInDown",
			"animate__backInLeft",
			"animate__backInRight",
			"animate__backInUp",
		],
		"Back Exits": [
			"animate__backOutDown",
			"animate__backOutLeft",
			"animate__backOutRight",
			"animate__backOutUp",
		],
		"Bouncing Entrances": [
			"animate__bounceIn",
			"animate__bounceInDown",
			"animate__bounceInLeft",
			"animate__bounceInRight",
			"animate__bounceInUp",
		],
		"Bouncing Exits": [
			"animate__bounceOut",
			"animate__bounceOutDown",
			"animate__bounceOutLeft",
			"animate__bounceOutRight",
			"animate__bounceOutUp",
		],
		"Fading Entrances": [
			"animate__fadeIn",
			"animate__fadeInDown",
			"animate__fadeInDownBig",
			"animate__fadeInLeft",
			"animate__fadeInLeftBig",
			"animate__fadeInRight",
			"animate__fadeInRightBig",
			"animate__fadeInUp",
			"animate__fadeInUpBig",
			"animate__fadeInTopLeft",
			"animate__fadeInTopRight",
			"animate__fadeInBottomLeft",
			"animate__fadeInBottomRight",
		],
		"Fading Exits": [
			"animate__fadeOut",
			"animate__fadeOutDown",
			"animate__fadeOutDownBig",
			"animate__fadeOutLeft",
			"animate__fadeOutLeftBig",
			"animate__fadeOutRight",
			"animate__fadeOutRightBig",
			"animate__fadeOutUp",
			"animate__fadeOutUpBig",
			"animate__fadeOutTopLeft",
			"animate__fadeOutTopRight",
			"animate__fadeOutBottomRight",
			"animate__fadeOutBottomLeft",
		],
		Flippers: [
			"animate__flip",
			"animate__flipInX",
			"animate__flipInY",
			"animate__flipOutX",
			"animate__flipOutY",
		],
		Lightspeed: [
			"animate__lightSpeedInRight",
			"animate__lightSpeedInLeft",
			"animate__lightSpeedOutRight",
			"animate__lightSpeedOutLeft",
		],
		"Rotating Entrances": [
			"animate__rotateIn",
			"animate__rotateInDownLeft",
			"animate__rotateInDownRight",
			"animate__rotateInUpLeft",
			"animate__rotateInUpRight",
		],
		"Rotating Exits": [
			"animate__rotateOut",
			"animate__rotateOutDownLeft",
			"animate__rotateOutDownRight",
			"animate__rotateOutUpLeft",
			"animate__rotateOutUpRight",
		],
		Specials: [
			"animate__hinge",
			"animate__jackInTheBox",
			"animate__rollIn",
			"animate__rollOut",
		],
		"Zooming Entrances": [
			"animate__zoomIn",
			"animate__zoomInDown",
			"animate__zoomInLeft",
			"animate__zoomInRight",
			"animate__zoomInUp",
		],
		"Zooming Exits": [
			"animate__zoomOut",
			"animate__zoomOutDown",
			"animate__zoomOutLeft",
			"animate__zoomOutRight",
			"animate__zoomOutUp",
		],
		"Sliding Entrances": [
			"animate__slideInDown",
			"animate__slideInLeft",
			"animate__slideInRight",
			"animate__slideInUp",
		],
		"Sliding Exits": [
			"animate__slideOutDown",
			"animate__slideOutLeft",
			"animate__slideOutRight",
			"animate__slideOutUp",
		],
	}

	// Add custom attributes to the targeted blocks
	function addAnimationAttributes(settings, name) {
		if (targetedBlocks.includes(name)) {
			settings.attributes = Object.assign(settings.attributes, {
				animationCategory: { type: "string", default: "" },
				animationClass: { type: "string", default: "" },
			})
		}
		return settings
	}

	// Create a higher-order component to add the controls
	var withAnimationControls = createHigherOrderComponent(function (
		BlockEdit
	) {
		return function (props) {
			if (targetedBlocks.includes(props.name)) {
				var animationCategory = props.attributes.animationCategory
				var animationClass = props.attributes.animationClass

				var categoryOptions = [
					{ label: "None", value: "" },
					...Object.keys(ANIMATION_CATEGORIES).map((category) => ({
						label: category,
						value: category,
					})),
				]

				var classOptions = animationCategory
					? [
							{ label: "None", value: "" },
							...(
								ANIMATION_CATEGORIES[animationCategory] || []
							).map((cls) => ({
								label: cls.replace("animate__", ""),
								value: cls,
							})),
					  ]
					: [{ label: "Select a category first", value: "" }]

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
								title: "Animation Controls",
								initialOpen: true,
							},
							el(SelectControl, {
								label: "Animation Category",
								value: animationCategory,
								options: categoryOptions,
								onChange: function (newCategory) {
									props.setAttributes({
										animationCategory: newCategory,
										animationClass: "",
									})
								},
								__nextHasNoMarginBottom: true,
							}),
							el(SelectControl, {
								label: "Animation Class",
								value: animationClass,
								options: classOptions,
								onChange: function (newClass) {
									props.setAttributes({
										animationClass: newClass,
									})
								},
								__nextHasNoMarginBottom: true,
							})
						)
					)
				)
			}
			return el(BlockEdit, props)
		}
	},
	"withAnimationControls")

	// Add the selected animation class directly to the block in the editor
	function addEditorClass(BlockListBlock) {
		return function (props) {
			if (targetedBlocks.includes(props.block.name)) {
				var animationClass = props.block.attributes.animationClass

				useEffect(() => {
					var wrapper = props.wrapperProps && props.wrapperProps.ref
					if (wrapper && animationClass) {
						// Remove existing animation classes
						wrapper.classList.remove("animate__animated")
						wrapper.classList.forEach(function (cls) {
							if (cls.startsWith("animate__")) {
								wrapper.classList.remove(cls)
							}
						})

						// Apply new animation classes
						wrapper.classList.add(
							"wow",
							"animate__animated",
							animationClass
						)

						// Trigger reflow for animation
						void wrapper.offsetWidth
					}
				}, [animationClass])

				// Create new wrapperProps to avoid direct mutation
				var newWrapperProps = Object.assign({}, props.wrapperProps, {
					className: [
						props.wrapperProps?.className || "",
						"wow",
						animationClass,
					]
						.filter(Boolean)
						.join(" "),
				})

				// Return a new props object with updated wrapperProps
				var newProps = Object.assign({}, props, {
					wrapperProps: newWrapperProps,
				})

				return el(BlockListBlock, newProps)
			}

			return el(BlockListBlock, props)
		}
	}

	// Add the selected animation class directly to the save output
	function addAnimationClass(extraProps, blockType, attributes) {
		if (
			targetedBlocks.includes(blockType.name) &&
			attributes.animationClass
		) {
			extraProps.className = [
				extraProps.className || "",
				"wow",
				attributes.animationClass,
			]
				.filter(Boolean)
				.join(" ")
		}
		return extraProps
	}

	// Register filters
	addFilter(
		"blocks.registerBlockType",
		"systempress/animation-attributes",
		addAnimationAttributes
	)
	addFilter(
		"editor.BlockEdit",
		"systempress/animation-controls",
		withAnimationControls
	)
	addFilter(
		"editor.BlockListBlock",
		"systempress/animation-editor-class",
		addEditorClass
	)
	addFilter(
		"blocks.getSaveContent.extraProps",
		"systempress/animation-class",
		addAnimationClass
	)
})(window.wp)
