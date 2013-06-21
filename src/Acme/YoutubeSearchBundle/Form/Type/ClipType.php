<?php

namespace Acme\YoutubeSearchBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('url','text');
        $builder->add('timeStart', 'integer');
        $builder->add('timeFinish', 'integer');
        $builder->add('tags', 'collection', array(
                'type' => new TagType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            )
        );
        $builder->add('save', 'submit', array('attr' => array('class' => 'btn btn-primary')));
    }

    public function getName()
    {
        return 'clip';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\YoutubeSearchBundle\Entity\Clip',
        ));
    }

}
