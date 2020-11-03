<?php
namespace App\Handler;

use Doctrine\ORM\EntityManager;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Container\ContainerInterface;

class MyListFactory
{
    public function __invoke(ContainerInterface $container) : RequestHandlerInterface
    {
        $em = $container->get(EntityManager::class);
        return new MyListHandler($em);
    }
    
}