<?php

namespace Core\TicketsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('gender')
            ->add('country')
            ->add('descr')
            ->add('page')
            ->add('www')
            ->add('youtube')
            ->add('image')
        ;
    }

    public function getName()
    {
        return 'core_ticketsbundle_artisttype';
    }
}
