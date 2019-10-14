<?php

require 'util.php';

$twig = get_twig();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "post";
} else {
    echo $twig->render('register_form.twig');
}
