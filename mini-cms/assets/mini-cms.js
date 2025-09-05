jQuery(document).ready(function($) {
    function loadList() {
        $.post(miniCMS.ajaxurl, { action: 'mini_cms_list', _ajax_nonce: miniCMS.nonce }, function(res) {
            if(res.success) $("#mini-cms0list").html(res.data);
        });
    }
    loadList();

    $("#mini-cms-form").on("submit", function(e) {
        e.preventDefault();
        $.post(miniCMS.ajaxurl, $(this).serialize() + "&action=mini_cms_save&ajax_nonce=" + miniCMS.nonce, function(res) {
            if(res.success) {
                $("#mini-cms-form")[0].reset();
                loadList();
            }
        });
    });

    $("#mini-cms-list").on("click", ".delete", function() {
        $.post(miniCMS.ajaxurl, {action: "mini_cms_delete", id: $(this).data("id"), _ajax_nonce: miniCMS.nonce }, function(res) {
            if(res.success) loadList();
        });
    });

    $("#mini-cms-list").on("click", ".edit", function() {
        var id = $(this).data("id");
        $.get(miniCMS.ajaxurl, { action: "mini_cms_list_single", id: id, _ajax_nonce: miniCMS.nonce }, function(res) {
            if(res.success) {
                var p = res.data;
                $("#mini-cms-form [name=post_id]").val(p.ID);
                $("#mini-cms-form [name=title]").val(p.post_title);
                $("#mini-cms-form [name=content]").val(p.post_content);
                $("#mini-cms-form [name=post_type]").val(p.post_type);
            }
        });
    });
});