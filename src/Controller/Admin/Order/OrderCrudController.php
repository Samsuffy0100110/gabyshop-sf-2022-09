<?php

namespace App\Controller\Admin\Order;

use App\Entity\Order\Order;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OrderCrudController extends AbstractCrudController
{
    private $entityManager;
    private $crudUrlGenerator;


    public function __construct(EntityManagerInterface $entityManager, AdminUrlGenerator $crudUrlGenerator)
    {
        $this->entityManager = $entityManager;
        $this->crudUrlGenerator = $crudUrlGenerator;
    }

    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $updatePreparation = Action::new('updatePreparation', 'Prépartion en cours', 'fas fa-box-open')
            ->setCssClass('update-state')
            ->linkToCrudAction('updatePreparation');

        $updateDelivery = Action::new('updateDelivery', 'Livraison en cours', 'fas fa-truck')
            ->setCssClass('update-state')
            ->linkToCrudAction('updateDelivery');

        $updateDelivered = Action::new('updateDelivered', 'Livré', 'fas fa-check')
            ->setCssClass('update-state')
            ->linkToCrudAction('updateDelivered');

        return $actions->add('index', 'detail')
            ->add('detail', $updatePreparation)
            ->add('detail', $updateDelivery)
            ->add('detail', $updateDelivered)
            ->update(Crud::PAGE_INDEX, 'detail', function (Action $action) {
                return $action->setIcon('fa fa-eye')->setLabel('voir')->setCssClass('btn btn-info');
            })
            ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
                return $action->setIcon('fa fa-arrow-left')->setLabel('retour');
            })
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->remove(Crud::PAGE_DETAIL, Action::DELETE)
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_INDEX, Action::DELETE);
    }

    public function updatePreparation(AdminContext $adminContext)
    {
        $order = $adminContext->getEntity()->getInstance();
        if ($order->getState() === 1) {
            $order->setState(2);
            $this->entityManager->flush();

            $this->addFlash('notice', sprintf(
                "<span style='background-color:#32ff7e; 
                color:#000'>La commande <strong>%s</strong> est passée au 
                status \"Préparation en cours\"<span>",
                $order->getReference()
            ));

            // $url = $this->crudUrlGenerator
            // ->setController(OrderCrudController::class)
            // ->setAction(Action::EDIT)
            // ->generateUrl();
            // return $this->redirect($url);

        } elseif ($order->getState() !== 2) {
            $this->addFlash('notice', sprintf(
                "<span style='background-color:#ff3838; 
                color:#000'>La commande <strong>%s</strong> 
                devra avoir le status \"Payée\" afin de pouvoir la passer 
                au status \"Préparation en cours\"<span>",
                $order->getReference()
            ));
        } else {
            $this->addFlash('notice', sprintf(
                "<span style='background-color:#ff3838; 
                color:#000'>La commande <strong>%s</strong> 
                est déjà au status \"Préparation en cours\"<span>",
                $order->getReference()
            ));
        }
        $url = $this->crudUrlGenerator
            ->setController(OrderCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }

    public function updateDelivery(AdminContext $adminContext, MailerInterface $mailer)
    {
        $order = $adminContext->getEntity()->getInstance();
        if ($order->getState() === 2) {
            $order->setState(3);
            $this->entityManager->flush();

            $this->addFlash('notice', sprintf(
                "<span style='background-color:#32ff7e; 
                color:#000'>La commande <strong>%s</strong> est 
                passée au status \"Livraison en cours\"<span>",
                $order->getReference()
            ));
            $email = (new TemplatedEmail())
            ->from(new Address($this->getParameter('mailer_address')))
            ->to($order->getUser()->getEmail())
            ->subject('Votre commande est en cours de livraison')
            ->html($this->renderView('mailer/delivery.html.twig', [
                'order' => $order,
                'address' => $order->getAdress(),
                'shipping' => $order->getShipping(),
            ]));
            $mailer->send($email);
        } elseif ($order->getState() !== 3) {
            $this->addFlash('notice', sprintf(
                "<span style='background-color:#ff3838; 
                color:#000'>La commande <strong>%s</strong> 
                devra avoir le status \"Préparation en cours\" 
                afin de pouvoir la passer au status \"Livraison en cours\"<span>",
                $order->getReference()
            ));
        } else {
            $this->addFlash('notice', sprintf(
                "<span style='background-color:#ff3838; 
                color:#000'>La commande <strong>%s</strong> 
                est au status \"Livraison en cours\"<span>",
                $order->getReference()
            ));
        }
        $url = $this->crudUrlGenerator
            ->setController(OrderCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }

    public function updateDelivered(AdminContext $adminContext, MailerInterface $mailer)
    {
        $order = $adminContext->getEntity()->getInstance();
        if ($order->getState() === 3) {
            $order->setState(4);
            $this->entityManager->flush();

            $this->addFlash('notice', sprintf(
                "<span style='background-color:#32ff7e; 
                color:#000'>La commande <strong>%s</strong> est passée au 
                status \"Livré\"<span>",
                $order->getReference()
            ));
            $email = (new TemplatedEmail())
            ->from(new Address($this->getParameter('mailer_address')))
            ->to($order->getUser()->getEmail())
            ->subject('Votre commande est livrée')
            ->html($this->renderView('mailer/delivered.html.twig', [
                'order' => $order,
                'address' => $order->getAdress(),
                'shipping' => $order->getShipping(),
            ]));
            $mailer->send($email);
        } elseif ($order->getState() !== 4) {
            $this->addFlash('notice', sprintf(
                "<span style='background-color:#ff3838; 
                color:#000'>La commande <strong>%s</strong> 
                devra avoir le status \"Livraison en cours\" afin de pouvoir 
                la passer au status \"Livré\"<span>",
                $order->getReference()
            ));
        } else {
            $this->addFlash('notice', sprintf(
                "<span style='background-color:#ff3838; 
                color:#000'>La commande <strong>%s</strong> 
                est au status \"Livré\"<span>",
                $order->getReference()
            ));
        }
        $url = $this->crudUrlGenerator
            ->setController(OrderCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['id' => 'DESC'])
        ->showEntityActionsInlined();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('reference', 'Référence'),
            DateTimeField::new('createdAt', 'créée le'),
            DateTimeField::new('updatedAt', 'modifiée le'),
            TextField::new('user.fullname', 'Nom Prénom')->hideOnIndex(),
            TextField::new('adress.name', 'Lieu')->hideOnIndex(),
            TextField::new('adress.adresse', 'Adresse de livraison')->hideOnIndex(),
            TextField::new('adress.city', 'Ville')->hideOnIndex(),
            TextField::new('adress.zipCode', 'Code postal')->hideOnIndex(),
            TextField::new('adress.country', 'Pays')->hideOnIndex(),
            TextField::new('user.phone', 'Téléphone')->hideOnIndex(),
            AssociationField::new('user', 'Email')->hideOnIndex(),
            ChoiceField::new('state', 'Etat commande')->setChoices([
                'Non payée' => '0',
                'Payée' => '1',
                'Préparation en cours' => '2',
                'Livraison en cours' => '3',
                'Livré' => '4',
            ]),
            ArrayField::new('orderDetails', 'Produits achetés')->hideOnIndex(),
            ArrayField::new('customs', 'Personnalisation')
                ->addCssClass('fw-bold')
                ->hideOnIndex(),
        ];
    }
}
