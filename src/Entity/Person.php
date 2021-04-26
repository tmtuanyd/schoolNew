<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\AppTrait\AppBlameable;
use App\Entity\AppTrait\AppSoftDeleteable;
use App\Entity\AppTrait\AppTimestampable;
use App\Entity\Tree\Tree;
use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @Gedmo\Tree(type="nested")
 * @ApiResource()
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
{
    use AppBlameable;
    use AppTimestampable;
    use AppSoftDeleteable;
    use Tree;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer",  name="prs_id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="prs_first_name")
     */
    private $firstName;

    /**
     * @return mixed
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param mixed $root
     */
    public function setRoot($root): void
    {
        $this->root = $root;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param mixed $children
     */
    public function setChildren($children): void
    {
        $this->children = $children;
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="prs_last_name")
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer", nullable=true, name="prs_gender", options={"command":""})
     */
    private $gender;

    /**
     * @ORM\Column(type="date", nullable=true, name="prs_date_of_birth")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="prs_email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="prs_phone_number")
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="json", nullable=true, name="prs_other_infos", options={"default"="{}"})
     */
    private $otherInfos = [];

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="person", cascade={"persist", "remove"})
     */
    private $appUser;

    /**
     * @Gedmo\TreeRoot()
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(name="prs_tree_root", referencedColumnName="prs_id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @Gedmo\TreeParent()
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="children")
     * @ORM\JoinColumn(name="prs_parent_id", referencedColumnName="prs_id", onDelete="SET NULL", nullable=true)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Person", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGender(): ?int
    {
        return $this->gender;
    }

    public function setGender(?int $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getDateOfBirth(): ?string
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?string $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getOtherInfos(): ?array
    {
        return $this->otherInfos;
    }

    public function setOtherInfos(?array $otherInfos): self
    {
        $this->otherInfos = $otherInfos;

        return $this;
    }

    public function getAppUser(): ?User
    {
        return $this->appUser;
    }

    public function setAppUser(?User $appUser): self
    {
        $this->appUser = $appUser;

        return $this;
    }
}
