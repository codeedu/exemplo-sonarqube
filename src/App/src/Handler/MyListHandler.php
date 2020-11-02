<?php
declare(strict_types = 1);

namespace App\Handler;

use Domain\MyList\Entity;
use Domain\MyList\ListItem;
use Domain\MyList\Movie;
use Domain\MyList\MyList;
use Domain\Product\Product;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class MyListHandler implements RequestHandlerInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

//        $myList = new MyList(new Entity(), 1);
//        $listItem = new ListItem(new Entity(), new Movie(new Entity(), "hello"));
//
////        $myList->addToList($listItem);
//////        print_r($myList->listItems());
////        $this->entityManager->persist($myList);
////        $this->entityManager->flush();
//
//        $repository = $this->entityManager->getRepository(MyList::class);
//        $myList = $repository->findAll();
////        print_r($myList[0]->listItems()[0]->id());die;
//
//        $listItem = $myList[0]->listItems()[0];
//        $myList = $myList[0];
//        $myList->removeFromList($listItem);
//        $this->entityManager->flush();
//        print_r($myList->listItems());die;


        $movie = new Movie(new Entity(), "");
        echo $movie->getId();die;

//        return new JsonResponse($myList);
    }
}