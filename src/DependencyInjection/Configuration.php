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

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration.
 *
 * This class generates configuration settings tree
 *
 * @author Vincent Composieux <composieux@ekino.com>
 * @author Olivier M. Mukadi <mbo2olivier@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Builds configuration tree.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder A tree builder instance
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('mukadi_wordpress');
        
        if(method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        }
        else {
            $rootNode = $treeBuilder->root('mukadi_wordpress');
        }
        

        $rootNode
            ->children()
                ->scalarNode('table_prefix')->end()
                ->scalarNode('wordpress_directory')->defaultNull()->end()
                ->scalarNode('entity_manager')->end()

                ->arrayNode('globals')
                    ->prototype('scalar')->defaultValue([])->end()
                ->end()
            ->end();

        $this->addServicesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    protected function addServicesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('services')
                ->addDefaultsIfNotSet()
                ->children()
                    ->arrayNode('comment')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Entity\Comment')->end()
                            ->scalarNode('manager')->cannotBeEmpty()->defaultValue('mukadi_wordpress.manager.comment_default')->end()
                            ->scalarNode('repository_class')->cannotBeEmpty()->defaultValue('Doctrine\ORM\EntityRepository')->end()
                        ->end()
                    ->end()
                    ->arrayNode('comment_meta')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Entity\CommentMeta')->end()
                            ->scalarNode('manager')->cannotBeEmpty()->defaultValue('mukadi_wordpress.manager.comment_meta_default')->end()
                            ->scalarNode('repository_class')->cannotBeEmpty()->defaultValue('Doctrine\ORM\EntityRepository')->end()
                        ->end()
                    ->end()
                    ->arrayNode('link')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Entity\Link')->end()
                            ->scalarNode('manager')->cannotBeEmpty()->defaultValue('mukadi_wordpress.manager.link_default')->end()
                            ->scalarNode('repository_class')->cannotBeEmpty()->defaultValue('Doctrine\ORM\EntityRepository')->end()
                        ->end()
                    ->end()
                    ->arrayNode('option')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Entity\Option')->end()
                            ->scalarNode('manager')->cannotBeEmpty()->defaultValue('mukadi_wordpress.manager.option_default')->end()
                            ->scalarNode('repository_class')->cannotBeEmpty()->defaultValue('Doctrine\ORM\EntityRepository')->end()
                        ->end()
                    ->end()
                    ->arrayNode('post')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Entity\Post')->end()
                            ->scalarNode('manager')->cannotBeEmpty()->defaultValue('mukadi_wordpress.manager.post_default')->end()
                            ->scalarNode('repository_class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Repository\PostRepository')->end()
                        ->end()
                    ->end()
                    ->arrayNode('post_meta')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Entity\PostMeta')->end()
                            ->scalarNode('manager')->cannotBeEmpty()->defaultValue('mukadi_wordpress.manager.post_meta_default')->end()
                            ->scalarNode('repository_class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Repository\PostMetaRepository')->end()
                        ->end()
                    ->end()
                    ->arrayNode('term')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Entity\Term')->end()
                            ->scalarNode('manager')->cannotBeEmpty()->defaultValue('mukadi_wordpress.manager.term_default')->end()
                            ->scalarNode('repository_class')->cannotBeEmpty()->defaultValue('Doctrine\ORM\EntityRepository')->end()
                        ->end()
                    ->end()
                    ->arrayNode('term_relationships')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Entity\TermRelationships')->end()
                            ->scalarNode('manager')->cannotBeEmpty()->defaultValue('mukadi_wordpress.manager.term_relationships_default')->end()
                            ->scalarNode('repository_class')->cannotBeEmpty()->defaultValue('Doctrine\ORM\EntityRepository')->end()
                        ->end()
                    ->end()
                    ->arrayNode('term_taxonomy')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Entity\TermTaxonomy')->end()
                            ->scalarNode('manager')->cannotBeEmpty()->defaultValue('mukadi_wordpress.manager.term_taxonomy_default')->end()
                            ->scalarNode('repository_class')->cannotBeEmpty()->defaultValue('Doctrine\ORM\EntityRepository')->end()
                        ->end()
                    ->end()
                    ->arrayNode('user')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Entity\User')->end()
                            ->scalarNode('manager')->cannotBeEmpty()->defaultValue('mukadi_wordpress.manager.user_default')->end()
                            ->scalarNode('repository_class')->cannotBeEmpty()->defaultValue('Doctrine\ORM\EntityRepository')->end()
                        ->end()
                    ->end()
                    ->arrayNode('user_meta')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->cannotBeEmpty()->defaultValue('Mukadi\WordpressBundle\Entity\UserMeta')->end()
                            ->scalarNode('manager')->cannotBeEmpty()->defaultValue('mukadi_wordpress.manager.user_meta_default')->end()
                            ->scalarNode('repository_class')->cannotBeEmpty()->defaultValue('Doctrine\ORM\EntityRepository')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
