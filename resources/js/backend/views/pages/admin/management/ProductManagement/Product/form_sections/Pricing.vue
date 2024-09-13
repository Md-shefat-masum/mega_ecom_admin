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
            <div class="col-md-4">
                <label for="retailer_sales_price">
                    Retailer Sales Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" :value="product_price" name="retailer_sales_price" id="retailer_sales_price" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="customer_sales_price">
                    Customer Sales Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" :value="product_price" name="customer_sales_price" id="customer_sales_price" class="form-control">
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: ()=>({
        price: {}
    }),
    computed: {
        product_price: function(){
            let price = (+this.price.tax_amount || 0) + (+this.price.purchase_price || 0);
            let profit = price * +this.price.profit_margin_percent / 100;
            return price + profit;
        }
    }
}
</script>
<style lang="">

</style>
