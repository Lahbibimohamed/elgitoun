<?php

namespace App\Form;

use App\Entity\PublicationEquipement;
use Symfony\Component\Form\AbstractType;
use App\Entity\TypePublication;
use App\Entity\User;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class EchangematerielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('price')
            ->add('user')
            ->add('typepublication',EntityType::class,[
                "class"=>TypePublication::class,
                "choice_label"=>"name"
            ])
            ->add('user',EntityType::class,[
                "class"=>User::class,
                "choice_label"=>"id"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PublicationEquipement::class,
        ]);
    }
}
