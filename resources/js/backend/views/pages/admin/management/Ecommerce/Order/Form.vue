<template>
    <div>
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">{{ param_id ? 'Update' : 'Create' }} new {{ route_prefix }}</h5>
                    <div>
                        <router-link v-if="item.slug" class="btn btn-outline-info mr-2 btn-sm"
                            :to="{ name: `Details${route_prefix}`, params: { id: item.slug } }">
                            Details {{ route_prefix }}
                        </router-link>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${route_prefix}` }">
                            All {{ route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row"  style="row-gap: 30px;">
                                <div class="col-md-4">
                                    <label>
                                        Customer Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" :value="order?.order_address?.first_name" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Division
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" value="dhaka" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        District
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" value="dhaka" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Phone Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" :value="order?.address?.mobile_number" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label>
                                        Address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea type="text" :value="order?.address?.address"
                                        class="form-control"></textarea>
                                </div>
                            </div>

                            <hr class="my-4" />
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <input type="search" class="form-control" placeholder="Search Products">
                                </div>
                            </div>
                            <hr class="my-4" />

                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th class="text-center">Discount</th>
                                                <th>D.Price</th>
                                                <th style="width: 120px;" class="text-center">Qty</th>
                                                <th class="text-right" style="width: 120px;">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="product in 3" :key="product">
                                                <td>
                                                    <i class="fa fa-trash"></i>
                                                </td>
                                                <td>
                                                    asdfasdf
                                                </td>
                                                <td>
                                                    234
                                                </td>
                                                <td class="text-center">
                                                    <div style="gap: 10px;"
                                                        class="d-flex justify-content-center align-items-center">
                                                        <input :value="0" type="text" class="form-control text-center"
                                                            style="max-width: 80px;">
                                                        <span>
                                                            %
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                   234
                                                </td>
                                                <td class="text-center">
                                                    <input :value="product.qty" type="text"
                                                        class="form-control text-center" style="max-width: 80px;">
                                                </td>
                                                <td class="text-right">
                                                   234 * 234
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot class="text-end text-right">
                                            <tr>
                                                <td colspan="5" class="border-0"></td>
                                                <td class="border-top-md">Sub Total</td>
                                                <td class="border-top-md">2342</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="border-0"></td>
                                                <td>Delivery Charge</td>
                                                <td>
                                                    <input type="text" :value="100" class="form-control text-right"
                                                        style="width: 80px;">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="border-0"></td>
                                                <td>Total</td>
                                                <td class="text-info font-weight-bold">
                                                    234
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="border-0"></td>
                                                <td>Paid</td>
                                                <td class="text-warning font-weight-bold">
                                                   234
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="border-0"></td>
                                                <td>Due</td>
                                                <td>0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <hr class="my-4" />


                            <div class="form-group mt-5 text-center">
                                <button type="submit" class="btn btn-light btn-square px-5">
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
import { mapActions, mapState } from 'pinia'
import { store } from './setup/store';
import setup from "./setup";
import form_fields from "./setup/form_fields";

export default {
    data: () => ({
        route_prefix: '',
        form_fields,
        param_id: null,
    }),
    created: async function () {
        let id = this.param_id = this.$route.params.id;
        this.route_prefix = setup.route_prefix;

        this.reset_fields();

        if (id) {
            this.set_fields(id);
        }
    },
    methods: {
        ...mapActions(store, {
            create: 'create',
            update: 'update',
            details: 'details',
        }),
        reset_fields: function () {
            this.form_fields.forEach((item) => {
                item.value = "";
            });
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
                    this.$router.push({ name: `Details${this.route_prefix}` });
                }
            } else {
                let response = await this.create($event);
                if ([200, 201].includes(response.status)) {
                    window.s_alert("data created");
                    this.$router.push({ name: `All${this.route_prefix}` });
                }
            }
        },
    },

    computed: {
        ...mapState(store, {
            item: "item",
        }),
    },
}
</script>
