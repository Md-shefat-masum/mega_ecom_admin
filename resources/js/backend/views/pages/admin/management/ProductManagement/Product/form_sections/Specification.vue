<template lang="">
    <div>
        <div class="mb-4">
            <h5>
                Specification
            </h5>
            <button type="button" @click="()=>(is_modify = false)" v-if="is_modify" class="btn btn-info btn-sm ml-3">Save</button>
            <button type="button" @click="()=>(is_modify = true)"  v-else class="btn btn-warning btn-sm ml-3">Modify</button>
        </div>
        <table class="table" v-show="is_modify">
            <thead>
                <tr>
                    <td></td>
                    <td>Key</td>
                    <td>Value</td>
                </tr>
            </thead>
            <tbody>
                <template v-for="(item, index) in specifications" :key="index">
                    <tr>
                        <th colspan="3">
                            <div class="d-flex align-items-start">
                                <i @click="remove(index)"
                                    class="fa fa-trash btn btn-sm btn-outline-danger mr-4"></i>

                                <input
                                    :name="`specification[${index}][heading]`"
                                    v-model="item.heading"
                                    type="text" class="ml-4 form-control flex-fill" />
                            </div>
                        </th>
                    </tr>
                    <tr v-for="(value, value_index) in item.values" :key="value_index">
                        <td style="width: 15px;">
                            <i @click="remove_sub_menu(index, value_index)" v-if="item.values.length > 1" class="fa fa-trash btn btn-sm btn-outline-danger"></i>
                        </td>
                        <td style="width: 300px;">
                            <input type="text" placeholder="eg: color"
                                :name="`specification[${index}][values][${value_index}][key]`"
                                v-model="value.key"
                                class="form-control">
                        </td>
                        <td>
                            <input type="text" placeholder="eg: red"
                                :name="`specification[${index}][values][${value_index}][value]`"
                                v-model="value.value"
                                class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <i @click.prevent="add_sub_menu(index)" class="fa fa-plus btn btn-sm btn-info"></i>
                        </td>
                    </tr>
                </template>
                <tr>
                    <th colspan="4">
                        <i @click.prevent="add" class="fa fa-plus btn btn-sm btn-info"></i>
                        new specification
                    </th>
                </tr>
                <tr>
                    <th colspan="4" class="text-center">
                        <button type="button" @click="()=>(is_modify = false)" v-if="is_modify" class="btn btn-success btn-sm ml-3">
                            Save Specification
                        </button>
                    </th>
                </tr>
            </tbody>
        </table>

        <table class="table" v-show="!is_modify">
            <tbody>
                <template v-for="(item, index) in specifications" :key="index">
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
</template>
<script>
import { mapState } from 'pinia';
import {store} from '../setup/store';
export default {
    data: () => ({
        specifications: [],
        is_modify: false,
    }),
    created: function () {
        this.add();
        this.add();
    },
    watch: {
        'item': {
            handler: function(v){
                this.specifications= this.get_json(v.specification);
            }
        }
    },
    methods: {
        add: function () {
            this.specifications.push({
                "heading": "heading",
                "values": [
                    {
                        "key": "color",
                        "value": "red"
                    },
                    {
                        "key": "size",
                        "value": "sm,lg,xl"
                    }
                ],
            });
        },
        add_sub_menu: function (index) {
            this.specifications[index].values.push({
                "key": "key",
                "value": "value"
            })
        },
        remove: function (index) {
            this.specifications.splice(index, 1);
        },
        remove_sub_menu: function (index, value_index) {
            this.specifications[index].values.splice(value_index, 1);
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
        ...mapState(store, {
            item: "item",
            is_loading: 'is_loading',
        }),
    }

}
</script>
<style lang="">

</style>
