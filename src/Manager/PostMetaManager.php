<?php
/*
 * This file is part of the Ekino Wordpress package.
 *
 * (c) 2013 Ekino
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mukadi\WordpressBundle\Manager;

use Doctrine\ORM\EntityManager;
use Mukadi\WordpressBundle\Model\Post;
use Mukadi\WordpressBundle\Model\PostMeta;
use Mukadi\WordpressBundle\Repository\PostMetaRepository;
use Mukadi\Doctrine\CRUD\CRUD as BaseManager;

/**
 * Class PostMetaManager.
 *
 * This is the PostMeta entity manager
 *
 * @author Vincent Composieux <composieux@ekino.com>
 * @author Olivier M. Mukadi <mbo2olivier@gmail.com>
 */
class PostMetaManager extends BaseManager
{
    /**
     * @var PostMetaRepository
     */
    protected $repository;

    /**
     * @param EntityManager   $em
     * @param string          $class
     */
    public function __construct(EntityManager $em, $class)
    {
        parent::__construct($em, $class);
        $this->repository = $em->getRepository($this->class);
    }

    /**
     * @param int    $postId         A post identifier
     * @param string $metaName       A meta name
     * @param bool   $fetchOneResult Use fetchOneOrNullResult() method instead of getResult()?
     *
     * @return array|PostMeta
     */
    public function getPostMeta($postId, $metaName, $fetchOneResult = false)
    {
        $query = $this->repository->getPostMetaQuery($postId, $metaName);

        return $fetchOneResult ? $query->getOneOrNullResult() : $query->getResult();
    }

    /**
     * @param Post $post
     *
     * @return PostMeta|null
     */
    public function getThumbnailPostId(Post $post)
    {
        return $this->getPostMeta($post->getId(), '_thumbnail_id', true);
    }
}
