<?php

namespace App\Services;

use Cocur\Slugify\Slugify as CocurSLugify;

class Slugify {

    //--Création de la fonction slugify -- //
    public function slugify($stringToSlugify){
        $slugify = new CocurSlugify();
        return $slugify->slugify($stringToSlugify);
    }
}