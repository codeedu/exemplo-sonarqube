<?php
declare(strict_types=1);

namespace Domain\MyList;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class User extends Entity
{

    public function __construct($id)
    {
        parent::__construct($id);
    }

    /**
     * @return mixed
     */
    public function getId(): string
    {
        return $this->id;
    }
}