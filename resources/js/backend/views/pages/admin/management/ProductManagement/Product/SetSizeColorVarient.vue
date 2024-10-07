<template>
    <div class="container" style="max-width: 1400px">
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">Set Size and Color Product varient</h5>
                    <div>
                        <router-link
                            class="btn btn-outline-warning btn-sm"
                            :to="{ name: `All${setup.route_prefix}` }"
                        >
                            All {{ setup.route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">

                        <div class="col-12">
                            <label for="product_id">Select product</label>
                            <ProductDropdown :multiple="false" :call_back="get_product" :name="'product_id'"/>
                        </div>

                        <div class="col-md-12 py-4" v-if="product">
                            <label for="color">Select Size</label>

                            <div class="my-2" style="display: grid; grid-template-columns: repeat(auto-fit,100px);align-items: center;gap: 20px;">
                                <div class="pl-4 d-flex align-items-center"  v-for="size in sizes" :key="size.id">
                                    <input @change="push_size(size)" type="checkbox" :name="`size_${size.id}`" :id="`size_${size.id}`" class="form-check-input">
                                    <label class="ml-2 mb-0" :for="`size_${size.id}`">
                                        {{ size.title }}
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12 py-4" v-if="product">
                            <label for="color">Select Color</label>

                            <div class="my-2" style="display: grid; grid-template-columns: repeat(auto-fit,150px);align-items: center;;">
                                <div class="pl-4 d-flex align-items-center"  v-for="color in colors" :key="color.id">
                                    <input @change="push_color(color)" type="checkbox" :name="`color_${color.id}`" :id="`color_${color.id}`" class="form-check-input">
                                    <label class="ml-2 mb-0 d-flex align-items-center" :for="`color_${color.id}`">
                                        <span class="mr-2" :style="`height: 20px; width: 20px; background: ${color.value}`"></span>
                                        {{ color.title }}
                                    </label>
                                </div>
                            </div>

                        </div>


                        <div class="col-12 mt-5"></div>
                        <div class="col-md-12" v-if="product">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Set Quantity According to Colors </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Color</th>
                                                <th class="text-center" style="width: 200px;">Qty</th>
                                                <!-- <th class="text-center" style="width: 200px;">Price</th> -->
                                                <th class="text-center" style="width: 400px;">Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="variant in color" :key="variant.id">
                                                <td>
                                                    <input type="hidden" :value="product.id" :name="`color_varient_qty[${variant.id}][product_id]`">
                                                    <input type="hidden" :value="variant.product_varient_group?.id" :name="`color_varient_qty[${variant.id}][product_varient_group_id]`">
                                                    <input type="hidden" :value="variant.product_varient?.id" :name="`color_varient_qty[${variant.id}][product_varient_id]`">
                                                    <input type="hidden" :value="variant.id" :name="`color_varient_qty[${variant.id}][product_varient_value_id]`">
                                                    <input type="hidden" :value="variant.product_varient?.title" :name="`color_varient_qty[${variant.id}][varient_title]`">

                                                    {{ variant.title }}

                                                </td>
                                                <td>
                                                    <input :name="`color_varient_qty[${variant.id}][qty]`" type="number" class="form-control">
                                                </td>
                                                <!-- <td>
                                                    <input name="price" type="number" class="form-control">
                                                </td> -->
                                                <td>
                                                    <image-component :name="`color_varient_qty[${variant.id}][image][]`" :multiple="true" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 my-3"></div>

                        <div class="col-md-6" v-if="product">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="">Set Price According to Sizes</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th class="text-center" style="width: 200px;">Qty</th>
                                                <th class="text-center" style="width: 200px;">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="variant in size" :key="variant.id">
                                                <td>
                                                    <input type="hidden" :value="product.id" :name="`varient_size[${variant.id}][product_id]`">
                                                    <input type="hidden" :value="variant.product_varient_group?.id" :name="`varient_size[${variant.id}][product_varient_group_id]`">
                                                    <input type="hidden" :value="variant.product_varient?.id" :name="`varient_size[${variant.id}][product_varient_id]`">
                                                    <input type="hidden" :value="variant.id" :name="`varient_size[${variant.id}][product_varient_value_id]`">
                                                    <input type="hidden" :value="variant.product_varient?.title" :name="`varient_size[${variant.id}][varient_title]`">

                                                    {{ variant.title }}
                                                </td>
                                                <td>
                                                    <input :name="`varient_size[${variant.id}][qty]`" type="number" class="form-control">
                                                </td>
                                                <td>
                                                    <input :name="`varient_size[${variant.id}][price]`" type="number" class="form-control">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" v-if="product">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h5 class="">Combined Quantity</h5>
                                    <button type="button" @click="generateVariants" class="btn btn-primary">
                                        Generate Variants
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Size</th>
                                                <th class="text-center" style="width: 200px;">Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(variant, index) in variants" :key="variant.id">
                                                <td>
                                                    <input type="hidden" :value="product.id" :name="`varient_combinition[${index}][product_id]`">
                                                    <input type="hidden" :value="variant.color_id" :name="`varient_combinition[${index}][color_product_varient_value_id]`">
                                                    <input type="hidden" :value="variant.size_id" :name="`varient_combinition[${index}][size_product_varient_value_id]`">

                                                    {{ variant.combination }}
                                                </td>
                                                <td>
                                                    <input :name="`varient_combinition[${index}][qty]`" type="number" class="form-control">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
import { mapActions, mapState } from "pinia";
import { store } from "./setup/store";
import setup from "./setup";
import ProductDropdown from '../Product/components/dropdown/DropDownEl.vue'
import axios from 'axios';

export default {
    components: {
        ProductDropdown,
    },
    data: () => ({
        route_prefix: "",
        param_id: null,
        setup,
        colors: [],
        sizes: [],

        product: null,
        size: [],
        color: [],
        variants: [],
    }),

    created: async function () {
        this.route_prefix = setup.route_prefix;
        axios.get('/product-varient-values/varients-by-type?group=cloth&varient=color').then((res) => {
            this.colors = res.data.data;
        });
        axios.get('/product-varient-values/varients-by-type?group=cloth&varient=size').then((res) => {
            this.sizes = res.data.data;
        });
    },
    methods: {
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
            if (this.color.find((i)=>i.id==color.id)) {
                this.color= this.color.filter(i=>i.id != color.id);
            } else {
                this.color.push(color);
            }
        },
        push_size(size) {
            if (this.size.find((i)=>i.id==size.id)) {
                this.size= this.size.filter(i=>i.id != size.id);
            } else {
                this.size.push(size);
            }
        },

        get_product: function(data){
            this.product = data;
        },

        submitHandler: async function(){
            try {
                let res = await axios.post('/products/set-color-size-varient',new FormData(event.target));
                window.s_alert("varient update.");
            } catch (error) {
                window.s_alert('failed', 'error');
            }
        }
    },

    computed: {},
};
</script>
