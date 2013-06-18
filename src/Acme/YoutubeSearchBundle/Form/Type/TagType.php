<?php

namespace Acme\YoutubeSearchBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name','text');
        $builder->add('save', 'submit');
    }

    public function getName()
    {
        return 'tag';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\YoutubeSearchBundle\Entity\Tag',
        ));
    }

}
