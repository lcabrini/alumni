<?php

require_once('util.php');
require_once('projects.php');

$projects = get_active_projects();
$twig = get_twig();
echo $twig->render('project_list.twig', [
    'projects' => $projects
]);
