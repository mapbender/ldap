<?php

namespace FOM\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function getName()
    {
        return 'user';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'label' => 'Username'))
            ->add('email', 'email', array(
                'label' => 'E-Mail'))
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'required' => $options['requirePassword'],
                'options' => array(
                    'label' => 'Password')));

        //if($options['extendedEdit']) {
            $builder
                ->add('roleObjects', 'entity', array(
                    'class' =>  'FOMUserBundle:Role',
                    'query_builder' => function(EntityRepository $er) {
                        $qb = $er->createQueryBuilder('r')
                            ->add('where', "r.override <> 'IS_AUTHENTICATED_FULLY'")
                            ->add('orderBy', 'r.title ASC');
                        return $qb;
                    },
                    'expanded' => true,
                    'multiple' => true,
                    'property' => 'title',
                    'label' => 'Roles'));
        //}

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'requirePassword' => true,
            'extendedEdit' => false
        ));
    }
}

