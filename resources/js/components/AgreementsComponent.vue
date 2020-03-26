<template>
    <div class="w-full h-full bg-white">
        <a-modal centered mask closable :width="900" :footer="null" v-model="newagreementmodal">
            <newagreement class="w-4/5"></newagreement>
        </a-modal>
        <div class="w-full flex flex-wrap bg-white p-2 flex ">
            <div class="w-11/12 flex content-center">
                <a-row :gutter="16" >
                    <a-col :span="12">
                        <a-card :bordered="false" style="width: 150px">
                            <a-statistic title="Agreements" :value="1128" style="margin-right: 50px"> </a-statistic>
                        </a-card>
                    </a-col>
                </a-row>
            </div>
        </div>
        <div class="w-full flex bg-white mb-2">
            <div class="w-full flex content-center">
                <div class="w-4/12 p-2 ml-3">
                    <a-icon type="search" />
                    <input v-on:keyup.enter="onSearch" v-model="searchTerm" prefix="ios-search-outline" placeholder="Search" class="appearance-none bg-transparent border-none w-3/4 font-sans tracking-wider mr-3 py-1 px-2 leading-tight focus:outline-none focus:bg-white" type="text" />
                </div>
                <div class="flex-grow content-center h-full p-2">
                    <a-dropdown class="mx-2">
                        <a class="font-sans tracking-wider text-gray-900 hover:text-gray-900" href="#">  <a-icon :style="{ padding: '0', fontSize: '20px'}" type="calendar" /> </a>
                        <a-menu slot="overlay">
                            <a-menu-item>
                                <a href="javascript:;">Dates</a>
                            </a-menu-item>
                        </a-menu>
                    </a-dropdown>
                    <a-dropdown class="mx-2">
                        <a class="font-sans tracking-wider text-gray-900 hover:text-gray-900" href="#">  <a-icon :style="{ padding: '0', fontSize: '20px'}" type="bank" /> </a>
                        <a-menu slot="overlay">
                            <a-menu-item>
                                <a href="javascript:;">Dates</a>
                            </a-menu-item>
                        </a-menu>
                    </a-dropdown>
                    <a-dropdown class="mx-2">
                        <a class="font-sans tracking-wider text-gray-900 hover:text-gray-900" href="#">  <a-icon :style="{ padding: '0', fontSize: '20px'}" type="flag" /> </a>
                        <a-menu slot="overlay">
                            <a-menu-item>
                                <a href="javascript:;">Dates</a>
                            </a-menu-item>
                        </a-menu>
                    </a-dropdown>
                </div>
                <div class="w-2/12 p-2">
                    <a-button @click="newagreementmodal = true">
                        New Agreement
                    </a-button>
                </div>
            </div>               
        </div>
        <a-table :columns = "columns" :dataSource = "agreements" style="width: 97vw" class="mx-auto">
            <a slot="action" slot-scope="text, record" @click="viewAgreements(record.id)">View</a>
            <div slot="expandedRowRender" slot-scope="record" style="margin: 0">
                <p class="font-xl font-semibold tracking-wider leading-loose"> 
                    Agreement Purpose
                </p>
                <p class="w-2/3">
                    {{record.purpose}}
                </p>
            </div>
        </a-table>
    </div>
</template>

<script>
import NewAgreement from './NewAgreementComponent.vue'
export default {
    components: {
        'newagreement': NewAgreement
    },
    data() {
        return {
            newagreementmodal: false,
            searchTerm: '',
            agreements: [],
            error: '',
            columns : [
                {
                    title: 'ID',
                    dataIndex: 'id',
                    key: 'id'
                },
                {
                    title: 'Title',
                    dataIndex: 'title',
                    key: 'title'
                },
                {
                    title: 'type',
                    dataIndex: 'type',
                    key: 'key'
                },
                {
                    title: 'Start Date',
                    dataIndex: 'startdate',
                    key: 'startdate'
                },
                {
                    title: 'End Date',
                    dataIndex: 'enddate',
                    key: 'enddate'
                },
                { 
                    title: 'Action', 
                    dataIndex: '', key: 'x', 
                    scopedSlots: { customRender: 'action' } 
                },
            ]
        }
    },
    mounted(){
        // Fetch agreements
        axios({
            method: 'get',
            url: 'api/agreements',
        }).then((response)=>{
            this.agreements = response.data.data
            // Push data to store
            this.$store.dispatch('fetchAgreements', response.data)
        }).catch((error)=>{
            this.error = error
        })
    },
    methods: {
        viewAgreements(id){
            this.$router.push( {name: 'agreementview', params: {id: id} })
        }
    }
}
</script>