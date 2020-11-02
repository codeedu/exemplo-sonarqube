<?php

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(function ($className) {
    return class_exists($className);
});