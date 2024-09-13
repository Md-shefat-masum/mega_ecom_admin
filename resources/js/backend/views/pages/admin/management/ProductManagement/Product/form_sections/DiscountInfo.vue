<template lang="">
    <div>
        <div class="row" style="row-gap: 30px;">
            <div class="col-12">
                <h4>Discount Info</h4>
            </div>
            <div class="col-md-4">
                <label for="discount_type">
                    Discount Type
                </label>
                <select v-model="discount_type" name="discount_type" id="discount_type" class="form-control">
                    <option value="off">--no discount--</option>
                    <option value="percent">Percentage(%)</option>
                    <option value="flat">Fixed(TK)</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>
                    Discount Amount
                    <!-- <span class="text-danger">*</span> -->
                </label>
                <input type="text" v-model="discount_amount" name="discount_amount" id="discount_amount" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="retailer_discount_price">
                    Retailer Discount Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" :value="retailer_discount_price" name="retailer_discount_price" id="retailer_discount_price" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="customer_discount_price">
                    Customer Discount Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" :value="customer_discount_price" name="customer_discount_price" id="customer_discount_price" class="form-control">
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        discount_type: 'off',
        discount_amount: 0,
        retailer_discount_price: 0,
        customer_discount_price: 0,
    }),
    created: function(){
        this.$watch('discount_amount',function(){
            this.retailer_discount_price = this.get_retailer_discount_price();
            this.customer_discount_price = this.get_customer_discount_price();
        })
    },
    methods: {
        get_retailer_discount_price: function () {
            try{
                let retailer_el = document.getElementById('retailer_sales_price');
                if(retailer_el){
                    let retailer_price = +retailer_el.value;
                    console.log(retailer_price);

                    if (this.discount_type == 'flat') {
                        return retailer_price - this.discount_amount;
                    } else if (this.discount_type == 'percent') {
                        return retailer_price - (retailer_price * this.discount_amount / 100);
                    } else {
                        return retailer_price;
                    }
                }
            }catch(e){
                console.log(e);
            }
        },
        get_customer_discount_price: function () {
            try{
                let customer_el = document.getElementById('customer_sales_price');
                if(customer_el){
                    let customer_price = + customer_el.value;
                    if (this.discount_type == 'flat') {
                        return customer_price - this.discount_amount;
                    } else if (this.discount_type == 'percent') {
                        return customer_price - (customer_price * this.discount_amount / 100);
                    } else {
                        return customer_price;
                    }
                }
            }catch(e){
                console.log(e);
            }
        },
    }
}
</script>
<style lang="">

</style>
