<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}


// Shortcode for login form
function custom_login_form() {
    ob_start();

    $error = '';

    if ( isset( $_POST['custom_login_submit'] ) ) {
        $login = sanitize_text_field( $_POST['email'] );
        $password = sanitize_text_field( $_POST['password'] );

        // Check if the login input is an email
        if ( is_email( $login ) ) {
            $user = get_user_by( 'email', $login );
            if ( $user ) {
                $login = $user->user_login; // Set the login to the user's username
            }
        }

        // Attempt to log in with username and password
        $user = wp_signon( array(
            'user_login'    => $login,
            'user_password' => $password,
            'remember'      => true
        ) );

        if ( is_wp_error( $user ) ) {
            $error = 'Invalid login credentials. Please try again.';
        } else {
            wp_redirect( home_url() );
            exit;
        }
    }

    ?>
   
    <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="w-8 h-8 mr-2" src="https://img.freepik.com/free-vector/letter-n-logo-design_474888-2012.jpg?t=st=1726829999~exp=1726833599~hmac=49c23b1cfd68fa0a7e62d9cb100661331936887fd3ed57dc1b388922d6dee507&w=740" alt="logo">
          needinvision    
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  login your account
              </h1>
              <form class="space-y-4 md:space-y-6" method="post" action="">
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" name="custom_login_submit">login</button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      don't have an account? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">create account</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>



    <?php
    return ob_get_clean();
}
add_shortcode('custom_login', 'custom_login_form');
?>
