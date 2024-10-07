<template lang="">
    <div>
        <div class="row" style="row-gap: 30px;">
            <div class="col-12">
                <h4>Medicine Attributes</h4>
            </div>
            <div class="col-md-12">
                <label>
                    Medicine Generic
                </label>
                <div id="product_medicine_generic_id">
                    <GenericDropDown
                        :value="item?.medicine_generic? [item.medicine_generic] : []"
                        :name="'product_medicine_generic_id'"
                        :multiple="false"/>
                </div>
            </div>
            <div class="col-md-12">
                <label>
                    Medicine Form
                </label>
                <div id="product_medicine_form_id">
                    <FormDropDown
                        :value="item?.medicine_form? [item.medicine_form] : []"
                        :name="'product_medicine_form_id'"
                        :multiple="false"/>
                </div>
            </div>

            <div class="col-md-4">
                <label for="company">
                    Company
                </label>
                <div>
                    <CompanyDropDown
                        :value="item?.company? [item.company] : []"
                        :name="'product_company_id'"
                        :multiple="false"/>
                    <!-- <input type="text" id="company" name="company" class="form-control"> -->
                </div>
            </div>

            <div class="col-md-4">
                <label for="medicine_type">
                    Medicine Type
                </label>
                <div>
                    <select class="form-control" name="medicine_type" id="medicine_type">
                        <option value="">--select--</option>
                        <option v-for="type in types" :value="type" :key="type">
                            {{ type }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <label for="is_antibiotic">
                    IS Antibiotics
                </label>
                <div>
                    <select class="form-control" name="is_antibiotic" id="is_antibiotic">
                        <option selected value="0">no</option>
                        <option value="1">yes</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import GenericDropDown from "../../Generic/components/dropdown/DropDownEl.vue";
import FormDropDown from "../../Form/components/dropdown/DropDownEl.vue";
import CompanyDropDown from "../../Company/components/dropdown/DropDownEl.vue";
import UnitDropDown from "../../Unit/components/dropdown/DropDownEl.vue";
import { mapState } from "pinia";
import { store } from "../setup/store";
export default {
    components: {
        GenericDropDown,
        FormDropDown,
        UnitDropDown,
        CompanyDropDown,
    },
    data: () => ({
        units: [],
        types: [
            "Tablets",
            "Capsules",
            "Syrups",
            "Ointments",
            "Creams",
            "Lotions",
            "Injections",
            "Inhalers",
            "Suppositories",
            "Patches (Transdermal)",
            "Drops (Eye, Ear, Nose)",
            "Gels",
            "Powders",
            "Suspensions",
            "Elixirs",
            "Lozenges",
            "Topical Sprays",
            "Infusions",
            "Granules",
            "Emulsions",
        ],
    }),
    watch: {
        item: {
            handler: function (v) {},
        },
    },
    mounted: function () {
        axios.get("/all-product-units").then((res) => {
            this.units = res.data;
        });
    },
    computed: {
        ...mapState(store, {
            item: "item",
            is_loading: "is_loading",
        }),
    },
    methods: {
        set_base_unit: function () {
            let value = event.target.value;
            let b2b_sales_unit = document.querySelector(
                '[name="b2b_sales_unit"]'
            );
            let b2c_sales_unit = document.querySelector(
                '[name="b2c_sales_unit"]'
            );
            if (b2b_sales_unit) {
                b2b_sales_unit.value = value;
            }
            if (b2c_sales_unit) {
                b2c_sales_unit.value = value;
            }
        },

        set_base_multiplier: function () {
            let value = event.target.value;
            let b2b_unit_multiplier = document.querySelector(
                '[name="b2b_unit_multiplier"]'
            );
            let b2c_unit_multiplier = document.querySelector(
                '[name="b2c_unit_multiplier"]'
            );
            if (b2b_unit_multiplier) {
                b2b_unit_multiplier.value = value;
            }
            if (b2c_unit_multiplier) {
                b2c_unit_multiplier.value = value;
            }
        },
    },
};
</script>
<style lang="">
</style>
