import {Component, View} from 'angular2/core'
import {Http, HTTP_PROVIDERS} from 'angular2/http'
import {RouteConfig, ROUTER_DIRECTIVES} from 'angular2/router';
import {FilterPipe} from './filterPipe'

import {HomeComponent} from './home.component';
import {SiteComponent} from './site.component';

@Component({
  selector: 'my-app',
  viewProviders: [HTTP_PROVIDERS]
})

@View({
  templateUrl: '/api/angular/partials/_base.html',
  directives: [ROUTER_DIRECTIVES],
  pipes: [FilterPipe],
})

@RouteConfig([
  {path:'/', name: 'Home', component: HomeComponent},
  {path:'/site/:siteid', name: 'Site', component: SiteComponent}
])

export class AppComponent {
  selectedSite: Object;
  sites: Array<Object>;
  // this.http = Http;
  constructor(http: Http) {
    http.get('/api/sites').subscribe(res => {
      // http.request('static/sites.json').subscribe(res => {
      this.sites = res.json();
    });
  }
  onSelect(site) {
    this.selectedSite = site;
    function drawChart(site) {
      var data = new google.visualization.DataTable();

      data.addColumn('number', 'LATITUDE');
      data.addColumn('number', 'LONGITUDE');
      data.addColumn('string', 'DESCRIPTION');

      if (site && site.latitude && site.longitude) {
        data.addRows([[parseFloat(site.latitude), parseFloat(site.longitude), site.description]])
      }

      var region = "auto";
      if (site && site.state) {
        region = "US-" + site.state;
      }

      var options = {
        colorAxis: { minValue: 0, maxValue: 0, colors: ['#6699CC'] },
        legend: 'none',
        backgroundColor: { fill: 'transparent', stroke: '#FFF', strokeWidth: 0 },
        datalessRegionColor: '#f5f5f5',
        displayMode: 'markers',
        enableRegionInteractivity: 'true',
        resolution: 'provinces',
        sizeAxis: { minValue: 1, maxValue: 1, minSize: 5, maxSize: 5 },
        region: region,
        height: 400,
        keepAspectRatio: true,
        tooltip: { textStyle: { color: '#444444' } }
      };
      var chart = new google.visualization.GeoChart(document.getElementById('visualization'));
      chart.draw(data, options);
    }

    google.load('visualization', '1.0', {
      'packages': ['corechart'], 'site': site, callback: function(data) {
      drawChart(site)
    }
    });
}

/*
    Site.json

    description
    state
    latitude
    longitude
    timezone
    install
    horizontal_datum
    vertical_datum
    vertical_accuracy
    elevation_method
    tz_offset
    active_flag
    type
    responsibility
    agency_region
    siteid
    elevation
*/
