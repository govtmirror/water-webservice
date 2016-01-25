System.register(['angular2/core', 'angular2/http', 'angular2/router', './filterPipe', './home.component', './site.component'], function(exports_1) {
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
    var core_1, http_1, router_1, filterPipe_1, home_component_1, site_component_1;
    var AppComponent;
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
            },
            function (filterPipe_1_1) {
                filterPipe_1 = filterPipe_1_1;
            },
            function (home_component_1_1) {
                home_component_1 = home_component_1_1;
            },
            function (site_component_1_1) {
                site_component_1 = site_component_1_1;
            }],
        execute: function() {
            AppComponent = (function () {
                // this.http = Http;
                function AppComponent(http) {
                    var _this = this;
                    http.get('/api/sites').subscribe(function (res) {
                        // http.request('static/sites.json').subscribe(res => {
                        _this.sites = res.json();
                    });
                }
                AppComponent.prototype.onSelect = function (site) {
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
                };
                AppComponent = __decorate([
                    core_1.Component({
                        selector: 'my-app',
                        viewProviders: [http_1.HTTP_PROVIDERS]
                    }),
                    core_1.View({
                        templateUrl: '/api/angular/partials/_base.html',
                        directives: [router_1.ROUTER_DIRECTIVES],
                        pipes: [filterPipe_1.FilterPipe],
                    }),
                    router_1.RouteConfig([
                        { path: '/', name: 'Home', component: home_component_1.HomeComponent },
                        { path: '/site/:siteid', name: 'Site', component: site_component_1.SiteComponent }
                    ]), 
                    __metadata('design:paramtypes', [http_1.Http])
                ], AppComponent);
                return AppComponent;
            })();
            exports_1("AppComponent", AppComponent);
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
//# sourceMappingURL=app.component.js.map