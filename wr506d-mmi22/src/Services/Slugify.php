<?php

namespace App\Services;

use Cocur\Slugify\Slugify as CocurSLugify;

class Slugify
{
    //--Création de la fonction slugify -- //
    public function slugify($stringToSlugify)
    {
        $slugify = new CocurSLugify();
        return $slugify->slugify($stringToSlugify);
    }
}
