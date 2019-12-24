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
 * Class TermTaxonomy.
 *
 * This is the TermTaxonomy entity
 *
 * @author Vincent Composieux <composieux@ekino.com>
 */
abstract class TermTaxonomy implements WordpressEntityInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $termId;

    /**
     * @var string
     */
    protected $taxonomy;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $parentId;

    /**
     * @var int
     */
    protected $count;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $count
     *
     * @return TermTaxonomy
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param string $description
     *
     * @return TermTaxonomy
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param int $parentId
     *
     * @return TermTaxonomy
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param string $taxonomy
     *
     * @return TermTaxonomy
     */
    public function setTaxonomy($taxonomy)
    {
        $this->taxonomy = $taxonomy;

        return $this;
    }

    /**
     * @return string
     */
    public function getTaxonomy()
    {
        return $this->taxonomy;
    }

    /**
     * @param int $termId
     *
     * @return TermTaxonomy
     */
    public function setTermId($termId)
    {
        $this->termId = $termId;

        return $this;
    }

    /**
     * @return int
     */
    public function getTermId()
    {
        return $this->termId;
    }
}
