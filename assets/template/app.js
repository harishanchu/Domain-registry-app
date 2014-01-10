////include underscore before this file
_.templateSettings = {
    interpolate: /\{\{\=(.+?)\}\}/g,
    escape: /\{\{\-(.+?)\}\}/g,
    evaluate: /\{\{(.+?)\}\}/g
};
App = window.App || {};
App.template = {};
App.template.add =
    [
        '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Add domain</h3>'+
        '</div>'+
        '<div class="modal-body">'+
            '<form name="get-info">'+
            '<label>Enter domain</label>'+
            '<input class="input-block-level" type="text" placeholder="www.google.com">'+
            '<button class="btn btn-primary pull-right get-domain-info">Go</button>'+
            '</form>'+
        '</div>'
    ].join("\n");
App.template.editFields =
    [
        '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>Add domain</h3>'+
        '</div>'+
        '<div class="modal-body">'+
            '<form name="submit-domain">'+
            '<label>Enter domain</label>'+
            '<input class="input-block-level" type="text" name="domain" value="{{= domain }}">'+
            '<div class="filds">'+
                '<label>Title</label>'+
                '<input class="input-block-level" type="text" name="title" value="{{= title }}" >'+
                '<label>Keywords</label>'+
                '<textarea class="input-block-level" rows="2" name="keywords">'+
                    '{{= keywords }}'+
                '</textarea>'+
                '<label>Description</label>'+
                '<textarea class="input-block-level" rows="4" name="description" >' +
                '{{= description }}'+
                '</textarea>'+
                '<button class="btn btn-primary pull-right submit-domain">Save</button>'+
            '</form>'+
            '</div>'+
        '</div>'
    ].join("\n");
App.template.viewDomain =
    [
        '<div class="modal-header">'+
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>'+
            '<h3>{{= domain }}</h3>'+
            '</div>'+
            '<div class="modal-body">'+
            '<div class="filds">'+
            '<h6>Title</h6>'+
            '<div>{{= title }}</div>'+
            '<h6>Keywords</h6>'+
            '<div>{{= keywords }}</div>'+
            '<h6>Description</h6>'+
            '<div>{{= description }}</div>'+
            '</div>'+
        '</div>'
    ].join("\n");