$.fn.xone = function(array) {
    var options = $.extend({
        want: [
            'posts','post','lists'
        ],
        posts: {
            'post_template':null,
            'post_place':null,
            'post':null,
            'post_order':null,
            'items':null,
            'post_link':null,
            'post_image':null,
            'post_html':null,
            'post_title':null,
            'post_caption':null,
            'link_before':null,
            'link_after':null,
        },
        lists: {
            'test' : {
                'list_template':null,
                'list_place' : null,
                'list_name' : null,
                'item_template' : null,
                'item_link' : null,
                'item_title' : null,
            }
        }

    },array);
    $.ajax({
        type:'POST',
        url: "/xone/response.php",
        data: options,
        dataType: 'json',
        success: function (data) {
         // alert(data)
           // $('*').html(data['posts']['post_url']);
          // alert(data['function'][0]['success']);
            if(data['function'][0]['success']==true) {
                $.each(data['items'] ,function(key,value) {
                    if(value=='posts') {
                        var x = data['posts'].length;
                        var link_after = options['posts']['link_after'];
                        var link_before = options['posts']['link_before'];
                        if(options['posts']['link_after'] == null || options['posts']['link_after']=='' || options['posts']['link_after']==' ') {
                            var link_after = '';
                        }
                        if(options['posts']['link_before'] == null || options['posts']['link_before']=='') {
                            var link_before = '';
                        }
                        if(x==1) {
                            $(options['posts']['post_link']).attr('href',link_before+data['posts'][0]['post_url']+link_after);
                            $(options['posts']['post_image']).attr('src',data['posts'][0]['post_thumb']);
                            $(options['posts']['post_caption']).html(data['posts'][0]['post_html']);
                            $(options['posts']['post_title']).html(data['posts'][0]['post_title']);
                            $(options['posts']['post_place']).append(post);   
                        }
                        else {
                            $.each(data['posts'],function(key,value) {
                                var template = options['posts']['post_template'];var post = options['posts']['post'];
                                $(template+' '+post+' '+options['posts']['post_link']).attr('href',link_before+value['post_url']+link_after);
                                $(template+' '+post+' '+options['posts']['post_image']).attr('src',value['post_thumb']);
                                $(template+' '+post+' '+options['posts']['post_caption']).html(value['post_html']);
                                $(template+' '+post+' '+options['posts']['post_title']).html(value['post_title']);
                                var item = $(options['posts']['post_template']).html();
                                $(options['posts']['post_place']).append(item);   
                            });
                        }
                        $(options['posts']['post_template']).html('');
                    }
                    if(value=='menu') {

                    }
                })
            }
        }
    });
    /*
    $.post('xone/response.php',,function(data) {
        alert(data);
    }) */
};