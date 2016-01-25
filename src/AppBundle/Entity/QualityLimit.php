<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QualityLimit
 *
 * @ORM\Table(name="quality_limit")
 * @ORM\Entity
 */
class QualityLimit
{
    /**
     * @var float
     *
     * @ORM\Column(name="high", type="float", precision=10, scale=0, nullable=true)
     */
    private $high;

    /**
     * @var float
     *
     * @ORM\Column(name="low", type="float", precision=10, scale=0, nullable=true)
     */
    private $low;

    /**
     * @var float
     *
     * @ORM\Column(name="delta", type="float", precision=10, scale=0, nullable=true)
     */
    private $delta;

    /**
     * @var string
     *
     * @ORM\Column(name="tablemask", type="string", length=100)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tablemask;



    /**
     * Set high
     *
     * @param float $high
     *
     * @return QualityLimit
     */
    public function setHigh($high)
    {
        $this->high = $high;

        return $this;
    }

    /**
     * Get high
     *
     * @return float
     */
    public function getHigh()
    {
        return $this->high;
    }

    /**
     * Set low
     *
     * @param float $low
     *
     * @return QualityLimit
     */
    public function setLow($low)
    {
        $this->low = $low;

        return $this;
    }

    /**
     * Get low
     *
     * @return float
     */
    public function getLow()
    {
        return $this->low;
    }

    /**
     * Set delta
     *
     * @param float $delta
     *
     * @return QualityLimit
     */
    public function setDelta($delta)
    {
        $this->delta = $delta;

        return $this;
    }

    /**
     * Get delta
     *
     * @return float
     */
    public function getDelta()
    {
        return $this->delta;
    }

    /**
     * Get tablemask
     *
     * @return string
     */
    public function getTablemask()
    {
        return $this->tablemask;
    }
}
