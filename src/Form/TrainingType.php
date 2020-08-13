<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Training;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\EventDispatcher\DependencyInjection\AddEventAliasesPass;

class TrainingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'label' => 'Nom du cours :' ,
            ])
            ->add('startedAt', DateTimeType::class, [
                'label' => 'Débute à :', 
                // 'dateTime' => 'now'
                // 'format' => 'dd/MM/yyyy',
            ])
            ->add('endedAt', DateTimeType::class, [
                'label' => 'Fini à :',
            ])
           ->add('coach', EntityType::class, [ 
               'class' => User::class,
               'query_builder' => function (UserRepository $repo) {
                return $repo->createQueryBuilder('u')
                ->orderBy('u.roles', 'ASC')
                ->where('u.roles LIKE :role')
                ->setParameter('role', '%"'.'ROLE_COACH'.'"%');
                },
                'choice_label' => 'Prenom',
            ])
            ->add('userNom', EntityType::class, [ 
                'label' => 'Adhérent',
                'class' => User::class,
                'choice_label' => 'Nom',
             ])
          
            
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Training::class,
        ]);
    }
}
