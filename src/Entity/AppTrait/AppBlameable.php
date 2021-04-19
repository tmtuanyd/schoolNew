<?php
namespace App\Entity\AppTrait;

use App\Entity\User;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation as Serializer;

trait AppBlameable
{
    /**
     * @var User/null $createdBy
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="app_created_by_id", referencedColumnName="user_id", onDelete="SET NULL")
     * @Gedmo\Blameable(on="create")
     * @Serializer\MaxDepth(1)
     */
    protected $createdBy;
    /**
     * @var User/null $updatedBy
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="app_updated_by_id", referencedColumnName="user_id", onDelete="SET NULL")
     * @Gedmo\Blameable(on="update")
     * @Serializer\MaxDepth(1)
     */
    protected $updatedBy;

    /**
     * @return User
     */
    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    /**
     * @param User $createdBy
     */
    public function setCreatedBy(User $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return User
     */
    public function getUpdatedBy(): User
    {
        return $this->updatedBy;
    }

    /**
     * @param User $updatedBy
     */
    public function setUpdatedBy(User $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }
}
