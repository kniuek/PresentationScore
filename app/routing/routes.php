<?php

$app
    ->get('/', 'controller.demo:demoAction')
    ->bind('homepage')
;