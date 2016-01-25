<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
      // echo var_dump(explode(".",$_SERVER["REQUEST_URI"]));
        // replace this example code with whatever you need
        return $this->render('api/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }


    /**
     * @Route("/api/series", name="series_v1")
     */
    public function seriesAction(Request $request)
    {
      $format = "json";
      $results = $this->findAll("Seriescatalog", $format);
      return $this->renderResults($results);
    }

    /**
     * @Route("/api/series/{siteId}", name="series_detail_v1")
     */
    public function seriesDetailAction(Request $request, $siteId)
    {
      $format = "json";
      $results = $this->findBySiteId("Seriescatalog", $format, $siteId);
      return $this->renderResults($results);
    }

    /**
     * @Route("/api/series/{siteId}/{tablename}", name="series_values_v1")
     */
    public function seriesValuesAction(Request $request, $siteId, $tablename)
    {
      $series = $this->getSeriesValues($request, $tablename);
      $serializer = $this->container->get('serializer');
      $results = $serializer->serialize($series, 'json');
      return $this->renderResults($results);
    }


    /**
     * @Route("/api/sites", name="sites_v1")
     */
    public function sitesAction(Request $request)
    {
      // $request->headers->set('content-type: ', 'application/json; charset=utf-8');
      // $request->headers->set('Access-Control-Allow-Origin: ', '*');
      // echo $request;
      // echo "<br />";
      // echo "<br />";
      // echo "<br />";
      $results = $this->findAll("Sitecatalog", "json");
      return $this->renderResults($results);
    }

    /**
     * @Route("/api/sites/{siteId}", name="site_detail_v1")
     */
    public function siteDetailAction(Request $request, $siteId)
    {
      $format = "json";
      $results = $this->findBySiteId("Sitecatalog", $format, $siteId);
      return $this->renderResults($results);
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

    function serializeResults($container, $series, $format){
      $serializer = $container->get('serializer');
      $results = $serializer->serialize($series, $format);
      return $results;
    }
}
