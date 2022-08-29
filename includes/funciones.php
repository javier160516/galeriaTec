<?php

define('TEMPLATES_URL', __DIR__. "/templates");

function incluirTemplate(string $view) {
    include TEMPLATES_URL."/${view}.php";
}