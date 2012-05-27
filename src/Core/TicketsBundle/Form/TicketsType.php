<?php

namespace Core\TicketsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TicketsType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('price')
            ->add('programmations')
        ;
    }

    public function getName()
    {
        return 'core_ticketsbundle_ticketstype';
    }
}
