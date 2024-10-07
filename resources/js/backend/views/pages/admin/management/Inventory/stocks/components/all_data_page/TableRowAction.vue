<template lang="">
    <span @click.prevent="active_row($event)" class="icon"></span>
    <div class="table_action_btns">
        <ul>
            <!-- <li v-if="item.slug">
                <details-btn :item="item" />
            </li>
            <li v-if="item.slug">
                <edit :item="item"/>
            </li>
            <li v-if="item.slug">
                <deactive :item="item"/>
            </li> -->
            <li v-if="item.slug">
                <destroy :item="item"/>
            </li>

            <slot />
        </ul>
    </div>
</template>
<script>
import active_row from '../../helpers/table_active_row';
import Details from './action_buttons/Details.vue';
import Edit from './action_buttons/Edit.vue';
import Deactive from './action_buttons/Deactive.vue';
import Destroy from './action_buttons/Destroy.vue';
export default {
    props: {
        item: {
            type: Object,
            default: {},
        }
    },
    components: {
        DetailsBtn: Details,
        Edit,
        Deactive,
        Destroy,
    },
    methods: {
        active_row,
    }
}
</script>
<style lang="">

</style>
