import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        status: '',
        agreements: '',
        partners: '',
        analytics: {
            partnershipStats: {
                partners: '',
                countries: '',
                fields: '',
                agreements: '',
                types: ''
            }
        }
    },
    mutations: {
        // 
        loadAgreements(state, agreements){
            state.agreements = agreements
        },
        loadPartners(state, partners){
            state.partners = partners
        },
        loadAnalytics(state, analytics){
            state.analytics = analytics
        }
    },
    actions: {
        // 
        fetchAgreements({commit}, payload){
            return new Promise((resolve, reject)=>{
                commit('loadAgreements', payload)
                resolve()
            })
        },
        fetchPartners({commit}, payload){
            return new Promise((resolve, reject)=>{
                commit('loadPartners', payload)
                resolve()
            })
        },
        fetchAnalytics({commit}, payload){
            return new Promise((resolve, reject)=>{
                commit('loadAnalytics', payload)
                resolve()
            })
        }
    },
    getters: {
        // 
        analytics: (state)=>{
            return state.analytics
        },
        agreementsType: (state)=>{
            return state.analytics.partnershipStats.types
        },
        partnerFields: (state)=>{
            return state.analytics.partnershipStats.fields
        },
        partnerCountries: (state)=>{
            return state.analytics.partnershipStats.countries
        },
        agreements: (state)=>{
            return state.agreements.data
        },
        partners: (state)=>{
            return state.partners.data
        }
    }
})

export default store