<template lang="">
    <div>
        <div class="row" style="row-gap: 30px;">
            <div class="col-12">
                <h4>Attributes</h4>
            </div>
            <div class="col-md-12">
                <label>
                    Category
                    <span class="text-danger">*</span>
                </label>
                <div>
                    <categoryDropDown
                        :value="item?.product_categories"
                        :name="'categories'"
                        :multiple="true"/>
                </div>
            </div>
            <div class="col-md-4">
                <label for="type">
                    Product Group
                    <span class="text-danger">*</span>
                </label>
                <div id="type">
                    <!-- <select name="product_category_group_id" id="product_category_group_id" class="form-control">
                        <option value="">--select product type--</option>
                        <option value="3">
                            ইলেক্ট্রনিক্স ও যন্ত্রপাতি
                        </option>
                        <option value="1">
                            মেডিসিন
                        </option>
                    </select> -->
                    <CategoryGroupDropDown
                        :value="item?.product_category_group ? [item?.product_category_group] : []"
                        :name="`product_category_group_id`"
                        :multiple="false" />
                </div>
            </div>
            <div class="col-md-4">
                <label>
                    Brand
                    <span class="text-danger">*</span>
                </label>
                <div class="no_pagination">
                    <BrandDropDown
                        :value="item?.product_brand ? [item?.product_brand] : []"
                        :name="`product_brand_id`"
                        :multiple="false" />
                </div>
            </div>
            <div class="col-md-4">
                <label>
                    Manufacturer
                </label>
                <div class="no_pagination">
                    <ManufactureDropDown
                        :value="item?.product_menufecturer? [item.product_menufecturer] : []"
                        :name="`product_menufecturer_id`"
                        :multiple="false"/>
                </div>
            </div>
            <div class="col-md-4">
                <label for="product_unit_id">
                    Unit
                    <span class="text-danger">*</span>
                </label>
                <div>
                    <select name="product_unit_id" id="product_unit_id" :value="item.product_unit_id" class="form-control">
                        <option value="">--select unit--</option>
                        <option v-for="unit in units" :selected="unit.title=='peice'" :value="unit.id" :key="unit.id">
                            {{ unit.title }}
                        </option>
                    </select>
                </div>
                <!-- <UnitDropDown :name="`product_unit_id`" /> -->
            </div>

            <div class="col-md-4">
                <label for="product_unit_multiplier">
                    Unit Multiplier
                </label>
                <div>
                    <input type="text" name="product_unit_multiplier" id="product_unit_multiplier" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label>
                    SKU
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label>
                    Barcode
                    <span class="text-danger">*</span>
                </label>
                <div>
                    <input type="text" @change="extractNumberFromString"
                        :value="latest_bar_code"
                        name="barcode" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label>
                    Weight (gm)
                </label>
                <div>
                    <input type="text" name="weight" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label for="width">
                    Width (in)
                </label>
                <div>
                    <input type="text" name="width" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label for="height">
                    Height (in)
                </label>
                <div>
                    <input type="text" name="height" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label for="alert_quantity">
                    Alert Quantity
                    <span class="text-danger">*</span>
                </label>
                <div>
                    <input type="text" value="10" name="alert_quantity" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label for="seller_points">
                    Seller Point
                </label>
                <div>
                    <input type="text" name="seller_points" class="form-control">
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import categoryDropDown from "../../Category/components/dropdown/DropDownEl.vue"
import BrandDropDown from "../../Brand/components/dropdown/DropDownEl.vue"
import UnitDropDown from "../../Unit/components/dropdown/DropDownEl.vue"
import ManufactureDropDown from "../../Manufacture/components/dropdown/DropDownEl.vue"
import CategoryGroupDropDown from "../../CategoryGroup/components/dropdown/DropDownEl.vue"
import { mapState, mapWritableState } from 'pinia'
import {store} from '../setup/store'
export default {
    components: {
        categoryDropDown,
        BrandDropDown,
        UnitDropDown,
        ManufactureDropDown,
        CategoryGroupDropDown,
    },
    data: ()=>({
        units: [],
    }),
    watch: {
        'item': {
            handler: function(v){
                this.product_description= v.description;
                this.warranty_policy= v.warranty_policy;
                this.guarenty_policy= v.guarenty_policy;
                this.latest_bar_code = v.barcode;
            }
        }
    },
    methods: {
         extractNumberFromString: function() {
            let input = event.target.value;
            let numericString = input.replace(/\D/g, '');
            let barcode = numericString ? parseInt(numericString, 10) : this.latest_bar_code;
            event.target.value = barcode;
        }
    },
    mounted: function(){
        axios.get('/all-product-units')
            .then(res=>{
                this.units = res.data;
            })
    },
    computed: {
        ...mapWritableState(store, {
            item: "item",
            is_loading: 'is_loading',
            latest_bar_code: "latest_bar_code",
        }),
    }
}
</script>
<style lang="">

</style>
