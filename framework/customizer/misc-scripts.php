<?php
function murray_customize_register_misc( $wp_customize )
{
    //Replace Header Text Color with, separate colors for Title and Description
    //Override murray_site_titlecolor
    $wp_customize->remove_control('display_header_text');
    $wp_customize->remove_setting('header_textcolor');
    $wp_customize->add_setting('murray_site_titlecolor', array(
        'default'     => '#FFF',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'murray_site_titlecolor', array(
            'label' => __('Site Title Color','murray'),
            'section' => 'colors',
            'settings' => 'murray_site_titlecolor',
            'type' => 'color'
        ) )
    );

    $wp_customize->add_setting('murray_header_desccolor', array(
        'default'     => '#FFF',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            'murray_header_desccolor', array(
            'label' => __('Site Tagline Color','murray'),
            'section' => 'colors',
            'settings' => 'murray_header_desccolor',
            'type' => 'color'
        ) )
    );


    //Settings for Header Image
    $wp_customize->add_setting( 'murray_himg_style' , array(
        'default'     => 'cover',
        'sanitize_callback' => 'murray_sanitize_himg_style'
    ) );

    /* Sanitization Function */
    function murray_sanitize_himg_style( $input ) {
        if (in_array( $input, array('contain','cover') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'murray_himg_style', array(
        'label' => __('Header Image Arrangement','murray'),
        'section' => 'header_image',
        'settings' => 'murray_himg_style',
        'type' => 'select',
        'choices' => array(
            'contain' => __('Contain','murray'),
            'cover' => __('Cover Completely (Recommended)','murray'),
        )
    ) );

    $wp_customize->add_setting( 'murray_himg_align' , array(
        'default'     => 'center',
        'sanitize_callback' => 'murray_sanitize_himg_align'
    ) );

    /* Sanitization Function */
    function murray_sanitize_himg_align( $input ) {
        if (in_array( $input, array('center','left','right') ) )
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'murray_himg_align', array(
        'label' => __('Header Image Alignment','murray'),
        'section' => 'header_image',
        'settings' => 'murray_himg_align',
        'type' => 'select',
        'choices' => array(
            'center' => __('Center','murray'),
            'left' => __('Left','murray'),
            'right' => __('Right','murray'),
        )
    ) );

    $wp_customize->add_setting( 'murray_himg_repeat' , array(
        'default'     => true,
        'sanitize_callback' => 'murray_sanitize_checkbox'
    ) );

    $wp_customize->add_control(
        'murray_himg_repeat', array(
        'label' => __('Repeat Header Image','murray'),
        'section' => 'header_image',
        'settings' => 'murray_himg_repeat',
        'type' => 'checkbox',
    ) );


    //Settings For Logo Area

    $wp_customize->add_setting(
        'murray_hide_title_tagline',
        array( 'sanitize_callback' => 'murray_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'murray_hide_title_tagline', array(
            'settings' => 'murray_hide_title_tagline',
            'label'    => __( 'Hide Title and Tagline.', 'murray' ),
            'section'  => 'title_tagline',
            'type'     => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'murray_branding_below_logo',
        array( 'sanitize_callback' => 'murray_sanitize_checkbox' )
    );

    $wp_customize->add_control(
        'murray_branding_below_logo', array(
            'settings' => 'murray_branding_below_logo',
            'label'    => __( 'Display Site Title and Tagline Below the Logo.', 'murray' ),
            'section'  => 'title_tagline',
            'type'     => 'checkbox',
            'active_callback' => 'murray_title_visible'
        )
    );

    function murray_title_visible( $control ) {
        $option = $control->manager->get_setting('murray_hide_title_tagline');
        return $option->value() == false ;
    }
    //upgrade
    $wp_customize->add_section(
        'murray_sec_upgrade',
        array(
            'title' => __('Upgrade to Murray Pro Version', 'murray'),
            'priority' => 1,
        )
    );

    $wp_customize->add_setting(
        'murray_upgrade',
        array('sanitize_callback' => 'esc_textarea')
    );

    $wp_customize->add_control(
        new WP_Customize_Upgrade_Control(
            $wp_customize,
            'murray_upgrade',
            array(
                'label' => __('Thank You', 'murray'),
                'description' => __('Thank You for Choosing Murray. Murray Plus is a Powerful Wordpress theme which also supports WooCommerce in the best possible way. It is "as we say" the last theme you would ever need. It has all the basic and advanced features needed to run a gorgeous looking site. If you are looking for more features and to support us, please  <a href="https://inkhive.com/product/murray-plus/">purchase Murray Plus</a>.', 'murray'),
                'section' => 'murray_sec_upgrade',
                'settings' => 'murray_upgrade',
            )
        )
    );
}
add_action('customize_register', 'murray_customize_register_misc');