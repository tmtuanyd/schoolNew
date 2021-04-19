<?php


namespace App\Entity\AppTrait;


trait AppTimestampable
{
    /**
     * @var \DateTime $created
     * @Gedmo\Timestampable(on="create")
     * @Groups({"api"})
     * @ORM\Column(name="app_created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @var \DateTime  $updated
     * @Gedmo\Timestampable(on="update")
     * @Groups({"api"})
     * @ORM\Column(name="app_updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;
}
