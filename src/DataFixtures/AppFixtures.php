<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Room;
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
        $images = ["https://images.pexels.com/photos/316080/pexels-photo-316080.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/265947/pexels-photo-265947.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/265920/pexels-photo-265920.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/3831826/pexels-photo-3831826.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/256444/pexels-photo-256444.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/713149/pexels-photo-713149.jpeg?auto=compress&cs=tinysrgb&w=600", "https://www.1001salles.com/images/provider/30339/1638349684_61a73b7418810-m.webp", "https://www.1001salles.com/images/provider/9311/1549363306_5317_981394516-m.webp", "https://www.1001salles.com/images/provider/60181/1705067906_65a14582b9090-m.webp", "https://images.pexels.com/photos/1297465/pexels-photo-1297465.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/258154/pexels-photo-258154.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/189296/pexels-photo-189296.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/261102/pexels-photo-261102.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/70441/pexels-photo-70441.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/262047/pexels-photo-262047.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/16985196/pexels-photo-16985196/free-photo-of-restaurant-hotel-luxe-tables.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load", "https://images.pexels.com/photos/20603169/pexels-photo-20603169/free-photo-of-restaurant-luxe-tables-moderne.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load", "https://images.pexels.com/photos/20184689/pexels-photo-20184689/free-photo-of-restaurant-table-plantes-centrales.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load", "https://images.pexels.com/photos/5328972/pexels-photo-5328972.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load", "https://images.pexels.com/photos/20184675/pexels-photo-20184675/free-photo-of-restaurant-table-verres-lunettes.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load", "https://images.pexels.com/photos/15126371/pexels-photo-15126371/free-photo-of-restaurant-lampes-table-miroir.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load", "https://images.pexels.com/photos/1001965/pexels-photo-1001965.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/261169/pexels-photo-261169.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/2869215/pexels-photo-2869215.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/53577/hotel-architectural-tourism-travel-53577.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/2290753/pexels-photo-2290753.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/167533/pexels-photo-167533.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/1181396/pexels-photo-1181396.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/159213/hall-congress-architecture-building-159213.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/1181406/pexels-photo-1181406.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/1709003/pexels-photo-1709003.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/269140/pexels-photo-269140.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/1181394/pexels-photo-1181394.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/167478/pexels-photo-167478.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/159806/meeting-modern-room-conference-159806.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/2608517/pexels-photo-2608517.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/3581753/pexels-photo-3581753.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/6045329/pexels-photo-6045329.jpeg?auto=compress&cs=tinysrgb&w=600", "https://images.pexels.com/photos/6044811/pexels-photo-6044811.jpeg?auto=compress&cs=tinysrgb&w=600"];
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
                ]), 0, 2)) // Choisir jusqu'à 2 équipements uniques
            ;
            $manager->persist($room);
        };
        
        
        // BOOKINGS

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
