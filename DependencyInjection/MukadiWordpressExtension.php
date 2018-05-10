<?php
/*
 * This file is part of the Ekino Wordpress package.
 *
 * (c) 2013 Ekino
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mukadi\WordpressBundle\DependencyInjection;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class EkinoWordpressExtension.
 *
 * This is the bundle Symfony extension class
 *
 * @author Vincent Composieux <composieux@ekino.com>
 * @author Olivier M. Mukadi <mbo2olivier@gmail.com>
 */
class MukadiWordpressExtension extends Extension
{
    /**
     * @var array
     */
    protected static $entities = [
        'comment',
        'comment_meta',
        'link',
        'option',
        'post',
        'post_meta',
        'term',
        'term_relationships',
        'term_taxonomy',
        'user',
        'user_meta',
    ];

    /**
     * Loads configuration.
     *
     * @param array            $configs   A configuration array
     * @param ContainerBuilder $container Symfony container builder
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->setParameter('mukadi_wordpress.install_directory', $config['wordpress_directory'] ?: $container->getParameter('kernel.project_dir').'/public/');
        $this->loadWordpressGlobals($container, $config['globals']);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('manager.xml');
        $loader->load('services.xml');

        $container->setParameter('mukadi_wordpress.repositories', $config['services']);
        $this->loadEntities($container, $config['services']);
        $this->loadManagers($container, $config['services']);

        if (isset($config['table_prefix'])) {
            $this->loadTablePrefix($container, $config['table_prefix']);
        }

        if (isset($config['entity_manager'])) {
            $this->loadEntityManager($container, $config['entity_manager']);
        }

        $container->setParameter($this->getAlias().'.backend_type_orm', true);
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     */
    protected function loadEntities(ContainerBuilder $container, $config)
    {
        foreach (static::$entities as $entityName) {
            $container->setParameter(sprintf('mukadi_wordpress.entity.%s.class', $entityName), $config[$entityName]['class']);
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     */
    protected function loadManagers(ContainerBuilder $container, $config)
    {
        foreach (static::$entities as $entityName) {
            $container->setAlias(sprintf('mukadi_wordpress.manager.%s', $entityName), $config[$entityName]['manager']);
        }
    }

    /**
     * Loads table prefix from configuration to doctrine table prefix subscriber event.
     *
     * @param ContainerBuilder $container Symfony dependency injection container
     * @param string           $prefix    Wordpress table prefix
     */
    protected function loadTablePrefix(ContainerBuilder $container, $prefix)
    {
        $identifier = 'mukadi_wordpress.subscriber.table_prefix_subscriber';

        $serviceDefinition = $container->getDefinition($identifier);
        $serviceDefinition->setArguments([$prefix]);

        $container->setDefinition($identifier, $serviceDefinition);
    }

    /**
     * Sets Doctrine entity manager for Wordpress.
     *
     * @param ContainerBuilder       $container
     * @param EntityManagerInterface $em
     */
    protected function loadEntityManager(ContainerBuilder $container, $em)
    {
        $reference = new Reference(sprintf('doctrine.orm.%s_entity_manager', $em));

        foreach (static::$entities as $entityName) {
            $container->findDefinition(sprintf('mukadi_wordpress.manager.%s', $entityName))->replaceArgument(0, $reference);
        }
    }

    /**
     * Sets global variables array to load.
     *
     * @param ContainerBuilder $container
     * @param array            $globals
     */
    protected function loadWordpressGlobals(ContainerBuilder $container, $globals)
    {
        $coreGlobals = ['wp', 'wp_the_query', 'wpdb', 'wp_query', 'allowedentitynames'];
        $globals = array_merge($globals, $coreGlobals);

        $container->setParameter('mukadi_wordpress.globals', $globals);
    }

    /**
     * Returns bundle alias name.
     *
     * @return string
     */
    public function getAlias()
    {
        return 'mukadi_wordpress';
    }
}
