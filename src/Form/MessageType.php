<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject', TextType::class, [
               'attr' => ['class' => 'cForm__subject mF pF bR fFS', 'placeholder'=>'Subject'],
                'label'=> false,
                'required' => true,
            ])
            ->add('sender', EmailType::class, [
                'attr' => ['class' => 'cForm__sender mF pF bR fFS', 'placeholder'=>'Sender'],
                'label'=> false,
                'required' => true,
            ])
            ->add('content', TextAreaType::class, [
                'attr' => ['class' => 'cForm__content mF pF bR', 'placeholder'=>'Your message',
                    'maxlength'=>4000, 'rows'=>10, 'cols'=>40],
                'label'=> false,
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class'=>'cForm__submit mF pF bR fFS'],
                'label' => 'SEND',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
