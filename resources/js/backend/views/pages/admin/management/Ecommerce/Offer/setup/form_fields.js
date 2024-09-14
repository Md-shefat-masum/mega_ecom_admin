export default [

    {
        name: "title",
        label: "Title",
        type: "text",
        value: "",
    },

    {
        name: "description",
        label: "description",
        type: "text",
        value: "",
    },
    {
        name: "discount_type",
        label: "discount_type",
        type: "select",
        value: "",
        data_list: [
            {

                label: "flat",
                value: "flat"
            },
            {

                label: "percentage",
                value: "percentage"
            }
        ]
    },
    {
        name: "discount",
        label: "discount",
        type: "number",
        value: "",
    },
    {
        name: "image",
        label: "image",
        type: "file",
        value: "",
    },

];
