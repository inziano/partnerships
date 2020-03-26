<template>
    <div class="bg-white h-full w-full">
        <p class="text-xl font-semibold tracking-wider leading-loose">
            Partner
        </p>
        <div class="w-2/3 mx-auto" v-for="partner in partner" :key="partner.id"> 
            <p class="text-xl font-normal tracking-wider leading-loose font-sans"> {{ partner.name }}</p>
            <p class="text-xs font-semibold tracking-wider font-serif mb-0"><span class="text-sm tracking-wide font-sans"> {{partner.location}} | {{partner.country}}</span> </p>
            <p class="text-xs font-semibold tracking-wider font-serif"><span class="text-sm tracking-wide font-sans uppercase"> {{partner.field}}</span> </p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            partners: [],
            id: this.$route.params.id
        }
    },
    computed: {
        partner(){
            let id = this.id
            return this.partners.filter((partner)=>{
                return partner.id === this.id
            })
        }
    },
    mounted(){
        this.partners = this.$store.getters.partners
    },
    methods: {
        
    }
}
</script>