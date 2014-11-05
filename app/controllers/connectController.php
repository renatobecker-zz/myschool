<?php


class ConnectController extends BaseController {

/**
 * Login user with facebook
 *
 * @return void
 */

public function loginWithFacebook() {

    // get data from input
    $code = Input::get( 'code' );

    // get fb service
    $fb = OAuth::consumer( 'Facebook' );
    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $code ) ) {

        // This was a callback request from facebook, get the token
        $token = $fb->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $fb->request( '/me' ), true );

        //$message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
        //echo $message. "<br/>";

        //Var_dump
        //display whole array().

        //dd($result);

        //$friends = json_decode( $fb->request( '/me/friends' ), true );
        //dd($friends);  

        $uid   = $result['id'];
        $email = $result['email'];
        $user  = Usuario::whereEmail($email)->first();
        if (empty($user)) {

            $user = new Usuario;
            $user->nome     = $result['name'];
            $user->email    = $result['email'];
            $user->senha    = $uid;
            //$user->username = $result['username'];
            $user->uid      = $uid;

        }
        $user->photo    = 'https://graph.facebook.com/'.$result['id'].'/picture?type=large';            
        $user->access_token = $token->getAccessToken();
        $user->save();

        Auth::login($user);

        return Redirect::to('/')->with('message', 'Login Social: Facebook');
    }
    // if not ask for permission first
    else {

        // get fb authorization
        $url = $fb->getAuthorizationUri();

        // return to facebook login url
        return Redirect::to((string)$url);
    }
}
    

public function loginWithGoogle() {

    // get data from input
    $code = Input::get( 'code' );

    // get google service
    $googleService = OAuth::consumer( 'Google' );

    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $code ) ) {

        // This was a callback request from google, get the token
        $token = $googleService->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );
        /*
        $message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
        echo $message. "<br/>";

        //Var_dump
        //display whole array().
        dd($result);
        */

        $uid   = $result['id'];
        $email = $result['email'];
        $user  = Usuario::whereEmail($email)->first();
        if (empty($user)) {

            $user = new Usuario;
            $user->nome     = $result['name'];
            $user->email    = $result['email'];
            $user->senha    = $uid;
            //$user->username = $result['username'];
            $user->uid      = $uid;

        }
        $user->photo    = $result['picture'];
        $user->access_token = $token->getAccessToken();
        $user->save();

        Auth::login($user);

        return Redirect::to('/')->with('message', 'Login Social: Google');


    }
    // if not ask for permission first
    else {
        // get googleService authorization
        $url = $googleService->getAuthorizationUri();

        // return to google login url
        return Redirect::to( (string)$url);
    }
}

public function loginWithTwitter() {

    // get data from input
    $token = Input::get( 'oauth_token' );
    $verify = Input::get( 'oauth_verifier' );

    // get twitter service
    $tw = OAuth::consumer( 'Twitter');

    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $token ) && !empty( $verify ) ) {

        // This was a callback request from twitter, get the token
        $token = $tw->requestAccessToken( $token, $verify );

        // Send a request with it
        $result = json_decode( $tw->request( 'account/verify_credentials.json' ), true );

        $message = 'Your unique Twitter user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
        echo $message. "<br/>";

        //Var_dump
        //display whole array().
        dd($result);

    }
    // if not ask for permission first
    else {
        // get request token
        $reqToken = $tw->requestRequestToken();

        // get Authorization Uri sending the request token
        $url = $tw->getAuthorizationUri(array('oauth_token' => $reqToken->getRequestToken()));

        // return to twitter login url
        return Redirect::to((string)$url);
    }
}

public function loginWithLinkedin() {

        // get data from input
        $code = Input::get( 'code' );

        $linkedinService = OAuth::consumer( 'Linkedin' );


        if ( !empty( $code ) ) {

            // This was a callback request from linkedin, get the token
            $token = $linkedinService->requestAccessToken( $code );
            $fields = array('id', 'email-address', 'first-name', 'last-name', 'headline',
                            'location', 'industry', 'picture-url', 'public-profile-url');
            // Send a request with it. Please note that XML is the default format.
            $result = json_decode($linkedinService->request('/people/~:(' . implode(",", $fields). ')?format=json'), true);

            /*    
            // Show some of the resultant data
            echo 'Your linkedin first name is ' . $result['firstName'] . ' and your last name is ' . $result['lastName'];

            //Var_dump
            //display whole array().
            dd($result);
            */

            $uid   = $result['id'];
            $email = $result['emailAddress'];
            $user  = Usuario::whereEmail($email)->first();
            if (empty($user)) {

                $user = new Usuario;
                $user->nome     = $result['firstName'] . ' ' . $result['lastName'];
                $user->email    = $email;
                $user->senha    = $uid;
                //$user->username = $result['username'];
                $user->uid      = $uid;

            }   
            $user->photo    = $result['pictureUrl'];
            $user->access_token = $token->getAccessToken();
            $user->save();

            Auth::login($user);

            return Redirect::to('/')->with('message', 'Login Social: Linkedin');


        }// if not ask for permission first
        else {
            // get linkedinService authorization
            $url = $linkedinService->getAuthorizationUri(array('state'=>'DCEEFWF45453sdffef424'));

            // return to linkedin login url
           return Redirect::to((string)$url);
        }


    }

}
