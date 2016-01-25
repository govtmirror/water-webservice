<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seriescatalog
 *
 * @ORM\Table(name="seriescatalog")
 * @ORM\Entity
 */
class Seriescatalog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="parentid", type="integer", nullable=false)
     */
    private $parentid = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="isfolder", type="smallint", nullable=false)
     */
    private $isfolder = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="sortorder", type="integer", nullable=false)
     */
    private $sortorder = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="iconname", type="string", length=100, nullable=false)
     */
    private $iconname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="siteid", type="string", length=2600, nullable=false)
     */
    private $siteid = '';

    /**
     * @var string
     *
     * @ORM\Column(name="units", type="string", length=100, nullable=false)
     */
    private $units = '';

    /**
     * @var string
     *
     * @ORM\Column(name="timeinterval", type="string", length=100, nullable=false)
     */
    private $timeinterval = 'irregular';

    /**
     * @var string
     *
     * @ORM\Column(name="parameter", type="string", length=100, nullable=false)
     */
    private $parameter = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tablename", type="string", length=128, nullable=false)
     */
    private $tablename = '';

    /**
     * @var string
     *
     * @ORM\Column(name="provider", type="string", length=200, nullable=false)
     */
    private $provider = '';

    /**
     * @var string
     *
     * @ORM\Column(name="connectionstring", type="string", length=2600, nullable=false)
     */
    private $connectionstring = '';

    /**
     * @var string
     *
     * @ORM\Column(name="expression", type="string", length=2048, nullable=false)
     */
    private $expression = '';

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=2048, nullable=false)
     */
    private $notes = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="enabled", type="smallint", nullable=false)
     */
    private $enabled = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set parentid
     *
     * @param integer $parentid
     *
     * @return Seriescatalog
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;

        return $this;
    }

    /**
     * Get parentid
     *
     * @return integer
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * Set isfolder
     *
     * @param integer $isfolder
     *
     * @return Seriescatalog
     */
    public function setIsfolder($isfolder)
    {
        $this->isfolder = $isfolder;

        return $this;
    }

    /**
     * Get isfolder
     *
     * @return integer
     */
    public function getIsfolder()
    {
        return $this->isfolder;
    }

    /**
     * Set sortorder
     *
     * @param integer $sortorder
     *
     * @return Seriescatalog
     */
    public function setSortorder($sortorder)
    {
        $this->sortorder = $sortorder;

        return $this;
    }

    /**
     * Get sortorder
     *
     * @return integer
     */
    public function getSortorder()
    {
        return $this->sortorder;
    }

    /**
     * Set iconname
     *
     * @param string $iconname
     *
     * @return Seriescatalog
     */
    public function setIconname($iconname)
    {
        $this->iconname = $iconname;

        return $this;
    }

    /**
     * Get iconname
     *
     * @return string
     */
    public function getIconname()
    {
        return $this->iconname;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Seriescatalog
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
     * Set siteid
     *
     * @param string $siteid
     *
     * @return Seriescatalog
     */
    public function setSiteid($siteid)
    {
        $this->siteid = $siteid;

        return $this;
    }

    /**
     * Get siteid
     *
     * @return string
     */
    public function getSiteid()
    {
        return $this->siteid;
    }

    /**
     * Set units
     *
     * @param string $units
     *
     * @return Seriescatalog
     */
    public function setUnits($units)
    {
        $this->units = $units;

        return $this;
    }

    /**
     * Get units
     *
     * @return string
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * Set timeinterval
     *
     * @param string $timeinterval
     *
     * @return Seriescatalog
     */
    public function setTimeinterval($timeinterval)
    {
        $this->timeinterval = $timeinterval;

        return $this;
    }

    /**
     * Get timeinterval
     *
     * @return string
     */
    public function getTimeinterval()
    {
        return $this->timeinterval;
    }

    /**
     * Set parameter
     *
     * @param string $parameter
     *
     * @return Seriescatalog
     */
    public function setParameter($parameter)
    {
        $this->parameter = $parameter;

        return $this;
    }

    /**
     * Get parameter
     *
     * @return string
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Set tablename
     *
     * @param string $tablename
     *
     * @return Seriescatalog
     */
    public function setTablename($tablename)
    {
        $this->tablename = $tablename;

        return $this;
    }

    /**
     * Get tablename
     *
     * @return string
     */
    public function getTablename()
    {
        return $this->tablename;
    }

    /**
     * Set provider
     *
     * @param string $provider
     *
     * @return Seriescatalog
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set connectionstring
     *
     * @param string $connectionstring
     *
     * @return Seriescatalog
     */
    public function setConnectionstring($connectionstring)
    {
        $this->connectionstring = $connectionstring;

        return $this;
    }

    /**
     * Get connectionstring
     *
     * @return string
     */
    public function getConnectionstring()
    {
        return $this->connectionstring;
    }

    /**
     * Set expression
     *
     * @param string $expression
     *
     * @return Seriescatalog
     */
    public function setExpression($expression)
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     * Get expression
     *
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * Set notes
     *
     * @param string $notes
     *
     * @return Seriescatalog
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     *
     * @return Seriescatalog
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer
     */
    public function getEnabled()
    {
        return $this->enabled;
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
