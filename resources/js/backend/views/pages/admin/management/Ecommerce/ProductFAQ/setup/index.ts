import app_config from '../../../../app_config';
import setup_type from './setup_type';

const prefix: string = 'Product FAQ reply';

const setup: setup_type = {

    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'product-faqs',

    module_name: 'product_faq_reply',
    store_prefix: 'product_faq_reply',
    route_prefix: `product_faq_reply`,
    route_path: `product-faq-reply`,

    select_fields: [
        'id',
        'product_id',
        'user_id',
        'is_approved',
        'questions',
        'ans',
        'slug',
        'created_at',
        'status',
    ],

    sort_by_cols: [
        'id',
        'questions',
        'created_at',
        'status'
    ],

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,

    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,

};

export default setup;
