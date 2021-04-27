<?php

namespace App\DataFixtures;

use App\Entity\Group;
use App\Entity\GroupSuperRoot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GroupFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $group1 = new GroupSuperRoot();
        $group1->setName('group super root')
            ->setCode(Group::GROUP_SUPER_ROOT)
    }
}
