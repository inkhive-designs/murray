<?php
function murray_customize_register_layouts( $wp_customize )
{
// Layout and Design
    $wp_customize->add_panel('murray_design_panel', array(
        'priority' => 40,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __('Design & Layout', 'murray'),
    ));

    $wp_customize->add_section(
        'murray_design_options',
        array(
            'title' => __('Blog Layout', 'murray'),
            'priority' => 0,
            'panel' => 'murray_design_panel'
        )
    );


    $wp_customize->add_setting(
        'murray_blog_layout',
        array('sanitize_callback' => 'murray_sanitize_blog_layout', 'default' => 'murray')
    );

    function murray_sanitize_blog_layout($input)
    {
        if (in_array($input, array('grid', 'grid_2_column', 'grid_3_column', 'murray')))
            return $input;
        else
            return '';
    }

    $wp_customize->add_control(
        'murray_blog_layout', array(
            'label' => __('Select Layout', 'murray'),
            'settings' => 'murray_blog_layout',
            'section' => 'murray_design_options',
            'type' => 'select',
            'choices' => array(
                'murray' => __('Murray Theme Layout', 'murray'),
                'grid' => __('Basic Blog Layout', 'murray'),
                'grid_2_column' => __('Grid - 2 Column', 'murray'),
                'grid_3_column' => __('Grid - 3 Column', 'murray'),

            )
        )
    );

    $wp_customize->add_section(
        'murray_sidebar_options',
        array(
            'title' => __('Sidebar Layout', 'murray'),
            'priority' => 0,
            'panel' => 'murray_design_panel'
        )
    );

    $wp_customize->add_setting(
        'murray_disable_sidebar',
        array('sanitize_callback' => 'murray_sanitize_checkbox')
    );

    $wp_customize->add_control(
        'murray_disable_sidebar', array(
            'settings' => 'murray_disable_sidebar',
            'label' => __('Disable Sidebar Everywhere.', 'murray'),
            'section' => 'murray_sidebar_options',
            'type' => 'checkbox',
            'default' => false
        )
    );

    $wp_customize->add_setting(
        'murray_disable_sidebar_home',
        array('sanitize_callback' => 'murray_sanitize_checkbox')
    );

    $wp_customize->add_control(
        'murray_disable_sidebar_home', array(
            'settings' => 'murray_disable_sidebar_home',
            'label' => __('Disable Sidebar on Home/Blog.', 'murray'),
            'section' => 'murray_sidebar_options',
            'type' => 'checkbox',
            'active_callback' => 'murray_show_sidebar_options',
            'default' => false
        )
    );

    $wp_customize->add_setting(
        'murray_disable_sidebar_front',
        array('sanitize_callback' => 'murray_sanitize_checkbox')
    );

    $wp_customize->add_control(
        'murray_disable_sidebar_front', array(
            'settings' => 'murray_disable_sidebar_front',
            'label' => __('Disable Sidebar on Front Page.', 'murray'),
            'section' => 'murray_sidebar_options',
            'type' => 'checkbox',
            'active_callback' => 'murray_show_sidebar_options',
            'default' => false
        )
    );


    $wp_customize->add_setting(
        'murray_sidebar_width',
        array(
            'default' => 4,
            'sanitize_callback' => 'murray_sanitize_positive_number')
    );

    $wp_customize->add_control(
        'murray_sidebar_width', array(
            'settings' => 'murray_sidebar_width',
            'label' => __('Sidebar Width', 'murray'),
            'description' => __('Min: 25%, Default: 33%, Max: 40%', 'murray'),
            'section' => 'murray_sidebar_options',
            'type' => 'range',
            'active_callback' => 'murray_show_sidebar_options',
            'input_attrs' => array(
                'min' => 3,
                'max' => 5,
                'step' => 1,
                'class' => 'sidebar-width-range',
                'style' => 'color: #0a0',
            ),
        )
    );

    /* Active Callback Function */
    function murray_show_sidebar_options($control)
    {

        $option = $control->manager->get_setting('murray_disable_sidebar');
        return $option->value() == false;

    }

    $wp_customize->add_section(
        'murray_custom_footer',
        array(
            'title' => __('Custom Footer Text', 'murray'),
            'description' => __('Enter your Own Copyright Text.', 'murray'),
            'priority' => 11,
            'panel' => 'murray_design_panel'
        )
    );

    $wp_customize->add_setting(
        'murray_footer_text',
        array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );

    $wp_customize->add_control(
        'murray_footer_text',
        array(
            'section' => 'murray_custom_footer',
            'settings' => 'murray_footer_text',
            'type' => 'text'
        )
    );
}
add_action('customizer_register', 'murray_customizer_register_layouts');