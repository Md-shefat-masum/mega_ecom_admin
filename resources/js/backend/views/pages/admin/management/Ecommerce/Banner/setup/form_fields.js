export default [
    {
        name: "title",
        label: "Brand Title",
        type: "text",
        value: "",
    },
    {
        name: "short_des",
        label: "Short description",
        type: "text",
        value: "",
    },
    {
        name: "offer_title",
        label: "Offer title",
        type: "text",
        value: "",
    },
    {
        name: "button_url",
        label: "Button url",
        type: "text",
        value: "",
    },
    {
        name: "is_show",
        label: "Is show",
        type: "select",
        value: "",
        data_list: [
            {
                label: "Yes",
                value: 1,
            },
            {
                label: "No",
                value: 0,
            },
        ]
    },

    {
        name: "image",
        label: "Image",
        type: "file",
        multiple: false,
        value: "",
        row_col_class: "col-md-12",
    },
];
