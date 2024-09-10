<template lang="">
    <div>
        <div class="row" style="row-gap: 30px;">
            <div class="col-12">
                <h4>Product Information</h4>
            </div>
            <div class="col-md-12">
                <label>
                    Product Name 
                    <span class="text-danger">*</span>
                </label>
                <div>
                    <input type="text" v-model="title" @change="createURL($event.target.value)" name="title" id="title" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <label>
                    Product URL 
                    <span class="text-danger">*</span>
                </label>
                <div>
                    <input v-model="slug" name="slug" id="slug" type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <label>
                    Search Keywords 
                    <span class="text-danger">*</span>
                </label>
                <div>
                    <input v-model="search_keywords" name="search_keywords" id="search_keywords" type="text" class="form-control">
                </div>
            </div>

            <div class="col-md-4">
                <label>
                    Thumbnail Image 
                    <span class="text-danger">*</span>
                </label>
                <div>
                    <image-component name="thumb_image"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        title: '',
        slug: '',
        search_keywords: '',
    }),
    methods: {
        createURL: function (str) {
            let url = str
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-');
            this.slug = url;
            this.search_keywords = str;

        }
    }
}
</script>
<style lang="">

</style>
