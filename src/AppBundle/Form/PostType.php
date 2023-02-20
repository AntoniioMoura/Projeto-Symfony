<?php

namespace AppBundle\Form;

use AppBundle\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nome')
            ->add('endereco',TextareaType::class)
            ->add('email')
            ->add('telefone')
            ->add('password',PasswordType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => Post::class
        ]);
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_post_type';
    }
}
