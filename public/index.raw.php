<?php

  // Include Composer autoload
  require('../vendor/autoload.php');

  $pokedex = json_decode(file_get_contents('pokemon.json'), true);

  $app = new \Slim\App();

  $app->get('/pokemon/{id}', function($request, $response, $args) use ($pokedex) {

    $id = $args['id'];
    $pokemon = $pokedex[$id - 1];
    //d($pokemon);

    echo $pokemon['id'];
    echo "<br>\n";
    echo $pokemon['name'];
    echo "<br>\n";

    foreach ($pokemon['types'] as $type) {
      echo "- " . $type . "<br>\n";
    }
    echo "<br>\n";

    foreach ($pokemon['baseStats'] as $stat) {
      echo "* " . $stat . "<br>\n";
    }
    echo "<br>\n";

  });

  $app->run();

?>
