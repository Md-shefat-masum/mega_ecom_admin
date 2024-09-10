<template>
    <div>
        <div class="pb-4">
            <h5>
                Short Description ( add short description in key and values)
            </h5>
            <button type="button" @click="()=>(is_modify = false)" v-if="is_modify" class="btn btn-info btn-sm ml-3">Save</button>
            <button type="button" @click="()=>(is_modify = true)"  v-else class="btn btn-warning btn-sm ml-3">Modify</button>
        </div>
        <div>
            <table class="table" v-if="is_modify">
                <thead class="text-center bg-secondary">
                    <tr>
                        <td></td>
                        <td>Key</td>
                        <td>Value</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(i, index) in description_points" :key="index">
                        <td style="width: 15px;">
                            <i @click="remove(index)" v-if="description_points.length > 1"
                                class="fa fa-trash btn btn-sm btn-outline-danger"></i>
                        </td>
                        <td style="width: 300px;">
                            <input type="text" placeholder="eg: color" 
                                v-model="i.key"
                                :name="`specification[${index}][key]`" 
                                class="form-control">
                        </td>
                        <td>
                            <input type="text" placeholder="eg: red" 
                                v-model="i.value"
                                :name="`specification[${index}][value]`" 
                                class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <i @click.prevent="add" class="fa fa-plus btn btn-sm btn-info"></i>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center">
                            <button type="button" @click="()=>(is_modify = false)" v-if="is_modify" 
                                class="btn btn-success btn-sm ml-3">
                                Save short description
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <table v-else class="table">
                <tbody>
                    <tr v-for="(point, index) in description_points" :key="index">
                        <td style="width: 200px;">{{ point.key }}</td>
                        <td>{{ point.value }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        description_points: [
            {
                key: 'color',
                value: 'red',
            },
            {
                key: 'speed',
                value: '100mbps',
            },
        ],
        is_modify: false,
    }),
    methods: {
        add: function () {
            this.description_points.push({
                key: 'key',
                value: 'value',
            });
        },
        remove: function (index) {
            this.description_points.splice(index, 1);
        },
    }
}
</script>
<style lang="">

</style>