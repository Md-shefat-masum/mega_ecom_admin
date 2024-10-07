<template>
    <div class="container">
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">
                        Purchase
                    </h5>
                    <div>
                        <router-link v-if="item.slug" class="btn btn-outline-info mr-2 btn-sm"
                            :to="{ name: `Details${route_prefix}`, params: {id: item.slug} }">
                            Details {{ route_prefix }}
                        </router-link>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${route_prefix}` }">
                            All {{ route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">
                        <!-- <div class="col-md-6" v-for="(form_field, index) in form_fields" :key="index">
                            <common-input
                                :label="form_field.label"
                                :type="form_field.type"
                                :name="form_field.name"
                                :multiple="form_field.multiple"
                                :value="form_field.value"
                                :data_list="form_field.data_list" />
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_id">
                                    Product
                                </label>
                                <div class="mt-1 mb-3">
                                    <ProductModal :multiple="false" :name="`product_id`" />
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_id">Supplier</label>
                                <div class="mt-1 mb-3">
                                    <SupplierModal :multiple="false" :name="`supplier_id`" />
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bill_receipt_no">Receipt</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" 
                                        type="date" name="bill_receipt_no" id="bill_receipt_no">
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" 
                                        type="date" name="date" id="date">
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <div class="mt-1 mb-3">
                                    <input class="form-control form-control-square mb-2" 
                                        type="date" name="qty" id="qty">
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
import { mapActions, mapState } from 'pinia'
import { store } from './setup/store';
import setup from "./setup";
import form_fields from "./setup/form_fields";
import ProductModal from "../../ProductManagement/Product/components/dropdown/DropDownEl.vue"
import SupplierModal from "../../UserManagement/suppliers/components/dropdown/DropDownEl.vue"

export default {
    components: {
        ProductModal,
        SupplierModal,
    },
    data: () => ({
        route_prefix: '',
        form_fields,
        param_id: null,
        user_addresses: [],
    }),
    created: async function () {
        let id = this.param_id = this.$route.params.id;
        this.route_prefix = setup.route_prefix;
        this.reset_fields();
        
        if (id) {
            await this.set_fields(id);
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
                    this.$router.push({ name: `All${this.route_prefix}` });
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
