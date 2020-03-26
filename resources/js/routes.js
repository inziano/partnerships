import Router from 'vue-router'
import Dashboard from './components/DashboardComponent'
import Charts from './components/ChartsComponent'
import Agreements from './components/AgreementsComponent'
import Agreementview from './components/AgreementviewComponent'
import Partners from './components/PartnersComponent'
import Partnerview from './components/PartnerviewComponent'

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Dashboard,
            name: 'dashboard'
        },
        {
            path: '/agreements',
            component: Agreements,
            name: 'agreements'
        },
        {
            path: '/agreement',
            component: Agreementview,
            name: 'agreementview'

        },
        {
            path: '/partners',
            component: Partners,
            name: 'partners'
        },
        {
            path: '/partner',
            component: Partnerview,
            name: 'partnerview'
        }
    ]
})

export default router