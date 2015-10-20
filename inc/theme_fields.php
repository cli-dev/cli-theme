<?php if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_55d4c883ee802',
	'title' => 'Theme Options',
	'fields' => array (
		array (
			'key' => 'field_55d4c8ed4b508',
			'label' => 'General',
			'name' => '',
			'type' => 'accordion',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'field_type-tab field_key-field_55d4c8ed4b508',
				'id' => '',
			),
			'icon_class' => 'dashicons-arrow-right',
		),
		array (
			'key' => 'field_55d4c8814b504',
			'label' => 'Favicon',
			'name' => 'favicon',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 33,
				'class' => 'field_type-image field_key-field_55d4c8814b504',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_55d4c8aa4b505',
			'label' => 'Logo',
			'name' => 'logo',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 33,
				'class' => 'field_type-image field_key-field_55d4c8aa4b505',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_560abb4369cfa',
			'label' => 'Mobile Logo',
			'name' => 'mobile_logo',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 33,
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_560abb7769cfb',
			'label' => 'Desktop Logo Maximum Width',
			'name' => 'desktop_logo_maximum_width',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => 'px',
			'min' => '',
			'max' => '',
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_560abb9e69cfc',
			'label' => 'Mobile Logo Maximum Width',
			'name' => 'mobile_logo_maximum_width',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => 'px',
			'min' => '',
			'max' => '',
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_55d4ceba2c1ed',
			'label' => 'Content Background Color',
			'name' => 'content_background_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 33,
				'class' => 'field_type-color_picker field_key-field_55d4ceba2c1ed',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55e4b1fd06820',
			'label' => 'Main Font Color',
			'name' => 'main_font_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 33,
				'class' => 'field_type-color_picker field_key-field_55e4b1fd06820',
				'id' => '',
			),
			'default_value' => '#000000',
		),
		array (
			'key' => 'field_55e9e8c340c74',
			'label' => 'Text Highlight Color',
			'name' => 'text_highlight_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 33,
				'class' => 'field_type-color_picker field_key-field_55e9e8c340c74',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_560eade55e137',
			'label' => 'Theme Colors',
			'name' => 'theme_colors',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'layout' => 'table',
			'button_label' => 'Add Theme Color',
			'sub_fields' => array (
				array (
					'key' => 'field_560eadf35e138',
					'label' => 'Color',
					'name' => 'color',
					'type' => 'color_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => 20,
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
				),
				array (
					'key' => 'field_560eaefda8409',
					'label' => 'Color Class Name',
					'name' => 'color_class_name',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => 80,
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
		),
		array (
			'key' => 'field_5602e62ed6d6a',
			'label' => 'Theme Fonts',
			'name' => 'theme_fonts',
			'type' => 'repeater',
			'instructions' => 'Add fonts to the theme',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'layout' => 'table',
			'button_label' => 'Add Font',
			'sub_fields' => array (
				array (
					'key' => 'field_5602e644d6d6b',
					'label' => 'Font',
					'name' => 'theme_font',
					'type' => 'google_font_selector',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'include_web_safe_fonts' => 1,
					'enqueue_font' => 1,
					'default_font' => 'Open Sans',
				),
			),
		),
		array (
			'key' => 'field_56265e29e9709',
			'label' => '404 Header Image',
			'name' => '404_header_image',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'url',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array (
			'key' => 'field_55d4c8be4b506',
			'label' => 'Header Options',
			'name' => '',
			'type' => 'accordion',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'field_type-tab field_key-field_55d4c8be4b506',
				'id' => '',
			),
			'icon_class' => 'dashicons-arrow-right',
		),
		array (
			'key' => 'field_560ec99f29270',
			'label' => 'Header Type',
			'name' => 'header_type',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'Top Menu' => 'Top Menu',
				'Left Side Menu' => 'Left Side Menu',
				'Right Side Menu' => 'Right Side Menu',
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_5605b94321d7d',
			'label' => 'Logo Position',
			'name' => 'logo_position',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'left' => 'left',
				'center' => 'center',
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_5604338a4ef10',
			'label' => 'Is header in grid?',
			'name' => 'is_header_in_grid',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_560ec99f29270',
						'operator' => '==',
						'value' => 'Top Menu',
					),
				),
			),
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
		),
		array (
			'key' => 'field_55d4c8cd4b507',
			'label' => 'Header Background Color',
			'name' => 'header_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => 'field_type-color_picker field_key-field_55d4c8cd4b507',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55e870ab71ed8',
			'label' => 'Header Background Opacity',
			'name' => 'header_background_opacity',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => 'field_type-number field_key-field_55e870ab71ed8',
				'id' => '',
			),
			'default_value' => 1,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 0,
			'max' => 1,
			'step' => '0.05',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_560eca6029271',
			'label' => 'Menu Background Color',
			'name' => 'menu_background_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55f30b4e7e257',
			'label' => 'Desktop Header Height',
			'name' => 'desktop_header_height',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => 'field_type-number field_key-field_55f30b4e7e257',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => 'px',
			'min' => '',
			'max' => '',
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5604357499149',
			'label' => 'Mobile Header Height',
			'name' => 'mobile_header_height',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => 'field_type-number field_key-field_55f30b4e7e257',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => 'px',
			'min' => '',
			'max' => '',
			'step' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_560433b34ef11',
			'label' => 'Hide menu on desktop?',
			'name' => 'hide_menu_on_desktop',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'message' => 'Will open with a button',
			'default_value' => 0,
		),
		array (
			'key' => 'field_55d4c9004b509',
			'label' => 'Menu Link Color',
			'name' => 'menu_link_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => 'field_type-color_picker field_key-field_55d4c9004b509',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55d4ccd62c1e6',
			'label' => 'Menu Link Active Color',
			'name' => 'menu_link_active_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => 'field_type-color_picker field_key-field_55d4ccd62c1e6',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55d4c9204b50a',
			'label' => 'Menu Font Size',
			'name' => 'menu_font_size',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => 'field_type-number field_key-field_55d4c9204b50a',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 12,
			'max' => 50,
			'step' => 1,
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5602e24562fc3',
			'label' => 'Menu Font Family',
			'name' => 'menu_font_family',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				0 => 'Oswald',
				1 => 'Lato',
				2 => 'Crimson Text',
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 1,
			'ajax' => 1,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_560eca9229272',
			'label' => 'Header Widget Font Color',
			'name' => 'header_font_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55d616e76456c',
			'label' => 'Footer Options',
			'name' => '',
			'type' => 'accordion',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'field_type-tab field_key-field_55d616e76456c',
				'id' => '',
			),
			'icon_class' => 'dashicons-arrow-right',
		),
		array (
			'key' => 'field_55d617006456d',
			'label' => 'Footer Top Background Color',
			'name' => 'footer_top_background_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => 'field_type-color_picker field_key-field_55d617006456d',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55d617196456e',
			'label' => 'Footer Top Text Color',
			'name' => 'footer_top_text_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => 'field_type-color_picker field_key-field_55d617196456e',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55d6172c6456f',
			'label' => 'Footer Top Link Color',
			'name' => 'footer_top_link_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => 'field_type-color_picker field_key-field_55d6172c6456f',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55d6173a64570',
			'label' => 'Footer Top Link Hover Color',
			'name' => 'footer_top_link_hover_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => 'field_type-color_picker field_key-field_55d6173a64570',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55e4a26589202',
			'label' => 'Footer Bottom Background Color',
			'name' => 'footer_bottom_background_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => 'field_type-color_picker field_key-field_55e4a26589202',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55e4a26989203',
			'label' => 'Footer Bottom Text Color',
			'name' => 'footer_bottom_text_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => 'field_type-color_picker field_key-field_55e4a26989203',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55e4a26c89205',
			'label' => 'Footer Bottom Link Hover Color',
			'name' => 'footer_bottom_link_hover_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => 'field_type-color_picker field_key-field_55e4a26c89205',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_55e4a26a89204',
			'label' => 'Footer Bottom Link Color',
			'name' => 'footer_bottom_link_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 25,
				'class' => 'field_type-color_picker field_key-field_55e4a26a89204',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_56043ca610408',
			'label' => 'Typography',
			'name' => '',
			'type' => 'accordion',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'icon_class' => 'dashicons-arrow-right',
		),
		array (
			'key' => 'field_560f06f06f1ba',
			'label' => 'Default Font Family',
			'name' => 'default_font_family',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				0 => 'Oswald',
				1 => 'Lato',
				2 => 'Crimson Text',
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_56043cbf10409',
			'label' => 'Headings Font Family',
			'name' => 'headings_font_family',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				0 => 'Oswald',
				1 => 'Lato',
				2 => 'Crimson Text',
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_56043cd61040a',
			'label' => 'Headings Font Color',
			'name' => 'headings_font_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_56043cf61040b',
			'label' => 'Headings Text Transform',
			'name' => 'headings_text_transform',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'none' => 'none',
				'uppercase' => 'uppercase',
				'lowercase' => 'lowercase',
				'capitalize' => 'capitalize',
			),
			'default_value' => array (
			),
			'allow_null' => 1,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_56043d281040c',
			'label' => 'Headings Line Height',
			'name' => 'headings_line_height',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '0.8',
			'max' => 2,
			'step' => '0.05',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56043d461040d',
			'label' => 'Headings Font Weight',
			'name' => 'headings_font_weight',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				400 => 400,
				100 => 100,
				300 => 300,
				500 => 500,
				600 => 600,
				700 => 700,
				800 => 800,
				900 => 900,
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_56043d901040e',
			'label' => 'Paragraph Font Family',
			'name' => 'paragraph_font_family',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				0 => 'Oswald',
				1 => 'Lato',
				2 => 'Crimson Text',
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_56043dab1040f',
			'label' => 'Paragraph Font Color',
			'name' => 'paragraph_font_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'default_value' => '#000000',
		),
		array (
			'key' => 'field_56043dc610410',
			'label' => 'Paragraph Text Transform',
			'name' => 'paragraph_text_transform',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'none' => 'none',
				'uppercase' => 'uppercase',
				'lowercase' => 'lowercase',
				'capitalize' => 'capitalize',
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_56043dda10411',
			'label' => 'Paragraph Line Height',
			'name' => 'paragraph_line_height',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'default_value' => 1,
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => '0.5',
			'max' => 2,
			'step' => '0.05',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56043e0610413',
			'label' => 'Paragraph Font Weight',
			'name' => 'paragraph_font_weight',
			'type' => 'select',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 20,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				400 => 400,
				100 => 100,
				300 => 300,
				500 => 500,
				600 => 600,
				700 => 700,
				800 => 800,
				900 => 900,
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
		array (
			'key' => 'field_5626690ae235d',
			'label' => 'Link Text Color',
			'name' => 'link_text_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
		),
		array (
			'key' => 'field_5626691de235e',
			'label' => 'Link Text Hover Color',
			'name' => 'link_text_hover_color',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-general-settings',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'field',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;