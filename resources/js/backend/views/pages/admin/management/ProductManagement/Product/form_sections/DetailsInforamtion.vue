<template lang="">
    <div>
        <div class="row" style="row-gap: 30px;">
            <div class="col-12">
                <h4>Details Informations</h4>
            </div>
            <div class="col-md-12">
                <label for="video_url">
                    Video URL
                </label>
                <input type="text" name="video_url" id="video_url" class="form-control">
            </div>
            <div class="col-md-12">
                <label>
                    description
                </label>
                <div class="mt-1 mb-3">
                    <text-editor :set_value="set_value" :data_store="`product_description`" />
                    <div class="text_output" v-html="product_description"></div>
                    <textarea class="d-none" name="description"
                        :value="product_description"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <label>
                    waranty policy
                </label>
                <div class="mt-1 mb-3">
                    <text-editor :set_value="set_value" :data_store="`warranty_policy`" />
                    <div class="text_output" v-html="warranty_policy"></div>
                    <textarea class="d-none" name="warranty_policy"
                        :value="warranty_policy"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <label>
                    guraranty policy
                </label>
                <div class="mt-1 mb-3">
                    <text-editor :set_value="set_value" :data_store="`guarenty_policy`" />
                    <div class="text_output" v-html="guarenty_policy"></div>
                    <textarea class="d-none" name="guarenty_policy"
                        :value="guarenty_policy"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <short-description />
            </div>
            <div class="col-md-12">
                <specification />
            </div>
        </div>
    </div>
</template>
<script>
import ShortDescription from './ShortDescription.vue';
import Specification from './Specification.vue';
export default {
    components: {
        ShortDescription,
        Specification,
    },
    data: () => ({
        product_description: '',
        warranty_policy: '',
        guarenty_policy: '',
    }),
    methods: {
        set_value: function (state, value) {
            this[state] = value;
        },
    }
}
</script>
<style lang="">

</style>
