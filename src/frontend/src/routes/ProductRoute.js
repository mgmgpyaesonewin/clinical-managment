import Products from '../components/Product/AllProducts.vue';
import EmptyView from '../components/EmptyRouterView.vue';
import DetailProduct from '../components/Patient/PatientDetail';

export const ProductRoute = {
    path: '/products', component: EmptyView,
    meta: { name: 'Products', link: '/products', requiresAuth: true },
    children: [
        {
            path: '', component: Products, name: 'all-products',
            meta: {
                name: 'All',
                link: '/products',
            }
        },
        {
            path: 'detail/:id', component: DetailProduct, name: 'patient-detail',
            meta: {
                name: 'PatientDetail',
                link: '',
            }
        },
    ]
};


