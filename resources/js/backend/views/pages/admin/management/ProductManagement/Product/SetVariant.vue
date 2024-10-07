<template>
    <div class="container" style="max-width: 1400px">
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">Set Product varient</h5>
                    <div>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${setup.route_prefix}` }">
                            All {{ setup.route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">

                        <div class="col-12">
                            <label for="product_id">Select product</label>
                            <ProductDropdown :multiple="false" :call_back="get_product" :name="'product_id'" />
                        </div>

                        <div class="col-12 mt-4" v-if="product">
                            <label for="product_id">Select Varient Group</label>
                            <VariantGroupDropdown :multiple="false" :call_back="get_varient_group"
                                :name="'product_id'" />
                        </div>

                        <div class="col-12 mt-4" v-if="product_varient_group_id">
                            <label for="product_id">Select Varient</label>
                            <VariantDropdown :multiple="false" :call_back="get_varient" :name="'product_id'" />
                        </div>

                        <div class="col-12 mt-4" v-if="product_varient_id" :key="product_varient_id">
                            <label for="product_id">Select Varient Values</label>
                            <VariantValueDropdown :multiple="true" :call_back="get_varient_value"
                                :name="'product_id'" />
                        </div>

                        <div class="col-lg-12 mt-5">
                            <h4>Selected Varients</h4>
                            <table class="table">
                                <tbody>
                                    <tr v-for="(item, index) in selected_varients" :key="index">
                                        <td style="width: 40px;">
                                            <i class="fa fa-trash btn btn-sm btn-outline-danger" @click.prevent="delete_varient(index)"></i>
                                        </td>
                                        <td class="text-capitalize" style="width: 140px;">
                                            {{ item.title }}
                                        </td>
                                        <td style="width: 2px;">:</td>
                                        <td class="text-wrap">
                                            <span v-for="(value, value_index) in item.values" :key="value.id"
                                                class="p-1 border rounded-1 m-1">
                                                {{ value.title }}

                                                <i class="fa fa-close text-danger ms-2" @click.prevent="delete_varient_value(index, value_index)"></i>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-light btn-square px-5">
                        <i class="icon-login"></i>
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from "pinia";
import { store } from "./setup/store";
import { store as product_varient_store } from "../Variant/setup/store";
import { store as product_varient_value_store } from "../VariantValue/setup/store";
import setup from "./setup";
import ProductDropdown from '../Product/components/dropdown/DropDownEl.vue'
import VariantGroupDropdown from '../VariantGroup/components/dropdown/DropDownEl.vue'
import VariantDropdown from '../Variant/components/dropdown/DropDownEl.vue'
import VariantValueDropdown from '../VariantValue/components/dropdown/DropDownEl.vue'
import axios from 'axios';

export default {
    components: {
        ProductDropdown,
        VariantGroupDropdown,
        VariantDropdown,
        VariantValueDropdown,
    },
    data: () => ({
        route_prefix: "",
        param_id: null,
        setup,

        selected_varients: {},
        product: null,
    }),

    created: async function () {
        this.route_prefix = setup.route_prefix;
    },

    watch: {
        selected_varients: function (v) {
            console.log(v);
        }
    },
    methods: {
        ...mapActions(product_varient_store, {
            get_all_varients: 'get_all',
            set_only_latest_varients_data: 'set_only_latest_data',
        }),
        ...mapActions(product_varient_value_store, {
            get_all_varient_values: 'get_all',
            set_only_latest_varient_values_data: 'set_only_latest_data',
        }),
        generateVariants() {
            let variant = [];

            for (let i = 0; i < this.size.length; i++) {
                for (let j = 0; j < this.color.length; j++) {
                    variant.push({
                        combination: `${this.size[i]?.title} - ${this.color[j]?.title}`,
                        qty: 0,
                        price: 0,
                        size_id: this.size[i]?.id,
                        color_id: this.color[i]?.id,
                    });
                }
            }

            this.variants = variant;
        },

        push_color(color) {
            if (this.color.find((i) => i.id == color.id)) {
                this.color = this.color.filter(i => i.id != color.id);
            } else {
                this.color.push(color);
            }
        },
        push_size(size) {
            if (this.size.find((i) => i.id == size.id)) {
                this.size = this.size.filter(i => i.id != size.id);
            } else {
                this.size.push(size);
            }
        },

        get_product: function (data) {
            this.product = data;
        },

        get_varient_group: function (data) {
            this.set_only_latest_varients_data(true);
            this.product_varient_group_id = data.id;
            this.get_all_varients();
        },

        get_varient: function (data) {
            this.set_only_latest_varient_values_data(true);
            this.product_varient_id = data.id;
            this.get_all_varient_values();

            let varient = this.selected_varients[data.id];
            if (!varient) {
                this.selected_varients[data.id] = {
                    title: data.title,
                    product_varient_group_id: data.product_varient_group_id,
                    values: [],
                }
            }
        },

        get_varient_value: function (data) {
            let varient = this.selected_varients[data.product_varient_id];
            // console.log(varient);
            if (varient) {
                let check = varient?.values?.find(i => i.id == data.id);
                if (check) {
                    varient.values = varient?.values?.filter(i => i.id != data.id);
                } else {
                    varient.values.push({
                        id: data.id,
                        title: data.title,
                        product_varient_value_id: data.id,
                        product_varient_id: data.product_varient_id,
                        product_varient_group_id: data.product_varient_group_id,
                        product_id: this.product.id,
                    })
                }
            }
        },

        submitHandler: async function () {
            try {
                let res = await axios.post('/products/set-varient', { product_id: this.product.id, varients: this.selected_varients });
                window.s_alert("varient update.");
            } catch (error) {
                window.s_alert('failed', 'error');
            }
        },

        delete_varient: function(varient_id){
            delete this.selected_varients[varient_id];
            this.product_varient_id = null;
        },
        delete_varient_value: function(varient_id, varient_value_id){
            try {
                this.selected_varients[varient_id]['values'].splice(varient_value_id,1);
                this.product_varient_id = null;
            } catch (error) {
                
            }
        },
    },

    computed: {
        ...mapWritableState(product_varient_store, {
            product_varient_group_id: 'product_varient_group_id',
        }),
        ...mapWritableState(product_varient_value_store, {
            product_varient_id: 'product_varient_id',
        }),
    },
};
</script>
