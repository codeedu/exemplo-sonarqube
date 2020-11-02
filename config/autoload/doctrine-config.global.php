<?php
use Zend\Stdlib\ArrayUtils;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Component\Console\Helper\QuestionHelper;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
$vendorPath = __DIR__ . '/../../vendor';
$doctrineModuleConfig = [];
$provider = new \DoctrineModule\ConfigProvider();
$doctrineModuleConfig['dependencies'] = $provider->getDependencyConfig();
unset($doctrineModuleConfig['service_manager']);
unset($doctrineModuleConfig['dependencies']['factories']['doctrine.cli']);
$doctrineModuleConfig['dependencies']['factories']['doctrine.cli'] = function(\Interop\Container\ContainerInterface $container){
    $cli = new Application;
    $cli->setName('DoctrineModule Command Line Interface');
    $cli->setVersion('2.1.0');
    $cli->setHelperSet(new HelperSet);
    $cli->setCatchExceptions(true);
    $cli->setAutoExit(false);
    $commands = array(
        'doctrine.dbal_cmd.runsql',
        'doctrine.dbal_cmd.import',
        'doctrine.orm_cmd.clear_cache_metadata',
        'doctrine.orm_cmd.clear_cache_result',
        'doctrine.orm_cmd.clear_cache_query',
        'doctrine.orm_cmd.schema_tool_create',
        'doctrine.orm_cmd.schema_tool_update',
        'doctrine.orm_cmd.schema_tool_drop',
        'doctrine.orm_cmd.ensure_production_settings',
        'doctrine.orm_cmd.convert_d1_schema',
        'doctrine.orm_cmd.generate_repositories',
        'doctrine.orm_cmd.generate_entities',
        'doctrine.orm_cmd.generate_proxies',
        'doctrine.orm_cmd.convert_mapping',
        'doctrine.orm_cmd.run_dql',
        'doctrine.orm_cmd.validate_schema',
        'doctrine.orm_cmd.info',
    );
    if (class_exists('Doctrine\\DBAL\\Migrations\\Version')) {
        $commands = ArrayUtils::merge(
            $commands,
            array(
                'doctrine.migrations_cmd.execute',
                'doctrine.migrations_cmd.generate',
                'doctrine.migrations_cmd.migrate',
                'doctrine.migrations_cmd.status',
                'doctrine.migrations_cmd.version',
                'doctrine.migrations_cmd.diff',
                'doctrine.migrations_cmd.latest',
            )
        );
    }
    $cli->addCommands(array_map(array($container, 'get'), $commands));
    /* @var $entityManager \Doctrine\ORM\EntityManager */
    $entityManager = $container->get('doctrine.entitymanager.orm_default');
    $helperSet     = $cli->getHelperSet();
    if (class_exists('Symfony\Component\Console\Helper\QuestionHelper')) {
        $helperSet->set(new QuestionHelper(), 'dialog');
    } else {
        $helperSet->set(new DialogHelper(), 'dialog');
    }
    $helperSet->set(new ConnectionHelper($entityManager->getConnection()), 'db');
    $helperSet->set(new EntityManagerHelper($entityManager), 'em');
    return $cli;
};


$doctrineOrmModuleConfig = include($vendorPath . '/doctrine/doctrine-orm-module/config/module.config.php');
$doctrineOrmModuleConfig['dependencies'] = $doctrineOrmModuleConfig['service_manager'];
unset($doctrineOrmModuleConfig['service_manager']);
return ArrayUtils::merge($doctrineModuleConfig, $doctrineOrmModuleConfig);