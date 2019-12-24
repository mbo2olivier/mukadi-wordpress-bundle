<?php

namespace Mukadi\WordpressBundle\Model;

/**
 * Class TermMeta.
 *
 * This is the TermMeta entity
 *
 * @author Olivier M. Mukadi <mbo2olivier@gmail.com>
 */
abstract class TermMeta implements WordpressEntityInterface
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
     * @param string $key
     *
     * @return TermMeta
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
     * @param int $termId
     *
     * @return TermMeta
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

    /**
     * @param string $value
     *
     * @return TermMeta
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
