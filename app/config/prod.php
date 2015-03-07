<?php

$app['twig.path'] = array(__DIR__.'/../../src/Web/Resources/views');
$app['twig.form.templates'] = array('bs3_form.html.twig');
$app['twig.options'] = array('cache' => __DIR__.'/../../var/cache/twig');
