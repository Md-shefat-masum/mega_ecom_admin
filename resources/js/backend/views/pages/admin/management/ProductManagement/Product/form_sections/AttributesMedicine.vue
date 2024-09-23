<template lang="">
    <div>
        <div class="row" style="row-gap: 30px;">
            <div class="col-12">
                <h4>Medicine Attributes</h4>
            </div>
            <div class="col-md-12">
                <label>
                    Generic ID
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
                <label>
                    Strenth
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    Form
                    <span class="text-danger">*</span>
                </label>
                <div>
                    <select name="product_category_group_id" class="form-control">
                        <option value="">--select product type--</option>
                        <option value="3">
                            ইলেক্ট্রনিক্স ও যন্ত্রপাতি
                        </option>
                        <option value="1">
                            মেডিসিন
                        </option>
                    </select>
                    <!-- <CategoryGroupDropDown :name="`product_category_group_id`" :multiple="false" /> -->
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    generic name
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    Company
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    Manufacture
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    Medicine Type
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    IS Antibiotics
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    Vendor
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    Medicine Base Unit
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    Medicine B2B Sales Unit
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    Medicine B2C Sales Unit
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    Base Unit multiplier
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label>
                    B2B Unit multiplier
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <label>
                    B2C Unit multiplier
                </label>
                <div>
                    <input type="text" name="sku" class="form-control">
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
import { mapState } from 'pinia'
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
            }
        }
    },
    mounted: function(){
        axios.get('/all-product-units')
            .then(res=>{
                this.units = res.data;
            })
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
