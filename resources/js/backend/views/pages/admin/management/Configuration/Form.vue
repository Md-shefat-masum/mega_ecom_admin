<template>
    <div class="container">

        <form @submit.prevent="submitHandler">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="text-capitalize">{{ param_id ? 'Update' : 'Create' }} new {{ route_prefix }}</h5>
                    <div>
                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${route_prefix_name}` }">
                            All {{ route_prefix }}
                        </router-link>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-7">
                            <div class="row">
                                <div class="col-md-12" v-for="(form_field, index) in form_fields" :key="index">
                                    <common-input :label="form_field.label" :type="form_field.type"
                                        :name="form_field.name" :multiple="form_field.multiple"
                                        :value="form_field.value" :data_list="form_field.data_list" />
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-light btn-square px-5">
                                    <i class="icon-login"></i>
                                    Submit
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
import { mapActions, mapState } from 'pinia'
import { user_setup_store } from './setup/store';
import setup from "./setup";
import form_fields from "./setup/form_fields";

export default {
    data: () => ({
        route_prefix: setup.route_prefix,
        route_prefix_name: setup.route_prefix_name,

        form_fields,
        param_id: null,
    }),
    created: async function () {
        let id = this.$route.query.id;
        this.form_fields.forEach((item) => {
            item.value = "";
        });

        return;
        await this.get_all_data()
        if (id) {
            this.param_id = id;
            await this.get_single_data(id);
            if (this.single_data) {
                this.form_fields.forEach((field, index) => {
                    Object.entries(this.single_data).forEach((value) => {
                        if (field.name == value[0]) {
                            this.form_fields[index].value = value[1];
                        }


                    });
                });
            }
        } else {
            this.form_fields.forEach((item) => {
                item.value = "";
            });
        }
    },
    methods: {
        ...mapActions(user_setup_store, {
            get_all_data: 'all',
            get_single_data: 'get',
            store_data: 'store',
            update_data: 'update',
        }),

        submitHandler: async function ($event) {
            if (this.param_id) {
                let response = await this.update_data($event.target, this.param_id);
                if (response.data.status === "success") {
                    window.s_alert(response.data.message);
                    this.$router.push({ name: `All${this.route_prefix}` });
                }
            } else {
                let response = await this.store_data($event.target);
                if (response.data.status === "success") {
                    window.s_alert(response.data.message);
                    this.$router.push({ name: `All${this.route_prefix}` });
                }
            }
        },


    },

    computed: {
        ...mapState(user_setup_store, {
            single_data: "single_data",
            all_data: 'all_data',
        }),
    },


}
</script>
