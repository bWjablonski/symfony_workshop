<?php

namespace App\Form;

use App\Entity\Insurance;
use App\Entity\InsuranceTypeEnum;
use App\Entity\Tool;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsuranceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('endDate')
            ->add('type', EnumType::class, ['class' => InsuranceTypeEnum::class])
            ->add('name')
            ->add('description')
            ->add('tool')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Insurance::class,
        ]);
    }
}
