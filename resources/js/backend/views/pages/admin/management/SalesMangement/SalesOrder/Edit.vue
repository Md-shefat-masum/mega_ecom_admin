<template>
    <div style="max-width: 1800px; margin: 0 auto;">
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">Sales Order</h5>
                    <div>
                        <router-link v-if="item.slug" class="btn btn-outline-info mr-2 btn-sm"
                            :to="{ name: `Details${setup.route_prefix}`, params: { id: item.slug } }">
                            Details Sales Order
                        </router-link>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${setup.route_prefix}` }">
                            All Sales Order
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height" v-if="Object.keys(item).length">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row" v-if="order" style="row-gap: 30px;">

                                <div class="col-md-4">
                                    <input type="hidden" name="source" value="pos">

                                    <label>
                                        Order ID
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" :value="latest_order_id" name="order_id" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Reference
                                    </label>
                                    <input type="text" :value="item.reference" name="reference" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Select Customer
                                        <span class="text-danger">*</span>
                                    </label>
                                    <UserDropDown :call_back="get_user_info" :name="`customer_id`" :value="[item.customer]" :multiple="false" />
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Select Wearhouse
                                        <span class="text-danger">*</span>
                                    </label>
                                    <ProductWearHuseDropDown :name="`product_wearhouse_id`" :value="[item.wearhouse]" :multiple="false" />
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Date
                                    </label>
                                    <input type="date" name="date" :value="new Date(item.date).toISOString().substring(0, 10)"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Due Date
                                    </label>
                                    <input type="date" name="due_date"
                                        :value="new Date(item.due_date).toISOString().substring(0, 10)" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Price Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select v-model="price_type" name="price_type" id="price_type" class="form-control">
                                        <option value="b2c" selected>customer</option>
                                        <option value="b2b">retailer</option>
                                        <option value="default">default</option>
                                    </select>
                                </div>
                            </div>

                            <div style="margin-top: 80px;"></div>
                            <hr class="my-4" />

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="mb-3">
                                            <!-- <input type="search" class="form-control" placeholder="Search Products"> -->
                                            <ProductDropDown :name="`product_ids`" />
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 20px;"></th>
                                                        <th>Name</th>
                                                        <th style="width: 180px;">Price</th>
                                                        <th class="text-center" style="width: 180px;">Discount</th>
                                                        <th style="width: 180px;">D.Price</th>
                                                        <th style="width: 120px;" class="text-center">Qty</th>
                                                        <th class="text-right" style="width: 120px;">
                                                            Total
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(product, index) in selected_items" :key="product.id">
                                                        <td>
                                                            <input type="hidden"
                                                                :name="`products[${index}][product_id]`"
                                                                :value="product.id">
                                                            <input type="hidden"
                                                                :name="`products[${index}][product_title]`"
                                                                :value="product.title">
                                                            <input type="hidden"
                                                                :name="`products[${index}][purchase_price]`"
                                                                :value="product.purchase_price">
                                                            <input type="hidden"
                                                                :name="`products[${index}][discount_type]`"
                                                                :value="`percentage`">

                                                            <i @click.prevent="remove_data(index)"
                                                                class="fa fa-trash btn btn-outline-danger"></i>
                                                        </td>
                                                        <td>
                                                            {{ product.title }}
                                                        </td>
                                                        <td>
                                                            {{ get_price_info(product) }}
                                                        </td>
                                                        <td class="text-center">
                                                            <div style="gap: 10px;"
                                                                class="d-flex justify-content-center align-items-center">
                                                                <input type="number"
                                                                    :name="`products[${index}][discount]`"
                                                                    @click="$event.target.select()"
                                                                    v-model="products_discount_list[product.id]"
                                                                    class="form-control text-center"
                                                                    style="max-width: 80px;">
                                                                <span>
                                                                    %
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <input type="hidden"
                                                                :name="`products[${index}][sales_price]`"
                                                                :value="calculate_price(product)">
                                                            {{ calculate_price(product) }}
                                                        </td>
                                                        <td class="text-center">
                                                            <input v-model="product.qty"
                                                                :name="`products[${index}][qty]`" type="number"
                                                                @click="$event.target.select()"
                                                                class="form-control text-center"
                                                                style="max-width: 130px;" />
                                                        </td>
                                                        <td class="text-right">
                                                            <input type="hidden" :name="`products[${index}][total]`"
                                                                :value="product.qty * calculate_price(product)">
                                                            {{ product.qty * calculate_price(product) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot class="text-end text-right">
                                                    <tr>
                                                        <td colspan="5" class="border-0"></td>
                                                        <td class="border-top-md">Sub Total</td>
                                                        <td class="border-top-md">
                                                            <input type="hidden" :value="sub_total" name="subtotal">
                                                            {{ sub_total }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="border-0"></td>
                                                        <td>Other Charge</td>
                                                        <td>
                                                            <input type="text" v-model="other_charge"
                                                                class="form-control text-right" style="width: 80px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="border-0"></td>
                                                        <td class="border-0">
                                                            <select class="form-control" name="discount_on_all_type"
                                                                v-model="discount_on_total_type">
                                                                <option value="fixed">Fixed</option>
                                                                <option value="percentage">Percentage</option>
                                                            </select>
                                                        </td>
                                                        <td>Discount On Total</td>
                                                        <td>
                                                            <input type="text" v-model="discount_on_total"
                                                                name="discount_on_all" class="form-control text-right"
                                                                style="width: 80px;">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="border-0"></td>
                                                        <td>Grand Total</td>
                                                        <td class="text-info font-weight-bold align-middle"
                                                            style="font-size: 20px;">
                                                            <input type="hidden" name="total" :value="total_price">
                                                            {{ total_price }}
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4" />

                            <div class="row" style="margin-top: 100px;">
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Payment</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="paid_amount">Amount</label>
                                                <input type="text" name="paid_amount" id="paid_amount" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="account_number">Account</label>
                                                <div>
                                                    <input type="hidden" name="account_id" :value="account_id">
                                                    <input type="hidden" name="account_head_id" :value="account_head_id">
                                                    <AccountNumberDropDown :callback="set_account" name="account_number" :multiple="false" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="trx_id">Transaction ID</label>
                                                <input type="text" name="trx_id" id="trx_id" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="payment_note">Payment Note</label>
                                                <div>
                                                    <textarea name="payment_note" id="payment_note" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Order Status Info</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="order_status">Order Status</label>
                                                <select name="order_status" id="order_status" :value="item.order_status" class="form-control">
                                                    <option value="pending">Pending</option>
                                                    <option value="accepted">Accepted</option>
                                                    <option value="processing">Processing</option>
                                                    <option value="on_the_way">On The Way</option>
                                                    <option value="delivered">Delivered</option>
                                                    <option value="cancelled">Cancelled</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="note">note</label>
                                                <textarea type="text" name="note" :value="item.note" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mt-3">Delivery Address</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="district">District</label>
                                                <input type="text" name="district" :value="user_info.district"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="police_station">Police Station</label>
                                                <input type="text" name="police_station" :value="user_info.police_station"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea type="text" name="address" :value="user_info.address"
                                                    class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="terms_and_condition">Invoice Terms and Conditions</label>
                                                <textarea type="text" name="terms_and_condition"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-light btn-square px-5">
                        <i class="icon-lock"></i>
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from 'pinia'
import { store } from './setup/store';
import { store as product_store } from '../../ProductManagement/Product/setup/store';
import setup from "./setup";
import form_fields from "./setup/form_fields";
import ProductDropDown from '../../ProductManagement/Product/components/dropdown/DropDownElManaged.vue'
import UserDropDown from '../../UserManagement/users/components/dropdown/DropDownEl.vue'
import ProductWearHuseDropDown from '../../Inventory/WearHouse/components/dropdown/DropDownEl.vue'
import AccountNumberDropDown from '../../AccountManagement/AccountNumber/components/dropdown/DropDownEl.vue'

export default {
    components: {
        ProductDropDown,
        UserDropDown,
        ProductWearHuseDropDown,
        AccountNumberDropDown,
    },
    data: () => ({
        setup,
        route_prefix: '',
        form_fields,
        param_id: null,
        order: {},
        price_type: 'b2c',
        user_info: {},

        latest_order_id: null,

        other_charge: 100,
        discount_on_total: 0,
        discount_on_total_type: 'fixed',

        products_discount_list: {},

        account_id: null,
        account_head_id: null,
    }),
    created: async function () {
        // this.get_latest_order_id();
        this.set_fields(this.$route.params.id);
    },
    watch: {
        selected_items: {
            handler: function (v) {
                v.forEach(product => {
                    this.products_discount_list[product.id] = this.get_product_discount_info(product);
                });
            }
        },
        item: {

            handler: function (item) {
                this.latest_order_id = item.order_id;
                this.price_type = item.price_type;
                this.reset_selected_managed_items(item.products);
                try {
                    this.user_info = JSON.parse(item.address);
                } catch (error) {
                }
            }
        }
    },
    methods: {
        ...mapActions(store, {
            create: 'create',
            update: 'update',
            details: 'details',
        }),
        ...mapActions(product_store, {
            reset_selected_managed_items: 'reset_selected_managed_items',
        }),
        get_latest_order_id: function () {
            axios.get('/sales-orders/latest-order-id')
                .then(res => {
                    this.latest_order_id = res.data.data;
                    this.create_latest_order_id();
                });

            /** crate a method take input as like ET1212423 , split the number an icrement 1 then merge with prefix */
        },
        create_latest_order_id: function () {
            let splited = this.latest_order_id.split('');
            let number = parseInt(splited.pop()) + 1;
            this.latest_order_id = splited.join('') + number.toString();
        },
        get_selected_product: function (values) {
            // this.selected_items = values;
            if (this.selected_items.length != values.length) {
                this.values.forEach(i => {
                    let check = this.default_data.find(si => si.id == i.id);
                    if (!check) {
                        this.remove_item(i)
                    }
                });
            }
        },
        set_fields: async function (id) {
            this.param_id = id;
            await this.details(id);
            if (this.item) {
                this.form_fields.forEach((field, index) => {
                    Object.entries(this.item).forEach((value) => {
                        if (field.name == value[0]) {
                            this.form_fields[index].value = value[1];
                        }
                    });
                });
            }
        },

        submitHandler: async function ($event) {
            if (this.param_id) {
                let response = await this.update($event);
                if ([200, 201].includes(response.status)) {
                    window.s_alert("data updated");
                    this.$router.push({ name: `Details${this.setup.route_prefix}` });
                }
            } else {
                let response = await this.create($event);
                if ([200, 201].includes(response.status)) {
                    window.s_alert("data created");
                    this.$router.push({ name: `All${this.setup.route_prefix}` });
                }
            }
        },

        calculate_price: function (item) {
            let discount_form_saved = this.products_discount_list[item.id];
            let discount_amount = this.validatePercentageInput(discount_form_saved);

            let price = this.get_price_info(item);
            let d_price = price;
            if (discount_amount > 0) {
                d_price = price - (price * (discount_amount / 100))
            }

            // console.log(d_price);

            return Math.round(d_price);
        },

        validatePercentageInput: function (inputValue) {
            const percentage = Number(inputValue);

            // Check if the input is a number, an integer, and within the range of 0-100
            if (
                !isNaN(percentage) && // Check if it's a number
                Number.isInteger(percentage) && // Check if it's an integer
                percentage >= 0 && // Check if it's greater than or equal to 0
                percentage <= 100 // Check if it's less than or equal to 100
            ) {
                return percentage;
            } else {
                return 0;
            }
        },

        remove_data: function (index) {
            this.selected_items.splice(index, 1);
        },

        get_price_info: function (product) {
            if (this.price_type == 'b2c') return product.customer_sales_price;
            if (this.price_type == 'b2b') return product.retailer_sales_price;
            if (this.price_type == 'default') return product.product_price;
        },

        get_product_discount_info: function (product) {
            let disocunt = 0;
            if (this.price_type == 'b2c') disocunt = product.b2c_discount_amount;
            if (this.price_type == 'b2b') disocunt = product.b2b_discount_amount;
            if (this.price_type == 'default') disocunt = product.discount_amount;
            return disocunt;
        },

        get_user_info: function (item) {
            return ;
            if (item) {
                var info = {
                    name: item.name,
                    email: item.email,
                    phone_number: item.phone_number,
                };
                if (item?.user_address?.length) {
                    let address = item?.user_address[0];
                    info = {
                        ...info,
                        address: address.address,
                        division: address.division?.name,
                        district: address.district?.name,
                        station: address.station?.name,
                    }
                }

                this.user_info = info;
            } else {
                this.user_info = {};
            }

        },

        set_account: function (item) {
            this.account_head_id = item.account_head_id;
            this.account_id = item.account_id;
        }
    },

    computed: {
        ...mapState(store, {
            item: "item",
        }),
        ...mapState(product_store, {
            selected_items: (state) => {
                return state.selected_managed_items?.product_ids || [];
            },
        }),
        sub_total: function () {
            let that = this;
            return this.selected_items?.reduce(function (t, i) {
                t += (i.qty * that.calculate_price(i));
                return t;
            }, 0);
        },
        total_price: function () {
            let dis = 0;
            let total = +this.sub_total + +this.other_charge;
            if (this.discount_on_total > 0) {
                if (this.discount_on_total_type == "percentage") {
                    if (this.discount_on_total < 0) this.discount_on_total = 0;
                    if (this.discount_on_total > 100) this.discount_on_total = 100;

                    dis = total * this.discount_on_total / 100;

                    if (dis < 0) dis = 0;
                }
                if (this.discount_on_total_type == "fixed") {
                    dis = this.discount_on_total
                }
            }
            return total - dis;
        }
    },
}
</script>