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

    const ROLE_SUPER_ROOT = 'ROLE_SUPER_ROOT';

    // Group Module
    const ROLE_ROLE_GROUP_ROLE_VIEW_LIST = 'ROLE_ROLE_GROUP_ROLE_VIEW_LIST';
    const ROLE_ROLE_GROUP_ROLE_CREATE = 'ROLE_ROLE_GROUP_ROLE_CREATE';
    const ROLE_ROLE_GROUP_ROLE_EDIT = 'ROLE_ROLE_GROUP_ROLE_EDIT';
    const ROLE_ROLE_USER_ROLE_MANAGE = 'ROLE_ROLE_USER_ROLE_MANAGE';

    // User Module
    const ROLE_USER_MANAGE = 'ROLE_USER_MANAGE';
    const ROLE_USER_CREATE = 'ROLE_USER_CREATE';
    const ROLE_USER_EDIT = 'ROLE_USER_EDIT';
    const ROLE_USER_DELETE = 'ROLE_USER_DELETE';

    // MailType Module
    const ROLE_MAIL_TYPE_MANAGE = 'ROLE_MAIL_TYPE_MANAGE';
    const ROLE_MAIL_TYPE_CREATE = 'ROLE_MAIL_TYPE_CREATE';
    const ROLE_MAIL_TYPE_EDIT = 'ROLE_MAIL_TYPE_EDIT';
    const ROLE_MAIL_TYPE_DELETE = 'ROLE_MAIL_TYPE_DELETE';


    // DocumentType Module
    const ROLE_DOCUMENT_TYPE_MANAGE = 'ROLE_DOCUMENT_TYPE_MANAGE';
    const ROLE_DOCUMENT_TYPE_CREATE = 'ROLE_DOCUMENT_TYPE_CREATE';
    const ROLE_DOCUMENT_TYPE_EDIT = 'ROLE_DOCUMENT_TYPE_EDIT';
    const ROLE_DOCUMENT_TYPE_DELETE = 'ROLE_DOCUMENT_TYPE_DELETE';

    // Class Module
    const ROLE_CLASS_MANAGE = 'ROLE_CLASS_MANAGE';
    const ROLE_CLASS_CREATE = 'ROLE_CLASS_CREATE';
    const ROLE_CLASS_EDIT = 'ROLE_CLASS_EDIT';
    const ROLE_CLASS_DELETE = 'ROLE_CLASS_DELETE';

    // Establishment Module
    const ROLE_ESTABLISHMENT_MANAGE = 'ROLE_ESTABLISHMENT_MANAGE';
    const ROLE_ESTABLISHMENT_CREATE = 'ROLE_ESTABLISHMENT_CREATE';
    const ROLE_ESTABLISHMENT_EDIT = 'ROLE_ESTABLISHMENT_EDIT';
    const ROLE_ESTABLISHMENT_DELETE = 'ROLE_ESTABLISHMENT_DELETE';

    // Admission Module
    const ROLE_ADMISSION_MANAGE = 'ROLE_ADMISSION_MANAGE';
    const ROLE_ADMISSION_CREATE = 'ROLE_ADMISSION_CREATE';
    const ROLE_ADMISSION_EDIT = 'ROLE_ADMISSION_EDIT';
    const ROLE_ADMISSION_DELETE = 'ROLE_ADMISSION_DELETE';

    // Application Module
    const ROLE_APPLICATION_MANAGE = 'ROLE_APPLICATION_MANAGE';
    const ROLE_APPLICATION_CREATE = 'ROLE_APPLICATION_CREATE';
    const ROLE_APPLICATION_EDIT = 'ROLE_APPLICATION_EDIT';
    const ROLE_APPLICATION_DELETE = 'ROLE_APPLICATION_DELETE';

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
