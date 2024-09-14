<template>
    <div>
        <form @submit.prevent="submitHandler">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="row" style="row-gap: 30px;">
                                <div class="col-md-12" v-if="is_loaded">
                                    <div class="form-group mt-4">
                                        <label for="">Shiping and Delivery</label>
                                        <div class="mt-1 mb-3">
                                            <!-- <input class="form-control form-control-square mb-2" type="text"
                                        name="page_full_description" id="title"> -->
                                            <text-editor :set_value="set_value" :data_store="`page_full_description`"
                                                :default_data="page_full_description" />
                                            <div class="text_output" v-html="page_full_description"></div>
                                            <textarea class="d-none" name="description"
                                                :value="page_full_description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-5 text-center">
                                <button type="submit" class="btn btn-light btn-square px-5">
                                    <i class="icon-login"></i>
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</template>

<script>
export default {
    components: {

    },
    data: () => ({
        page_full_description: '',
        is_loaded: true,
    }),
    created: async function () {
        await this.get_all_terms_and_condition()
    },

    methods: {

        submitHandler: async function ($event) {
            let formData = new FormData($event.target);

            let response = await axios.post('website-configurations/set-shiping-and-delivery', formData);
            if (response.data.status == 'success') {
                window.s_alert("Data updated");
                this.get_all_terms_and_condition();
            }
        },

        set_value: function (state, value) {
            this[state] = value;
        },

        get_all_terms_and_condition: async function () {
            this.is_loaded = false
            let response = await axios.get('get-website-settings');
            if (response.data.status == 'success') {
                response.data.data.forEach(element => {
                    if (element.title == "shiping_and_delivery") {
                        this.page_full_description = element.setting_values[0].value;
                    }
                })
            }
            this.is_loaded = true
        }


    },


}
</script>

<style></style>
