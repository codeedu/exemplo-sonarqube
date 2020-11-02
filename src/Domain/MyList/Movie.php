<?php
declare(strict_types = 1);

namespace Domain\MyList;

use Domain\Core\DomainException;
use Respect\Validation\Validator as v;


class Movie extends Entity
{
    private $name;

    public function __construct(Entity $id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->validate();
    }


    public function getName() : string
    {
        return $this->name;
    }

    public function validate() {

        if(!v::NotBlank()->NotEmpty()->validate($this->name)) {
            throw new DomainException("Movie name cannot be blank");
        }
    }
}