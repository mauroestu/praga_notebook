<?php
// src/DataFixtures/AppFixtures.php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Type;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TypeFixtures implements FixtureInterface
{

    /**
    * Load function which enters the types of notes to the table Tipo
    *
    * @author Mauricio Estuardo Batres Montejo
    *
    * @param ObjectManager  $manager Symfony ORM manager.
    *
    * @return nothing
    *
    */
    public function load(ObjectManager $manager)
    {

        $NoteBookTypes = array(
          Type::CONST_MENTAL_NOTE => 'Notas mentales',
          Type::CONST_ENTERTAINMENT_NOTE => 'Notas de entretenimiento',
          Type::CONST_ACADEMIC_NOTE => 'Notas académicas'
        );

        foreach ($NoteBookTypes as $id => $name) {
            $Type = new Type();
            $Type->setId($id);
            $Type->setName($name);
            $Type->setEnabled(true);
            $manager->persist($Type);
        }

        $manager->flush();
    }
}
