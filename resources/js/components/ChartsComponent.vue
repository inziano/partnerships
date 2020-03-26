<template>
    <div class="w-full h-full p-2 bg-gray-100">
        <div class="w-full  flex">
            <div class="w-1/3 ml-2 flex bg-white rounded-sm">
                <div class="w-full p-5 h-64">
                    <div class="w-full text-center relative mb-10 p-5" style="height: 40%; top: 10%;">
                        <p class="text-4xl font-sans font-bold mb-0"> {{ partners }}</p>
                        <span class="text-xs tracking-widest font-semibold font-sans uppercase"> Partners</span>
                    </div>
                    <div class="w-full text-center p-5 relative" style="height: 40%">
                        <p class="text-4xl font-sans font-bold mb-0"> {{agreements}}</p>
                        <span class="text-xs tracking-widest font-semibold font-sans uppercase"> Agreements</span> 
                    </div>
                </div>
            </div>
            <div class="w-1/3 ml-2 rounded-sm">
                <typologychart></typologychart>
            </div>
            <div class="w-1/3 ml-2 rounded-sm">
                <agreementchart></agreementchart>
            </div>    
        </div>
        <div class="w-full p-5" style="height: 600px;">
            <mapchart></mapchart>
        </div>
        
    </div>
</template>

<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

am4core.useTheme(am4themes_animated);

// Import the charts
import MapChart from './charts/MapChartComponent'
import TypologyChart from './charts/TypologyChartComponent'
import AgreementTypeChart from './charts/AgreementTypeChartComponent'

export default {
    components: {
        'mapchart': MapChart,
        'typologychart': TypologyChart,
        'agreementchart': AgreementTypeChart
    },
    data() {
        return {

        }
    },
    computed: {
        agreements(){
            return this.$store.getters.analytics.partnershipStats.agreements || 0
        },
        partners(){
            return this.$store.getters.analytics.partnershipStats.partners || 0
        }
    },
    mounted(){

    }
}
</script>