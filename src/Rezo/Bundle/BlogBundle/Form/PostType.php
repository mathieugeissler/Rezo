<?php

namespace Rezo\Bundle\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('format', 'choice', array(
                'choices' => array(
                    'Default' => 'Default',
                    'Link' => 'Link',
                    'Gallery' => 'Gallery',
                    'Movie' => 'Movie',
                ),
                'required' => true,
                'choices_as_values' => true,
            ))
            ->add('published', 'checkbox', array(
                'required' => false,
            ))
            ->add('categories', 'entity', array(
                'class' => 'Rezo\Bundle\BlogBundle\Entity\Category',
                'multiple' => true,
                'required' => false,
                'expanded' => true,
                'choice_label' => 'name',
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rezo\Bundle\BlogBundle\Entity\Post',
            'attr' => ['id' => 'PostType']
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rezo_bundle_blogbundle_post';
    }
}
