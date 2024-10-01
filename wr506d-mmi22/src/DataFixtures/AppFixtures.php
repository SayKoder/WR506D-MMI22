<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use DateTimeImmutable;
use App\Entity\Actor;
use App\Entity\Movie;
use App\Entity\Category;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));

        $actors = $faker->actors($gender = null, $count = 190, $duplicates = false);
        $createdActors = [];
        foreach ($actors as $i) {
            $fullname = $i; //ex : Christian Bale
            $fullnameExploded = explode(' ', $fullname);

            $firstname = $fullnameExploded[0]; //ex : Christian
            $lastname = $fullnameExploded[1]; //ex : Bale


            $actor = new Actor();
            $actor->setFirstname($firstname);
            $actor->setLastname($lastname);
            $actor->setDob($faker->dateTimeThisCentury);
            $actor->setAwards($faker->numberBetween(0, 10));
            $actor->setBio($faker->text(200));
            $actor->setNationality($faker->country());
            $actor->setMedia($faker->imageUrl(640, 480, 'people'), 'true');
            $actor->setGender($faker->randomElement(['  ', 'M', 'F']));
            $actor->setDeathDate($faker->optional($weight = 0.2)->dateTimeBetween('dob', 'now'));
            $actor->setCreatedAt(new DateTimeImmutable());

            $createdActors[] = $actor;
            $manager->persist($actor);
        }

        $createdCategories = [];
        for ($i = 0; $i < 10; $i++) {
            $genre = $faker->movieGenre();
            $category = new Category();
            $category->setTitre($genre);
            $createdCategories[] = $category;
            $manager->persist($category);
        }

        $movies = $faker->movies(100);
        foreach ($movies as $item) {
            $movie = new Movie();
            $movie->setTitle($item);
            $movie->setDescription($faker->text(200));
            $movie->setReleaseDate(new DateTimeImmutable());
            $movie->setDuration($faker->numberBetween(60, 180));
            $movie->setEntries($faker->numberBetween(0, 1000000));
            $movie->setRating($faker->randomFloat(1, 0, 10));
            $movie->setDirector($faker->name);
            $movie->setMedia($faker->imageUrl(640, 480, 'nature'));
            $movie->setCreatedAt(new DateTimeImmutable());

            shuffle($createdActors);
            $createdActorsSliced = array_slice($createdActors, 0, 4);
            foreach ($createdActorsSliced as $actor) {
                $movie->addActor($actor);
            }

            shuffle($createdCategories);
            $createdCategoriesSliced = array_slice($createdCategories, 0, 2);
            foreach ($createdCategoriesSliced as $category) {
                $movie->addCategory($category);
            }

            $manager->persist($movie);
        }

        $manager->flush();
    }
}