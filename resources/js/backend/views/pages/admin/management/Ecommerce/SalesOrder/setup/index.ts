import app_config from '../../../../app_config';
import setup_type from './setup_type';

const prefix: string = 'Electronic Sales Order';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'sales-ecommerce-orders',

    module_name: 'sales_order',
    store_prefix: 'sales_order',
    route_prefix: `electronics_sales_order`,
    route_path: 'ecommerce-order',

    select_fields: ['id', "order_id", 'date', 'order_status', 'total', 'paid_status', 'slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'order_id', 'date', 'created_at', 'status'],

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
