(function(exports, $, bb){

    //document ready
    $(function(){

        /**
         ***************************************
         * App
         ***************************************
         */
        var app = {

            init: function(){
                app.registerEvents();
            },
            toggleLoader:function(e)
            {
                if(e=='show')
                    $('#ajax-loader').show();
                else
                    $('#ajax-loader').hide();
            },
            notify:function(type,text,autoHide)
            {
                var options = {
                    text: text,
                    type: type,
                    layout: 'topCenter'
                };
                autoHide==undefined?autoHide=true:false;
                if(autoHide)
                    options.timeout = 3000;
                noty(options);
            },
            addDomain: function()
            {
                $('#app-modal').html(App.template.add);
                $('#app-modal').modal('show')
            },
            getDomainInfo: function(e)
            {
                e.preventDefault();
//                var re = new RegExp(/^((?:(?:(?:\w[\.\-\+]?)*)\w)+)((?:(?:(?:\w[\.\-\+]?){0,62})\w)+)\.(\w{2,6})$/);
                var domain = $('#app-modal input').val();
//                if(domain.match(re))
                if($.trim(domain)!='')
                {
                    app.toggleLoader('show');
                    $.ajax({
                        url: SITE_URL+'/domaininfo',
                        type: 'GET',
                        dataType: 'json',
                        data:{domain:domain},
                        success: function(data) {
                            var template = _.template(App.template.editFields);
                            $('#app-modal').html(template(data));
                            app.toggleLoader('hide');
                        },
                        error: function(xhr)
                        {
                            app.notify('error',xhr.responseText);
                            app.toggleLoader('hide');
                        }
                    });
                }
                else
                {
                    app.notify('error','invalid domain');
                }
            },
            submitDomain: function(e){
                e.preventDefault();
                var data = $(this).serialize();
                app.toggleLoader('show');
                $.ajax({
                    url: SITE_URL+'/add',
                    method:'POST',
                    data: data,
                    dataType: 'json',
                    success: function(data)
                    {
                        var template = _.template(App.template.viewDomain);
                        $('#app-modal').html(template(data));
                        app.notify('success','Domain added successfully');
                        $('#container .domains').append('<li data-attr-domain="'+data.domain+'">'+data.domain+'</li>')
                        app.toggleLoader('hide');
                    },
                    error: function(xhr){
                        app.notify('error',xhr.responseText);
                        app.toggleLoader('hide');
                    }
                })
            },
            viewDomain: function(){
                app.toggleLoader('show');
                $.ajax({
                    url: SITE_URL+'/view',
                    method:'get',
                    data: {domain:$(this).attr('data-attr-domain')},
                    dataType: 'json',
                    success: function(data)
                    {
                        var template = _.template(App.template.viewDomain);
                        $('#app-modal').html(template(data)).modal('show');
                        app.toggleLoader('hide');
                    },
                    error: function(xhr){
                        app.notify('error',xhr.responseText);
                        app.toggleLoader('hide');
                    }
                })
            },
            registerEvents: function(){
                $('#container')
                    .on('click','.add-domain',app.addDomain)
                    .on('click','.domains li',app.viewDomain)
                    .on('submit','form[name="get-info"]',app.getDomainInfo)
                    .on('submit','form[name="submit-domain"]',app.submitDomain);
            }
        };
        app.init();
    });//end document ready

}(this, jQuery));