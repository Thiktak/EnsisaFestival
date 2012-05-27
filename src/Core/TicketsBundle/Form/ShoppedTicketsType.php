<?php

namespace Core\TicketsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ShoppedTicketsType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('tickets')
        ;
    }

    public function getName()
    {
        return 'core_ticketsbundle_shoppedticketstype';
    }
}
