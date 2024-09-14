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
                                    <!-- <th class="w-10 text-center">
                                        <input class="form-check-input ml-0 select_all_checkbox" type="checkbox" />
                                    </th> -->
                                    <th class="w-10">ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Is Hide</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in products.data" :key="item.id" class="table_rows table_row_83106">
                                    <!-- <td><input class="form-check-input ml-0" type="checkbox" /></td> -->
                                    <td>{{ item.id }}</td>
                                    <td>
                                        <img class="bg-white" :src="load_image(item.product_image?.url)" alt=""
                                            style="height: 30px;" />
                                    </td>
                                    <td>
                                        <div class="text-warning cursor-pointer">{{ item.title }}</div>
                                    </td>
                                    <td>
                                        <input @change="updateFeatured(item.slug)" class="form-check-input"
                                            :checked="item.is_available" type="checkbox" />
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
            let response = await axios.post(`products/actions-update/${slug}?is_available=1`);
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
        }
    },


};
</script>
