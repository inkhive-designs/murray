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