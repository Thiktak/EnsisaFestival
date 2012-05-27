<?php

namespace Core\TicketsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProgrammationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('title')
            ->add('stock')
            ->add('artists')
        ;
    }

    public function getName()
    {
        return 'core_ticketsbundle_programmationtype';
    }
}
