<?php

namespace App\Controller\Admin;

use App\Entity\BOOKING;
use App\Enum\BookingStatus;
use App\Entity\NOTIFICATION;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BOOKINGCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BOOKING::class;
    }
    


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield AssociationField::new('room_id', 'Salle')->setRequired(true);
        yield DateTimeField::new('created_at', 'Date de création')->hideOnForm();
        yield DateTimeField::new('check_in_at', 'Date d\'arrivée')->setRequired(true);
        yield DateTimeField::new('check_out_at', 'Date de départ')->setRequired(true);
        yield ChoiceField::new('status', 'Statut')
            ->setChoices([
                'En attente' => BookingStatus::Pending,
                'Réservé' => BookingStatus::Booked,
                'Annulé' => BookingStatus::Cancelled,
                'Refusé' => BookingStatus::Declined,
                'Terminé' => BookingStatus::Completed,
            ])
            ->setFormType(ChoiceType::class)
            ->setFormTypeOption('choice_value', fn (BookingStatus $status = null) => $status?->value)
            ->renderAsBadges([
                BookingStatus::Pending->value => 'warning',
                BookingStatus::Booked->value => 'success',
                BookingStatus::Cancelled->value => 'danger',
                BookingStatus::Declined->value => 'danger',
                BookingStatus::Completed->value => 'info',
            ]);
        yield BooleanField::new('is_validate', 'Validé');
        yield NumberField::new('billing', 'Montant total (€)')
            ->setNumDecimals(2)
            ->setStoredAsString(false)
            ->setFormTypeOption('grouping', true)
            ->setFormTypeOption('scale', 2);
        yield AssociationField::new('user_id', 'Utilisateur')->hideOnForm();
    }

    /**
     * Fonction qui vérifie si le statut d'une réservation a été modifié.
     * Si c'est le cas, la fonction appel createNotification() pour générer une nouvelle notification.
     * Ne retourne rien.
     * 
     * @param EntityManagerInterface $entityManager
     * @param [type] $entityInstance
     * @return void
     */
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $unitOfWork = $entityManager->getUnitOfWork();
        $unitOfWork->initializeObject($entityInstance);
        $originalData = $unitOfWork->getOriginalEntityData($entityInstance);

        $oldStatus = $originalData['status'] ?? null;
        $newStatus = $entityInstance->getStatus();

        parent::updateEntity($entityManager, $entityInstance);

        if ($oldStatus !== $newStatus) {
            $this->createNotification($entityManager, $entityInstance, $newStatus);
        }
    }

    /**
     * Fonction qui crée une nouvelle notification.
     *
     * @param EntityManagerInterface $entityManager
     * @param BOOKING $booking
     * @param BookingStatus $newStatus
     * @return void
     */
    private function createNotification(EntityManagerInterface $entityManager, BOOKING $booking, BookingStatus $newStatus): void
    {
        $notification = new NOTIFICATION();
        $notification->setBookingId($booking);

        switch ($newStatus) {
            case BookingStatus::Pending:
                $notification->setTitle('Réservation en attente');
                $notification->setContent('Votre réservation est en attente de confirmation.');
                $notification->setLabel('info');
                break;
            case BookingStatus::Booked:
                $notification->setTitle('Réservation confirmée');
                $notification->setContent('Votre réservation a été confirmée. Vous pouvez dès à présent passé au paiement de la facture.');
                $notification->setLabel('success');
                break;
            case BookingStatus::Cancelled:
                $notification->setTitle('Réservation annulée');
                $notification->setContent('Votre réservation a été annulée.');
                $notification->setLabel('danger');
                break;
            case BookingStatus::Declined:
                $notification->setTitle('Réservation refusée');
                $notification->setContent('Votre réservation a été refusée.');
                $notification->setLabel('warning');
                break;
            case BookingStatus::Completed:
                $notification->setTitle('Réservation terminée');
                $notification->setContent('Votre séjour est terminé. Nous espérons que vous avez passé un bon moment.');
                $notification->setLabel('info');
                break;
        }

        $entityManager->persist($notification);
        $entityManager->flush();
    }
    
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
