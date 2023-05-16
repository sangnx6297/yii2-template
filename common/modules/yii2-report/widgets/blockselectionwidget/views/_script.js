
function search(target, uuid, opts) {
    var $list = $('select.list-'+uuid+'[data-target="' + target +'-'+uuid+ '"]');
    $list.html('');
    var q = $('.search-'+uuid+'[data-target="' + target + '"]').val();
    $.each(opts.items[target], function (key,value) {
        var r = this;
        if(q){
            if (r.hasOwnProperty('text') && r.text.toLowerCase().indexOf(q.toLowerCase()) >= 0) {
                $('<option>').text(r.text).val(r.id).appendTo($list);
            }else if (!r.hasOwnProperty('text') && r.toLowerCase().indexOf(q.toLowerCase()) >= 0) {
                $('<option>').text(r).val(r).appendTo($list);
            }
        }else {
            if(r.hasOwnProperty('id') && r.hasOwnProperty('text')){
                $('<option>').text(r.text).val(r.id).appendTo($list);
            }else {
                $('<option>').text(r).val(r).appendTo($list);
            }
        }
    });
}
function updateRoutes(r, uuid, opts) {
    opts.items.available = r.available;
    opts.items.assigned = r.assigned;
    search('available', uuid, opts);
    search('assigned', uuid, opts);
}

function BlockSelection(uuid, opts, _searchData) {
    this.uuid = uuid;
    this.opts = opts;
    
    this.init = function (){
        $('.animate-'+uuid).hide();

        $('#btn-new-'+uuid).click(function () {
            var $this = $(this);
            var item = $('#inp-route').val().trim();
            if (item != '') {
                $this.children('.animate-'+uuid).show();

                $.post($this.attr('href'), {item: item}, function (r) {
                    $('#inp-route').val('').focus();
                    updateRoutes(r,uuid, opts);
                }).always(function () {
                    $this.children('.animate-'+uuid).hide();
                });
            }
            return false;
        });

        $('.btn-assign-'+uuid).click(function () {
            var $this = $(this);
            var target = $this.data('target');
            var items = $('select.list-'+uuid+'[data-target="' + target + '"]').val();
            if (items && items.length) {
                var pData = {items: items};
                $.each($this.data(),function (key,value){
                    pData[key] = value;
                });

                $.each($('#btn-refresh').data(),function (key,value){
                    var items = value.split("#")
                    pData[items[1]] = $('#'+items[0]).val();
                });

                $this.children('.animate-'+uuid).show();

                $.post($this.attr('href'), pData, function (r) {
                    updateRoutes(r,uuid, opts);
                }).always(function () {
                    $this.children('.animate-'+uuid).hide();
                });
            }
            return false;
        });

        $('#btn-refresh-'+uuid).click(function () {
            var $this = $(this);
            var $icon = $(this).children('i.fas');
            $icon.addClass('fa-spin');
            var pData = {};
            $.each($this.data(),function (key,value){
                var items = value.split("#")
                pData[items[1]] = $('#'+items[0]).val();
            });

            $.each(_searchData, function (key,value){
                pData[key] = value;
            });
            console.log(pData);
            $.post($(this).attr('href'),pData, function (r) {
                updateRoutes(r,uuid, opts);
            }).always(function () {
                $icon.removeClass('fa-spin');
            });
            return false;
        });


        $('.search-'+uuid+'[data-target]').keyup(function () {
            search($(this).data('target'), uuid, opts);
        });
        search('available', uuid, opts);
        search('assigned', uuid, opts);
    }


}

//
// function updateRoutes(r, uuid, opts) {
//     opts.items.available = r.available;
//     opts.items.assigned = r.assigned;
//     search('available-'+uuid);
//     search('assigned-'+uuid);
// }
//
// $('#btn-new').click(function () {
//     var $this = $(this);
//     var item = $('#inp-route').val().trim();
//     if (item != '') {
//         $this.children('.animate-').show();
//
//         $.post($this.attr('href'), {item: item}, function (r) {
//             $('#inp-route').val('').focus();
//             updateRoutes(r);
//         }).always(function () {
//             $this.children('.animate').hide();
//         });
//     }
//     return false;
// });
//
// $('.btn-assign').click(function () {
//     var $this = $(this);
//     var target = $this.data('target');
//     var items = $('select.list[data-target="' + target + '"]').val();
//     if (items && items.length) {
//         var pData = {items: items};
//         $.each($this.data(),function (key,value){
//            pData[key] = value;
//         });
//
//         $.each($('#btn-refresh').data(),function (key,value){
//             var items = value.split("#")
//             pData[items[1]] = $('#'+items[0]).val();
//         });
//
//         $this.children('.animate').show();
//
//         $.post($this.attr('href'), pData, function (r) {
//             updateRoutes(r);
//         }).always(function () {
//             $this.children('.animate').hide();
//         });
//     }
//     return false;
// });
//
// $('#btn-refresh').click(function () {
//     var $this = $(this);
//     var $icon = $(this).children('i.fas');
//     $icon.addClass('fa-spin');
//     var pData = {};
//     $.each($this.data(),function (key,value){
//         var items = value.split("#")
//         pData[items[1]] = $('#'+items[0]).val();
//     });
//
//     $.each(_searchData, function (key,value){
//         pData[key] = value;
//     });
//     console.log(pData);
//     $.post($(this).attr('href'),pData, function (r) {
//         updateRoutes(r);
//     }).always(function () {
//         $icon.removeClass('fa-spin');
//     });
//     return false;
// });
//
// $('.search[data-target]').keyup(function () {
//     search($(this).data('target'));
// });
//
// function search(target) {
//     var $list = $('select.list[data-target="' + target + '"]');
//     $list.html('');
//     var q = $('.search[data-target="' + target + '"]').val();
//     $.each(_opts.items[target], function (key,value) {
//         var r = this;
//         if(q){
//             if (r.hasOwnProperty('text') && r.text.toLowerCase().indexOf(q.toLowerCase()) >= 0) {
//                 $('<option>').text(r.text).val(r.id).appendTo($list);
//             }else if (!r.hasOwnProperty('text') && r.toLowerCase().indexOf(q.toLowerCase()) >= 0) {
//                 $('<option>').text(r).val(r).appendTo($list);
//             }
//         }else {
//             if(r.hasOwnProperty('id') && r.hasOwnProperty('text')){
//                 $('<option>').text(r.text).val(r.id).appendTo($list);
//             }else {
//                 $('<option>').text(r).val(r).appendTo($list);
//             }
//         }
//     });
// }

// initial
// search('available');
// search('assigned');

