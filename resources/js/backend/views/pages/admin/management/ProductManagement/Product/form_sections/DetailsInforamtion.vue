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
                <input type="text" @focusout="set_video_url" name="video_url" id="video_url" class="form-control">
                <div>
                    <iframe class="mt-3" v-if="video_url" :src="video_url" height="100" width="150"></iframe>
                </div>
            </div>
            <div class="col-md-12">
                <label>
                    description
                </label>
                <div class="mt-1 mb-3">
                    <text-editor v-if="product_description" :default_data="product_description" :set_value="set_value" :data_store="`product_description`" />
                    <text-editor v-else :set_value="set_value" :data_store="`product_description`" />

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
import ShortDescription from "./ShortDescription.vue";
import Specification from "./Specification.vue";
import { mapState } from "pinia";
import { store } from "../setup/store";

export default {
    components: {
        ShortDescription,
        Specification,
    },
    data: () => ({
        product_description: "",
        warranty_policy: "",
        guarenty_policy: "",
        video_url: null,
    }),
    watch: {
        item: {
            handler: function (v) {
                this.product_description = v.description;
                this.warranty_policy = v.warranty_policy;
                this.guarenty_policy = v.guarenty_policy;
            },
        },
    },
    methods: {
        set_value: function (state, value) {
            this[state] = value;
        },

        set_video_url: function () {
            const urlObj = new URL(event.target.value);
            if (
                urlObj.hostname === "www.youtube.com" &&
                urlObj.pathname === "/watch"
            ) {
                const videoId = urlObj.searchParams.get("v");
                if (videoId) {
                    this.video_url =
                        event.target.value = `https://www.youtube.com/embed/${videoId}`;
                    return;
                }
            }
            event.target.value = "";
            this.video_url = null;
        },
    },
    computed: {
        ...mapState(store, {
            item: "item",
            is_loading: "is_loading",
        }),
    },
};
</script>
<style lang="">
</style>
