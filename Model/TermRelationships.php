<?php
/*
 * This file is part of the Ekino Wordpress package.
 *
 * (c) 2013 Ekino
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mukadi\WordpressBundle\Model;

/**
 * Class TermRelationships.
 *
 * This is the TermRelationships entity
 *
 * @author Vincent Composieux <composieux@ekino.com>
 * @author Olivier M. Mukadi <mbo2olivier@gmail.com>
 */
abstract class TermRelationships implements WordpressEntityInterface
{
    /**
     * @var int
     */
    protected $taxonomyId;

    /**
     * @var int
     */
    protected $termOrder;

    /**
     * @var int
     */
    protected $postId;

    /**
     * @param int $postId
     *
     * @return TermRelationships
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * @return int
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param int $termOrder
     *
     * @return TermRelationships
     */
    public function setTermOrder($termOrder)
    {
        $this->termOrder = $termOrder;

        return $this;
    }

    /**
     * @return int
     */
    public function getTermOrder()
    {
        return $this->termOrder;
    }

    /**
     * @param int $taxonomyId
     *
     * @return TermRelationships
     */
    public function setTaxonomyId($taxonomyId)
    {
        $this->taxonomyId = $taxonomyId;

        return $this;
    }

    /**
     * @return int
     */
    public function getTaxonomyId()
    {
        return $this->taxonomyId;
    }
}
