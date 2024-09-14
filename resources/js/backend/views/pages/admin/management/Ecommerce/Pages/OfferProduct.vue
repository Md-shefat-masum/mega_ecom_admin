<template>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header py-1 d-flex align-items-center justify-content-between">
                    <h5 class="text-capitalize mb-0">All Products</h5>
                    <div style="flex: 1 1 0%;">
                        <input @keydown="searchData" v-model="search" class="form-control w-100 ml-4 all_page_search" />
                    </div>
                    <div>
                        <button class="btn btn-outline-success btn-sm">
                            <i class="fa fa-gear"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table_responsive card_body_fixed_height">
                        <table class="table table-hover text-center table-bordered">
                            <thead>
                                <tr>
                                    <th class="w-10 m-0 px-3"> <span class="icon"></span></th>
                                    <th class="w-10">ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Dicount type</th>
                                    <th>Dicount amount</th>
                                    <th>Purchase Price</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="(item, index) in products.data" :key="item.id" class="table_rows  "
                                    :class="`table_row_${index}`">
                                    <td><span class="icon" @click="toggleRow(index)"></span>
                                        <div class="table_action_btns">
                                            <ul>
                                                <li class="c-pointer"><a @click="edit_product_discount(item.slug)"
                                                        class="border-secondary"><i
                                                            class="fa fa-pencil-square-o text-info"></i> Edit </a></li>

                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{ item.id }}</td>
                                    <td>
                                        <img class="bg-white" :src="load_image(item.product_image?.url)" alt=""
                                            style="height: 30px;" />
                                    </td>
                                    <td>
                                        <div class="text-warning cursor-pointer">{{ item.title.substr(0, 20) }}</div>
                                    </td>
                                    <td>
                                        <div class="text-warning cursor-pointer">{{ item.discount_type ?? 'N/A' }}</div>
                                    </td>
                                    <td>
                                        <div class="text-warning cursor-pointer">{{ item.discount_amount ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-warning cursor-pointer">{{
                                            item.product_purchase_price.toFixed(2) ?? 'N/A'
                                            }}</div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mx-3">
                    <nav aria-label="" class="d-flex gap-2 align-items-center">
                        <ul class="pagination my-2" style="font-size: 11px;">
                            <li class="page-item" :class="{ disabled: !pagination.prev_page_url }"
                                @click="changePage(pagination.prev_page_url)">
                                <a class="page-link"><span>« Previous</span></a>
                            </li>

                            <!-- Calculate visible page numbers -->
                            <li class="page-item" :class="{ disabled: page === pagination.current_page }"
                                v-for="page in visiblePages" :key="page"
                                @click="changePage(pagination.path + '?page=' + page)">
                                <a class="page-link"><span>{{ page }}</span></a>
                            </li>

                            <li class="page-item" :class="{ disabled: !pagination.next_page_url }"
                                @click="changePage(pagination.next_page_url)">
                                <a class="page-link"><span>Next »</span></a>
                            </li>
                        </ul>
                        <div class="d-flex" style="gap: 5px;">
                            <span></span><span>{{ pagination.from }}</span><span>-</span><span>{{ pagination.to
                                }}</span><span>of</span><span>{{ pagination.total }}</span>
                        </div>
                        <div class="d-flex" style="gap: 5px;">
                            <span></span><span>Limit</span>
                            <select v-model="pagination.per_page" class="bg-transparent text-white rounded-1"
                                @change="changePage(pagination.path + `?limit=${pagination.per_page}`)">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

    </div>
    <div class="off_canvas quick_view " :class="show_details_canvas ? 'active' : ''">
        <div class="off_canvas_body">
            <div class="header">
                <h3 class="heading_text">Edit</h3><button class="btn btn-sm btn-outline-danger"><i class="fa fa-close"
                        @click="set_show_details_canvas(false)"></i></button>
            </div>
            <div class="data_content">
                <form @submit.prevent="submitHandler">
                    <input type="hidden" name="slug" v-model="editData.slug">
                    <div class="col-md-12">
                        <label> Discount type <span class="text-danger">*</span></label>
                        <select name="discount_type" id="" class="form-control" v-model="editData.discount_type">
                            <option value="percent">Percentage</option>
                            <option value="flat">Flat</option>
                        </select>
                    </div>
                    <div class="col-md-12 my-3">
                        <label> Discount amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="discount_amount" id=""
                            v-model="editData.discount_amount">
                    </div>
                    <!-- <div class="col-md-12">
                        <label> Purchase price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="purchase_price" id="">
                    </div> -->
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-light btn-square px-5 my-3">Submit</button>
                    </div>

                </form>

            </div>
        </div>
        <div class="off_canvas_overlay"></div>
    </div>
</template>
<script>
export default {
    data: () => ({
        search: '',
        products: [],
        pagination: {
            current_page: 1,
            last_page: 1,
            prev_page_url: null,
            next_page_url: null,
            path: '',
            from: 0,
            to: 0,
            total: 0,
            per_page: 10,
        },
        visiblePages: [], // To store the list of pages to be displayed
        maxVisiblePages: 10, // Maximum number of pages to show
        show_details_canvas: false,
        editData: {},

    }),

    created: async function () {
        await this.get_all_products();
    },

    methods: {
        async get_all_products(pageUrl = 'products') {
            let response = await axios.get(pageUrl);
            if (response.data.status === 'success') {
                this.products = response.data.data;
                this.pagination = response.data.data;
                this.calculateVisiblePages();
            }
        },

        changePage(url) {
            if (url) {
                this.get_all_products(url);
            }
        },

        calculateVisiblePages() {
            const { current_page, last_page } = this.pagination;
            let start = Math.max(1, current_page - Math.floor(this.maxVisiblePages / 2));
            let end = Math.min(last_page, current_page + Math.floor(this.maxVisiblePages / 2));

            // Adjust start and end if there are not enough pages before or after the current page
            if (end - start + 1 < this.maxVisiblePages) {
                if (current_page - start < Math.floor(this.maxVisiblePages / 2)) {
                    end = Math.min(last_page, end + (Math.floor(this.maxVisiblePages / 2) - (current_page - start)));
                }
                if (end - start + 1 < this.maxVisiblePages) {
                    start = Math.max(1, start - (Math.floor(this.maxVisiblePages / 2) - (end - start)));
                }
            }

            this.visiblePages = Array.from({ length: end - start + 1 }, (_, i) => start + i);
        },

        async updateFeatured(slug) {
            let response = await axios.post(`products/actions-update/${slug}?is_featured=1`);
            if (response.data.status === 'success') {
                window.s_alert(response.data.message);
                this.get_all_products();
            }
        },

        searchData: function () {
            clearTimeout(this.searchTimer);
            this.searchTimer = setTimeout(async () => {
                this.get_all_products('products?search=' + this.search);
                if (response.data.status === 'success') {
                    window.s_alert(response.data.message);
                    this.get_all_products();
                }
            }, 1000);
        },
        toggleRow: function (index) {
            let target = document.querySelector('.table_row_' + index);
            target.classList.toggle("active");
        },
        submitHandler: async function ($event) {
            let formData = new FormData($event.target);
            let response = await axios.post('products/product-discount-update', formData);

            if (response.data.status == "success") {
                window.s_alert(response.data.message);
            }
            this.get_all_products();
        },
        set_show_details_canvas: function () {
            this.show_details_canvas = !this.show_details_canvas
        },
        edit_product_discount: async function (slug) {
            this.set_show_details_canvas();
            let response = await axios.get('products/' + slug);


            if (response.data.status === 'success') {
                this.editData = response.data.data;
            }

        }
    },


};
</script>

<style>
.icon {
    cursor: pointer;
    position: relative;
    border: 1px solid var(--brand_white2);
    height: 10px;
    width: 10px;
    border-radius: 0;
    /* Changed from 0% to 0 for consistency */
    display: flex;
    /* Use Flexbox for better centering */
    align-items: center;
    justify-content: center;
    color: white;
}

.icon::after {
    content: "\f085";
    font-family: 'FontAwesome';
    font-weight: bold;
}
</style>
