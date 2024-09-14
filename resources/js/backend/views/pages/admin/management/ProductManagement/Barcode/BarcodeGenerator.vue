<template>
    <div class="container">
        <div class="card" >
            <div class="card-header">
                <h4>Print Labels</h4>
            </div>
            <div class="card-body" style="min-height: 400px;">
                <div>
                    <div class="d-flex my-2">
                        <label style="width: 168px">Product</label>
                        <div class="flex-fill">
                            <ProductDropDown :call_back="get_selected_product" :multiple="false" />
                        </div>

                    </div>
                    <div class="d-flex gap-3 my-2">
                        <label style="width: 200px">Company</label>
                        <input v-model="company" class="form-control" />
                    </div>
                    <div class="d-flex gap-3 my-2">
                        <label style="width: 200px">Amount</label>
                        <input v-model="count" class="form-control" />
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-info mr-2" @click.prevent="generate_code">
                        generate code
                    </button>

                    <button @click.prevent="print_codes" class="btn btn-secondary">
                        Print
                    </button>
                </div>
                <div class="card_body_fixed_height" id="print_area" v-show="show">
                    <div v-for="i in count" :key="i" class="mb-3 text-center">
                        <div class="bg-white d-inline-block text-dark p-3" style="max-width: 250px;">
                            <div>{{ company }}</div>
                            <div>{{ product }}</div>
                            <div><b>Price:</b>৳{{ price }}</div>
                            <svg :id="`barcode${i}`"></svg>
                            <div>{{ label }}</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</template>

<script>
import ProductDropDown from "../Product/components/dropdown/DropDownEl.vue"
export default {
    components: {
        ProductDropDown,
    },
    data: ()=>({
        count: 100,
        label: '',
        price: '',
        product: "",
        company: "ETEK Enterprise",
        show: false,
    }),
    mounted: function () {

    },
    methods: {
        generate_code: function () {
            this.show = true;
            try {
                if(this.product && this.price){
                    for (let index = 1; index <= this.count; index++) {
                        JsBarcode("#barcode"+index, this.label, {
                            format: "CODE39",
                            lineColor: "#000",
                            width: 1,
                            height: 40,
                            displayValue: false
                        });
                    }
                }
            } catch (error) {
                console.log(error);
            }
        },
        print_codes: function(){
            $("#print_area").print(/*options*/);
        },
        get_selected_product: function(data){
            this.product = data.title;
            this.label = data.barcode;
            this.price = data.customer_sales_price;

            console.log(data);
        }
    }
}
</script>

<style></style>
