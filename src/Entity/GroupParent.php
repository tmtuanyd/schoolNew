<?php

namespace App\Entity;

use App\Repository\GroupAdminRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=GroupAdminRepository::class)
 * @ApiResource()
 */
class GroupParent extends Group
{
}
