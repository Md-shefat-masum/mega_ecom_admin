<template lang="">
    <div class="d-flex">
        <!-- <create /> -->
        <export-all />
        <export-selected />
        <trash />
        <!-- <bulk-actions></bulk-actions> -->
        <slot/>
    </div>
</template>
<script>
import Create from "./action_buttons/Create.vue"
import ExportAll from "./action_buttons/ExportAll.vue"
import ExportSelected from "./action_buttons/ExportSelected.vue"
import Trash from "./action_buttons/Trash.vue"
import BulkActions from "./action_buttons/BulkActions.vue"
export default {
    components: {
        Create,
        ExportAll,
        ExportSelected,
        Trash,
        BulkActions,
    }
}
</script>
<style lang="">

</style>
