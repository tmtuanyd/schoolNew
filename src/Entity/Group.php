<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\AppTrait\AppBlameable;
use App\Entity\AppTrait\AppTimestampable;
use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 * @ORM\DiscriminatorMap({
 *     "student" = "GroupStudent",
 *     "admin" = "GroupAdmin",
 *     "parent" = "GroupParent",
 *     "superRoot" = "GroupSuperRoot",
 *     "superAdmin" = "GroupSuperAdmin",
 *     "teacher" = "GroupTeacher"
 *     })
 */
abstract class Group
{
    use AppBlameable;
    use AppTimestampable;

    const GROUP_STUDENT = 'student';
    const GROUP_ADMIN = 'admin';
    const GROUP_PARENT = 'parent';
    const GROUP_SUPER_ROOT = 'super_root';
    const GROUP_SUPER_ADMIN = 'super_admin';
    const GROUP_TEACHER = 'teacher';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="grp_id")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="groups")
     *  @ORM\JoinTable(name="user_group",
     *     joinColumns={@ORM\JoinColumn(name="grp_id", referencedColumnName="grp_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="use_id", referencedColumnName="use_id")}
     * )
     */
    private $users;

    /**
     * @ORM\Column(type="array", nullable=true, name="grp_roles")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="grp_name")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="grp_code")
     */
    private $code;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
