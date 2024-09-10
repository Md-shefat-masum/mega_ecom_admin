<template lang="">
    <div>
        <div class="row" style="row-gap: 30px;">
            <div class="col-12">
                <h4>Inventory</h4>
            </div>
            <div class="col-md-4">
                <label>
                    Warehouse
                </label>
                <div>
                    <WeareHouseDropdown name="wear_house_id"/>
                </div>
            </div>
            <div class="col-md-4">
                <label for="openning_stock">
                    Opening Stock
                </label>
                <input name="openning_stock" id="openning_stock" type="text" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="low_stock">
                    Low Stock
                </label>
                <input type="text" name="low_stock" id="low_stock" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="product_warranty">
                    Product waranty ( days )
                </label>
                <input type="text" name="product_warranty" id="product_warranty" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="expiration_days">
                    Expire Date
                </label>
                <input type="date" name="expiration_days" id="expiration_days" class="form-control">
            </div>
        </div>
    </div>
</template>
<script>
import WeareHouseDropdown from "../../../Inventory/wearhouse/components/dropdown/DropDownEl.vue"
export default {
    components: {
        WeareHouseDropdown,
    }
}
</script>
<style lang="">

</style>
