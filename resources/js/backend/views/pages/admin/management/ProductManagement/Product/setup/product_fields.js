export default {
    // categoryGroupId: [],
    basicInfo: [
        "id",
        "title",
        "type",
        "medicine_type",
        "video_url",
        "product_menufecturer.title",
        "company.title",
        "product_brand.title",
        "medicine_form.title",
        "medicine_generic.title",
        "product_unit.title",
        "product_unit_multiplier",
    ],
    pricing: [
        "price_type",
        "tax_type",
        "tax_amount",
        "purchase_price",
        "customer_sales_price",
        "retailer_sales_price",
        "minimum_sale_price",
        "maximum_sale_price",
        "profit_margin_percent",
        "discount_type",
        "discount_amount",
        "discount_price",
    ],
    stockInfo: [
        "alert_quantity",
        "expiration_days",
        "product_warranty",
        // "warranty_policy",
        // "guarantee_policy",
        "total_sold",
        "total_view",
        "total_wishlist",
        "sku",
        "barcode",
    ],
    shipping: [
        "is_free_delivery",
        "is_returnable",
        "is_pre_order",
        "is_up_coming",
        "is_emi_support"
    ],
    statusInfo: [
        "is_available",
        "is_featured",
        "is_new",
        "is_best_selling",
        "is_trending",
        "is_hide",
        "status",
        "slug"
    ],
    seo: [
        "meta_title",
        "meta_description",
        "meta_keywords",
        "search_keywords"
    ],
    timestamps: [
        "creator",
        "created_at",
        "updated_at"
    ]
};
