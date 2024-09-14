<template lang="">
    <select v-if="selected.length" class="form-control" style="width: 100px;height: 30px;font-size: 12px" @change="bulk_actions">
        <option disabled selected>Select action</option>
        <option value="inactive">Inactive</option>
        <option value="active">Action</option>
        <option value="delete">Delete</option>
    </select>
</template>
<script>
import { mapActions, mapState } from 'pinia';
import { store } from '../../../setup/store';

export default {
    props: {
        item: {
            slug: "",
        }
    },
    methods: {
        ...mapActions(store, [
            `get_all`,
            `bulk_action`,
            'selected',
            'set_only_latest_data',
            'clear_selected',
        ]),

        bulk_actions: async function () {
            let action = this.$el.value;
            let con = await window.s_confirm('Are you sure want to ' + action + ' items ?');
            if (con) {
                let selected_data = this.selected;
                selected_data = selected_data.map((item => item.id))

                this.set_only_latest_data(true);
                await this.bulk_action(action, selected_data);
                await this.get_all();
                this.clear_selected();
                this.set_only_latest_data(false);
                window.s_alert('You have ' + action + ' items ?');
            }

        }
    },
    computed: {
        ...mapState(store, [
            'selected',
        ])
    }
}
</script>
<style lang="">

</style>
