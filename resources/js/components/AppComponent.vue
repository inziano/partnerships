<template>
    <div class="w-full h-full bg-gray-100 p-0" style="height:100vh">
        <nav class="flex items-center justify-between flex-wrap p-4" :class="{ 'bg-green-700': color, 'bg-green-700': transparent }">
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <span class="font-semibold font-sans text-xl tracking-wider text-white">Partnerships</span>
            </div>
            <div class="block lg:hidden">
                <button class="flex items-center px-3 py-2 border rounded text-white border-teal-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                </button>
            </div>
            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                <div class="text-sm lg:flex-grow">
               
                </div>
                <div>
                    <router-link to="/" class="inline-block text-sm font-semibold leading-loose tracking-wider px-4 py-2 leading-none text-white  hover:border-transparent hover:text-teal-500 mt-4 lg:mt-0">Overview</router-link>
                    <router-link to="/agreements" class="inline-block text-sm font-semibold leading-loose tracking-wider px-4 py-2 leading-none text-white  hover:border-transparent hover:text-teal-500 mt-4 lg:mt-0">Agreements</router-link>
                    <router-link to="/partners" class="inline-block text-sm font-semibold leading-loose tracking-wider px-4 py-2 leading-none text-white  hover:border-transparent hover:text-teal-500 mt-4 lg:mt-0">Partners</router-link>
                </div>
            </div>
        </nav>

        <div class="h-auto w-full p-2 bg-gray-100">
			<router-view></router-view>
		</div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            color: true,
            transparent: false
        }
    },
    created() {
       
    },
    mounted(){
        // Fetch store values 
        axios({
            method: 'get',
            url: '/api/analytics'
        }).then((response)=>{
            // some response 
            console.log(response)
        }).catch((error)=>{
            // Throw error codes, fail gracefully
        })
        // Listen to the analytics 
        Echo.channel('analytics').listen('Analytics', (e)=>{
            // Push analytics to store
            this.$store.dispatch('fetchAnalytics', e)
        })
    },
    watch: {
        // Watch route change and toggle navigation colo/transparency
        $route: function(to, from){
            to.name == 'dashboard' ? this.toggleColor() : this.toggleTransparency()
        }
    },
    methods: {
        // Toggle color
        toggleColor(){
            // change color
            this.color = true
            this.transparent = true

            console.log(this.color, this.transparent)
        },
        // Toggle transparency
        toggleTransparency(){
            // change color
            this.color = false
            this.transparent = true
            console.log(this.color, this.transparent)
        }
    }
}
</script>