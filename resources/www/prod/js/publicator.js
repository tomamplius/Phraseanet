function publicator_reload_publicator(url) {
    var options = $('#dialog_publicator form[name="current_datas"]').serializeArray();
    var dialog = p4.Dialog.get(1);
    dialog.load(url, 'POST', options);
}
