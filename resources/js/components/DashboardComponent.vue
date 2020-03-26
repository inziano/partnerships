<template>
    <div class="w-full h-full bg-gray-100">
        <div  class="w-full h-full bg-gray-100">
            <div class="w-11/12 mx-auto">
                <p class="text-2xl font-semibold font-sans tracking-wide">Overview</p>
            </div>
            <chart class=""></chart>
        </div>
    </div>
</template>

<script>
import * as am4core from "@amcharts/amcharts4/core";
import * as am4charts from "@amcharts/amcharts4/charts";
import am4themes_animated from "@amcharts/amcharts4/themes/animated";

am4core.useTheme(am4themes_animated);

import Charts from './ChartsComponent.vue';

export default {
    components: {
        'chart': Charts,
    },
    data() {
        return {

        }
    },
    mounted(){
    },
    methods: {
        
    }
}
</script>