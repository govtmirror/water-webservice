<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;

class ApiController extends Controller
{

//   use Symfony\Component\HttpFoundation\Response;
//
// // create a simple Response with a 200 status code (the default)
// $response = new Response('Hello '.$name, Response::HTTP_OK);
//
// // create a JSON-response with a 200 status code
// $response = new Response(json_encode(array('name' => $name)));
// $response->headers->set('Content-Type', 'application/json');



    /**
     * @Route("/api/", name="API Home")
     * @Route("/api/index.html", name="API Home2")
     * @Route("/api/index", name="API Home3")
     */
    public function indexAction(Request $request)
    {
        $response = $this->render('api/index.html.twig', array());
        return $response;
    }

    public function returnCsvAction(){
    // If you need to send a CSV file directly to the browser,
    // without writing in an external file,
    // you can open the output and use fputcsv on it..
    //
    // $out = fopen('php://output', 'w');
    // fputcsv($out, array('this','is some', 'csv "stuff", you know.'));
    // fclose($out);
    //
      $response->headers->set('Content-Type', 'text/csv');
      $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');

      return $response;
    }

    /**
     * @Route("/api/series", name="series_v1")
     */
    public function seriesAction(Request $request)
    {
      $format = $this->getFormatParameter($request);
      $results = $this->findAll("Seriescatalog", $format);
      return $this->renderResults($results);
    }

    /**
     * @Route("/api/series/{siteId}", name="series_detail_v1")
     */
    public function seriesDetailAction(Request $request, $siteId)
    {
      $format = $this->getFormatParameter($request);
      $results = $this->findBySiteId("Seriescatalog", $format, $siteId);
      return $this->renderResults($results);
    }

    /**
     * @Route("/api/series/{siteId}/{tablename}", name="series_values_v2")
     */
    public function seriesValuesAction(Request $request, $siteId, $tablename)
    {
      $format = $this->getFormatParameter($request);
      $series = $this->getSeriesValues($request, $tablename);
      $results = $this->serializeResults($this->container, $series, $format);
      return $this->renderResults($results);
    }

    /**
     * @Route("/api/series_WML/{siteId}/{tablename}", name="series_values_v1")
     */
    public function seriesValuesAction_WML(Request $request, $siteId, $tablename)
    {
      //Controller handles WML@ Requests
      $format = $this->getFormatParameter($request);
      $series = $this->getSeriesValues($request, $tablename);
      $results = $this->serializeResults($this->container, $series, $format);
      return $this->renderResults($results);
    }


    /**
     * @Route("/api/sites", name="sites_v1")
     */
    public function sitesAction(Request $request)
    {
      $format = $this->getFormatParameter($request);
      $results = $this->findAll("Sitecatalog", $format);
      return $this->renderResults($results);
    }

    /**
     * @Route("/api/sites/{siteId}", name="site_detail_v1")
     */
    public function siteDetailAction(Request $request, $siteId)
    {
      $format = $this->getFormatParameter($request);
      $results = $this->findBySiteId("Sitecatalog", $format, $siteId);
      return $this->renderResults($results);
    }

    function getFormatParameter(Request $request){
        // Default the format to json
        $format = "json";
        $requestParams = $this->getRequestParams($request);
        if(isset($requestParams['Format'])){
          $format = $requestParams['Format'];
        }
        return $format;
    }

    function getSeriesValues($request, $tablename)
    {
        $sql = $this->buildSql($request, $tablename);
        $stmt = $this->getDoctrine()->getManager()->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function buildSql($request, $tablename){
        $sql = "SELECT datetime, value, flag FROM ".$tablename;

        $whereClauses = "";

        $requestParams = $this->getRequestParams($request);
        if(isset($requestParams['Start']) || isset($requestParams['End'])){
          $dateWhereClause = $this->buildStartEndWhereClause($requestParams);
          $whereClauses = $whereClauses.$dateWhereClause;

        }

        if($whereClauses != ""){
          $sql = $sql." ".$whereClauses;
        }

        $sql = $sql." ORDER BY datetime";

        return $sql;
    }

    function buildStartEndWhereClause($requestParams){
      $whereClauses = "";
      if(isset($requestParams['Start']) && isset($requestParams['End'])){
        $whereClauses = "WHERE datetime > '".$requestParams['Start']."' AND datetime < '".$requestParams['End']."'";
      }
      elseif (isset($requestParams['Start'])) {
        $whereClauses = "WHERE datetime > '".$requestParams['Start']."'";
      }
      elseif (isset($requestParams['End'])) {
        $whereClauses = "WHERE datetime < '".$requestParams['End']."'";
      }
      return $whereClauses;
    }

    function getRequestParams($request){
      $requestParams = array();

      $startTime = $request->query->get('start');
      $startDate = $this->getDateTimeFromString($startTime);
      if($startDate != null){
        $requestParams['Start'] = $startDate;
      }

      $endTime = $request->query->get('end');
      $endDate = $this->getDateTimeFromString($endTime);
      if($endDate != null){
        $requestParams['End'] = $endDate;
      }

      $format = $request->query->get('Format');
      if($format != null){
        $requestParams['Format'] = $format;
      }

      return $requestParams;
    }

    function getDateTimeFromString($parameter){
      if($parameter == ""){
        return;
      }

      $rawTime = str_replace('"', "", $parameter);
      $time = strtotime($rawTime, false);
      if (($timestamp = strtotime($rawTime)) === false) {
          return;
      } else {
          $date = date("Y-m-d", $time);
          return $date;
      }

      return $date;
    }

    function renderResults($results){
      return $this->render('api/v1/results.html.twig', array(
          'results' => $results,
      ));
    }

    function findAll($catalog, $format){
      $series = $this->getDoctrine()
          ->getRepository("AppBundle:".$catalog)
          ->findAll();
      $container = $this->container;
      $results = $this->serializeResults($container, $series, $format);
      return $results;
    }

    function findBySiteId($catalog, $format, $siteId){
      $series = $this->getDoctrine()
          ->getRepository("AppBundle:".$catalog)
          ->findBySiteid($siteId);
      $container = $this->container;

      $results = $this->serializeResults($container, $series, $format);
      return $results;
    }

    function convertToWml($series){

    }

    function serializeResults($container, $series, $format){
      switch($format){
        case "json":
          $serializer = $container->get('serializer');
          $results = $serializer->serialize($series, $format);
          break;
        case "wml":
          $results = $this->_build_WML($series);
          break;
        case "csv":
          $results = $this->buildCsv($series);
          break;
        default:
          $serializer = $container->get('serializer');
          $results = $serializer->serialize($series, $format);
          break;
      }
      return $results;
    }

    function _build_WML($series){
      $xml = new \DOMDocument();

      //Collection
      $wml2Collection = $xml->createElement("wml2:Collection");
      $wml2Collection = $xml->appendChild($wml2Collection);

      //gml:description
      $gmlDescription = $xml->createElement("gml:description", "KISTERS KiWIS WaterML2.0 EXAMPLE");
      $gmlDescription = $wml2Collection->appendChild($gmlDescription);

      //wml2:metadata
      $wml2Metadata = $xml->createElement("wml2:metadata");
      $wml2Metadata = $wml2Collection->appendChild($wml2Metadata);

      //wml2:DocumentMetadata
      $wml2DocumentMetadata = $xml->createElement("wml2:DocumentMetadata");
      $wml2DocumentMetadata = $wml2Metadata->appendChild($wml2DocumentMetadata);

      //wml2:generationDate
      $wml2generationDate = $xml->createElement("wml2:generationDate","2016-01-22");
      $wml2generationDate = $wml2DocumentMetadata->appendChild($wml2generationDate);

      //wml2:generationSystem
      $wml2GenerationSystem = $xml->createElement("wml2:generationSystem","USBR");
      $wml2GenerationSystem = $wml2DocumentMetadata->appendChild($wml2GenerationSystem);

      //MeasurementTimeseries
      $MeasurementTimeseries = $xml->createElement("wml2:MeasurementTimeseries");
      $MeasurementTimeseries = $wml2Collection->appendChild($MeasurementTimeseries);

      //Loop thru the raw data
      foreach ($series as $key => $value) {

        $xml_point = $xml->createElement("wml2:point");
        $xml_point = $MeasurementTimeseries->appendChild($xml_point);

        $xml_MeasurementTVP = $xml->createElement("wml2:MeasurementTVP");
        $xml_MeasurementTVP = $xml_point->appendChild($xml_MeasurementTVP);

        if(array_key_exists('datetime',$value))
        {
          $xml_time = $xml->createElement("wml2:time",$value['datetime']);
          $xml_time = $xml_MeasurementTVP->appendChild($xml_time);
        }
        if(array_key_exists('value',$value))
        {
          $xml_value = $xml->createElement("wml2:value",$value['value']);
          $xml_value = $xml_MeasurementTVP->appendChild($xml_value);
        }
      }

      $xmlString = $xml->saveXML();
      return $xmlString;
    }

    function buildCsv($series){
      $header = $this -> buildHeader($series);

      // foreach ($series as $value) {
      //   echo var_dump($value[0]);
      // }
    }

    function buildHeader($array){
      $arrayKeys = $this->getObjectVariables($array);
      $keysCount = count($arrayKeys);
      $count = 0;
      $header = "";
      foreach ($arrayKeys as $key => $value) {
        $header = $header.$value;

        // Add the comma if it isn't the last object in the array
        $count++;
        if($count != $keysCount){
          $header = $header.", ";
        }
      }
      return $header;
    }

    function getObjectVariables($array){
      if(count($array) > 0){
        $arrayKeys = array_keys(get_object_vars($array[0]));
        return $arrayKeys;
      }
    }
}
