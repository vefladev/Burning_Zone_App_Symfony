<?php

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture {

    private $passwordEncoder;

    const USER = 'user-1';
    const USER_2 = 'user-2';
    const USER_3 = 'user-3';

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager) {

        $user = new User();

        $user->setPassword($this->passwordEncoder->encodePassword(
                                $user,
                                '123'
                ))
                ->setEmail('coach@me.com')
                ->setPrenom('flavien')
                ->setNom('wils')
                ->setDateDeNaissance(new \DateTime(['format' => 'dd/MM/yyyy','31/01/1993']))
                ->setRoles(['ROLE_COACH'])
                ->setImageName('ROLE_ADMIN')
                ->setCreatedAt(new \DateTime())

        ;
        $manager->persist($user);

        $user2 = new User();

        $user2->setPassword($this->passwordEncoder->encodePassword(
                                $user2,
                                '123'
                ))
                ->setEmail('admin@me.com')
                ->setPrenom('manon')
                ->setNom('roux')
                ->setDateDeNaissance(new \DateTime(['format' => 'dd/MM/yyyy','31/01/1994']))
                ->setRoles(['ROLE_ADMIN'])
                ->setImageName('ROLE_ADMIN')
                ->setCreatedAt(new \DateTime())

        ;
        $manager->persist($user2);


        $user3 = new User();

        $user3->setPassword($this->passwordEncoder->encodePassword(
                                $user3,
                                '123'
                ))
                ->setEmail('user@me.com')
                ->setPrenom('laura')
                ->setNom('verre')
                ->setDateDeNaissance(new \DateTime(['format' => 'dd/MM/yyyy','31/01/1992']))
                ->setRoles(['ROLE_USER'])
                ->setImageName('ROLE_ADMIN')
                ->setCreatedAt(new \DateTime())

        ;
        $manager->persist($user3);



        $manager->flush();

        $this->addReference(self::USER, $user);
        $this->addReference(self::USER_2, $user2);
        $this->addReference(self::USER_3, $user3);

    }

}
