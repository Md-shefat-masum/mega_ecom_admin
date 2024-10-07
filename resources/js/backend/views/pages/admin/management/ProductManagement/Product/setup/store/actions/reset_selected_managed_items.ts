import { mapActions, mapWritableState } from "pinia";
import { store } from "..";

async function reset_selected_managed_items (values = []){
    let state = mapWritableState(store, [
        'selected_managed_items'
    ]);

    console.log(values);
    
    state.selected_managed_items.set(values);
}

export default reset_selected_managed_items;