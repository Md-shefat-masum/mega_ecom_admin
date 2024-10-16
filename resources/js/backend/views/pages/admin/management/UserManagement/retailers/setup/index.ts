import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'Retailer';
const setup: setup_type = {
    prefix,
    permission: [`admin`,`super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'retailers',

    select_fields: ['id', 'name', 'email', 'photo', 'phone_number','slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'name', 'email', 'phone_number', 'created_at', 'status'],

    module_name: 'retailers',
    store_prefix: 'retailers',
    route_prefix: `Retailer`,
    route_path: `retailers`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
