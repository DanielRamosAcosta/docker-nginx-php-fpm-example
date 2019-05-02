<?php

  // Include Composer autoload
  require('../vendor/autoload.php');

  // Create Slim App
  $app = new \Slim\App();

  // Create database from JSON
  $pokedex = json_decode(file_get_contents('pokemon.json'), true);

  // Fetch Dep. Iny. Container
  $container = $app->getContainer();

  // Register Twig View Helper
  $container['view'] = function($c) {
    $templates = '../views/';
    $cache = '../storage/framework/cache/';

    $view = new \Slim\Views\Twig($templates, ['cache' => $cache]);

    return $view;
  };

  $app->get('/pokemon/{id}', function($request, $response, $args) use ($pokedex) {

    $data = [
      'id' => $args['id'],
      'pokemon' => $pokedex[ $args['id'] ]
    ];

    return $this->view->render($response, 'index.twig', $data);

  });

  $app->run();

  //d($pokedex);

?>
