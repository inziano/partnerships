<template>
    <div class="w-full h-full bg-white" style="">
        <a-modal centered mask closable :width="900" :footer="null" v-model="newpartnermodal">
            <newpartner class="w-4/5"></newpartner>
        </a-modal>
        <div class="w-full flex flex-wrap bg-white flex ">
            <div class="w-11/12 flex content-center">
                <a-row :gutter="16" >
                    <a-col :span="12">
                        <a-card :bordered="false" style="width: 150px">
                            <a-statistic title="Partners" :value="1128" style="margin-right: 50px"> </a-statistic>
                        </a-card>
                    </a-col>
                </a-row>
            </div>
        </div>
        <div class="w-full flex bg-white">
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
                    <a-button @click="newpartnermodal = true">
                        New Partner
                    </a-button>
                </div>
            </div>               
        </div>
        <div class="w-full p-2 flex flex-wrap justify-center content-center bg-white">
            <a-card class="bg-gray-100" v-for="partner in partners" :key="partner.id" @click="viewPartner(partner.id)" style="width: 49%; margin: 1px; ">
                <p class="w-full text-xl font-semibold">
                    {{partner.name}}
                </p>
                <p> 
                    {{partner.abbreviation}}
                </p>
                <div>
                    <li>
                        {{partner.address}}
                    </li>
                    <li>
                        {{partner.location}} | {{partner.country}}
                    </li>
                   
                </div>
                <template class="ant-card-actions" slot="actions">
                    <a-icon type="edit" key="edit" />
                    <a-icon type="ellipsis" key="ellipsis" />
                </template>
            </a-card>
        </div>
    </div>
</template>

<script>
import NewPartner from './NewPartnerComponent.vue'

export default {
    components: {
        'newpartner': NewPartner
    },
    data() {
        return {
            newpartnermodal: false,
            searchTerm: '',
            partners: [],
            noData: false,
            error: '',
        }
    },
    computed:{
        // Populated by partners
        partnerData(){
            return this.partners
        }
    },
    mounted(){

        axios({
            method: 'get',
            url: 'api/partners',
        }).then((response)=>{
            this.partners = response.data.data
            // Store data
            this.$store.dispatch('fetchPartners', response.data)
        }).catch((error)=>{
            this.error = error
        })
    },
    methods: {
        viewPartner(id){
            this.$router.push({name: 'partnerview', params: {id: id}})
        },

        onSearch(){
            let term = this.searcTerm

            axios({
                method: 'get',
                url: 'api/partners?search='+term, 
            }).then((response)=>{
                this.partners = response.data.data
                // Store data
            }).catch((error)=>{
                this.error = error
            })
        }
    },
    watch: {
        partnerData: function(){
            this.partnerData.length ? this.noData = false : this.noData = true

            console.log(this.noData)
        }
    }
}
</script>