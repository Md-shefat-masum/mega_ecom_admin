export default [

    {
        name: "code",
        label: "code",
        type: "text",
        value: "",
    },

    {
        name: "type",
        label: "Type",
        type: "select",
        multiple: false,
        data_list: [
            {
                label: "Numeric",
                value: "numeric",
            },
            {
                label: "Percent",
                value: "percent",
            },
        ]
    },


    {
        name: "value",
        label: " Amount",
        type: "number",
        value: "",
    },
    {
        name: "expire_date",
        label: " Expire date",
        type: "date",
        value: "",
    },

];
