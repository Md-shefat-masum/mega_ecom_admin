<template lang="">
    <div>
        <div class="row" style="row-gap: 30px;">
            <div class="col-12">
                <h4>Product Discount Info</h4>
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
                <input type="number" v-model="discount_amount" name="discount_amount" id="discount_amount" class="form-control">
            </div>
            <!-- <div class="col-md-4">
                <label for="discount_price">
                    Discount Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" :value="discount_price" name="discount_price" id="discount_price" class="form-control">
            </div> -->
        </div>

        <!-- <div class="row mt-5" style="row-gap: 20px;">
            <div class="col-12">
                <h4>B2B Discount Info</h4>
            </div>
            <div class="col-md-4">
                <label for="b2b_discount_type">
                    Discount Type
                </label>
                <select v-model="b2b_discount_type" name="b2b_discount_type" id="b2b_discount_type" class="form-control">
                    <option value="off">--no discount--</option>
                    <option value="percent">Percentage(%)</option>
                    <option value="flat">Fixed(TK)</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="b2b_discount_amount">
                    B2B Discount Amount
                </label>
                <input type="number" v-model="b2b_discount_amount" name="b2b_discount_amount" id="b2b_discount_amount" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="b2b_discount_price">
                    B2B Discount Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" :value="b2b_discount_price" name="b2b_discount_price" id="b2b_discount_price" class="form-control">
            </div>
        </div> -->

        <!-- <div class="row mt-5" style="row-gap: 20px;">
            <div class="col-12">
                <h4>B2C Discount Info</h4>
            </div>
            <div class="col-md-4">
                <label for="b2c_discount_type">
                    Discount Type
                </label>
                <select v-model="b2c_discount_type" name="b2c_discount_type" id="b2c_discount_type" class="form-control">
                    <option value="off">--no discount--</option>
                    <option value="percent">Percentage(%)</option>
                    <option value="flat">Fixed(TK)</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="b2c_discount_amount">
                    B2C Discount Amount
                </label>
                <input type="number" v-model="b2c_discount_amount" name="b2c_discount_amount" id="b2c_discount_amount" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="b2c_discount_price">
                    B2C Discount Price
                    <span class="text-danger">*</span>
                </label>
                <input type="text" :value="b2c_discount_price" name="b2c_discount_price" id="b2c_discount_price" class="form-control">
            </div>
        </div> -->

    </div>
</template>
<script>
import { mapState } from "pinia";
import { store } from "../setup/store";
export default {
    data: () => ({
        discount_type: "off",
        discount_amount: 0,
        discount_price: 0,

        b2b_discount_type: "off",
        b2b_discount_amount: 0,
        b2b_discount_price: 0,
        b2b_discount_price: 0,

        b2c_discount_type: "off",
        b2c_discount_amount: 0,
        b2c_discount_price: 0,
        b2c_discount_price: 0,
    }),
    watch: {
        item: {
            handler: function (v) {
                this.discount_type = v.discount_type;
                this.discount_amount = v.discount_amount;

                this.b2b_discount_type = v.b2b_discount_type;
                this.b2b_discount_amount = v.b2b_discount_amount;

                this.b2c_discount_type = v.b2c_discount_type;
                this.b2c_discount_amount = v.b2c_discount_amount;
            },
            deep: true,
        },
    },
    created: function () {
        this.$watch("discount_amount", function () {
            this.discount_price = Math.round(this.get_discount_price());
        });
        this.$watch("b2b_discount_amount", function () {
            this.b2b_discount_price = Math.round(this.get_b2b_discount_price());
        });
        this.$watch("b2c_discount_amount", function () {
            this.b2c_discount_price = Math.round(this.get_b2c_discount_price());
        });
    },
    methods: {
        get_discount_price: function () {
            try {
                let el = document.getElementById("product_price");
                if (el) {
                    let discount_price = +el.value;

                    if (this.discount_type == "flat") {
                        return discount_price - this.discount_amount;
                    } else if (this.discount_type == "percent") {
                        return (
                            discount_price -
                            (discount_price * this.discount_amount) / 100
                        );
                    } else {
                        return discount_price;
                    }
                }
            } catch (e) {
                console.log(e);
            }
        },
        get_b2b_discount_price: function () {
            try {
                let el = document.getElementById("retailer_sales_price");
                if (el) {
                    let b2b_discount_price = +el.value;

                    if (this.b2b_discount_type == "flat") {
                        return b2b_discount_price - this.b2b_discount_amount;
                    } else if (this.b2b_discount_type == "percent") {
                        return (
                            b2b_discount_price -
                            (b2b_discount_price * this.b2b_discount_amount) / 100
                        );
                    } else {
                        return b2b_discount_price;
                    }
                }
            } catch (e) {
                console.log(e);
            }
        },
        get_b2c_discount_price: function () {
            try {
                let el = document.getElementById("customer_sales_price");
                if (el) {
                    let b2c_discount_price = +el.value;

                    if (this.b2c_discount_type == "flat") {
                        return b2c_discount_price - this.b2c_discount_amount;
                    } else if (this.b2c_discount_type == "percent") {
                        return (
                            b2c_discount_price -
                            (b2c_discount_price * this.b2c_discount_amount) / 100
                        );
                    } else {
                        return b2c_discount_price;
                    }
                }
            } catch (e) {
                console.log(e);
            }
        },
    },
    computed: {
        ...mapState(store, {
            item: "item",
            is_loading: "is_loading",
        }),
    },
};
</script>
<style lang="">
</style>
