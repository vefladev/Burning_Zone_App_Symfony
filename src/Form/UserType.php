<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {     
         $builder
                ->add('email')
                ->add('prenom',  TextType::class)
                ->add('nom', TextType::class)
                ->add('imageFile',VichImageType::class,['required'=>true])
                ->add('roles', ChoiceType::class, [
                    'choices' => [
                        'Adherent' => 'ROLE_USER',
                        'Coach' => 'ROLE_COACH',
                        'Administrateur' => 'ROLE_ADMIN'
                    ],
                    'expanded' => true,
                    'multiple' => true,
                    'label' => 'Rôles' 
                ])
                ->add('DateDeNaissance', BirthdayType::class,[
                    'format' => 'dd/MM/yyyy',
                ])
                ->add('adresse', TextType::class)
                ->add('telephone', TextType::class)
                
                // ->add('plainPassword', PasswordType::class, [
                //     // instead of being set onto the object directly,
                //     // this is read and encoded in the controller
                //     'mapped' => false,
                //     'constraints' => [
                //         new NotBlank([
                //             'message' => 'Please enter a password',
                //         ]),
                //         new Length([
                //             'min' => 6,
                //             'minMessage' => 'Your password should be at least {{ limit }} characters',
                //             // max length allowed by Symfony for security reasons
                //             'max' => 4096,
                //         ]),
                //     ],
                // ])
            ;
        }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
