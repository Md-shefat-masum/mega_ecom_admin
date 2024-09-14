
import TermsAndCondition from "./TermsAndCondition.vue";
import ReturnPolicy from "./ReturnPolicy.vue";
import ShipingAndDelivery from "./ShipingAndDelivery.vue";
import BreakingNews from "./BreakingNews.vue";
import FeatureProducts from "./FeatureProduct.vue";
import HideProducts from "./HideProduct.vue";
import FeatureCategory from "./FeatureCategory.vue";
import HideCategory from "./HideCategory.vue";
import OfferProduct from "./OfferProduct.vue";
import Layout from "./Layout.vue";


const routes =
{
    path: 'pages',
    component: Layout,
    children: [
        {
            path: 'terms-and-condition',
            name: "TermsAndCondition",
            component: TermsAndCondition,
        },
        {
            path: 'return-policy',
            name: "ReturnPolicy",
            component: ReturnPolicy,
        },
        {
            path: 'shipping-and-delivery',
            name: "ShipingAndDelivery",
            component: ShipingAndDelivery,
        },
        {
            path: 'breaking-news',
            name: "BreakingNews",
            component: BreakingNews,
        },
        {
            path: 'feature-products',
            name: "FeatureProducts",
            component: FeatureProducts,
        },
        {
            path: 'hide-products',
            name: "HideProducts",
            component: HideProducts,
        },
        {
            path: 'feature-category',
            name: "FeatureCategory",
            component: FeatureCategory,
        },
        {
            path: 'hide-category',
            name: "HideCategory",
            component: HideCategory,
        },
        {
            path: 'discount-products',
            name: "OfferProduct",
            component: OfferProduct,
        },


    ]
};


export default routes;
