<?php
// index.php
  require_once('vendor/autoload.php');

  // initiate f3
  $f3 = Base::instance();

  // configuration
  // $f3->set('AUTOLOAD', 'controllers/');
  // $f3->set('DEBUG', 3);

  // use a configuration file
  $f3->config('app/config/config.ini');

  $loader = new \Twig\Loader\FilesystemLoader('app\views');
  $loader->addPath('public', 'public');
  $twig = new \Twig\Environment($loader);

  $f3->set('twig', $twig);

  // Home page
  $f3->route('GET /', function($f3) {
    echo $f3->get('twig')->render('home.html');
  });

  /**
   * Book handling
   */
  // create book
  $f3->route('GET /book/create', 'Books->create_form');
  $f3->route('POST /book/create', 'Books->add_new_book');
  // update book
  $f3->route('GET /book/update/@ISBN', 'Books->update_form');
  $f3->route('POST /book/update/@ISBN', 'Books->update_book');
  // delete book
  $f3->route('GET /book/delete/@ISBN', 'Books->delete_book');


  /**
   * Members 
   */
  // register user
  $f3->route('GET /member/create', 'Members->create_form');
  $f3->route('POST /member/create', 'Members->create');
  // update members
  $f3->route('GET /member/update/@id', 'Members->update_form');
  $f3->route('POST /member/update/@id', 'Members->update');
  // delete account
  $f3->route('GET /member/delete/@id', 'Members->delete_account');


  /**
   * Admin Users
   */
  $f3->route('GET /admin/user_list', 'Members->list_user');


  /**
   * Search
   */
  // search book
  $f3->route('GET /search', 'Search->search_book');
  $f3->route('GET|POST /search/result', 'Search->search_result');
  // get book detail
  $f3->route('GET /search/detail/@ISBN', 'Search->get_detail');


  // other function page
  $f3->route('GET|POST|PUT /book/upload_image', 'UploadImage->book_image');


  // execute f3
  $f3->run();

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <h1>Library HOME ^^</h1>
  <a href="src/manage_book.php">register a book</a><br/>
  <a href="templates/advance_search.html">Advanced Search</a><br/>
  <a href="templates/booksDetails.html">book details</a><br/>
  <a href="templates/main.html.twig">main</a><br/>
  <a href="src/search_result.php">search result</a><br>
  <a href="src/login.php">login</a><br>
  <a href="src/home.php">home</a><br>
  <a href="src/create_user.php">Create User</a><br>
  <a href="src/manage_account.php">User Account</a><br>
</body>
</html>
