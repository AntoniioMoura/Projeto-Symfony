<?php

namespace AppBundle\Form;

use AppBundle\Entity\Pizza;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PizzaForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nome')
            ->add('Ingredientes',TextareaType::class)
            ->add('Valor');


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_pizza_form';
    }
}
