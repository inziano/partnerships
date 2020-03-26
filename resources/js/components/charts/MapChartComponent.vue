<template>
    <div class="w-full h-full bg-white">
        <div class="w-11/12 bg-white mx-auto p-2 my-0">
            <p class="text-base font-sans font-medium tracking-wider mb-0">
                Partners
            </p>
            <p class="text-sm font-normal tracking-wide m-0">
                Distribution of partners across countries
            </p>
        </div>
        <div class="w-11/12" ref="mapdiv" style=" height: 80%; min-height: 500px; min-width: 500px;"></div>
    </div>
</template>

<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4maps from "@amcharts/amcharts4/maps";
import am4geodata_worldHigh from "@amcharts/amcharts4-geodata/worldHigh";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

am4core.useTheme(am4themes_animated);

export default {
    data() {
        return {
            countryList: '',
            mapData: []   
        }
    },
    computed: {
        // countries
        countries(){
            return this.$store.getters.partnerCountries
        },
        partnerLocations(){
            // 
            Object.keys(this.countries).forEach(obj=>{
                let ctry = this.countryList.filter( country=>country.name == obj )
                let myObj = {
                    id: ctry[0]['code'],
                    name: ctry[0]['name'],
                    value: this.countries[obj].length,
                    color: Math.floor(Math.random()*16777215).toString(16)
                }

                this.mapData.push(myObj)
            })

            return this.mapData
        }
    },
    methods: {
        renderMap(){
            // Create map instance
            let chart = am4core.create(this.$refs.mapdiv, am4maps.MapChart)
            // Set map definition
            chart.geodata = am4geodata_worldHigh;
            // Set projection
            chart.projection = new am4maps.projections.Miller();

            // Create map polygon series
            let polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
            polygonSeries.exclude = ["AQ"];
            polygonSeries.useGeodata = true;
            polygonSeries.nonScalingStroke = true;
            polygonSeries.strokeWidth = 0.5;
            polygonSeries.calculateVisualCenter = true;

            let imageSeries = chart.series.push(new am4maps.MapImageSeries());
            imageSeries.data = this.partnerLocations.length ? this.partnerLocations : [{ id: 'KE', name: 'Kenya', value: 1, color: '#a55f78'}]
            imageSeries.dataFields.value = "value";

            let imageTemplate = imageSeries.mapImages.template;
            imageTemplate.nonScaling = true

            let circle = imageTemplate.createChild(am4core.Circle);
            circle.fillOpacity = 0.7;
            circle.propertyFields.fill = "color";
            circle.tooltipText = "{name}: [bold]{value}[/]";


            imageSeries.heatRules.push({
            "target": circle,
            "property": "radius",
            "min": 4,
            "max": 30,
            "dataField": "value"
            })

            imageTemplate.adapter.add("latitude", function(latitude, target) {
            let polygon = polygonSeries.getPolygonById(target.dataItem.dataContext.id);
            if (polygon){
                return polygon.visualLatitude;
            }
            return latitude;
            })

            imageTemplate.adapter.add("longitude", function(longitude, target) {
            let polygon = polygonSeries.getPolygonById(target.dataItem.dataContext.id);
            if (polygon){
                return polygon.visualLongitude;
            }
            return longitude;
            })

            // Zoomout
            let zoomOut = chart.createChild(am4core.ZoomOutButton)
            zoomOut.align = 'right'
            zoomOut.hide()
            zoomOut.events.on("hit", function(ev){
                polygonSeries.show()
                chart.goHome()
                // countrySeries.hide()
                zoomOut.hide()
            })

            // Drilldown event 
            polygonSeries.mapPolygons.template.events.on("hit", function(ev){
                let chart = ev.target.series.chart
                chart.zoomToMapObject(ev.target)
                zoomOut.show()
            })
        },
    },
    mounted(){
        // Get the country and codes
        axios({
            method: 'get',
            url: 'assets/countries.json'
        }).then((response)=>{
            this.countryList = response.data
        }).catch((error)=>{
            this.$message.error('Map data not loaded. You may experience challenges using the map')
        })
        // Render the map
        this.renderMap()
    },
    watch: {
        // Watch for changes in the data and re-draw the chart
        partnerLocations: function(){
            this.renderMap()
        }
    },
    beforeDestroy() {
        if (this.chart) {
            this.chart.dispose();
        }
    }
}
</script>