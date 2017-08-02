<?php
function murray_customize_register_fonts($wp_customize){
    //Fonts
$wp_customize->add_section(
'murray_typo_options',
array(
'title'     => __('Google Web Fonts','murray'),
'priority'  => 41,
)
);

$font_array = array('Fjalla One','Khula','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans');
$fonts = array_combine($font_array, $font_array);

$wp_customize->add_setting(
'murray_title_font',
array(
'default'=> 'Fjalla One',
'sanitize_callback' => 'murray_sanitize_gfont'
)
);

function murray_sanitize_gfont( $input ) {
if ( in_array($input, array('Source Sans Pro','Khula','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans') ) )
return $input;
else
return '';
}

$wp_customize->add_control(
'murray_title_font',array(
'label' => __('Title','murray'),
'settings' => 'murray_title_font',
'section'  => 'murray_typo_options',
'type' => 'select',
'choices' => $fonts,
)
);

$wp_customize->add_setting(
'murray_body_font',
array(	'default'=> 'Source Sans Pro',
'sanitize_callback' => 'murray_sanitize_gfont' )
);

$wp_customize->add_control(
'murray_body_font',array(
'label' => __('Body','murray'),
'settings' => 'murray_body_font',
'section'  => 'murray_typo_options',
'type' => 'select',
'choices' => $fonts
)
);
}
add_action('customize_register', 'murray_customize_register_fonts');