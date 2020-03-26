<template>
    <div class="w-full h-full bg-white">
        <div class="w-11/12 bg-white mx-auto p-2">
            <p class="text-base font-sans font-medium tracking-wider mb-0">
                Partners
            </p>
            <p class="text-sm font-normal tracking-wide">
                Distribution of partners by fields
            </p>
        </div>
        <div ref="partnerTypology" style="height: 80%; min-width:300px; min-height: 300px"></div>
    </div>
</template>

<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

am4core.useTheme(am4themes_animated);

export default {
    data(){
        return{
            chartdata: []
        }
    },
    computed: {
        partners(){
            return this.$store.getters.partnerFields
        },
        fields(){
            // Loop through the object and get the count
            Object.keys(this.partners).forEach(obj=>{
                let myObj = {
                    type: obj,
                    number: this.partners[obj].length
                }
                this.chartdata.push(myObj)
            })
            return this.chartdata
        }
    },
    methods: {
        // Create the chart
        renderChart(){
             // Create pie chart
        let chart = am4core.create(this.$refs.partnerTypology, am4charts.PieChart)
        //  Chart data, if types is empty, use default data as a placeholder
        chart.data = this.fields.length ? this.fields : [{ type: 'field', number: 1 }]
        let series = chart.series.push(new am4charts.PieSeries())
        series.dataFields.value = "number"
        series.dataFields.radiusValue = "number"
        series.dataFields.category = "type"
        series.colors.step = 6
        series.hiddenState.properties.endAngle = -90
        series.labels.template.disabled = true;
        series.ticks.template.disabled = true;
        chart.legend = new am4charts.Legend()
        chart.legend.position = "bottom"
        chart.legend.maxWidth = 100
        chart.legend.valueLabels.template.align = "left"
        chart.legend.useDefaultMarker = true;
        let markerTemplate = chart.legend.markers.template;
        markerTemplate.width = 10;
        markerTemplate.height = 10;
        let marker = chart.legend.markers.template.children.getIndex(0);
        marker.cornerRadius(12, 12, 12, 12);
        marker.strokeWidth = 2;
        marker.strokeOpacity = 1;
        }
    },
    mounted(){
       this.renderChart()
    },
    watch: {
        // Watch for changes in the data and re-draw the chart
        fields: function(){
            this.renderChart()
        }
    },
    beforeDestroy() {
        if (this.chart) {
            this.chart.dispose();
        }
    }
}
</script>