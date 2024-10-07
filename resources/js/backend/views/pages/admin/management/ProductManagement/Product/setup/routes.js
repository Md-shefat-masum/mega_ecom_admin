import setup from ".";
import All from "../All.vue";
import Form from "../Form.vue";
import Edit from "../Edit.vue";
import Details from "../Details.vue";
import Layout from "../Layout.vue";
import SetSizeColorVarient from "../SetSizeColorVarient.vue";
import SetVariant from "../SetVariant.vue";

let route_prefix = setup.route_prefix;

const routes =
{
    path: setup.route_path,
    component: Layout,
    children: [
        {
            path: '',
            name: "All" + route_prefix,
            component: All,
        },
        {
            path: "create",
            name: "Create" + route_prefix,
            component: Form,
        },
        {
            path: "set-size-color-variant",
            name: "SetSizeColorVarient",
            component: SetSizeColorVarient,
        },
        {
            path: "set-variant",
            name: "SetVariant",
            component: SetVariant,
        },
        {
            path: ":id",
            name: "Details" + route_prefix,
            component: Details,
        },
        {
            path: "edit/:id",
            name: "Edit" + route_prefix,
            component: Edit,
        },

    ]
};


export default routes;
