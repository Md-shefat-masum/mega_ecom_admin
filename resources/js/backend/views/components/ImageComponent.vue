<template>
    <div>
        <input
            @change="preview"
            class="form-control"
            type="file"
            ref="input_files"
            :accept="accept"
            :class="classNames"
            :name="name"
            :multiple="multiple"
        />

        <template v-if="multiple">
            <div class="uploaded_image_preview my-2 d-flex flex-wrap" style="gap: 10px;">
                <img
                    v-show="component_images?.length"
                    v-for="image in component_images"
                    :key="image"
                    :src="image"
                    :class="image != '' ? 'border' : ''"
                    style="width: 50px; height: 50px; object-fit: contain"
                    alt="image"
                    target="_black"
                />
                <span v-if="component_value" class="text-warning ml-2">
                    <i class="fa fa-trash" @click="reset_image()"></i>
                </span>
            </div>
        </template>

        <template v-else>
            <div class="uploaded_image_preview my-2 d-flex gap-1 flex-wrap">
                <img
                    v-if="component_value"
                    :src="component_value"
                    style="max-width: 200px; height: 80px; object-fit: contain"
                    alt="image"
                    target="_black"
                    class="border"
                />
                <span v-if="component_value" class="text-warning ml-2">
                    <i class="fa fa-trash" @click="reset_image()"></i>
                </span>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    props: {
        name: {
            required: true,
            default: "selected_images",
        },
        multiple: {
            default: false,
        },
        classNames: {
            default: "form-control",
        },
        accept: {
            required: false,
            default: "image/*",
        },
        images: {
            default: [],
            required: false,
        },
        value: {
            required: false,
            default: null,
        },
        delete_image_api: {
            required: false,
            default: null,
        },
    },
    data: () => ({
        component_images: [],
        component_value: null,
    }),
    watch: {
        images: function (v) {
            this.component_images = this.images;
            this.component_value = this.images[0];
        },
        component_images: function (v) {
            this.component_value = v[0];
        },
    },

    methods: {
        preview: function () {
            let that = this;
            // console.log("image", that)
            that.component_images = [];
            that.component_value = null;
            [...that.$refs.input_files.files].forEach((el) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const base64String = e.target.result;
                    that.component_images.push(base64String);
                    that.component_value = base64String;
                };
                reader.readAsDataURL(el);
            });
        },
        reset_image: function () {
            this.$refs.input_files.value = null;
            this.component_value = null;
            this.component_images = [];

            if (this.delete_image_api) {
                axios.post(this.delete_image_api);
            }
        },
    },
};
</script>

<style></style>
