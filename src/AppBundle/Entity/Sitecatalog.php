<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sitecatalog
 *
 * @ORM\Table(name="sitecatalog")
 * @ORM\Entity
 */
class Sitecatalog
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1024, nullable=false)
     */
    private $description = '';

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=30, nullable=false)
     */
    private $state = '';

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=30, nullable=false)
     */
    private $latitude = '';

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=30, nullable=true)
     */
    private $longitude = '';

    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=30, nullable=false)
     */
    private $timezone = '';

    /**
     * @var string
     *
     * @ORM\Column(name="install", type="string", length=30, nullable=false)
     */
    private $install = '';

    /**
     * @var string
     *
     * @ORM\Column(name="horizontal_datum", type="string", length=30, nullable=false)
     */
    private $horizontalDatum = '';

    /**
     * @var string
     *
     * @ORM\Column(name="vertical_datum", type="string", length=30, nullable=false)
     */
    private $verticalDatum = '';

    /**
     * @var float
     *
     * @ORM\Column(name="vertical_accuracy", type="float", precision=10, scale=0, nullable=false)
     */
    private $verticalAccuracy = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="elevation_method", type="string", length=100, nullable=false)
     */
    private $elevationMethod = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tz_offset", type="string", length=10, nullable=false)
     */
    private $tzOffset = '';

    /**
     * @var string
     *
     * @ORM\Column(name="active_flag", type="string", length=1, nullable=false)
     */
    private $activeFlag = 'T';

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=false)
     */
    private $type = '';

    /**
     * @var string
     *
     * @ORM\Column(name="responsibility", type="string", length=30, nullable=false)
     */
    private $responsibility = '';

    /**
     * @var string
     *
     * @ORM\Column(name="agency_region", type="string", length=30, nullable=false)
     */
    private $agencyRegion = '';

    /**
     * @var string
     *
     * @ORM\Column(name="siteid", type="string", length=255)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $siteid;

    /**
     * @var string
     *
     * @ORM\Column(name="elevation", type="string", length=30)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $elevation;



    /**
     * Set description
     *
     * @param string $description
     *
     * @return Sitecatalog
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Sitecatalog
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Sitecatalog
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Sitecatalog
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     *
     * @return Sitecatalog
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set install
     *
     * @param string $install
     *
     * @return Sitecatalog
     */
    public function setInstall($install)
    {
        $this->install = $install;

        return $this;
    }

    /**
     * Get install
     *
     * @return string
     */
    public function getInstall()
    {
        return $this->install;
    }

    /**
     * Set horizontalDatum
     *
     * @param string $horizontalDatum
     *
     * @return Sitecatalog
     */
    public function setHorizontalDatum($horizontalDatum)
    {
        $this->horizontalDatum = $horizontalDatum;

        return $this;
    }

    /**
     * Get horizontalDatum
     *
     * @return string
     */
    public function getHorizontalDatum()
    {
        return $this->horizontalDatum;
    }

    /**
     * Set verticalDatum
     *
     * @param string $verticalDatum
     *
     * @return Sitecatalog
     */
    public function setVerticalDatum($verticalDatum)
    {
        $this->verticalDatum = $verticalDatum;

        return $this;
    }

    /**
     * Get verticalDatum
     *
     * @return string
     */
    public function getVerticalDatum()
    {
        return $this->verticalDatum;
    }

    /**
     * Set verticalAccuracy
     *
     * @param float $verticalAccuracy
     *
     * @return Sitecatalog
     */
    public function setVerticalAccuracy($verticalAccuracy)
    {
        $this->verticalAccuracy = $verticalAccuracy;

        return $this;
    }

    /**
     * Get verticalAccuracy
     *
     * @return float
     */
    public function getVerticalAccuracy()
    {
        return $this->verticalAccuracy;
    }

    /**
     * Set elevationMethod
     *
     * @param string $elevationMethod
     *
     * @return Sitecatalog
     */
    public function setElevationMethod($elevationMethod)
    {
        $this->elevationMethod = $elevationMethod;

        return $this;
    }

    /**
     * Get elevationMethod
     *
     * @return string
     */
    public function getElevationMethod()
    {
        return $this->elevationMethod;
    }

    /**
     * Set tzOffset
     *
     * @param string $tzOffset
     *
     * @return Sitecatalog
     */
    public function setTzOffset($tzOffset)
    {
        $this->tzOffset = $tzOffset;

        return $this;
    }

    /**
     * Get tzOffset
     *
     * @return string
     */
    public function getTzOffset()
    {
        return $this->tzOffset;
    }

    /**
     * Set activeFlag
     *
     * @param string $activeFlag
     *
     * @return Sitecatalog
     */
    public function setActiveFlag($activeFlag)
    {
        $this->activeFlag = $activeFlag;

        return $this;
    }

    /**
     * Get activeFlag
     *
     * @return string
     */
    public function getActiveFlag()
    {
        return $this->activeFlag;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Sitecatalog
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set responsibility
     *
     * @param string $responsibility
     *
     * @return Sitecatalog
     */
    public function setResponsibility($responsibility)
    {
        $this->responsibility = $responsibility;

        return $this;
    }

    /**
     * Get responsibility
     *
     * @return string
     */
    public function getResponsibility()
    {
        return $this->responsibility;
    }

    /**
     * Set agencyRegion
     *
     * @param string $agencyRegion
     *
     * @return Sitecatalog
     */
    public function setAgencyRegion($agencyRegion)
    {
        $this->agencyRegion = $agencyRegion;

        return $this;
    }

    /**
     * Get agencyRegion
     *
     * @return string
     */
    public function getAgencyRegion()
    {
        return $this->agencyRegion;
    }

    /**
     * Set siteid
     *
     * @param string $siteid
     *
     * @return Sitecatalog
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
     * Set elevation
     *
     * @param string $elevation
     *
     * @return Sitecatalog
     */
    public function setElevation($elevation)
    {
        $this->elevation = $elevation;

        return $this;
    }

    /**
     * Get elevation
     *
     * @return string
     */
    public function getElevation()
    {
        return $this->elevation;
    }
}
