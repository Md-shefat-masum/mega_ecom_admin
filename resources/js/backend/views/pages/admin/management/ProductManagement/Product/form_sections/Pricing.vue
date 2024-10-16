<template lang="">
    <div>
        <div class="row" style="row-gap: 30px;">
            <div class="col-12">
                <h4>Pricing</h4>
            </div>
            <div class="col-md-4">
                <label for="price_type">
                    Price Type
                    <span class="text-danger">*</span>
                </label>
                <select class="form-control" name="price_type" id="price_type">
                    <option value="single">Single</option>
                    <option value="varient">Varient</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="purchase_price">
                    Purchase Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" v-model="price.purchase_price" name="purchase_price" id="purchase_price" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="tax_type">
                    Tax Type
                    <span class="text-danger">*</span>
                </label>
                <select class="form-control" name="tax_type" id="tax_type">
                    <option value="inclusive">inclusive</option>
                    <option value="exclusive">exclusive</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>
                    Tax
                </label>
                <input type="text" v-model="price.tax_amount" name="tax_amount" id="tax_amount" class="form-control">
            </div>

            <div class="col-md-4">
                <label for="profit_margin_percent">
                    Profit Margin(%)
                    <span class="text-danger">*</span>
                </label>
                <input type="text"
                    v-model="price.profit_margin_percent"
                    name="profit_margin_percent"
                    id="profit_margin_percent"
                    class="form-control">
            </div>

            <div class="col-md-4">
                <label>
                    Product Price
                </label>
                <input type="text"
                    :value="product_price"
                    name="product_price" id="product_price" class="form-control">
            </div>

            <div class="col-md-4">
                <label>
                    Minimum Sales Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" :value="product_price" name="minimum_sale_price" id="minimum_sale_price" class="form-control">
            </div>
            <div class="col-md-4">
                <label>
                    Maximum Sales Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" :value="product_price" name="maximum_sale_price" id="maximum_sale_price" class="form-control">
            </div>

            <div class="col-md-4" v-for="group in customer_groups" :key="group.id">
                <label for="retailer_sales_price">
                    {{group.title}} Sales Price
                    <span class="text-danger">*</span>
                </label>
                <input type="hidden" :name="`sales_price_title[${group.id}]`" :value="group.title" />
                <input type="text"
                    :value="get_customer_group_price(group.id)"
                    :name="`sales_price[${group.id}]`"
                    :id="`${group.id}_sales_price`"
                    class="form-control">
            </div>

            <!-- <div class="col-md-4">
                <label for="retailer_sales_price">
                    B2B Sales Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" :value="product_price" name="retailer_sales_price" id="retailer_sales_price" class="form-control">
            </div> -->

            <!-- <div class="col-md-4">
                <label for="customer_sales_price">
                    B2C Sales Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" :value="product_price" name="customer_sales_price" id="customer_sales_price" class="form-control">
            </div> -->

            <!--
            <div class="col-12"></div>
            <div class="col-md-4">
                <label>
                    B2B Min Order Quantity
                </label>
                <div>
                    <input type="text" name="b2b_min_qty" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label>
                    B2B Max Order Quantity
                </label>
                <div>
                    <input type="text" name="b2b_max_qty" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label>
                    B2C Min Order Quantity
                </label>
                <div>
                    <input type="text" name="b2c_min_qty" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label>
                    B2C Max Order Quantity
                </label>
                <div>
                    <input type="text" name="b2c_max_qty" class="form-control">
                </div>
            </div> -->
        </div>
    </div>
</template>
<script>
import { mapState } from 'pinia';
import { store } from "../setup/store";
export default {
    data: () => ({
        price: {},
        customer_groups: [],
    }),
    created: function(){
        this.get_customer_groups();
    },
    watch: {
        'item': {
            handler: function (v) {
                this.price = v;
            },
            deep: true,
        }
    },
    computed: {
        ...mapState(store, {
            item: "item",
            is_loading: "is_loading",
        }),
        product_price: function () {
            let price = (+this.price.tax_amount || 0) + (+this.price.purchase_price || 0);
            let profit = price * +this.price.profit_margin_percent / 100;
            return Math.round(price + profit);
        }
    },
    methods: {
        get_customer_groups: function(){
            axios.get('user-customer-types?get_all=1')
                .then(res=>{
                    this.customer_groups = res.data.data;
                })
        },
        get_customer_group_price: function(group_id){
            // console.log()
            try{
                return this.price.customer_group_prices.find(i=>i.user_customer_type_id == group_id).price;
            }catch(error){
                return this.product_price;
            }
        }
    }
}
</script>
<style lang="">

</style>
