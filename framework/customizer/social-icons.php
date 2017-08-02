<?php
function murray_customize_register_social( $wp_customize )
{
// Social Icons
    $wp_customize->add_section('murray_social_section', array(
        'title' => __('Social Icons', 'murray'),
        'priority' => 44,
    ));

    $social_networks = array( //Redefinied in Sanitization Function.
        'none' => __('-', 'murray'),
        'facebook' => __('Facebook', 'murray'),
        'twitter' => __('Twitter', 'murray'),
        'google-plus' => __('Google Plus', 'murray'),
        'instagram' => __('Instagram', 'murray'),
        'rss' => __('RSS Feeds', 'murray'),
        'vine' => __('Vine', 'murray'),
        'vimeo-square' => __('Vimeo', 'murray'),
        'youtube' => __('Youtube', 'murray'),
        'flickr' => __('Flickr', 'murray'),
    );

    $social_count = count($social_networks);

    for ($x = 1; $x <= ($social_count - 3); $x++) :

        $wp_customize->add_setting(
            'murray_social_' . $x, array(
            'sanitize_callback' => 'murray_sanitize_social',
            'default' => 'none'
        ));

        $wp_customize->add_control('murray_social_' . $x, array(
            'settings' => 'murray_social_' . $x,
            'label' => __('Icon ', 'murray') . $x,
            'section' => 'murray_social_section',
            'type' => 'select',
            'choices' => $social_networks,
        ));

        $wp_customize->add_setting(
            'murray_social_url' . $x, array(
            'sanitize_callback' => 'esc_url_raw'
        ));

        $wp_customize->add_control('murray_social_url' . $x, array(
            'settings' => 'murray_social_url' . $x,
            'description' => __('Icon ', 'murray') . $x . __(' Url', 'murray'),
            'section' => 'murray_social_section',
            'type' => 'url',
            'choices' => $social_networks,
        ));

    endfor;

    function murray_sanitize_social($input)
    {
        $social_networks = array(
            'none',
            'facebook',
            'twitter',
            'google-plus',
            'instagram',
            'rss',
            'vine',
            'vimeo-square',
            'youtube',
            'flickr'
        );
        if (in_array($input, $social_networks))
            return $input;
        else
            return '';
    }
}
add_action('customize_register', 'murray_customize_register_social');