<?php

namespace App\Form;

use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('nombreArticleTotal')
            // ->add('reductionCustomer')
            // ->add('prixLivraison')
            // ->add('prixTotal')
            // ->add('modeLivraison')
            // ->add('modePaiement')
            // ->add('dateCommande')
            // ->add('statutCommande')
            // ->add('idAdresseFacture')
            // ->add('idAdresseLivraison')
            // ->add('idClient')
            // ->add('idArticle')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}
