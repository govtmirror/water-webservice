import {Component, View} from 'angular2/core'
import {Http, HTTP_PROVIDERS} from 'angular2/http'
import {RouteParams, Router} from 'angular2/router';

@Component({
  selector: 'my-app',
  viewProviders: [HTTP_PROVIDERS]
})

@View({
  templateUrl: '/angular/partials/site.html',
})

export class SiteComponent {
  selectedSite: Object;
  series: Array<Object>;
  selectedSeries: Array<Object>;
  selectedSiteSeries: Object;
  siteId: String;
  http: Http;

  constructor(http: Http, _routeParams: RouteParams) {
    this.http = http;
    this.siteId = _routeParams.get('siteid');
    var siteUrl = '/api/sites/' + this.siteId;
    http.get(siteUrl).subscribe(res => {
      // http.request('static/sites.json').subscribe(res => {
      if (res.json().length == 1) {
        this.selectedSite = res.json()[0];
      }
    });
    var seriesUrl = '/api/series/' + this.siteId;
    http.get(seriesUrl).subscribe(res => {
      // http.request('static/sites.json').subscribe(res => {
      this.series = res.json();
    });
  }

  onSelect(site) {
    this.selectedSiteSeries = site;
    var seriesUrl = '/api/series/' + site.siteid + "/" + site.tablename;

    this.http.get(seriesUrl).subscribe(res => {
      // http.request('static/sites.json').subscribe(res => {
      this.selectedSeries = res.json();
      // this.firstDate = new Date(this.selectedSeries[0].datetime);
      // this.lastDate = new Date(this.selectedSeries[this.selectedSeries.length - 1].datetime);
      function drawChart(site, seriesData) {
        var gData = new google.visualization.DataTable();
        gData.addColumn('date', 'Date');
        gData.addColumn('number', 'Value');

        seriesData.forEach(dataPoint => {
          gData.addRows([[new Date(dataPoint.datetime), parseFloat(dataPoint.value)]]);
        })

        var options = {
          hAxis: {
            title: 'Date',
            format: 'M/d/yy',
            gridlines: {
              format: 'M/d/yy',
              count: -1,
            },
          },
          vAxis: {
            title: site.parameter
          },
          height: 500,
          curveType: 'none',
          legend: { position: 'bottom' }
        };

        // var chart = new google.visualization.LineChart(document.getElementById('seriesChart'));
        // chart.draw(gData, options);

        var dashboard = new google.visualization.Dashboard(
          document.getElementById('dashboard_div'));

        // Create a range slider, passing some options
        var donutRangeSlider = new google.visualization.ControlWrapper({
          'controlType': 'DateRangeFilter',
          'containerId': 'filter_div',
          'options': {
            'filterColumnLabel': 'Date'
          }
        });
        var chartWrapper = new google.visualization.ChartWrapper({
          'chartType': 'LineChart',
          'containerId': 'chart_div',
          'options': {
            'hAxis': {
              'title': 'Date',
              'format': 'M/d/yy',
              'gridlines': {
                'format': 'M/d/yy',
                'count': -1,
              },
            },
            'vAxis': {
              'title': site.parameter
            },
            'height': 500,
            'curveType': 'none',
            'legend': { position: 'bottom' }
          }
        });

        dashboard.bind(donutRangeSlider, chartWrapper);

        // Draw the dashboard.
        dashboard.draw(gData);

      }
      var seriesData = this.selectedSeries;
      google.load('visualization', '1.0', { 'packages': ['corechart', 'timeline', 'controls'], callback: function(data) { drawChart(site, seriesData); } });
    });


  }

}

/*
  series info

  parentid
  isfolder
  sortorder
  iconname
  name
  siteid
  units
  timeinterval
  parameter
  tablename
  provider
  connectionstring
  expression
  notes
  enabled
  id

*/
