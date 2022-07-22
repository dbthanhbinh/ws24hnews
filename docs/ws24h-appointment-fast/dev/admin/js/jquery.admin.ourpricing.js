(function( $ ) {
    "use strict";

    function ajaxCallPost(ajaxCallUrl = null, data={}){
        var ajaxCall = $.ajax({
            type : "post",
            dataType : "json",
            url : ajaxCallUrl,
            data : data,
            context: this
        })
        return ajaxCall;
    }

    function quickEditFormService(dataRef){
        let updatefields = dataRef['updatefields']
        if (updatefields) {
            updatefields = updatefields.split(',')
        }
        else {
            updatefields = []
        }

        var html = '';
        html += '<tr id="' + dataRef['prefix'] + 'edit-' + dataRef['id'] + '" class="inline-edit-row inline-editor" style="">';
            html += '<td colspan="' + dataRef['colspan'] + '" class="colspanchange">';
            html += '<div class="inline-edit-wrapper">'
                html += '<fieldset>';
                    html += '<legend class="inline-edit-legend">Quick Edit</legend>';
                    html += '<div class="inline-edit-col">';
                    html += '<input type="hidden" name="' + dataRef['prefix'] + 'quickedittypeof" id="' + dataRef['prefix'] + 'quickedittypeof" class="ptitle" value="' + dataRef['typeof'] + '">';

                        $.each(updatefields, function( idx, value ) {
                            let clName = 'long-tex';
                            if (value === 'title' || value === 'price' || value === 'discount'){
                                if (value === 'price' || value === 'discount') {
                                    clName = 'short-tex';
                                }
                                html += getInputHtml(dataRef['prefix'], value, dataRef[value], clName)
                            }
                            if (value === 'category' || value === 'scope') {
                                var options = []
                                var _options = dataRef['options'] ? dataRef['options'].split(',') : [];
                                
                                if (_options && _options.length > 0){
                                    $.each(_options, function( idx, val ) {
                                        var _val = val ? val.split('_') : [];
                                        if (_val && _val[0]) {
                                            options[_val[0]] = _val[1]
                                        }
                                    });
                                }
                                html += getSelectHtml(dataRef['prefix'], value, dataRef[value], options, clName)
                            }

                            if (value === 'summaries') {
                                html += getTextareaHtml(dataRef['prefix'], value, dataRef[value], clName)
                            }

                            if (value === 'ordering' || value === 'slots'){
                                html += getInputNumberHtml(dataRef['prefix'], value, dataRef[value], clName)
                            }
                        });
                    html += '</div>';
                html += '</fieldset>';

                html += '<div class="inline-edit-save submit">';
                    html += '<button type="button" data-prefix="' + dataRef['prefix'] + '" data-id="' + dataRef['id'] + '" class="cancel button alignleft quickedit-cancel-js">Cancel</button>';
                    html += '<button type="button" data-typeof="' + dataRef['typeof'] + '" data-table="' + dataRef['table'] + '" data-updatefields="' + dataRef['updatefields'] + '" data-prefix="' + dataRef['prefix'] + '" data-id="' + dataRef['id'] + '" class="save button button-primary alignright quickedit-update-js">Update</button>';
                    html += '<div class="notice notice-error notice-alt inline hidden">';
                        html += '<p class="error"></p>';
                    html += '</div>';
                html += '</div>';
            html += '</div>';
            html += '</td>';
        html += '</tr>';

        return html;
    }

    function getInputHtml(prefix, key, value, clName)
    {
        let html = '<label class="' + clName + '">';
            html += '<span class="title">' + key + '</span>';
            html += '<span class="input-text-wrap">';
                html += '<input type="text" name="' + prefix + 'quickedit' + key + '" id="' + prefix + 'quickedit' + key + '" class="ptitle" value="' + value + '">';                
            html += '</span>';
        html += '</label>';
        return html;
    }

    function getTextareaHtml(prefix, key, value, clName)
    {
        let html = '<label class="' + clName + '">';
            html += '<span class="title">' + key + '</span>';
            html += '<span class="input-text-wrap">';
                html += '<textarea name="' + prefix + 'quickedit' + key + '" id="' + prefix + 'quickedit' + key + '" class="ptitle">' + value + '</textarea>'
            html += '</span>';
        html += '</label>';
        return html;
    }

    function getInputNumberHtml(prefix, key, value, clName)
    {
        let html = '<label class="' + clName + '">';
            html += '<span class="title">' + key + '</span>';
            html += '<span class="input-text-wrap">';
                html += '<input type="number" name="' + prefix + 'quickedit' + key + '" id="' + prefix + 'quickedit' + key + '" class="ptitle" value="' + value + '">';                
            html += '</span>';
        html += '</label>';
        return html;
    }

    function getSelectHtml(prefix, key, value, options, clName)
    {
        let html = '<label class="' + clName + '">';
            html += '<span class="title">' + key + '</span>';
            html += '<select name="' + prefix + 'quickedit' + key + '" id="' + prefix + 'quickedit' + key + '">';
                html += '<option value="-1"> -- None -- </option>';
                for (const o in options) {
                    html += '<option ' + getSlected(value, o) + ' value="'+ o +'"> ' + options[o] + ' </option>'; 
                }
            html += '</select>';
        html += '</label>';
        return html;
    }



    function getSlected(scope, currentValue) {
        return scope == currentValue ? 'selected="selected"': '';
    }

    $('.delete-button-js').on('click', function(){
        if (!confirm("Do you want to delete")){
            return false;
        }

        const delId = $(this).attr('data-delId');
        const trset = $(this).attr('data-trset');
        const table = $(this).attr('data-table');
        $.ajax({
            type : "post",
            dataType : "json",
            url : adminAjax,
            data : {
                action: "ourpricing_deleteitemset", //Tên action
                delId: delId,
                table: table
            },
            context: this,
            beforeSend: function(){
            },
            success: function(response) {
                if(response.success) {
                    // success
                    $('#'+trset).css("background-color", "red");
                    window.setTimeout(() => {
                        document.getElementById(trset).remove();
                    }, 500);
                }
                else {
                    alert('Error!');
                }
            },
            error: function( jqXHR, textStatus, errorThrown ){
                console.log( 'The following error occured: ' + textStatus, errorThrown );
            }
        })
        return false;
    })

    // Add quick edit time set
    $('.btn-our-quickedit-button-js').on('click', function(){
        var dataRef = {}
        $.each($(this).data(), function(key, value) {
            dataRef[key] = value
        });
        // ourpricing_edit-2
        const afterElm = document.getElementById(dataRef['prefix'] + 'edit-' + dataRef['id'])
        if (!afterElm || (afterElm && afterElm.length < 1))
            $('#' + dataRef['trset']).after(quickEditFormService(dataRef))
    })

    // Quick edit cancel
    $('#the-list').on('click', '.quickedit-cancel-js', function(){
        const prefix = $(this).attr('data-prefix');
        const id = $(this).attr('data-id');
        document.getElementById(prefix + 'edit-'+id)?.remove();
    })

    // Quick edit update timeset
    $('#the-list').on('click', '.quickedit-update-js', function(){
        const prefix = $(this).attr('data-prefix');
        const table = $(this).attr('data-table');
        const appTypeof = $(this).attr('data-typeof');
        let updatefields = $(this).attr('data-updatefields');
        const id = $(this).attr('data-id');

        if (updatefields) {
            updatefields = updatefields.split(',')
        }
        else {
            updatefields = []
        }

        var dataObjs = {}

        $.each(updatefields, function( idx, val ) {
            var _item = document.getElementById(prefix + 'quickedit' + val);
            if (_item) {
                dataObjs[val] = _item.value;
            }
            
        });

        ajaxCallPost(
            adminAjax,
            {
                action: "our_app_updatequickedit", //Tên action
                updateId: id,
                prefix: prefix,
                table: table,
                appTypeof: appTypeof,
                dataObjs: dataObjs
            }
        )
        .done(function(data){
            // Done
            console.log(data)
            if(data.success) {
                location.reload();
            }
            else {
                alert('Error!');
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            // If fail
            console.log(textStatus + ': ' + errorThrown);
        });
    })

})(jQuery);