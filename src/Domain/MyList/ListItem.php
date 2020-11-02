<?php

namespace Domain\MyList;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class ListItem extends Entity
{

    /**
     * @ORM\Column(type="string", name="movie_id")
     * @var string
     */
    private $movie;

    /**
     * @ORM\ManyToOne(targetEntity="MyList", inversedBy="items")
     */
    private $myList;

    /**
     * @param mixed $myList
     */
    public function myList($myList): void
    {
        $this->myList = $myList;
    }

    /** @ORM\Column(type="datetime", name="created_at") */
    private $createdAt;

    /** @ORM\Column(type="datetime", name="removed_at", nullable=True) */
    private $removedAt;


    public function __construct(Entity $id, Movie $movie)
    {
        $this->id = $id->id();
        $this->movie = $movie->getId();
        $this->createdAt = new \DateTime();
    }

    public function remove(): void
    {
        $this->removedAt = new \DateTime();
    }

    public function wasRemoved(): bool
    {
        if ($this->removedAt) {
            return true;
        }
        return false;
    }

}