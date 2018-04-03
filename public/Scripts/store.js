function saveStore() {
    var store_name = $('#store_name').val();
    var store_desc = $('#store_desc').val();

    if (parseInt(store_name.length) > 30) {
        $('#stnerror').html('<font>已超出' + (parseInt(store_name.length) - 30) + '字</font>').show();
        return false;
    }
    if (parseInt(store_desc.length) > 800) {
        $('#stderror').html('<font>已超出' + (parseInt(store_desc.length) - 800) + '字</font>').show();
        return false;
    }
    return true;
}
