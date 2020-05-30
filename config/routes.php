<?php

use Src\Actions\AnnouncementCreateAction;
use Src\Actions\AnnouncementsGetAction;
use Src\Actions\AnnouncementShowAction;
use Src\Actions\AnnouncementsIndexAction;
use Src\Http\Request;
use Src\Http\Router\RoutesCollection;
use Src\Template\TemplateRenderer;

$routes = new RoutesCollection();

$routes->get('home', '/', function (Request $request) use ($db) {
    return (new AnnouncementsIndexAction($db, new TemplateRenderer()))($request);
});

$routes->get('announcements', '/announcements', function (Request $request) use ($db) {
    return (new AnnouncementsGetAction($db, new TemplateRenderer()))($request);
});

$routes->get('announcement', '/announcement/(?P<id>\d+)', function (Request $request) use ($db) {
    return (new AnnouncementShowAction($db, new TemplateRenderer()))($request);
});


$routes->get('announcement-create', '/announcement/create', function (Request $request) use ($db) {
    return (new AnnouncementCreateAction($db, new TemplateRenderer()))($request);
});

$routes->post('announcement-create', '/announcement/create', function (Request $request) use ($db) {
    return (new AnnouncementCreateAction($db, new TemplateRenderer()))($request);
});

return $routes;