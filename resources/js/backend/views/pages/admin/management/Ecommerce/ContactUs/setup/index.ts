import app_config from '../../../../app_config';
import setup_type from './setup_type';

const prefix: string = 'Contact Us';

const setup: setup_type = {

    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'contact-uses',

    module_name: 'contact_us',
    store_prefix: 'contact_us',
    route_prefix: `contact_us`,
    route_path: `contact-us`,

    select_fields: [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'message',
        'slug',
        'created_at',
        'status',
    ],

    sort_by_cols: [
        'id',
        'first_name',
        'last_name',
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
