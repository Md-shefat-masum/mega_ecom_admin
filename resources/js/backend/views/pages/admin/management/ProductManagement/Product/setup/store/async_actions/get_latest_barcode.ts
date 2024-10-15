import axios from "axios";
import setup from "../..";
import { mapWritableState } from "pinia";
import { store } from "..";

async function execute(id){
    let state = mapWritableState(store, [
        'latest_bar_code',
    ]);

    let url = `${setup.api_host}/${setup.api_version}/${setup.api_end_point}/latest-barcode`;
    try {
        let response = await axios.get(url);
        state.latest_bar_code.set(response.data.data);
    } catch (error) {
        (window as any).s_alert('something is wrong.','error');
        return error.response;
    }
}

export default execute;
