function esc_enter_capture(reference, type = 'dropdownel') {
    let check_esc_enter = ['Enter', 'Escape'].includes(event.key);

    if(check_esc_enter){
        if (type == 'dropdownel') {
            event.preventDefault();
            if(this.show_list){
                this.show_list = false;
            }
        }
    }
}

export default esc_enter_capture;
