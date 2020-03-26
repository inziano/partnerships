<template>
    <div class="w-full h-full bg-white">
        <p class="text-xl font-semibold tracking-wider leading-loose">
            Agreement
        </p>
        <div class="w-2/3 mx-auto" v-for="agreement in agreement" :key="agreement.id"> 
            <p class="text-xl font-normal tracking-wider leading-loose font-sans"> {{ agreement.title }}</p>
            <p class="text-xs font-semibold tracking-wider font-serif"> Duration : <span class="text-sm tracking-wide font-sans">{{agreement.startdate}} to {{ agreement.enddate}}</span> </p>

            <div class="">
                <p class="text-base font-semibold tracking-wider"> Purpose </p>
                <p class="text-base font-normal leading loose"> {{agreement.purpose}} </p>

                <p class="text-base font-semibold tracking-wider"> Contacts </p>
                <div class="flex flex-wrap p-2">
                    <a-card class="p-2 w-1/3" v-for="contact in agreement.contact" :key="contact.id">
                        <p> {{contact.firstname}} {{contact.lastname}} </p>
                        <p> {{contact.email}} | {{contact.phone}}</p>
                        <p> {{ contact.designation}}</p>
                        <p> {{contact.country}} </p>
                    </a-card>
                </div>
               
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            agreements: [],
            id: this.$route.params.id
        }
    },
    computed: {
        agreement(){
            let id = this.id
            return this.agreements.filter((agreement)=>{
                return agreement.id === this.id
            })
        }
    },
    mounted(){
        this.agreements = this.$store.getters.agreements
    },
    methods: {
        
    }
}
</script>