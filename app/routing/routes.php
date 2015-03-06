<?php

$app
    ->get('/', 'controller.presentation:indexAction')
    ->bind('homepage')
;