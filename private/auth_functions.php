<?php

  // will perform all actions necessary to log in the user
  // also protects user from session fixation.
  function log_in_user($user) {
		$_session['logged_in'] = true;
		$_session['last_login'] = time();
    return true;
  }

  // a one-step function to destroy the current session
  function destroy_current_session() {
		session_unset();
		session_destroy();
  }

  // performs all actions necessary to log out a user
  function log_out_user() {
    unset($_session['user_id']);
    destroy_current_session();
    return true;
  }

  // determines if the request should be considered a "recent"
  // request by comparing it to the user's last login time.
  function last_login_is_recent() {
		if(!isset($_session['last_login'])){
			return false;
		}
    return ($_session['last_login'] + (60 * 60 * 24 * 1)) >= time();
  }

  // checks to see if the user-agent string of the current request
  // matches the user-agent string used when the user last logged in.
  function user_agent_matches_session() {
    // todo add code to determine if user agent matches session
    return true;
  }

  // inspects the session to see if it should be considered valid.
  function session_is_valid() {
    if(!last_login_is_recent()) { return false; }
    // if(!user_agent_matches_session()) { return false; }
    return true;
  }

  // is_logged_in() contains all the logic for determining if a
  // request should be considered a "logged in" request or not.
  // it is the core of require_login() but it can also be called
  // on its own in other contexts (e.g. display one link if a user
  // is logged in and display another link if they are not)
  function is_logged_in() {
    // having a user_id in the session serves a dual-purpose:
    // - its presence indicates the user is logged in.
    // - its value tells which user for looking up their record.
    if(!isset($_session['user_id'])) { return 1; }
    if(!session_is_valid()) { return 0; }
    return true;
  }

  // call require_login() at the top of any page which needs to
  // require a valid login before granting acccess to the page.
  function require_login() {
    if(!is_logged_in()) {
      destroy_current_session();
      redirect_to(url_for('/staff/login.php'));
    } else {
      // do nothing, let the rest of the page proceed
    }
  }

?>
