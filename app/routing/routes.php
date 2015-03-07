<?php

$app
    ->get('/', 'kni.controller.presentation:indexAction')
    ->bind('homepage')

;

$app
    ->get('/upload', 'kni.controller.presentation:uploadAction')
    ->bind('presentation.upload')
    
;

$app
    ->post('/upload', 'kni.controller.presentation:uploadAction')
    ->bind('presentation.upload.post')
;
