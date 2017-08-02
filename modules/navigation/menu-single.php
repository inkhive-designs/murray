<nav id="site-navigation" class="main-navigation single" role="navigation">
    <div class="nav-container container">
        <?php
        // Get the Appropriate Walker First.
        if (has_nav_menu(  'primary' ) && !get_theme_mod('murray_disable_nav_desc',true) ) :
            $walker = new Murray_Menu_With_Icon;
        else :
            $walker = '';
        endif;
        //Display the Menu.
        wp_nav_menu( array( 'theme_location' => 'primary', 'walker' => $walker ) ); ?>
    </div>
</nav>