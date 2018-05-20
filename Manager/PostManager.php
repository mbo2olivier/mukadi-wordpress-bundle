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
use Mukadi\WordpressBundle\Repository\PostRepository;
use Hautelook\Phpass\PasswordHash;
use Symfony\Component\HttpFoundation\Request;
use Mukadi\Doctrine\CRUD\CRUD as BaseManager;

/**
 * Class PostManager.
 *
 * This is the Post entity manager
 *
 * @author Vincent Composieux <composieux@ekino.com>
 * @author Olivier M. Mukadi <mbo2olivier@gmail.com>
 */
class PostManager extends BaseManager
{
    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * @var PostMetaManager
     */
    protected $postMetaManager;

    /**
     * @param EntityManager   $em
     * @param string          $class
     * @param PostMetaManager $postMetaManager
     */
    public function __construct(EntityManager $em, $class, PostMetaManager $postMetaManager)
    {
        parent::__construct($em, $class);
        $this->repository = $em->getRepository($this->class);
        $this->postMetaManager = $postMetaManager;
    }

    /**
     * @param Post $post
     *
     * @return bool
     */
    public function isCommentingOpened(Post $post)
    {
        return Post::COMMENT_STATUS_OPEN == $post->getCommentStatus();
    }

    /**
     * @param Post $post
     *
     * @return bool
     */
    public function hasComments(Post $post)
    {
        return 0 < $post->getCommentCount();
    }

    /**
     * @param Post    $post
     * @param Request $request
     * @param string  $cookieHash
     *
     * @return bool
     */
    public function isPasswordRequired(Post $post, Request $request, $cookieHash)
    {
        if (!$post->getPassword()) {
            return false;
        }

        $cookies = $request->cookies;

        if (!$cookies->has('wp-postpass_'.$cookieHash)) {
            return true;
        }

        $hash = stripslashes($cookies->get('wp-postpass_'.$cookieHash));

        if (0 !== strpos($hash, '$P$B')) {
            return true;
        }

        $wpHasher = new PasswordHash(8, true);

        return !$wpHasher->CheckPassword($post->getPassword(), $hash);
    }

    /**
     * @param Post $post
     *
     * @return string
     */
    public function getThumbnailPath(Post $post)
    {
        if (!$thumbnailPostMeta = $this->postMetaManager->getThumbnailPostId($post)) {
            return '';
        }

        /** @var $post Post */
        if (!$post = $this->get($thumbnailPostMeta->getValue())) {
            return '';
        }

        return $post->getGuid();
    }

    /**
     * Returns posts for current date or a specified date.
     *
     * @param \DateTime|null $date
     *
     * @return array
     */
    public function findByDate(\DateTime $date = null)
    {
        $date = $date ?: new \DateTime();

        return $this->repository->findByDate($date);
    }
}
