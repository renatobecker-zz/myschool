<?php
return array( 

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'Session', 

    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id'     => '1563072903922769',
            'client_secret' => '40e287c457ad7a9affe4fd1c5893f1ec',  
            'redirect_uri'  => url('/'),
            'scope'         => array('email','user_friends', 'user_about_me', 'read_friendlists'),
        ),      

        'Twitter' => array(
            'client_id'     => 'hxWde1ffyzfjuYL5pAFwUIA9Q',
            'client_secret' => 'GMQvkFCU5nngMlBAWv9zvk3ccDg8kIydPq1x78hh9kdT2gsWzw',
            // No scope - oauth1 doesn't need scope
        ),  

        'Google' => array(
            'client_id'     => '406241307459-g4q2402njtfosdfh8u5vdpfevh6f1l5p.apps.googleusercontent.com',
            'client_secret' => 'U4sPSWD8uVl5zK47jmhg_E0o',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),  

        'Linkedin' => array(
            'client_id'     => '75omq5wovoxopw',
            'client_secret' => '4Uo2UINkC8fxywoz',
            //'redirectUri'   =>  url('linkedin'),
            'scope' => array('r_basicprofile', 'r_emailaddress', 'r_contactinfo', 'r_fullprofile')
        ),  

    )

);
