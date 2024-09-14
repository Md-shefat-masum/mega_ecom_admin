<template>
    <div>
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">Sales Order Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row" style="row-gap: 30px;">
                                <div class="col-md-4">
                                    <label>
                                        Customer Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input readonly type="text" :value="orderInfo?.delivery_address_details?.user_name"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Division
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input readonly type="text" :value="orderInfo?.delivery_address_details?.division_name"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        District
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input readonly type="text" :value="orderInfo?.delivery_address_details?.district_name"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Station
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input readonly type="text" :value="orderInfo?.delivery_address_details?.station_name"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Phone Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input readonly type="text" :value="orderInfo?.delivery_address_details?.phone"
                                        class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input readonly type="text" :value="orderInfo?.delivery_address_details?.email"
                                        class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label>
                                        Address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea readonly type="text" :value="orderInfo?.delivery_address_details?.address"
                                        class="form-control"></textarea>
                                </div>
                            </div>

                            <hr class="my-4" />
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <!-- <input readonly type="search" class="form-control" placeholder="Search Products"> -->
                                    <!-- <ProductDropDown :name="`product_ids`" /> -->
                                </div>
                                <h5>Order Product details</h5>
                            </div>
                            <hr class="my-4" />

                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th style="width: 120px;" class="text-center">Qty</th>
                                                <th class="text-right" style="width: 120px;">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="product in orderInfo?.order_products" :key="product">
                                                <td>
                                                    {{ product.id }}
                                                    <!-- <i class="fa fa-trash c-pointer"></i> -->
                                                </td>
                                                <td class="w-50">
                                                    {{ product.product_name.substr(0, 30) }}
                                                </td>
                                                <td>
                                                    {{ product.price }}
                                                </td>

                                                <td class="text-center">
                                                    {{ product.qty }}
                                                </td>

                                                <td class="text-right">
                                                    {{ product.total }}
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="text-end text-right">
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="border-top-md">Sub Total</td>
                                                <td class="border-top-md">{{ orderInfo?.subtotal }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td>Delivery Charge</td>
                                                <td>
                                                    <input  type="text" readonly :value="orderInfo.delivery_charge"
                                                        class="form-control text-right" style="width: 80px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td>Total</td>
                                                <td class="text-info font-weight-bold">
                                                    {{ orderInfo?.total }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td>Paid</td>
                                                <td class="text-warning font-weight-bold">
                                                    {{ orderInfo?.paid_amount }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td>Due</td>
                                                <td>{{ orderInfo?.total - orderInfo?.paid_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td>Status</td>
                                                <td class="m-0 p-0">
                                                    <select class="form-control my-2" name="order_status"
                                                        v-model="orderInfo.order_status">
                                                        <option value="pending">Pending</option>
                                                        <option value="accepted">Accepted</option>
                                                        <option value="processing">Processing</option>
                                                        <option value="on_the_way">On the way</option>
                                                        <option value="delivered">Delivered</option>
                                                        <option value="cancelled">Cancelled</option>
                                                    </select>
                                                </td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <hr class="my-4" />


                            <div class="form-group mt-5 text-center">
                                <button  type="submit" class="btn btn-light btn-square px-5">
                                    <i class="icon-login"></i>
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
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
import ProductDropDown from '../../ProductManagement/Product/components/dropdown/DropDownEl.vue'
import UserDropDown from '../../UserManagement/users/components/dropdown/DropDownEl.vue'
import axios from 'axios';

export default {
    components: {
        ProductDropDown,
        UserDropDown,
    },
    data: () => ({
        setup,
        route_prefix: '',
        param_id: null,
        orderInfo: {},
    }),
    created: async function () {
        let id = this.param_id = this.$route.params.id;
        this.route_prefix = setup.route_prefix;
        this.get_order_details(id);
    },
    methods: {
        ...mapActions(store, {
            update: 'update',
            details: 'details',
        }),
        get_order_details: async function (id) {
            let response = await axios.get('sales-ecommerce-orders/' + id);
            response = response.data.data;
            this.orderInfo = response;
            console.log(this.orderInfo);
        },

        submitHandler: async function ($event) {
            let formData = new FormData($event.target);
            let response = await axios.post('sales-ecommerce-orders/update/' + this.param_id, formData);
            if (response.data.status === "success") {
                window.s_alert(response.data.message);
            }
        },
    },


}
</script>
