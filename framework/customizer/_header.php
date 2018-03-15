<?php
/**
 * Created by PhpStorm.
 * User: Gourav
 * Date: 3/15/2018
 * Time: 12:47 PM
 */
function murray_customize_register_header( $wp_customize ){
    $wp_customize->add_panel('murray_header_panel', array(
        'priority' => 2,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Header Settings', 'murray'),
    ));

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


}
add_action( 'customize_register', 'murray_customize_register_header' );