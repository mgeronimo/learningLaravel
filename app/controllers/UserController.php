<?php

/*
|--------------------------------------------------------------------------
| Confide Controller Template
|--------------------------------------------------------------------------
|
| This is the default Confide controller template for controlling user
| authentication. Feel free to change to your needs.
|
*/

class UserController extends BaseController {

    /**
     * Displays the form for account creation
     *
     */
    public function create()
    {
        return View::make("create");
    }

    /**
     * Stores new account
     *
     */

 
 public function edit()
    {
        $id = Input::get('id');
        $user = User::find($id);
        $user->username = Input::get( 'username' );
        $user->email = Input::get( 'email' );
        $user->password = Input::get( 'password' );
       
        $cpass=Input::get('confirmpassword');

        $user->fname = Input::get( 'fname' );
        $user->lname = Input::get( 'lname' );
      
     if ($cpass!=$user->password)
{
$errors= "Passwords did not match.";
return Redirect::back()->withInput()->with('success', $errors);
} 

DB::table('users')
            ->where('id', $id)
            ->update(array('username' => $user->username, 'email' => $user->email, 'password' => $user->password, 'fname' => $user->fname, 'lname' => $user->lname));
 $errors =  "Successfully edited user.";

return Redirect::back()->withInput()->with('success', $errors);
/*
if ($user->save()) {
     $errors =  "Successfully edited user.";
$user->save();
return Redirect::back()->withInput()->with('success', $errors);

} 

else{
    $errors =  "You have entered an invalid input.";
return Redirect::back()->withInput()->with('success', $errors);

}

  
  */  }


    public function store()
    {
        $user = new User;
        $user->username = Input::get( 'username' );
        $username = Input::get( 'username' );
        $user->email = Input::get( 'email' );
        $user->password = Input::get( 'password' );
        $user->fname = Input::get( 'fname' );
        $user->lname = Input::get( 'lname' );
        $user->confirmed = 1;
        // The password confirmation will be removed from model
        // before saving. This field will be used in Ardent's
        // auto validation.
        $user->password_confirmation = Input::get( 'password_confirmation' );

        // Save if  valid. Password field will be hashed before save
        $user->save();

        if ( $user->id )
        {
            $new_role = new Role;
            $new_role = Role::where('name','=','member')->first();;
            
            $get_user = new User;
            $get_user = User::where('username','=',$username)->first();   
            $get_user->attachRole( $new_role );

                        $notice = Lang::get('confide::confide.alerts.account_created') . ' ' . Lang::get('confide::confide.alerts.instructions_sent'); 
                    
            // Redirect with success message, You may replace "Lang::get(..." for your custom message.
                        return Redirect::action('UserController@login')
                            ->with( 'notice', $notice );
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $user->errors()->all(':message');

                        return Redirect::action('UserController@create')
                            ->withInput(Input::except('password'))
                ->with( 'error', $error );
        }
    }

    /**
     * Displays the login form
     *
     */
    public function login()
    {
        // Authenticate User
        if( Confide::user() )
        {
            return Redirect::to('/');
        }
        else
        {
            return View::make('login'); 
        }
    }

    /**
     * Attempt to do login
     *
     */
    public function do_login()
    {
        $input = array(
            'email'    => Input::get( 'username' ),
            'username' => Input::get( 'username' ), // so we have to pass both
            'password' => Input::get( 'password' ),
            'remember' => Input::get( 'remember' ),
        );

        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // logAttempt will check if the 'email' perhaps is the username.
        // Get the value from the config file instead of changing the controller
        if ( Confide::logAttempt( $input, Config::get('confide::signup_confirm') ) ) 
        {
            // Redirect the user to the URL they were trying to access before
            // caught by the authentication filter IE Redirect::guest('user/login').
            // Otherwise fallback to '/'
            // Fix pull #145
            return Redirect::intended('/'); // change it to '/admin', '/dashboard' or something
        }
        else
        {
            $user = new User;

            // Check if there was too many login attempts
            if( Confide::isThrottled( $input ) )
            {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            }
            elseif( $user->checkUserExists( $input ) and ! $user->isConfirmed( $input ) )
            {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            }
            else
            {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }
                    
                        return Redirect::action('UserController@login')
                            ->withInput(Input::except('password'))
                ->with( 'error', $err_msg );
                
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param    string  $code
     */
    public function confirm( $code )
    {
        if ( Confide::confirm( $code ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
                        return Redirect::action('UserController@login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
                        return Redirect::action('UserController@login')
                            ->with( 'error', $error_msg );
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function forgot_password()
    {
        return View::make(Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     */
    public function do_forgot_password()
    {
        if( Confide::forgotPassword( Input::get( 'email' ) ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
                        return Redirect::action('UserController@login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
                        return Redirect::action('UserController@forgot_password')
                            ->withInput()
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function reset_password( $token )
    {
        return View::make(Config::get('confide::reset_password_form'))
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     */
    public function do_reset_password()
    {
        $input = array(
            'token'=>Input::get( 'token' ),
            'password'=>Input::get( 'password' ),
            'password_confirmation'=>Input::get( 'password_confirmation' ),
        );

        // By passing an array with the token, password and confirmation
        if( Confide::resetPassword( $input ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
                        return Redirect::action('UserController@login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
                        return Redirect::action('UserController@reset_password', array('token'=>$input['token']))
                            ->withInput()
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function logout()
    {
        Confide::logout();
        
        return Redirect::to('/');
    }

    public function dashboard()
    {
        
if (Auth::check())
        return View::make('dashboard');
    else 
        return View::make('login');
    }

    public function profile()
    {
        return View::make('profile');
    }

    public function getRole()
    {
        
        $admin = new Role();
        $admin->name = 'admin';
        $admin->save();
     
        $member = new Role();
        $member->name = 'member';
        $member->save();

        $create = new Permission();
        $create->name = 'can_create';
        $create->display_name = 'Can Create User';
        $create->save();

        $update = new Permission();
        $update->name = 'can_update';
        $update->display_name = 'Can Update User';
        $update->save();

        $delete = new Permission();
        $delete->name = 'can_delete';
        $delete->display_name = 'Can Delete User';
        $delete->save();

        $view = new Permission();
        $view->name = 'can_view';
        $view->display_name = 'Can View User';
        $view->save();

        $admin->attachPermission($create);
        $admin->attachPermission($update);
        $admin->attachPermission($delete);
        $admin->attachPermission($view);
        $member->attachPermission($view);

        return Redirect::to('login'); 
    }


}
