import app_config from '../../../../app_config';
import setup_type from './setup_type';

const prefix: string = 'Offer products';

const setup: setup_type = {

    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'product-offers',

    module_name: 'product_offers',
    store_prefix: 'product_offers',
    route_prefix: `product_offers`,
    route_path: `product-offers`,

    select_fields: [
        'id',
        'title',
        'description',
        'discount_type',
        'discount',
        'image',
        'slug',
        'created_at',
        'status',
    ],

    sort_by_cols: [
        'id',
        'title',
        'description',
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
