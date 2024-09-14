<template>
    <div>
        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">Details {{ setup.route_prefix }}</h5>
                    <div>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${setup.route_prefix}` }">
                            All {{ setup.route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body card_body_fixed_height">
                    <div class="row">
                        <div class="col-lg-4">
                            <img :src="load_image(item.product_image?.url)" class="mb-3 img-fluid img-thumbnail" />
                            <ul style="display: flex; gap: 10px; flex-wrap:wrap;">
                                <li style="width: 100px;" v-for="image in item.product_images" :key="image.id">
                                    <img :src="load_image(image?.url)" class="img-fluid img-thumbnail" />
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-8">
                            <div v-for="(field, key) in Object.keys(product_fields) " :key="key" class="mb-4">
                                <h4>{{field.replace(/_/g, ' ')}}</h4>
                                <template v-if="product_fields[field].length">
                                    <table class="table quick_modal_table">
                                        <tbody>
                                            <tr v-for="(key_name, index) in product_fields[field]" :key="index">
                                                <th style="width: 200px;">
                                                    {{key_name.replace(/_/g, ' ')}}
                                                </th>
                                                <th>:</th>
                                                <th>
                                                    <div v-if="!key_name.includes('is_')">
                                                        {{ item[key_name] }}
                                                    </div>
                                                    <div v-else>
                                                        <input type="checkbox" :checked="+item[key_name]" class="form-check-input" />
                                                    </div>
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </template>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Short Description</h3>
                                </div>
                                <div class="card-body">
                                    <table v-if="item.short_description" class="table">
                                        <tbody>
                                            <tr v-for="(point, index) in get_json(item.short_description)" :key="index">
                                                <td style="width: 200px;">{{ point.key }}</td>
                                                <td>{{ point.value }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Specifications</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table" v-if="item.specification">
                                        <tbody>
                                            <template v-for="(item, index) in get_json(item.specification)" :key="index">
                                                <tr>
                                                    <th colspan="2">
                                                        {{ item.heading }}
                                                    </th>
                                                </tr>
                                                <tr v-for="(value, value_index) in item.values" :key="value_index">

                                                    <td style="width: 300px;">
                                                        {{ value.key }}
                                                    </td>
                                                    <td>
                                                        {{ value.value }}
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Product Description</h3>
                                </div>
                                <div class="card-body">
                                    <div v-html="item.description"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Guaranty Policy</h3>
                                </div>
                                <div class="card-body">
                                    <div v-html="item.guarenty_policy"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Waranty Policy</h3>
                                </div>
                                <div class="card-body">
                                    <div v-html="item.warranty_policy"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <router-link class="btn btn-outline-warning btn-sm"
                        :to="{
                            name: `Edit${setup.route_prefix}`,
                            params: { id: item.slug}
                        }">
                        Edit {{ setup.route_prefix }}
                    </router-link>

                    <a href="" v-if="item.prev_slug" @click.prevent="get_data(item.prev_slug)" class="btn btn-secondary btn-sm ml-2">
                        <i class="fa fa-angle-left"></i>
                        Previous {{ setup.route_prefix }} ({{ item.prev_count }})
                    </a>

                    <a href="" v-if="item.next_slug" @click.prevent="get_data(item.next_slug)" class="btn btn-secondary btn-sm ml-2">
                        Next {{ setup.route_prefix }} ({{ item.next_count }})
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { mapActions, mapState, mapWritableState } from 'pinia'
import { store } from './setup/store';
import setup from "./setup";
import product_fields from "./setup/product_fields";

export default {
    data: () => ({
        setup,
        product_fields: product_fields,
    }),
    created: async function () {
        let id = this.param_id = this.$route.params.id;
        await this.get_data(id);
    },
    methods: {
        ...mapActions(store, {
            details: 'details',
        }),
        get_data: async function(slug){
            this.item = {};
            await this.details(slug)
        },
        get_json: function(data){
            try {
                return JSON.parse(data)
            } catch (error) {
                return data
            }
        }
    },
    computed: {
        ...mapWritableState(store, {
            item: "item",
        }),
    },
}
</script>

<style scoped>
    h1,h2,h3,h4,h5,h6{
        font-size: 22px;
    }
</style>

