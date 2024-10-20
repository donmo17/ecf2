<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Room;
use App\Entity\RoomImg;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher) {}

    public function load(ObjectManager $manager): void
    {
        // USER
        $user = new User();
        $user->setEmail('johndoe@test.fr')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->hasher->hashPassword($user, 'password'))
            ->setFirstName('John')
            ->setLastName('DOE')
            ->setAddress('12 avenue du Général Leclerlc')
            ->setZipCode('95130')
            ->setCity('Franconville')
           // ->setImage('https://images.pexels.com/photos/4298629/pexels-photo-4298629.jpeg?auto=compress&cs=tinysrgb&w=600')
        ;
        $manager->persist($user);

        // ADMIN
        $admin = new User();
        $admin->setEmail('admin@test.fr')
        ->setRoles(['ROLE_ADMIN'])
        ->setPassword($this->hasher->hashPassword($admin, 'adminpassword'))
        ->setFirstName('Alexandre')
        ->setLastName('LEGRAND')
        ->setAddress('14 rue aux Loups')
        ->setZipCode('95130')
        ->setCity('Franconville')
       // ->setImage('https://images.pexels.com/photos/2173382/pexels-photo-2173382.jpeg?auto=compress&cs=tinysrgb&w=600')
        ;
        $manager->persist($admin);

        // ROOMS
        $faker = Factory::create();
        $equipment = ["Projecteur", "Tableau blanc", "Écran de projection", "Ordinateur portable", "Système de sonorisation", "Microphone", "Caméra de visioconférence", "Télévision grand écran", "Station d'accueil pour ordinateur", "Lecteur DVD", "Imprimante", "Logiciel de visioconférence", "Logiciel de présentation", "Tablette numérique", "Chargeur pour appareils mobiles", "Adaptateur HDMI", "Télécommande pour projecteur", "Système de gestion de salle", "Scanner de documents", "Routeur Wi-Fi", "Pointeur laser", "Câble réseau", "Hub USB", "Clavier sans fil", "Souris sans fil", "Station de recharge sans fil", "Tableau interactif", "Écran tactile", "Logiciel de tableau blanc interactif", "Logiciel de gestion de projet"];
        $ergonomic = ["Luminosité naturelle", "Accès terrasse", "Accès handicapés", "Climatisation", "Ventilation naturelle", "Fauteuils ergonomiques", "Tables ajustables en hauteur", "Système de projection (projecteur/écran)", "Système de visioconférence", "Éclairage ajustable", "Isolation acoustique", "Espace de rangement", "Support pour ordinateur portable", "Prises électriques accessibles", "Port USB pour recharge", "Wi-Fi haut débit", "Écran interactif", "Sol antidérapant", "Revêtement de sol insonorisant", "Capteurs de qualité de l'air", "Éclairage LED basse consommation", "Toilettes accessibles aux personnes à mobilité réduite", "Salle insonorisée pour appels", "Support ergonomique pour dos", "Écrans de confidentialité", "Espace de détente", "Stores électriques", "Panneaux de signalisation pour malvoyants", "Chaise pivotante", "Chauffage au sol", "Étagères murales", "Douches accessibles", "Espace ouvert pour mobilité des fauteuils roulants", "Détecteurs de mouvements pour l'éclairage", "Station de recharge pour véhicules électriques", "Zone fumeur extérieure", "Système de purification d’air", "Capteurs de température", "Sol en matériau recyclable", "Support pour vélos", "Panneaux solaires", "Système de sécurité renforcé (vidéosurveillance)", "Tables roulantes", "Cuisine équipée", "Panneaux d’affichage digitaux", "Porte automatique", "Vestiaires pour employés", "Espaces verts (jardin/terrasse végétalisée)", "Éclairage naturel optimisé", "Murs végétalisés"];
        $images = ['sall1.webp' ,'sall2.webp','sall3.webp','sall4.jpg','sall5.jpg','sall6.jpg','sall7.jpg','sall8.jpg','sall9.jpg','sall10.jpg','sall11.jpg','sall12.jpg','sall13.jpg','sall14.jpg','sall15.jpg','sall16.jpg','sall17.jpg','sall18.jpg','sall19.jpg','sall20.jpg'];
        $zipCode = [
            "Paris" => 75000,
            "Marseille" => 13000,
            "Lyon" => 69000,
            "Toulouse" => 31000,
            "Nice" => 06000,
            "Nantes" => 44000,
            "Strasbourg" => 67000,
            "Montpellier" => 34000,
            "Bordeaux" => 33000,
            "Lille" => 59000,
            "Rennes" => 35000,
            "Reims" => 51100,
            "Saint-Étienne" => 42000,
            "Toulon" => 83000,
            "Le Havre" => 76600,
            "Grenoble" => 38000,
            "Dijon" => 21000,
            "Nîmes" => 30000,
            "Aix-en-Provence" => 13100,
            "Angers" => 49000
        ];

        $capacityArr = [30 => 69, 70 => 119, 120 => 199, 200 => 499, 500 => 999];
        

        
           
        for($r = 0 ; $r < 50 ; $r++){
            $city = $faker->randomKey($zipCode);
            $capacity = $faker->randomKey($capacityArr);

            $room = new Room();
            $room->setTitle($faker->sentence(3))
                ->setDescription($faker->paragraphs(3, true))
                ->setPrice($faker->randomFloat(2, 149, 4500))
                ->setAddress($faker->streetAddress())
                ->setCity($city)
                ->setZipCode($zipCode[$city])
                ->setCapacityMin($capacity)
                ->setCapacityMax($capacityArr[$capacity])
                ->setErgonomic(array_slice(array_unique([
                    $faker->randomElement($ergonomic),
                    $faker->randomElement($ergonomic),
                ]), 0, 2))
                ->setEquipment(array_slice(array_unique([
                    $faker->randomElement($equipment),
                    $faker->randomElement($equipment),
                ]), 0, 2)); 
                $randomImages = array_unique(array_slice($faker->randomElements($images, 2), 0, 2));

                foreach ($randomImages as $randomImage) {
                    $roomImg = new RoomImg();
                    $roomImg->setImageName($randomImage); // Assigner une image aléatoire
                    $room->addRoomImg($roomImg); // Associer l'image à la salle
                    $manager->persist($roomImg); // Persister chaque image en base de données
                }
                
            ;
            $manager->persist($room);
        };
        
        
        // BOOKINGS

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
