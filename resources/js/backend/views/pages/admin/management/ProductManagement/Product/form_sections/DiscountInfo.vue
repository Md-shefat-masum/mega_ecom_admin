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
    }),
    computed: {
        retailer_discount_price: function () {
            let retailer_price = + document.getElementById('retailer_sales_price').value;
            if (this.discount_type == 'flat') {
                return retailer_price - this.discount_amount;
            } else if (this.discount_type == 'percent') {
                return retailer_price - (retailer_price * this.discount_amount / 100);
            } else {
                return retailer_price;
            }
        },
        customer_discount_price: function () {
            let customer_price = + document.getElementById('customer_sales_price').value;
            if (this.discount_type == 'flat') {
                return customer_price - this.discount_amount;
            } else if (this.discount_type == 'percent') {
                return customer_price - (customer_price * this.discount_amount / 100);
            } else {
                return customer_price;
            }
        },
    }
}
</script>
<style lang="">

</style>
