System.register(['angular2/core', 'angular2/http', 'angular2/router'], function(exports_1) {
    "use strict";
    var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
        var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
        if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
        else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
        return c > 3 && r && Object.defineProperty(target, key, r), r;
    };
    var __metadata = (this && this.__metadata) || function (k, v) {
        if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
    };
    var core_1, http_1, router_1;
    var SiteComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (http_1_1) {
                http_1 = http_1_1;
            },
            function (router_1_1) {
                router_1 = router_1_1;
            }],
        execute: function() {
            SiteComponent = (function () {
                function SiteComponent(http, _routeParams) {
                    var _this = this;
                    this.http = http;
                    this.siteId = _routeParams.get('siteid');
                    var siteUrl = '/api/sites/' + this.siteId;
                    http.get(siteUrl).subscribe(function (res) {
                        // http.request('static/sites.json').subscribe(res => {
                        if (res.json().length == 1) {
                            _this.selectedSite = res.json()[0];
                        }
                    });
                    var seriesUrl = '/api/series/' + this.siteId;
                    http.get(seriesUrl).subscribe(function (res) {
                        // http.request('static/sites.json').subscribe(res => {
                        _this.series = res.json();
                    });
                }
                SiteComponent.prototype.onSelect = function (site) {
                    var _this = this;
                    this.selectedSiteSeries = site;
                    var seriesUrl = '/api/series/' + site.siteid + "/" + site.tablename;
                    this.http.get(seriesUrl).subscribe(function (res) {
                        // http.request('static/sites.json').subscribe(res => {
                        _this.selectedSeries = res.json();
                        // this.firstDate = new Date(this.selectedSeries[0].datetime);
                        // this.lastDate = new Date(this.selectedSeries[this.selectedSeries.length - 1].datetime);
                        function drawChart(site, seriesData) {
                            var gData = new google.visualization.DataTable();
                            gData.addColumn('date', 'Date');
                            gData.addColumn('number', 'Value');
                            seriesData.forEach(function (dataPoint) {
                                gData.addRows([[new Date(dataPoint.datetime), parseFloat(dataPoint.value)]]);
                            });
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
                            var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard_div'));
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
                        var seriesData = _this.selectedSeries;
                        google.load('visualization', '1.0', { 'packages': ['corechart', 'timeline', 'controls'], callback: function (data) { drawChart(site, seriesData); } });
                    });
                };
                SiteComponent = __decorate([
                    core_1.Component({
                        selector: 'my-app',
                        viewProviders: [http_1.HTTP_PROVIDERS]
                    }),
                    core_1.View({
                        templateUrl: '/angular/partials/site.html',
                    }), 
                    __metadata('design:paramtypes', [http_1.Http, router_1.RouteParams])
                ], SiteComponent);
                return SiteComponent;
            })();
            exports_1("SiteComponent", SiteComponent);
        }
    }
});
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
//# sourceMappingURL=site.component.js.map