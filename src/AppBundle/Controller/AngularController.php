<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AngularController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
      // echo var_dump(explode(".",$_SERVER["REQUEST_URI"]));
        // replace this example code with whatever you need
        return $this->render('angular/index.html', array());
    }

    /**
     * @Route("/api/angular/partials/_base.html", name="BaseHtml")
     */
    public function baseAction(Request $request)
    {
        return $this->render('angular/partials/_base.html', array());
    }

    /**
     * @Route("/api/angular/partials/home.html", name="HomeHtml")
     */
    public function homeAction(Request $request)
    {

        return $this->render('angular/partials/home.html', array());
    }

    /**
     * @Route("/site/{site}", name="Angular Site1")
     * @Route("/site/{site}/", name="Angular Site2")
     */
    public function siteAction(Request $request)
    {
        return $this->render('angular/index.html', array());
    }

    /**
     * @Route("/angular/partials/site.html", name="siteHtml")
     */
    public function siteHtmlAction(Request $request)
    {
        return $this->render('angular/partials/site.html', array());
    }

    /**
     * @Route("/api/angular/app/boot.js", name="BootJs")
     * @Route("/api/angular/app/boot", name="BootJss")
     */
    public function bootJsAction(Request $request)
    {
        return $this->render('angular/app/boot.js', array(
        ));
    }

    /**
     * @Route("/api/angular/app/app.component.js", name="AppJs")
     * @Route("/api/angular/app/app.component", name="AppJss")
     */
    public function appJsAction(Request $request)
    {
        return $this->render('angular/app/app.component.js', array(
        ));
    }

    /**
     * @Route("/api/angular/app/site.component.js", name="SiteJs")
     * @Route("/api/angular/app/site.component", name="SiteJss")
     */
    public function siteJsAction(Request $request)
    {
        return $this->render('angular/app/site.component.js', array(
        ));
    }

    /**
     * @Route("/api/angular/app/home.component.js", name="HomeJs")
     * @Route("/api/angular/app/home.component", name="HomeJss")
     */
    public function homeJsAction(Request $request)
    {
        return $this->render('angular/app/home.component.js', array());
    }

    /**
     * @Route("/api/angular/app/filterPipe.js", name="FilterPipeJs")
     * @Route("/api/angular/app/filterPipe", name="FilterPipeJss")
     */
    public function filterPipJsAction(Request $request)
    {
        return $this->render('angular/app/filterPipe.js', array());
    }
}
