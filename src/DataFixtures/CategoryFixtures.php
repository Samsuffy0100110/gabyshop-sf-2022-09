<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Service\Slugify;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public const CATEGORIES = [
        0 => [
            'name' => 'Chambre',
            'description' => 'L\'intérieur de la chambre est un lieu de repos et de détente. 
            Il est donc important de créer une ambiance chaleureuse et apaisante. Pour cela, 
            il est conseillé de choisir des couleurs douces et apaisantes comme le blanc, le beige, 
            le gris ou le bleu. Pour les meubles, privilégiez les matières naturelles comme le bois, 
            le rotin ou le bambou. Pour les accessoires, misez sur les coussins, les plaids et les rideaux. 
            Pour les luminaires, choisissez des lampes à poser ou des appliques murales. Pour les murs, 
            optez pour des peintures mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'chambre.jpg',
            'parentCategory' => 'parentCategory_0',
        ],
        1 => [
            'name' => 'Salle de bain',
            'description' => 'La salle de bain est un lieu de détente et de relaxation. 
            Pour créer une ambiance chaleureuse et apaisante, 
            il est conseillé de choisir des couleurs douces et apaisantes comme le blanc, 
            le beige, le gris ou le bleu. Pour les meubles, privilégiez les matières naturelles comme le bois, 
            le rotin ou le bambou. Pour les accessoires, misez sur les coussins, les plaids et les rideaux. 
            Pour les luminaires, choisissez des lampes à poser ou des appliques murales. 
            Pour les murs, optez pour des peintures mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'salle-de-bain.jpg',
            'parentCategory' => 'parentCategory_0',
        ],
        2 => [
            'name' => 'Cuisine',
            'description' => 'La cuisine est un lieu de convivialité et de partage. 
            Pour créer une ambiance chaleureuse et apaisante, il est conseillé de 
            choisir des couleurs douces et apaisantes comme le blanc, le beige, 
            le gris ou le bleu. Pour les meubles, privilégiez les matières naturelles comme le bois, 
            le rotin ou le bambou. Pour les accessoires, misez sur les coussins, les plaids et les rideaux. 
            Pour les luminaires, choisissez des lampes à poser ou des appliques murales. Pour les murs, 
            optez pour des peintures mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'cuisine.jpg',
            'parentCategory' => 'parentCategory_0',
        ],
        3 => [
            'name' => 'Salon',
            'description' => 'Le salon est un lieu de convivialité et de partage. 
            Pour créer une ambiance chaleureuse et apaisante, 
            il est conseillé de choisir des couleurs douces et apaisantes comme le blanc, 
            le beige, le gris ou le bleu. Pour les meubles, privilégiez les matières naturelles comme le bois, 
            le rotin ou le bambou. Pour les accessoires, misez sur les coussins, les plaids et les rideaux. 
            Pour les luminaires, choisissez des lampes à poser ou des appliques murales. 
            Pour les murs, optez pour des peintures mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'salon.jpg',
            'parentCategory' => 'parentCategory_0',
        ],
        4 => [
            'name' => 'Bureau',
            'description' => 'Le bureau est un lieu de travail et de concentration. 
            Pour créer une ambiance chaleureuse et apaisante, 
            il est conseillé de choisir des couleurs douces et apaisantes comme le blanc, 
            le beige, le gris ou le bleu. Pour les meubles, 
            privilégiez les matières naturelles comme le bois, 
            le rotin ou le bambou. Pour les accessoires, misez sur les coussins, 
            les plaids et les rideaux. Pour les luminaires, choisissez des lampes à 
            poser ou des appliques murales. Pour les murs, optez pour des peintures 
            mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'bureau.jpg',
            'parentCategory' => 'parentCategory_0',
        ],
        5 => [
            'name' => 'Accesoires de Mode',
            'description' => 'Les accessoires de mode sont des éléments qui permettent
            de compléter une tenue. Ils sont indispensables pour donner du style à une 
            tenue. Pour créer une ambiance chaleureuse et apaisante, il est conseillé de 
            choisir des couleurs douces et apaisantes comme le blanc, le beige, le gris 
            ou le bleu. Pour les meubles, privilégiez les matières naturelles comme le bois, 
            le rotin ou le bambou. Pour les accessoires, misez sur les coussins, les plaids 
            et les rideaux. Pour les luminaires, choisissez des lampes à poser ou des appliques murales. 
            Pour les murs, optez pour des peintures mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'accesoire-de-mode.jpg',
            'parentCategory' => 'parentCategory_1',
        ],
        6 => [
            'name' => 'Soin du visage',
            'description' => 'Le soin du visage est un rituel de beauté qui permet 
            de prendre soin de sa peau. Pour créer une ambiance chaleureuse et apaisante, 
            il est conseillé de choisir des couleurs douces et apaisantes comme le blanc, 
            le beige, le gris ou le bleu. Pour les meubles, privilégiez les matières naturelles 
            comme le bois, le rotin ou le bambou. Pour les accessoires, misez sur les coussins, 
            les plaids et les rideaux. Pour les luminaires, choisissez des lampes à poser ou des 
            appliques murales. Pour les murs, optez pour des peintures mates ou des papiers peints 
            aux motifs doux et apaisants.',
            'image' => 'soin-du-visage.jpg',
            'parentCategory' => 'parentCategory_1',
        ],
        7 => [
            'name' => 'Soin du corps',
            'description' => 'Le soin du corps est un rituel de beauté qui permet de prendre soin 
            de sa peau. Pour créer une ambiance chaleureuse et apaisante, il est conseillé de choisir 
            des couleurs douces et apaisantes comme le blanc, le beige, le gris ou le bleu. 
            Pour les meubles, privilégiez les matières naturelles comme le bois, le rotin ou 
            le bambou. Pour les accessoires, misez sur les coussins, les plaids et les rideaux. 
            Pour les luminaires, choisissez des lampes à poser ou des appliques murales. 
            Pour les murs, optez pour des peintures mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'soin-du-corps.jpg',
            'parentCategory' => 'parentCategory_1',
        ],
        8 => [
            'name' => 'Maquillage',
            'description' => 'Le maquillage est un rituel de beauté qui permet de mettre en 
            valeur son visage. Pour créer une ambiance chaleureuse et apaisante, 
            il est conseillé de choisir des couleurs douces et apaisantes comme le blanc, 
            le beige, le gris ou le bleu. Pour les meubles, privilégiez les matières naturelles 
            comme le bois, le rotin ou le bambou. Pour les accessoires, misez sur les coussins, 
            les plaids et les rideaux. Pour les luminaires, choisissez des lampes à poser ou des 
            appliques murales. Pour les murs, optez pour des peintures mates ou des papiers peints 
            aux motifs doux et apaisants.',
            'image' => 'maquillage.jpg',
            'parentCategory' => 'parentCategory_1',
        ],
        9 => [
            'name' => 'Parfum',
            'description' => 'Le parfum est un rituel de beauté qui permet de mettre 
            en valeur son visage. Pour créer une ambiance chaleureuse et apaisante, 
            il est conseillé de choisir des couleurs douces et apaisantes comme le blanc, 
            le beige, le gris ou le bleu. Pour les meubles, privilégiez les matières naturelles 
            comme le bois, le rotin ou le bambou. Pour les accessoires, misez sur les coussins, 
            les plaids et les rideaux. Pour les luminaires, choisissez des lampes à poser ou des 
            appliques murales. Pour les murs, optez pour des peintures mates ou des papiers peints 
            aux motifs doux et apaisants.',
            'image' => 'parfum.jpg',
            'parentCategory' => 'parentCategory_1',
        ],
        10 => [
            'name' => 'Chaussures',
            'description' => 'Les chaussures sont des éléments qui permettent de compléter une tenue. 
            Ils sont indispensables pour donner du style à une tenue. Pour créer une ambiance 
            chaleureuse et apaisante, il est conseillé de choisir des couleurs douces et apaisantes 
            comme le blanc, le beige, le gris ou le bleu. Pour les meubles, privilégiez les matières 
            naturelles comme le bois, le rotin ou le bambou. Pour les accessoires, misez sur les coussins, 
            les plaids et les rideaux. Pour les luminaires, choisissez des lampes à poser ou des appliques murales. 
            Pour les murs, optez pour des peintures mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'chaussures.jpg',
            'parentCategory' => 'parentCategory_2',
        ],
        11 => [
            'name' => 'Sacs',
            'description' => 'Les sacs sont des éléments qui permettent de compléter une tenue. 
            Ils sont indispensables pour donner du style à une tenue. Pour créer une ambiance 
            chaleureuse et apaisante, il est conseillé de choisir des couleurs douces et 
            apaisantes comme le blanc, le beige, le gris ou le bleu. Pour les meubles, 
            privilégiez les matières naturelles comme le bois, le rotin ou le bambou. 
            Pour les accessoires, misez sur les coussins, les plaids et les rideaux. 
            Pour les luminaires, choisissez des lampes à poser ou des appliques murales. 
            Pour les murs, optez pour des peintures mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'sacs.jpg',
            'parentCategory' => 'parentCategory_2',
        ],
        12 => [
            'name' => 'Robes',
            'description' => 'Les robes sont des éléments qui permettent de compléter une tenue. 
            Ils sont indispensables pour donner du style à une tenue. Pour créer une ambiance 
            chaleureuse et apaisante, il est conseillé de choisir des couleurs douces et 
            apaisantes comme le blanc, le beige, le gris ou le bleu. Pour les meubles, 
            privilégiez les matières naturelles comme le bois, le rotin ou le bambou. 
            Pour les accessoires, misez sur les coussins, les plaids et les rideaux. 
            Pour les luminaires, choisissez des lampes à poser ou des appliques murales. 
            Pour les murs, optez pour des peintures mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'robes.jpg',
            'parentCategory' => 'parentCategory_2',
        ],
        13 => [
            'name' => 'Chemises',
            'description' => 'Les chemises sont des éléments qui permettent de compléter une tenue. 
            Ils sont indispensables pour donner du style à une tenue. Pour créer une ambiance 
            chaleureuse et apaisante, il est conseillé de choisir des couleurs douces et apaisantes 
            comme le blanc, le beige, le gris ou le bleu. Pour les meubles, privilégiez les 
            matières naturelles comme le bois, le rotin ou le bambou. Pour les accessoires, 
            misez sur les coussins, les plaids et les rideaux. Pour les luminaires, 
            choisissez des lampes à poser ou des appliques murales. Pour les murs, 
            optez pour des peintures mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'chemises.jpg',
            'parentCategory' => 'parentCategory_2',
        ],
        14 => [
            'name' => 'Pantalons',
            'description' => 'Les pantalons sont des éléments qui permettent de compléter une tenue. 
            Ils sont indispensables pour donner du style à une tenue. 
            Pour créer une ambiance chaleureuse et apaisante, 
            il est conseillé de choisir des couleurs douces et apaisantes comme le blanc, 
            le beige, le gris ou le bleu. Pour les meubles, privilégiez les matières 
            naturelles comme le bois, le rotin ou le bambou. Pour les accessoires, 
            misez sur les coussins, les plaids et les rideaux. Pour les luminaires, 
            choisissez des lampes à poser ou des appliques murales. Pour les murs, 
            optez pour des peintures mates ou des papiers peints aux motifs doux et apaisants.',
            'image' => 'pantalons.jpg',
            'parentCategory' => 'parentCategory_2',
        ],
    ];
    private Slugify $slug;

    public function __construct(Slugify $slugify)
    {
        $this->slug = $slugify;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $key => $value) {
            $category = new Category();
            $category->setName($value['name']);
            $category->setDescription($value['description']);
            $category->setImage($value['image']);
            $category->setParent($this->getReference($value['parentCategory']));
            $category->setSlug($this->slug->generate($value['name']));
            $manager->persist($category);
            $this->addReference('category_' . $key, $category);
        }
        $manager->flush();
    }


    public function getDependencies()
    {
        return [
            ParentCategoryFixtures::class,
        ];
    }
}
