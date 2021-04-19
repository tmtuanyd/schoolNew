<?php


namespace App\Entity\AppTrait;

use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

/*
 * TraitRepository AppSoftDeleteable
 * @package App\Entity\AppTrait
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 */
trait AppSoftDeleteable
{
    /**
     * @return \DateTime|null
     */
    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime|null $deletedAt
     */
    public function setDeletedAt(?\DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime", name="app_deleted_at", nullable=true)
     * @Serializer\Groups({"api"})
     * @Gedmo\Versioned()
     */
    protected $deletedAt;
    /**
     * Is deleted?
     *
     * @return bool
     */
    public function isDeleted()
    {
        return null !== $this->deletedAt;
    }
}
