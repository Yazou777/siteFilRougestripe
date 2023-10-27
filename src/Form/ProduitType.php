<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $sousCat = $options['sousCat'];
        $builder
            ->add('pro_nom')
            ->add('pro_prix')
            ->add('pro_image')
            ->add('pro_description')
            ->add('pro_stkphy')
            ->add('pro_stkale')
            ->add('cat', EntityType::class, [
                'class' => Categorie::class,
                'label' => 'Catégorie',
                'required' => true,
                'choices' => $sousCat,
                'multiple' => false,
               // 'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'sousCat'=> [],
            'data_class' => Produit::class,
            
        ]);
    }
}
