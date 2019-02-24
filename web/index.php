<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;
$configs = [
    'client_id' => '6vh7iucjqnpsxhpqprab9ko4m5dqtp',
    'redirect_uri' => 'https://secure-springs-34454.herokuapp.com/',
    'response_type' => 'token',
    'scope' => implode('+', [
        'user:read:email',
        'user:read:broadcast',
        'user:edit:broadcast',
        'user:edit',
        'clips:edit',
        'channel:read:subscriptions',
        'bits:read',
        'analytics:read:games',
        'analytics:read:extensions'
    ])
];

$url = 'https://id.twitch.tv/oauth2/authorize
    ?client_id=6vh7iucjqnpsxhpqprab9ko4m5dqtp
    &redirect_uri=
    &=
    &scope=user:edit+user:read:email';


// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->get('/streamer', function() use($app) {
    $app['monolog']->addDebug('logging output.');
    return $app['twig']->render('streamer.twig');
});

$app->get('/login', function() use($app, $configs) {
    $loginUrl = 'https://id.twitch.tv/oauth2/authorize?' . http_build_query($configs);

    $app['monolog']->addDebug('logging output.');
    header(sprintf('Location: %s', urldecode($loginUrl)));
    die();
});

$app->run();
