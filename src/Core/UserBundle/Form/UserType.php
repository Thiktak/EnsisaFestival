<?php

namespace Core\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('locked')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
        ;
    }

    public function getName()
    {
        return 'core_userbundle_usertype';
    }
}
