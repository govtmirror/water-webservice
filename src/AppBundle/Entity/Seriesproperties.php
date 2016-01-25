<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seriesproperties
 *
 * @ORM\Table(name="seriesproperties", uniqueConstraints={@ORM\UniqueConstraint(name="idx1", columns={"seriesid", "name"})})
 * @ORM\Entity
 */
class Seriesproperties
{
    /**
     * @var integer
     *
     * @ORM\Column(name="seriesid", type="integer", nullable=false)
     */
    private $seriesid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=10, nullable=false)
     */
    private $value = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set seriesid
     *
     * @param integer $seriesid
     *
     * @return Seriesproperties
     */
    public function setSeriesid($seriesid)
    {
        $this->seriesid = $seriesid;

        return $this;
    }

    /**
     * Get seriesid
     *
     * @return integer
     */
    public function getSeriesid()
    {
        return $this->seriesid;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Seriesproperties
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Seriesproperties
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
