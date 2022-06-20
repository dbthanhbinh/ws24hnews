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

    function quickEditFormService(rangeName = '', typeOf, ordering = 0, id){
        var html = '';
        html += '<tr id="edit-'+id+'" class="inline-edit-row inline-editor" style="">';
        html += '<td colspan="4" class="colspanchange">';
        html += '<fieldset>';
        html += '<legend class="inline-edit-legend">Quick Edit</legend>';
        html += '<div class="inline-edit-col">';
        html += '<label>';
        html += '<span class="title">Range Name</span>';
        html += '<span class="input-text-wrap">';
        html += '<input type="text" name="quickeditname" id="quickeditname" class="ptitle" value="'+rangeName+'">';
        html += '<input type="hidden" name="quickedittypeof" id="quickedittypeof" class="ptitle" value="'+typeOf+'">';
        html += '</span>';
        html += '</label>';
        html += '<label>';
        html += '<span class="title">Ordering</span>';
        html += '<span class="input-text-wrap"><input type="number" name="quickeditordering" id="quickeditordering" class="ptitle" value="'+ordering+'"></span>';
        html += '</label>';
        html += '</div>';
        html += '</fieldset>';
        html += '<div class="inline-edit-save submit">';
        html += '<button type="button" data-id="'+id+'" class="cancel button alignleft quickedit-cancel-js">Cancel</button>';
        html += '<button type="button" data-id="'+id+'" class="save button button-primary alignright quickedit-update-js">Update</button>';
        html += '<div class="notice notice-error notice-alt inline hidden">';
        html += '<p class="error"></p>';
        html += '</div>';
        html += '</div>';
        html += '</td>';
        html += '</tr>';

        return html;
    }

    function getSlected(scope, currentValue) {
        return scope == currentValue ? 'selected="selected"': '';
    }

    function quickEditForm(rangeName = '', typeOf, slots = 5, scope, scopes={}, ordering = 0, id){
        var html = '';
        html += '<tr id="edit-'+id+'" class="inline-edit-row inline-editor" style="">';
        html += '<td colspan="4" class="colspanchange">';
        html += '<fieldset>';
        html += '<legend class="inline-edit-legend">Quick Edit</legend>';
        html += '<div class="inline-edit-col">';
        html += '<label>';
        html += '<span class="title">Range Name</span>';
        html += '<span class="input-text-wrap">';
        html += '<input type="text" name="quickeditname" id="quickeditname" class="ptitle" value="'+rangeName+'">';
        html += '<input type="hidden" name="quickedittypeof" id="quickedittypeof" class="ptitle" value="'+typeOf+'">';
        html += '</span>';
        html += '</label>';
        html += '<label>';
        html += '<span class="title">Slots</span>';
        html += '<span class="input-text-wrap"><input type="text" name="quickeditslots" id="quickeditslots" class="ptitle" value="'+slots+'"></span>';
        html += '</label>';
        html += '<label>';
        html += '<span class="title">Ordering</span>';
        html += '<span class="input-text-wrap"><input type="number" name="quickeditordering" id="quickeditordering" class="ptitle" value="'+ordering+'"></span>';
        html += '</label>';

        html += '<label>';
        html += '<span class="title">Scope time</span>';
        // html += '<span class="input-text-wrap"></span>';

        html += '<select name="quickeditscope" id="quickeditscope">';
        html += '<option value="-1"> -- None -- </option>';

        for (const o in scopes) {
            html += '<option ' + getSlected(scope, o) + ' value="'+ o +'"> ' + scopes[o] + ' </option>'; 
        }
        html += '</select>';

        html += '</label>';

        html += '</div>';
        html += '</fieldset>';
        html += '<div class="inline-edit-save submit">';
        html += '<button type="button" data-id="'+id+'" class="cancel button alignleft quickedit-cancel-js">Cancel</button>';
        html += '<button type="button" data-id="'+id+'" class="save button button-primary alignright quickedit-update-js">Update</button>';
        html += '<div class="notice notice-error notice-alt inline hidden">';
        html += '<p class="error"></p>';
        html += '</div>';
        html += '</div>';
        html += '</td>';
        html += '</tr>';

        return html;
    }

    function quickEditAppointmentForm(name = '', phone = '', customernote = '', adminnote = '', coupon = '', id){
        var html = '';
        html += '<tr id="edit-'+id+'" class="inline-edit-row inline-editor" style="">';
        html += '<td colspan="4" class="colspanchange">';
        html += '<fieldset>';
        html += '<legend class="inline-edit-legend"><strong>Quick Edit</strong></legend>';
        html += '<div class="inline-edit-col">';
        html += '<label>';
        html += '<span class="title">Full name</span>';
        html += '<span class="input-text-wrap">';
        html += '<input type="text" name="quickeditname" id="quickeditname" class="ptitle" value="'+name+'"></span>';
        html += '</label>';
        html += '<label>';
        html += '<span class="title">Phone</span>';
        html += '<span class="input-text-wrap">';
        html += '<input type="text" name="quickeditphone" id="quickeditphone" class="ptitle" value="'+phone+'"></span>';
        html += '</label>';
        html += '<label>';
        html += '<span class="title">Customer note</span>';
        html += '<span class="input-text-wrap">';
        html += '<input type="text" name="quickeditcustomernote" id="quickeditcustomernote" class="ptitle" value="'+customernote+'"></span>';
        html += '</label>';
        html += '<label>';
        html += '<span class="title">Admin note</span>';
        html += '<span class="input-text-wrap">';
        html += '<input type="text" name="quickeditadminnote" id="quickeditadminnote" class="ptitle" value="'+adminnote+'"></span>';
        html += '</label>';
        html += '<label>';
        html += '<span class="title">Coupon</span>';
        html += '<span class="input-text-wrap">';
        html += '<input type="text" name="quickeditcoupon" id="quickeditcoupon" class="ptitle" value="'+coupon+'"></span>';
        html += '</label>';
        html += '</div>';
        html += '</fieldset>';
        html += '<div class="inline-edit-save submit">';
        html += '<button type="button" data-id="'+id+'" class="cancel button alignleft quickedit-cancel-js">Cancel</button>';
        html += '<button type="button" data-id="'+id+'" class="save button button-primary alignright quickedit-update-appointment-js">Update</button>';
        html += '<div class="notice notice-error notice-alt inline hidden">';
        html += '<p class="error"></p>';
        html += '</div>';
        html += '</div>';
        html += '</td>';
        html += '</tr>';

        return html;
    }

    $('.delete-button-js').on('click', function(){
        var delId = $(this).attr('data-delId');
        var trset = $(this).attr('data-trset');
        $.ajax({
            type : "post",
            dataType : "json",
            url : adminAjax,
            data : {
                action: "deletetimeset", //Tên action
                delId: delId
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

    // add quick edit time set
    $('.quickedit-button-js').on('click', function(){
        var trset = $(this).attr('data-trset');
        var action = $(this).attr('data-action');
        var typeOf = $(this).attr('data-typeof');
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        var slots = $(this).attr('data-slots');
        var scope = $(this).attr('data-scope');
        var scopes = JSON.parse($(this).attr('data-scopes'));
        var ordering = $(this).attr('data-ordering');
        var checking = document.getElementById('edit-'+id);
        if(!checking){
            if(typeOf === 'app-service')
                $('#'+trset).after(quickEditFormService(name, typeOf, ordering, id));
            else
                $('#'+trset).after(quickEditForm(name, typeOf, slots, scope, scopes, ordering, id));
        }
    })

    // quick edit cancel
    $('#the-list').on('click', '.quickedit-cancel-js', function(){
        var id = $(this).attr('data-id');
        document.getElementById('edit-'+id).remove();
    })

    // quick edit update timeset
    $('#the-list').on('click', '.quickedit-update-js', function(){
        var id = $(this).attr('data-id');
        
        var quickedittypeof = document.getElementById('quickedittypeof').value;
        var quickEditName = document.getElementById('quickeditname').value;
        var quickEditSlots = document.getElementById('quickeditslots')?.value;
        var quickEditScope = document.getElementById('quickeditscope')?.value;
        var quickEditOrdering = document.getElementById('quickeditordering').value;

        ajaxCallPost(
            adminAjax,
            {
                action: "updatequickedit", //Tên action
                updateId: id,
                quickedittypeof: quickedittypeof,
                quickEditName: quickEditName,
                quickEditSlots: quickEditSlots,
                quickEditScope: quickEditScope,
                quickEditOrdering: quickEditOrdering
            }
        )
        .done(function(data){
            // Done
            console.log('=====data: ', data)
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

    // add quick edit Appointment
    $('.quickedit-appointment-button-js').on('click', function(){
        var trset = $(this).attr('data-trset');
        var action = $(this).attr('data-action');
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        var phone = $(this).attr('data-phone');
        var customernote = $(this).attr('data-customernote');
        var adminnote = $(this).attr('data-adminnote');
        var coupon = $(this).attr('data-coupon');
        var checking = document.getElementById('edit-'+id);
        if(!checking)
            $('#'+trset).after(quickEditAppointmentForm(name, phone, customernote, adminnote, coupon, id));
    })

    // Delete Appointment
    $('.delete-appointment-button-js').on('click', function(){
        var delId = $(this).attr('data-delId');
        var trset = $(this).attr('data-trset');

        ajaxCallPost(
            adminAjax,
            {
                action: "deleteappointment", //Tên action
                delId: delId
            }
        )
        .done(function(data){
            // Done
            if(data.success) {
                // success
                $('#'+trset).css("background-color", "red");
                window.setTimeout(() => {
                    document.getElementById(trset).remove();
                }, 500);
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

    // quick edit update Appointment
    $('#the-list').on('click', '.quickedit-update-appointment-js', function(){
        var id = $(this).attr('data-id');
        var quickEditName = document.getElementById('quickeditname').value;
        var quickEditPhone = document.getElementById('quickeditphone').value;
        var quickEditCustomerNote = document.getElementById('quickeditcustomernote').value;
        var quickEditAdminNote = document.getElementById('quickeditadminnote').value;
        var quickEditCoupon = document.getElementById('quickeditcoupon').value;

        ajaxCallPost(
            adminAjax,
            {
                action: "quickupdateappointment", //Tên action
                updateId: id,
                quickEditName: quickEditName,
                quickEditPhone: quickEditPhone,
                quickEditCustomerNote: quickEditCustomerNote,
                quickEditAdminNote: quickEditAdminNote,
                quickEditCoupon: quickEditCoupon
            }
        )
        .done(function(data){
            // Done
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