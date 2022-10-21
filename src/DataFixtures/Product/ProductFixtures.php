<?php

namespace App\DataFixtures\Product;

use Faker\Factory;
use DateTimeImmutable;
use App\Service\Slugify;
use App\Entity\Product\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    private Slugify $slug;

    public function __construct(Slugify $slugify)
    {
        $this->slug = $slugify;
    }

    public const PRODUCTS = [
        0 => [
            'name' => 'Coiffeuse',
            'price' => 225,
            'quantity' => 3,
            'summary' => 'Une coiffeuse est un meuble de rangement 
            pour les vêtements et les accessoires de toilette. 
            Il est généralement composé de plusieurs tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Une coiffeuse est un meuble de rangement 
            pour les vêtements et les accessoires de toilette. 
            Il est généralement composé de plusieurs tiroirs et d\'une ou plusieurs portes. 
            Il est souvent équipé d\'un miroir, d\'une table à maquillage et d\'une chaise. 
            Il est généralement placé dans une chambre à coucher ou dans une pièce dédiée à la toilette.',
            'weight' => 10,
            'image0' => 'coiffeuse.jpg',
            'category' => 'category_0',
        ],
        1 => [
            'name' => 'Table basse',
            'price' => 125,
            'quantity' => 5,
            'summary' => 'Une table basse est un meuble de salon qui sert à 
            poser des objets, des livres, des magazines, 
            des verres, etc.',
            'description' => 'Une table basse est un meuble de salon qui 
            sert à poser des objets, des livres, 
            des magazines, des verres, etc. Elle est généralement placée 
            devant un canapé ou un fauteuil. 
            Elle peut être ronde, carrée, rectangulaire, ovale, etc. 
            Elle peut être faite de bois, de métal, 
            de verre, de plastique, etc. Elle peut être recouverte de tissu, 
            de cuir, de velours, etc. 
            Elle peut être équipée de tiroirs, de portes, de tablettes, etc.',
            'weight' => 5,
            'image0' => 'table_basse52.jpg',
            'category' => 'category_0',
        ],
        2 => [
            'name' => 'Table de chevet',
            'price' => 75,
            'quantity' => 7,
            'summary' => 'Une table de chevet est un meuble de rangement 
            pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs tiroirs et 
            d\'une ou plusieurs portes.',
            'description' => 'Une table de chevet est un meuble de rangement 
            pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs tiroirs et 
            d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de chevet. Il est 
            généralement placé à côté d\'un lit.',
            'weight' => 3,
            'image0' => 'table_chevet.jpg',
            'category' => 'category_0',
        ],
        3 => [
            'name' => 'Tapis',
            'price' => 50,
            'quantity' => 10,
            'summary' => 'Un tapis est un tissu épais et moelleux qui 
            sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre.',
            'description' => 'Un tapis est un tissu épais et moelleux 
            qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre. Il peut être fait de laine, de 
            coton, de soie, de lin, de jute, de chanvre, etc.
            Il peut être recouvert de motifs, de dessins, de 
            couleurs, etc. Il peut être rond, carré, rectangulaire, etc.',
            'weight' => 2,
            'image0' => 'tapis.jpg',
            'category' => 'category_0',
        ],
        4 => [
            'name' => 'Chaise',
            'price' => 50,
            'quantity' => 10,
            'summary' => 'Une chaise est un meuble de 
            rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de 
            plusieurs tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Une chaise est un meuble 
            de rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de 
            plusieurs tiroirs et d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de 
            chevet. Il est généralement placé à côté d\'un lit.',
            'weight' => 2,
            'image0' => 'chaise.jpg',
            'category' => 'category_0',
        ],
        5 => [
            'name' => 'Tapis de Bain',
            'price' => 25,
            'quantity' => 10,
            'summary' => 'Un tapis de bain est un tissu épais et 
            moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre.',
            'description' => 'Un tapis de bain est un tissu épais 
            et moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre. Il peut être fait de laine, 
            de coton, de soie, de lin, de jute, de chanvre, etc.
            Il peut être recouvert de motifs, de dessins, de 
            couleurs, etc. Il peut être rond, carré, rectangulaire, etc.',
            'weight' => 2,
            'image0' => 'tapis_de_bain.jpg',
            'category' => 'category_1',
        ],
        6 => [
            'name' => 'Baignoire',
            'price' => 150,
            'quantity' => 10,
            'summary' => 'Une baignoire est un meuble de 
            rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Une baignoire est un meuble de 
            rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de chevet. 
            Il est généralement placé à côté d\'un lit.',
            'weight' => 2,
            'image0' => 'baignoire.jpg',
            'category' => 'category_1',
        ],
        7 => [
            'name' => 'Douche',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Une douche est un tissu épais et moelleux 
            qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre.',
            'description' => 'Une douche est un tissu épais et 
            moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre. Il peut être fait de laine, 
            de coton, de soie, de lin, de jute, de chanvre, etc.
            Il peut être recouvert de motifs, de dessins, 
            de couleurs, etc. Il peut être rond, carré, rectangulaire, etc.',
            'weight' => 2,
            'image0' => 'douche.jpg',
            'category' => 'category_1',
        ],
        8 => [
            'name' => 'Lavabo',
            'price' => 50,
            'quantity' => 10,
            'summary' => 'Un lavabo est un meuble de rangement 
            pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Un lavabo est un meuble de 
            rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de chevet. 
            Il est généralement placé à côté d\'un lit.',
            'weight' => 2,
            'image0' => 'lavabo.jpg',
            'category' => 'category_1',
        ],
        9 => [
            'name' => 'Meuble de Salle de Bain',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Un meuble de salle de bain est un tissu 
            épais et moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre.',
            'description' => 'Un meuble de salle de bain est un 
            tissu épais et moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre. Il peut être fait de laine, 
            de coton, de soie, de lin, de jute, de chanvre, etc.
            Il peut être recouvert de motifs, de dessins, 
            de couleurs, etc. Il peut être rond, carré, rectangulaire, etc.',
            'weight' => 2,
            'image0' => 'meuble_de_salle_de_bain.jpg',
            'category' => 'category_1',
        ],
        10 => [
            'name' => 'Meuble Cuisine',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Un meuble de cuisine est un meuble de 
            rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Un meuble de cuisine est un meuble 
            de rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de chevet. 
            Il est généralement placé à côté d\'un lit.',
            'weight' => 2,
            'image0' => 'meuble_cuisine.jpg',
            'category' => 'category_2',
        ],
        11 => [
            'name' => 'Micro Onde',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Un micro onde est un tissu épais et 
            moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre.',
            'description' => 'Un micro onde est un tissu épais 
            et moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre. Il peut être fait de laine, 
            de coton, de soie, de lin, de jute, de chanvre, etc.
            Il peut être recouvert de motifs, de dessins, 
            de couleurs, etc. Il peut être rond, carré, rectangulaire, etc.',
            'weight' => 2,
            'image0' => 'micro_onde.jpg',
            'category' => 'category_2',
        ],
        12 => [
            'name' => 'Réfrigérateur',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Un réfrigérateur est un meuble de 
            rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Un réfrigérateur est un meuble 
            de rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de chevet. 
            Il est généralement placé à côté d\'un lit.',
            'weight' => 2,
            'image0' => 'refrigerateur.jpg',
            'category' => 'category_2',
        ],
        13 => [
            'name' => 'Table de Cuisine',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Une table de cuisine est un tissu épais 
            et moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre.',
            'description' => 'Une table de cuisine est un tissu épais 
            et moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre. Il peut être fait de laine, 
            de coton, de soie, de lin, de jute, de chanvre, etc.
            Il peut être recouvert de motifs, de dessins, 
            de couleurs, etc. Il peut être rond, carré, rectangulaire, etc.',
            'weight' => 2,
            'image0' => 'table_de_cuisine.jpg',
            'category' => 'category_2',
        ],
        14 => [
            'name' => 'Lave Vaiselle',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Un lave vaiselle est un meuble de 
            rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Un lave vaiselle est un meuble 
            de rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de chevet. 
            Il est généralement placé à côté d\'un lit.',
            'weight' => 2,
            'image0' => 'lave_vaiselle.jpg',
            'category' => 'category_2',
        ],
        15 => [
            'name' => 'Table de Salle à Manger',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Une table de salle à manger est un tissu 
            épais et moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre.',
            'description' => 'Une table de salle à manger est un 
            tissu épais et moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre. Il peut être fait de 
            laine, de coton, de soie, de lin, de jute, de chanvre, etc.
            Il peut être recouvert de motifs, de dessins, 
            de couleurs, etc. Il peut être rond, carré, rectangulaire, etc.',
            'weight' => 2,
            'image0' => 'table_de_salle_a_manger.jpg',
            'category' => 'category_3',
        ],
        16 => [
            'name' => 'Chaise de Salle à Manger',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Une chaise de salle à manger est un 
            meuble de rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Une chaise de salle à manger est 
            un meuble de rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de chevet. 
            Il est généralement placé à côté d\'un lit.',
            'weight' => 2,
            'image0' => 'chaise_de_salle_a_manger.jpg',
            'category' => 'category_3',
        ],
        17 => [
            'name' => 'Table de Salon',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Une table de salon est un tissu épais et 
            moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre.',
            'description' => 'Une table de salon est un tissu épais 
            et moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre. Il peut être fait de laine, 
            de coton, de soie, de lin, de jute, de chanvre, etc.
            Il peut être recouvert de motifs, de dessins, 
            de couleurs, etc. Il peut être rond, carré, rectangulaire, etc.',
            'weight' => 2,
            'image0' => 'table_de_salon.jpg',
            'category' => 'category_3',
        ],
        18 => [
            'name' => 'Canapé',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Un canapé est un meuble de rangement 
            pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Un canapé est un meuble de 
            rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de chevet. 
            Il est généralement placé à côté d\'un lit.',
            'weight' => 2,
            'image0' => 'canape.jpg',
            'category' => 'category_3',
        ],
        19 => [
            'name' => 'Table Basse',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Une table basse est un tissu épais et 
            moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre.',
            'description' => 'Une table basse est un tissu 
            épais et moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre. Il peut être fait de 
            laine, de coton, de soie, de lin, de jute, de chanvre, etc.
            Il peut être recouvert de motifs, de dessins, 
            de couleurs, etc. Il peut être rond, carré, rectangulaire, etc.',
            'weight' => 2,
            'image0' => 'table_basse.jpg',
            'category' => 'category_3',
        ],
        20 => [
            'name' => 'Chaise de Bureau',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Une chaise de bureau est un meuble 
            de rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Une chaise de bureau est un 
            meuble de rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de 
            plusieurs tiroirs et d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de chevet. 
            Il est généralement placé à côté d\'un lit.',
            'weight' => 2,
            'image0' => 'chaise_de_bureau.jpg',
            'category' => 'category_4',
        ],
        21 => [
            'name' => 'Bureau',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Un bureau est un tissu épais et moelleux 
            qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre.',
            'description' => 'Un bureau est un tissu épais et 
            moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre. Il peut être fait de laine, 
            de coton, de soie, de lin, de jute, de chanvre, etc.
            Il peut être recouvert de motifs, de dessins, 
            de couleurs, etc. Il peut être rond, carré, rectangulaire, etc.',
            'weight' => 2,
            'image0' => 'bureau.jpg',
            'category' => 'category_4',
        ],
        22 => [
            'name' => 'Lampe de Bureau',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Une lampe de bureau est un meuble 
            de rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Une lampe de bureau est un 
            meuble de rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de 
            plusieurs tiroirs et d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de chevet. 
            Il est généralement placé à côté d\'un lit.',
            'weight' => 2,
            'image0' => 'lampe_de_bureau.jpg',
            'category' => 'category_4',
        ],
        23 => [
            'name' => 'Tableau',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Un tableau est un tissu épais et moelleux 
            qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre.',
            'description' => 'Un tableau est un tissu épais et 
            moelleux qui sert à recouvrir le sol. Il est généralement placé
            dans une pièce à vivre. Il peut être fait de laine, 
            de coton, de soie, de lin, de jute, de chanvre, etc.
            Il peut être recouvert de motifs, de dessins, 
            de couleurs, etc. Il peut être rond, carré, rectangulaire, etc.',
            'weight' => 2,
            'image0' => 'tableau.jpg',
            'category' => 'category_4',
        ],
        24 => [
            'name' => 'Casque PC',
            'price' => 100,
            'quantity' => 10,
            'summary' => 'Un casque PC est un meuble de 
            rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de plusieurs 
            tiroirs et d\'une ou plusieurs portes.',
            'description' => 'Un casque PC est un meuble de 
            rangement pour les objets de toilette et les accessoires
            de nuit. Il est généralement composé de 
            plusieurs tiroirs et d\'une ou plusieurs portes.
            Il est souvent équipé d\'une lampe de 
            chevet. Il est généralement placé à côté d\'un lit.',
            'weight' => 2,
            'image0' => 'casque_pc.jpg',
            'category' => 'category_4',
        ],
        25 => [
            'name' => 'Lunettes de Soleil',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Les lunettes de soleil sont des 
            lunettes qui protègent les yeux du soleil. Elles sont généralement
            portées par les personnes qui vivent dans des régions chaudes.',
            'description' => 'Les lunettes de soleil sont 
            des lunettes qui protègent les yeux du soleil. Elles sont généralement
            portées par les personnes qui vivent dans des 
            régions chaudes. Elles sont généralement fabriquées en verre,
            en plastique ou en métal. Elles sont généralement 
            de couleur noire, blanche, verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'lunettes_de_soleil.jpg',
            'category' => 'category_5',
        ],
        26 => [
            'name' => 'Montre',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Une montre est un objet qui sert à 
            mesurer le temps. Elle est généralement portée par les personnes
            qui ont besoin de savoir à quelle heure il est.',
            'description' => 'Une montre est un objet qui sert 
            à mesurer le temps. Elle est généralement portée par les personnes
            qui ont besoin de savoir à quelle heure il est. 
            Elle est généralement fabriquée en métal, en plastique, en verre,
            en bois, etc. Elle est généralement de couleur
            noire, blanche, verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'montre.jpg',
            'category' => 'category_5',
        ],
        27 => [
            'name' => 'Boucles d\'Oreilles',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Les boucles d\'oreilles sont des bijoux qui 
            s\'accrochent aux oreilles. Elles sont généralement portées
            par les personnes qui aiment les bijoux.',
            'description' => 'Les boucles d\'oreilles sont des 
            bijoux qui s\'accrochent aux oreilles. Elles sont généralement portées
            par les personnes qui aiment les bijoux. Elles 
            sont généralement fabriquées en métal, en plastique, en verre,
            en bois, etc. Elles sont généralement de 
            couleur noire, blanche, verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'boucles_d_oreilles.jpg',
            'category' => 'category_5',
        ],
        28 => [
            'name' => 'Collier',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Un collier est un bijou qui s\'accroche
            autour du cou. Il est généralement porté par les personnes
            qui aiment les bijoux.',
            'description' => 'Un collier est un bijou 
            qui s\'accroche autour du cou. Il est généralement porté par les personnes
            qui aiment les bijoux. Il est généralement 
            fabriqué en métal, en plastique, en verre, en bois, etc.
            Il est généralement de couleur noire, 
            blanche, verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'collier.jpg',
            'category' => 'category_5',
        ],
        29 => [
            'name' => 'Bague',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Une bague est un bijou qui 
            s\'accroche au doigt. Elle est généralement portée par les personnes
            qui aiment les bijoux.',
            'description' => 'Une bague est un bijou qui 
            s\'accroche au doigt. Elle est généralement portée par les personnes
            qui aiment les bijoux. Elle est généralement 
            fabriquée en métal, en plastique, en verre, en bois, etc.
            Elle est généralement de couleur noire, 
            blanche, verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'bague.jpg',
            'category' => 'category_5',
        ],
        30 => [
            'name' => 'Creme solaire',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Une crème solaire est une crème qui 
            protège la peau du soleil. Elle est généralement utilisée
            par les personnes qui vivent dans des régions chaudes.',
            'description' => 'Une crème solaire est une crème 
            qui protège la peau du soleil. Elle est généralement utilisée
            par les personnes qui vivent dans des régions chaudes. 
            Elle est généralement fabriquée en métal, en plastique,
            en verre, en bois, etc. Elle est généralement de 
            couleur noire, blanche, verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'creme_solaire.jpg',
            'category' => 'category_6',
        ],
        31 => [
            'name' => 'Creme hydratante',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Une crème hydratante est une crème qui hydrate 
            la peau. Elle est généralement utilisée par les personnes
            qui ont la peau sèche.',
            'description' => 'Une crème hydratante est une crème 
            qui hydrate la peau. Elle est généralement utilisée par les personnes
            qui ont la peau sèche. Elle est généralement fabriquée 
            en métal, en plastique, en verre, en bois, etc.
            Elle est généralement de couleur noire, 
            blanche, verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'creme_hydratante.jpg',
            'category' => 'category_6',
        ],
        32 => [
            'name' => 'Creme anti-rides',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Une crème anti-rides est une crème 
            qui ralentit le vieillissement de la peau. Elle est généralement utilisée
            par les personnes qui ont des rides.',
            'description' => 'Une crème anti-rides est une crème 
            qui ralentit le vieillissement de la peau. Elle est généralement utilisée
            par les personnes qui ont des rides. Elle est généralement 
            fabriquée en métal, en plastique, en verre, en bois, etc.
            Elle est généralement de couleur noire, 
            blanche, verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'creme_anti_rides.jpg',
            'category' => 'category_6',
        ],
        33 => [
            'name' => 'Creme anti-acné',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Une crème anti-acné est une crème qui élimine 
            les boutons. Elle est généralement utilisée par les personnes
            qui ont des boutons.',
            'description' => 'Une crème anti-acné est une crème qui 
            élimine les boutons. Elle est généralement utilisée par les personnes
            qui ont des boutons. Elle est généralement fabriquée en 
            métal, en plastique, en verre, en bois, etc.
            Elle est généralement de couleur noire, blanche, 
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'creme_anti_acne.jpg',
            'category' => 'category_6',
        ],
        34 => [
            'name' => 'Creme anti-moustique',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Une crème anti-moustique est une crème qui 
            éloigne les moustiques. Elle est généralement utilisée par les personnes
            qui vivent dans des régions chaudes.',
            'description' => 'Une crème anti-moustique est une crème 
            qui éloigne les moustiques. Elle est généralement utilisée par les personnes
            qui vivent dans des régions chaudes. Elle est 
            généralement fabriquée en métal, en plastique, en verre, en bois, etc.
            Elle est généralement de couleur noire, 
            blanche, verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'creme_anti_moustique.jpg',
            'category' => 'category_6',
        ],
        35 => [
            'name' => 'Gel douche bio',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Un gel douche bio est un gel qui nettoie la peau. 
            Il est généralement utilisé par les personnes qui aiment les produits
            bio.',
            'description' => 'Un gel douche bio est un gel qui nettoie la peau. 
            Il est généralement utilisé par les personnes qui aiment les produits
            bio. Il est généralement fabriqué en métal, en plastique, 
            en verre, en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'gel_douche_bio.jpg',
            'category' => 'category_7',
        ],
        36 => [
            'name' => 'Creme pour le corps bio',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Une crème pour le corps bio est une crème qui 
            hydrate la peau. Elle est généralement utilisée par les personnes
            qui aiment les produits bio.',
            'description' => 'Une crème pour le corps bio est une crème 
            qui hydrate la peau. Elle est généralement utilisée par les personnes
            qui aiment les produits bio. Elle est généralement 
            fabriquée en métal, en plastique, en verre, en bois, etc.
            Elle est généralement de couleur noire, blanche, 
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'creme_corps_bio.jpg',
            'category' => 'category_7',
        ],
        37 => [
            'name' => 'Shampoing bio',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Un shampoing bio est un shampoing qui nettoie 
            les cheveux. Il est généralement utilisé par les personnes qui aiment les produits
            bio.',
            'description' => 'Un shampoing bio est un shampoing qui nettoie 
            les cheveux. Il est généralement utilisé par les personnes qui aiment les produits
            bio. Il est généralement fabriqué en métal, en plastique, 
            en verre, en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'shampoing_bio.jpg',
            'category' => 'category_7',
        ],
        38 => [
            'name' => 'Déodorant bio',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Un déodorant bio est un déodorant qui élimine les 
            odeurs corporelles. Il est généralement utilisé par les personnes qui aiment les produits
            bio.',
            'description' => 'Un déodorant bio est un déodorant qui élimine 
            les odeurs corporelles. Il est généralement utilisé par les personnes qui aiment les produits
            bio. Il est généralement fabriqué en métal, en plastique, 
            en verre, en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'deodorant_bio.jpg',
            'category' => 'category_7',
        ],
        39 => [
            'name' => 'Creme pour les mains bio',
            'price' => 80,
            'quantity' => 20,
            'summary' => 'Une crème pour les mains bio est une crème 
            qui hydrate les mains. Elle est généralement utilisée par les personnes
            qui aiment les produits bio.',
            'description' => 'Une crème pour les mains bio est une 
            crème qui hydrate les mains. Elle est généralement utilisée par les personnes
            qui aiment les produits bio. Elle est généralement 
            fabriquée en métal, en plastique, en verre, en bois, etc.
            Elle est généralement de couleur noire, blanche, verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'creme_mains_bio.jpg',
            'category' => 'category_7',
        ],
        40 => [
            'name' => 'Rouge à lèvres',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un rouge à lèvres est un rouge qui colore 
            les lèvres. Il est généralement utilisé par les personnes qui aiment
            se maquiller.',
            'description' => 'Un rouge à lèvres est un rouge qui 
            colore les lèvres. Il est généralement utilisé par les personnes qui aiment
            se maquiller. Il est généralement fabriqué en métal, 
            en plastique, en verre, en bois, etc. Il est généralement de couleur noire,
            blanche, verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'rouge_a_levres.jpg',
            'category' => 'category_8',
        ],
        41 => [
            'name' => 'Fond de teint',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un fond de teint est un fond qui colore la peau. 
            Il est généralement utilisé par les personnes qui aiment se maquiller.',
            'description' => 'Un fond de teint est un fond qui colore la 
            peau. Il est généralement utilisé par les personnes qui aiment se maquiller.
            Il est généralement fabriqué en métal, en plastique, 
            en verre, en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'fond_de_teint.jpg',
            'category' => 'category_8',
        ],
        42 => [
            'name' => 'Poudre',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une poudre est une poudre qui colore la peau. 
            Elle est généralement utilisée par les personnes qui aiment se maquiller.',
            'description' => 'Une poudre est une poudre qui colore la peau. 
            Elle est généralement utilisée par les personnes qui aiment se maquiller.
            Elle est généralement fabriquée en métal, en plastique, 
            en verre, en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'poudre.jpg',
            'category' => 'category_8',
        ],
        43 => [
            'name' => 'Mascara',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un mascara est un mascara qui colore les cils. 
            Il est généralement utilisé par les personnes qui aiment se maquiller.',
            'description' => 'Un mascara est un mascara qui colore les cils. 
            Il est généralement utilisé par les personnes qui aiment se maquiller.
            Il est généralement fabriqué en métal, en plastique, en verre, 
            en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'mascara.jpg',
            'category' => 'category_8',
        ],
        44 => [
            'name' => 'Fard à paupières',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un fard à paupières est un fard qui colore les 
            paupières. Il est généralement utilisé par les personnes qui aiment se maquiller.',
            'description' => 'Un fard à paupières est un fard qui colore 
            les paupières. Il est généralement utilisé par les personnes qui aiment se maquiller.
            Il est généralement fabriqué en métal, en plastique, 
            en verre, en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'fard_paupieres.jpg',
            'category' => 'category_8',
        ],
        45 => [
            'name' => 'Senteur Rose',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une senteur rose est une senteur qui colore 
            les parfums. Elle est généralement utilisée par les personnes qui aiment se parfumer.',
            'description' => 'Une senteur rose est une senteur qui 
            colore les parfums. Elle est généralement utilisée par les personnes qui aiment se parfumer.
            Elle est généralement fabriquée en métal, en plastique, 
            en verre, en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'senteur_rose.jpg',
            'category' => 'category_9',
        ],
        46 => [
            'name' => 'Senteur Fleur',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une senteur fleur est une senteur qui colore 
            les parfums. Elle est généralement utilisée par les personnes qui aiment se parfumer.',
            'description' => 'Une senteur fleur est une senteur qui colore 
            les parfums. Elle est généralement utilisée par les personnes qui aiment se parfumer.
            Elle est généralement fabriquée en métal, en plastique, 
            en verre, en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'senteur_fleur.jpg',
            'category' => 'category_9',
        ],
        47 => [
            'name' => 'Senteur Fruits',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une senteur fruits est une senteur qui colore 
            les parfums. Elle est généralement utilisée par les personnes qui aiment se parfumer.',
            'description' => 'Une senteur fruits est une senteur 
            qui colore les parfums. Elle est généralement utilisée par les personnes qui aiment se parfumer.
            Elle est généralement fabriquée en métal, en plastique, 
            en verre, en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'senteur_fruits.jpg',
            'category' => 'category_9',
        ],
        48 => [
            'name' => 'Senteur Bois',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une senteur bois est une senteur qui colore 
            les parfums. Elle est généralement utilisée par les personnes qui aiment se parfumer.',
            'description' => 'Une senteur bois est une senteur qui 
            colore les parfums. Elle est généralement utilisée par les personnes qui aiment se parfumer.
            Elle est généralement fabriquée en métal, en plastique, 
            en verre, en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'senteur_bois.jpg',
            'category' => 'category_9',
        ],
        49 => [
            'name' => 'Senteur Eau',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une senteur eau est une senteur qui colore les 
            parfums. Elle est généralement utilisée par les personnes qui aiment se parfumer.',
            'description' => 'Une senteur eau est une senteur qui colore 
            les parfums. Elle est généralement utilisée par les personnes qui aiment se parfumer.
            Elle est généralement fabriquée en métal, en plastique, 
            en verre, en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'senteur_eau.jpg',
            'category' => 'category_9',
        ],
        50 => [
            'name' => 'Mocassins',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un mocassin est une chaussure qui colore les pieds. 
            Il est généralement utilisé par les personnes qui aiment se chaussurer.',
            'description' => 'Un mocassin est une chaussure qui colore les 
            pieds. Il est généralement utilisé par les personnes qui aiment se chaussurer.
            Il est généralement fabriqué en métal, en plastique, en verre, 
            en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'mocassins.jpg',
            'category' => 'category_10',
        ],
        51 => [
            'name' => 'Bottes',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une botte est une chaussure qui colore les pieds. 
            Elle est généralement utilisée par les personnes qui aiment se chaussurer.',
            'description' => 'Une botte est une chaussure qui colore les pieds. 
            Elle est généralement utilisée par les personnes qui aiment se chaussurer.
            Elle est généralement fabriquée en métal, en plastique, en verre, 
            en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'bottes.jpg',
            'category' => 'category_10',
        ],
        52 => [
            'name' => 'Baskets',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une basket est une chaussure qui colore les pieds. 
            Elle est généralement utilisée par les personnes qui aiment se chaussurer.',
            'description' => 'Une basket est une chaussure qui colore les pieds. 
            Elle est généralement utilisée par les personnes qui aiment se chaussurer.
            Elle est généralement fabriquée en métal, en plastique, en verre, 
            en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'baskets.jpg',
            'category' => 'category_10',
        ],
        53 => [
            'name' => 'Sandales',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une sandale est une chaussure qui colore les pieds. 
            Elle est généralement utilisée par les personnes qui aiment se chaussurer.',
            'description' => 'Une sandale est une chaussure qui colore les 
            pieds. Elle est généralement utilisée par les personnes qui aiment se chaussurer.
            Elle est généralement fabriquée en métal, en plastique, 
            en verre, en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'sandales.jpg',
            'category' => 'category_10',
        ],
        54 => [
            'name' => 'Chaussures de ville',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une chaussure de ville est une chaussure qui colore 
            les pieds. Elle est généralement utilisée par les personnes qui aiment se chaussurer.',
            'description' => 'Une chaussure de ville est une chaussure qui 
            colore les pieds. Elle est généralement utilisée par les personnes qui aiment se chaussurer.
            Elle est généralement fabriquée en métal, en plastique, en verre, 
            en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'chaussures_de_ville.jpg',
            'category' => 'category_10',
        ],
        55 => [
            'name' => 'Sac à main',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un sac à main est un sac qui colore les mains. 
            Il est généralement utilisé par les personnes qui aiment se sacquer.',
            'description' => 'Un sac à main est un sac qui colore les mains. 
            Il est généralement utilisé par les personnes qui aiment se sacquer.
            Il est généralement fabriqué en métal, en plastique, en verre, 
            en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'sac_a_main.jpg',
            'category' => 'category_11',
        ],
        56 => [
            'name' => 'Sac à dos',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un sac à dos est un sac qui colore les mains. 
            Il est généralement utilisé par les personnes qui aiment se sacquer.',
            'description' => 'Un sac à dos est un sac qui colore les mains. 
            Il est généralement utilisé par les personnes qui aiment se sacquer.
            Il est généralement fabriqué en métal, en plastique, en verre, 
            en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'sac_a_dos.jpg',
            'category' => 'category_11',
        ],
        57 => [
            'name' => 'Sac à bandoulière',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un sac à bandoulière est un sac qui colore les mains. 
            Il est généralement utilisé par les personnes qui aiment se sacquer.',
            'description' => 'Un sac à bandoulière est un sac qui colore les mains. 
            Il est généralement utilisé par les personnes qui aiment se sacquer.
            Il est généralement fabriqué en métal, en plastique, en verre, 
            en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'sac_a_bandouliere.jpg',
            'category' => 'category_11',
        ],
        58 => [
            'name' => 'Sac à main Cuir',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un sac à main cuir est un sac qui colore les mains. 
            Il est généralement utilisé par les personnes qui aiment se sacquer.',
            'description' => 'Un sac à main cuir est un sac qui colore les mains. 
            Il est généralement utilisé par les personnes qui aiment se sacquer.
            Il est généralement fabriqué en métal, en plastique, en verre, 
            en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'sac_a_main_cuir.jpg',
            'category' => 'category_11',
        ],
        59 => [
            'name' => 'Sac de voyage',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un sac de voyage est un sac qui colore les mains. 
            Il est généralement utilisé par les personnes qui aiment se sacquer.',
            'description' => 'Un sac de voyage est un sac qui colore les mains. 
            Il est généralement utilisé par les personnes qui aiment se sacquer.
            Il est généralement fabriqué en métal, en plastique, en verre, 
            en bois, etc. Il est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'sac_de_voyage.jpg',
            'category' => 'category_11',
        ],
        60 => [
            'name' => 'Robes Midi',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une robe midi est une robe qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se rober.',
            'description' => 'Une robe midi est une robe qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se rober.
            Elle est généralement fabriquée en métal, en plastique, en verre, 
            en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'robe_midi.jpg',
            'category' => 'category_12',
        ],
        61 => [
            'name' => 'Robes Longues',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une robe longue est une robe qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se rober.',
            'description' => 'Une robe longue est une robe qui colore les 
            jambes. Elle est généralement utilisée par les personnes qui aiment se rober.
            Elle est généralement fabriquée en métal, en plastique, 
            en verre, en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'robe_longue.jpg',
            'category' => 'category_12',
        ],
        62 => [
            'name' => 'Robes Courtes',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une robe courte est une robe qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se rober.',
            'description' => 'Une robe courte est une robe qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se rober.
            Elle est généralement fabriquée en métal, en plastique, en verre, 
            en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'robe_courte.jpg',
            'category' => 'category_12',
        ],
        63 => [
            'name' => 'Robes de soirée',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une robe de soirée est une robe qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se rober.',
            'description' => 'Une robe de soirée est une robe qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se rober.
            Elle est généralement fabriquée en métal, en plastique, en verre, 
            en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'robe_de_soiree.jpg',
            'category' => 'category_12',
        ],
        64 => [
            'name' => 'Robes de cocktail',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une robe de cocktail est une robe qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se rober.',
            'description' => 'Une robe de cocktail est une robe qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se rober.
            Elle est généralement fabriquée en métal, en plastique, en verre, 
            en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'robe_de_cocktail.jpg',
            'category' => 'category_12',
        ],
        65 => [
            'name' => 'Chemises manches courtes',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une chemise à manches courtes est une chemise qui colore les bras. 
            Elle est généralement utilisée par les personnes qui aiment se chemiser.',
            'description' => 'Une chemise à manches courtes est une chemise qui colore les bras. 
            Elle est généralement utilisée par les personnes qui aiment se chemiser.
            Elle est généralement fabriquée en métal, en plastique, en verre, 
            en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'chemise_manches_courtes.jpg',
            'category' => 'category_13',
        ],
        66 => [
            'name' => 'Chemises manches longues',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une chemise à manches longues est une chemise qui colore les bras. 
            Elle est généralement utilisée par les personnes qui aiment se chemiser.',
            'description' => 'Une chemise à manches longues est une chemise qui colore les bras. 
            Elle est généralement utilisée par les personnes qui aiment se chemiser.
            Elle est généralement fabriquée en métal, en plastique, en verre, en bois, 
            etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'chemise_manches_longues.jpg',
            'category' => 'category_13',
        ],
        67 => [
            'name' => 'Chemises Homme',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une chemise pour homme est une chemise qui colore les bras. 
            Elle est généralement utilisée par les personnes qui aiment se chemiser.',
            'description' => 'Une chemise pour homme est une chemise qui colore les bras. 
            Elle est généralement utilisée par les personnes qui aiment se chemiser.
            Elle est généralement fabriquée en métal, en plastique, en verre, en bois, etc. 
            Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'chemise_homme.jpg',
            'category' => 'category_13',
        ],
        68 => [
            'name' => 'Chemises Femme',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une chemise pour femme est une chemise qui colore les bras. 
            Elle est généralement utilisée par les personnes qui aiment se chemiser.',
            'description' => 'Une chemise pour femme est une chemise qui colore les bras. 
            Elle est généralement utilisée par les personnes qui aiment se chemiser.
            Elle est généralement fabriquée en métal, en plastique, en verre, en bois, etc. 
            Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'chemise_femme.jpg',
            'category' => 'category_13',
        ],
        69 => [
            'name' => 'Chemises Enfant',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Une chemise pour enfant est une chemise qui colore les bras. 
            Elle est généralement utilisée par les personnes qui aiment se chemiser.',
            'description' => 'Une chemise pour enfant est une chemise qui colore les bras. 
            Elle est généralement utilisée par les personnes qui aiment se chemiser.
            Elle est généralement fabriquée en métal, en plastique, en verre, en bois, etc. 
            Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'chemise_enfant.jpg',
            'category' => 'category_13',
        ],
        70 => [
            'name' => 'Pantalons Homme',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un pantalon pour homme est un pantalon qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se pantalonner.',
            'description' => 'Un pantalon pour homme est un pantalon qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se pantalonner.
            Elle est généralement fabriquée en métal, en plastique, en verre, en bois, etc. 
            Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'pantalon_homme.jpg',
            'category' => 'category_14',
        ],
        71 => [
            'name' => 'Jeans Homme',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un jean pour homme est un jean qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se jeanner.',
            'description' => 'Un jean pour homme est un jean qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se jeanner.
            Elle est généralement fabriquée en métal, en plastique, en verre, 
            en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'jean_homme.jpg',
            'category' => 'category_14',
        ],
        72 => [
            'name' => 'Pantalons Femme',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un pantalon pour femme est un pantalon qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se pantalonner.',
            'description' => 'Un pantalon pour femme est un pantalon qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se pantalonner.
            Elle est généralement fabriquée en métal, en plastique, en verre, en bois, etc. 
            Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'pantalon_femme.jpg',
            'category' => 'category_14',
        ],
        73 => [
            'name' => 'Jeans Femme',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un jean pour femme est un jean qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se jeanner.',
            'description' => 'Un jean pour femme est un jean qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se jeanner.
            Elle est généralement fabriquée en métal, en plastique, en verre, 
            en bois, etc. Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'jean_femme.jpg',
            'category' => 'category_14',
        ],
        74 => [
            'name' => 'Pantalons Enfant',
            'price' => 30,
            'quantity' => 80,
            'summary' => 'Un pantalon pour enfant est un pantalon qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se pantalonner.',
            'description' => 'Un pantalon pour enfant est un pantalon qui colore les jambes. 
            Elle est généralement utilisée par les personnes qui aiment se pantalonner.
            Elle est généralement fabriquée en métal, en plastique, en verre, en bois, etc. 
            Elle est généralement de couleur noire, blanche,
            verte, bleue, rouge, etc.',
            'weight' => 0.5,
            'image0' => 'pantalon_enfant.jpg',
            'category' => 'category_14',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        foreach (self::PRODUCTS as $key => $value) {
            $product = new Product();
            $product->setName($value['name']);
            $product->setPrice($value['price'] * 100);
            $product->setSummary($value['summary']);
            $product->setDescription($value['description']);
            $product->setWeight(strval($value['weight']));
            $product->setImage0($value['image0']);
            $product->setImage1("https://loremflickr.com/300/300?random=");
            $product->setImage2("https://loremflickr.com/300/300?random=");
            $product->setImage3("https://loremflickr.com/300/300?random=");
            $product->setImage4("https://loremflickr.com/300/300?random=");
            $product->setCategory($this->getReference($value['category']));
            $product->setSlug($this->slug->generate($product->getName()));
            $product->setCreatedAt(new DateTimeImmutable());
            $product->setUpdatedAt($faker->dateTimeBetween('-6 months'));
            $product->setReleaseAt($faker->dateTimeBetween('-6 months'));
            $product->setSlug($this->slug->generate($product->getName()));
            $product->setTaxe($this->getReference("taxe_" . $faker->numberBetween(0, 1)));
            $this->addReference('product_' . $key, $product);
            $manager->persist($product);
        }

        $manager->flush();
    }

    // public function load(ObjectManager $manager): void
    // {
    //     $faker = Factory::create('fr_FR');

    //     for ($i = 0; $i < 40; $i++) {
    //         $product = new Product();
    //         $product->setName("Product $i");
    //         $product->setImage0("https://loremflickr.com/300/300?random=$i");
    //         $product->setImage1("https://loremflickr.com/300/300?random=1$i");
    //         $product->setImage2("https://loremflickr.com/300/300?random=2$i");
    //         $product->setImage3("https://loremflickr.com/300/300?random=3$i");
    //         $product->setImage4("https://loremflickr.com/300/300?random=4$i");
    //         $product->setPrice($faker->randomFloat(2, 0, 100));
    //         $product->setQuantity($faker->numberBetween(0, 100));
    //         $product->setDescription($faker->realText(100));
    //         $product->setCreatedAt(new DateTimeImmutable());
    //         $product->setUpdatedAt($faker->dateTimeBetween('-6 months'));
    //         $product->setReleaseAt($faker->dateTimeBetween('-6 months'));
    //         $product->setSummary($faker->realText(50));
    //         $product->setWeight("100");
    //         $product->setSlug($this->slug->generate($product->getName()));
    //         $product->setCategory($this->getReference("category_" . $faker->numberBetween(0, 4)));
    //         $product->setTaxe($this->getReference("taxe_" . $faker->numberBetween(0, 1)));
    //         $this->addReference("product_$i", $product);
    //         $manager->persist($product);
    //     }

    //     $manager->flush();
    // }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            TaxeFixtures::class,
        ];
    }
}
