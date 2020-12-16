<?php

use App\Models\Ad;
use Diglactic\Breadcrumbs\Breadcrumbs;

//Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});


//Product
Breadcrumbs::for('ads.show', function($trail, $ad) {
$trail->parent('home');
$trail->push($ad->title, route('ads.show', $ad));
});
