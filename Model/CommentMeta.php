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
 * Class CommentMeta.
 *
 * This is the CommentMeta entity
 *
 * @author Vincent Composieux <composieux@ekino.com>
 * @author Olivier M. Mukadi <mbo2olivier@gmail.com>
 */
abstract class CommentMeta implements WordpressEntityInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var integer
     */
    protected $commentId;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $value;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $commentId
     *
     * @return CommentMeta
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @param string $key
     *
     * @return CommentMeta
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $value
     *
     * @return CommentMeta
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
