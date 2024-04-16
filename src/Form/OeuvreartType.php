<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Oeuvreart;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OeuvreartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('prix')
            ->add('quantite')
            ->add('file')
            ->add('certif')
            ->add('idCat', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'description',
            ]);
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Oeuvreart::class,
        ]);
    }
}
