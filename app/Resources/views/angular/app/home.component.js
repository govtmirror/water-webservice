System.register(['angular2/core', 'angular2/http', './filterPipe'], function(exports_1) {
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
    var core_1, http_1, filterPipe_1;
    var HomeComponent;
    return {
        setters:[
            function (core_1_1) {
                core_1 = core_1_1;
            },
            function (http_1_1) {
                http_1 = http_1_1;
            },
            function (filterPipe_1_1) {
                filterPipe_1 = filterPipe_1_1;
            }],
        execute: function() {
            HomeComponent = (function () {
                // this.http = Http;
                function HomeComponent(http) {
                    var _this = this;
                    http.get('/api/sites').subscribe(function (res) {
                        // http.request('static/sites.json').subscribe(res => {
                        _this.sites = res.json();
                        _this.drawVisualization(_this.sites);
                    });
                }
                HomeComponent.prototype.resetMap = function () {
                    this.drawVisualization(this.sites);
                };
                HomeComponent.prototype.onSelect = function (site) {
                    this.selectedSite = site;
                    function drawChart(site) {
                        var data = new google.visualization.DataTable();
                        data.addColumn('number', 'LATITUDE');
                        data.addColumn('number', 'LONGITUDE');
                        data.addColumn('string', 'DESCRIPTION');
                        if (site && site.latitude && site.longitude) {
                            data.addRows([[parseFloat(site.latitude), parseFloat(site.longitude), site.description]]);
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
                        'packages': ['corechart'], 'site': site, callback: function (data) {
                            drawChart(site);
                        }
                    });
                    // http.get('http://127.0.0.1:8000/api/sites').subscribe(res => {
                    //   this.sites = res.json();
                    // });
                };
                HomeComponent.prototype.drawVisualization = function (sites) {
                    function drawChart() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('number', 'LATITUDE');
                        data.addColumn('number', 'LONGITUDE');
                        data.addColumn('string', 'DESCRIPTION');
                        // $.each(sites, function(i, site) {
                        sites.forEach(function (site) {
                            if (site.latitude && site.longitude) {
                                data.addRows([[parseFloat(site.latitude), parseFloat(site.longitude), site.description]]);
                            }
                        });
                        var options = {
                            colorAxis: { minValue: 0, maxValue: 0, colors: ['#6699CC'] },
                            legend: 'none',
                            backgroundColor: { fill: 'transparent', stroke: '#FFF', strokeWidth: 0 },
                            datalessRegionColor: '#f5f5f5',
                            displayMode: 'markers',
                            enableRegionInteractivity: 'true',
                            resolution: 'provinces',
                            sizeAxis: { minValue: 1, maxValue: 1, minSize: 5, maxSize: 5 },
                            region: 'auto',
                            height: 500,
                            keepAspectRatio: true,
                            tooltip: { textStyle: { color: '#444444' } },
                        };
                        var chart = new google.visualization.GeoChart(document.getElementById('visualization'));
                        google.visualization.events.addListener(chart, 'regionClick', function (eventData) {
                            // maybe you want to change the data table here...
                            var currentRegion = eventData.region;
                            console.log(currentRegion);
                            var data = new google.visualization.DataTable();
                            data.addColumn('number', 'LATITUDE');
                            data.addColumn('number', 'LONGITUDE');
                            data.addColumn('string', 'DESCRIPTION');
                            // $.each(sites, function(i, site) {
                            sites.forEach(function (site) {
                                if (site.latitude && site.longitude && site.state) {
                                    var siteRegion = "US-" + site.state;
                                    if (siteRegion == currentRegion) {
                                        data.addRows([[parseFloat(site.latitude), parseFloat(site.longitude), site.description]]);
                                    }
                                }
                            });
                            var options = {
                                colorAxis: { minValue: 0, maxValue: 0, colors: ['#6699CC'] },
                                legend: 'none',
                                backgroundColor: { fill: 'transparent', stroke: '#FFF', strokeWidth: 0 },
                                datalessRegionColor: '#f5f5f5',
                                displayMode: 'markers',
                                enableRegionInteractivity: 'true',
                                resolution: 'provinces',
                                sizeAxis: { minValue: 1, maxValue: 1, minSize: 5, maxSize: 5 },
                                region: currentRegion,
                                height: 500,
                                keepAspectRatio: true,
                                tooltip: { textStyle: { color: '#444444' } },
                            };
                            chart.draw(data, options);
                        });
                        chart.draw(data, options);
                    }
                    google.load('visualization', '1.0', { 'packages': ['corechart'], callback: drawChart });
                };
                HomeComponent = __decorate([
                    core_1.Component({
                        viewProviders: [http_1.HTTP_PROVIDERS]
                    }),
                    core_1.View({
                        templateUrl: 'api/angular/partials/home.html',
                        pipes: [filterPipe_1.FilterPipe],
                    }), 
                    __metadata('design:paramtypes', [http_1.Http])
                ], HomeComponent);
                return HomeComponent;
            })();
            exports_1("HomeComponent", HomeComponent);
        }
    }
});
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
//# sourceMappingURL=home.component.js.map