<?php

namespace App\DataFixtures;

use App\Entity\Prispevek;
use App\Entity\Uzivatel;
use App\Entity\Zinfo;
use App\Enums\UserRoles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        $uzivatel = new Uzivatel();
        $uzivatel->setJmeno('Jiří Halfar')
            ->setEmail('jirka.halfar@email.cz')
            ->setRoles([UserRoles::Admin])
            ->setPassword(
                $this->passwordHasher->hashPassword(
                    $uzivatel,
                    '123456789'
                )
            );
        $manager->persist($uzivatel);
            $postCount = $faker->numberBetween(10, 10);
            for ($j = 0; $j < $postCount; $j++) {
                $content = array_reduce(
                    $faker->paragraphs($faker->numberBetween(10, 25)),
                    fn ($text, $paragraph) => $text .= "<p>$paragraph</p>",
                    ""
                );
                                
                $prispevek = new Prispevek();
                $prispevek->setNazev($faker->words(3, true))
                    ->setObsah($content)
                    ->setObrazek1('pocitace.png')
                    ->setAutor($uzivatel);
                $manager->persist($prispevek);
            }
            for ($i = 0; $i < 3; $i++) {
                $obsah = array_reduce(
                    $faker->paragraphs($faker->numberBetween(10, 25)),
                    fn ($text, $paragraph) => $text .= "<p>$paragraph</p>",
                    ""
                );
                
                $info = new Zinfo();
                $info->setNazev($faker->word())
                    ->setObsah($obsah)
                    ->setOdkaz($faker->word());
                $manager->persist($info);
            }
        $manager->flush();
    }
}