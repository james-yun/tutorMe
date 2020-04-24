<?php

/**
 * This is an example of a front controller for a flat file PHP site. Using a
 * Static list provides security against URL injection by default. See README.md
 * for more examples.
 */
# [START gae_simple_front_controller]
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
  case '/':
  case '/homepage.php':
    require 'homepage.php';
    break;
  case '/signup':
  case '/signup.php':
    require 'signup.php';
    break;
  case '/login':
  case '/login.php':
    require 'login.php';
    break;
  case '/request':
  case '/request.php':
    require 'request.php';
    break;
  case '/results':
  case 'results.php':
    require 'results.php';
    break;
  default:
    http_response_code(404);
    exit('Not Found');
}
# [END gae_simple_front_controller]
