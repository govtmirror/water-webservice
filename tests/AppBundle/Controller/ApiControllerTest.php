<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Controller\ApiController;
use AppBundle\Entity\Seriescatalog;
use AppBundle\Entity\Sitecatalog;

class ApiControllerTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        self::bootKernel();

        $this->container = static::$kernel->getContainer();
    }

    public function testgetDateTimeFromString()
    {
        $apiController = new ApiController();
        $result = $apiController->getDateTimeFromString("2015-1-1");

        $this->assertEquals(Date("2015-01-01"), $result);
    }

    public function testgetDateTimeFromStringWithCharacters()
    {
        $apiController = new ApiController();
        $result = $apiController->getDateTimeFromString("asdfwqer");

        $this->assertEquals(null, $result);
    }

    // TODO single characters are timezones. Fix in future
    // public function testgetDateTimeFromStringWithOnceCharacter()
    // {
    //     $apiController = new ApiController();
    //     $result = $apiController->getDateTimeFromString("a");
    //
    //     $this->assertEquals(null, $result);
    // }

    function testgetRequestParamsStartDateOnly(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971?start="2015-11-01"');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $result = $apiController->getRequestParams($request);
      $this->assertEquals(array('Start' => "2015-11-01"), $result);
    }

    function testgetRequestParamsInvalidParameter(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971?test="2015-11-01"');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $result = $apiController->getRequestParams($request);
      $this->assertEquals(array(), $result);
    }

    function testgetRequestParamsEndDateOnly(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971?end="2015-11-02"');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $result = $apiController->getRequestParams($request);
      $this->assertEquals(array('End' => "2015-11-02"), $result);
    }

    function testgetRequestParamsStartAndEndDate(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971?start="2015-11-01"&end="2015-11-02"');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $result = $apiController->getRequestParams($request);
      $this->assertEquals(array('Start' => "2015-11-01",'End' => "2015-11-02"), $result);
    }

    function testgetRequestParamsNoDates(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $result = $apiController->getRequestParams($request);
      $this->assertEquals(array(), $result);
    }

    function testbuildStartEndWhereClauseStartDate(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971?start="2015-11-01"');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $requestParams = $apiController->getRequestParams($request);
      $result = $apiController->buildStartEndWhereClause($requestParams);
      $sql = "WHERE datetime > '2015-11-01'";
      $this->assertEquals($sql, $result);
    }

    function testbuildStartEndWhereClauseEndDate(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971?end="2015-11-02"');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $requestParams = $apiController->getRequestParams($request);
      $result = $apiController->buildStartEndWhereClause($requestParams);
      $sql = "WHERE datetime < '2015-11-02'";
      $this->assertEquals($sql, $result);
    }

    function testbuildStartEndWhereClauseStartEndDate(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971?start="2015-11-01"&end="2015-11-02"');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $requestParams = $apiController->getRequestParams($request);
      $result = $apiController->buildStartEndWhereClause($requestParams);
      $sql = "WHERE datetime > '2015-11-01' AND datetime < '2015-11-02'";
      $this->assertEquals($sql, $result);
    }

    function testbuildStartEndWhereClauseNoDates(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $requestParams = $apiController->getRequestParams($request);
      $result = $apiController->buildStartEndWhereClause($requestParams);
      $sql = "";
      $this->assertEquals($sql, $result);
    }

    function testbuildSqlWithStartParam(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971?start="2015-11-01"');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $result = $apiController->buildSql($request, "lchdb2_yearly_13971");
      $sql = "SELECT datetime, value, flag FROM lchdb2_yearly_13971 WHERE datetime > '2015-11-01' ORDER BY datetime";
      $this->assertEquals($sql, $result);
    }

    function testbuildSqWithEndParaml(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971?end="2015-11-01"');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $result = $apiController->buildSql($request, "lchdb2_yearly_13971");
      $sql = "SELECT datetime, value, flag FROM lchdb2_yearly_13971 WHERE datetime < '2015-11-01' ORDER BY datetime";
      $this->assertEquals($sql, $result);
    }

    function testbuildSqlWithStartAndEndParam(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971?start="2015-11-01"&end="2015-11-01"');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $result = $apiController->buildSql($request, "lchdb2_yearly_13971");
      $sql = "SELECT datetime, value, flag FROM lchdb2_yearly_13971 WHERE datetime > '2015-11-01' AND datetime < '2015-11-01' ORDER BY datetime";
      $this->assertEquals($sql, $result);
    }

    function testbuildSqlWithNoDateParams(){
      $client = static::createClient();
      $crawler = $client->request('GET', '/api/series/LakeMohave/lchdb2_yearly_13971');
      $request = $client->getRequest();

      $apiController = new ApiController();
      $result = $apiController->buildSql($request, "lchdb2_yearly_13971");
      $sql = "SELECT datetime, value, flag FROM lchdb2_yearly_13971 ORDER BY datetime";
      $this->assertEquals($sql, $result);
    }

    /**
     * @group failing
     */
    function testserializeResults(){
      $format = 'json';
      $series = new Seriescatalog();
      $series->setParentid(14097);
      $series->setIsfolder(0);
      $series->setSortorder(0);
      $series->seticonname("hdb");
      $series->setname("LakeMohave: ReservoirWsElevationEndOfPerReadingUsedAsValueForPer");
      $series->setSiteid("LakeMohave");
      $series->setunits("feet");
      $series->settimeinterval("Yearly");
      $series->setparameter("ReservoirWsElevationEndOfPerReadingUsedAsValueForPer");
      $series->settablename("lchdb2_yearly_2100");
      $series->setprovider("HDBSeries");
      $series->setconnectionstring("server=LCHDB2;sdi=2100;TimeInterval=Yearly;LastUpdate=06/17/2015 11:22");
      $series->setexpression("");
      $series->setnotes("");
      $series->setenabled(1);

      $seriesArray = array();
      array_push($seriesArray, $series);
      $serializedArray = '[{"parentid":14097,"isfolder":0,"sortorder":0,"iconname":"hdb","name":"LakeMohave: ReservoirWsElevationEndOfPerReadingUsedAsValueForPer","siteid":"LakeMohave","units":"feet","timeinterval":"Yearly","parameter":"ReservoirWsElevationEndOfPerReadingUsedAsValueForPer","tablename":"lchdb2_yearly_2100","provider":"HDBSeries","connectionstring":"server=LCHDB2;sdi=2100;TimeInterval=Yearly;LastUpdate=06\/17\/2015 11:22","expression":"","notes":"","enabled":1}]';

      $apiController = new ApiController();
      $result = $apiController->serializeResults($this->container, $seriesArray, $format);
      $this->assertEquals($serializedArray, $result);
    }
}
