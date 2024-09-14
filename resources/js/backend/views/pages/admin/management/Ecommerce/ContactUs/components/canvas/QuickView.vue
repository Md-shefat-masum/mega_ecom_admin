<template lang="">
    <div class="off_canvas quick_view" :class="{active: show_details_canvas}">
        <div class="off_canvas_body">
            <div class="header">
                <h3 class="heading_text">Quick View</h3>
                <button @click.prevent="set_show_details_canvas(false)"
                    class="btn btn-sm btn-outline-danger">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <div class="data_content">
                <table class="table quick_modal_table">
                    <tbody>

                        <tr>
                            <th>First Name </th>
                            <th>:</th>
                            <th>
                                {{ item.first_name }}
                            </th>
                        </tr>
                        <tr>
                            <th>Last Name </th>
                            <th>:</th>
                            <th>
                                {{ item.last_name }}
                            </th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>:</th>
                            <th>
                                {{ item.email }}
                            </th>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <th>:</th>
                            <th>
                                {{ item.phone_number }}
                            </th>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <th>:</th>
                            <th>
                                {{ item.message }}
                            </th>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="off_canvas_overlay"></div>
    </div>
</template>
<script>
import { mapActions, mapWritableState } from 'pinia';
import { store } from '../../setup/store';

export default {
    methods: {
        ...mapActions(store, [
            'set_show_details_canvas'
        ]),
    },
    computed: {
        ...mapWritableState(store, [
            'show_details_canvas',
            'item',
        ])
    }
};
</script>
<style lang="">
</style>
