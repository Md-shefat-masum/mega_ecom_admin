import setup_type from './setup_type';
import app_config from '../../../../app_config';

const prefix: string = 'account heads';
const setup: setup_type = {
    prefix,
    permission: [`admin`, `super_admin`],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: 'account-heads',

    select_fields: ['id', 'title','description','date','slug', 'created_at', 'status'],
    sort_by_cols: ['id', 'title', 'description', 'created_at', 'status'],

    module_name: 'account-heads',
    store_prefix: 'account-heads',
    route_prefix: `Account-heads`,
    route_path: `account-heads`,

    layout_title: prefix + ' Management',
    page_title: `${prefix} Management`,
    all_page_title: 'All ' + prefix,
    details_page_title: 'Details ' + prefix,
    create_page_title: 'Create ' + prefix,
    edit_page_title: 'Edit ' + prefix,
};

export default setup;
