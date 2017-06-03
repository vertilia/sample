<?php
    $this->onload_pool[__FILE__] =
<<<'EOjs'
var Contract = Backbone.Model.extend();
var Contracts = Backbone.Collection.extend({
    url: '/api/v1/contracts',
});
var cts = new Contracts;
cts.fetch();
var ct = new Contract({id:1}, {collection:cts});
ct.fetch();
ct.set("ref", "RefNo");
ct.save();
cts.create();
ct.destroy();

$('button').click(function(el){
    var method, url, data;
    switch($(el.target).data('type')){
        case 'list': method = 'GET'; url = '/api/v1/contracts'; break;
        case 'create': method = 'POST'; url = '/api/v1/contracts'; data = {'ct_cn_id':1,'ct_ur_id_validator':null,'ct_owner_type':'prov','ct_ref_num':'test/1','ct_is_valid':0,'ct_date_begin':'2016-12-28','ct_date_end':null,'ct_description':'test/1'}; break;
        case 'read': method = 'GET'; url = '/api/v1/contracts/1'; break;
        case 'update': method = 'PUT'; url = '/api/v1/contracts/1'; data = {'code':'contract_code','client':'contract_client'}; break;
        case 'delete': method = 'DELETE'; url = '/api/v1/contracts/1'; break;
    }
    $.ajax({
        method: method,
        url: url,
        data: data,
        success: function(result){console.log(result)},
        error: function(){alert('error!')},
    });
})
EOjs;
?>
<div class="btn-group" role="group" aria-label="group">
    <button type="button" class="btn btn-default" data-type="list">
        List
    </button>
    <button type="button" class="btn btn-default" data-type="create">
        Create
    </button>
    <button type="button" class="btn btn-default" data-type="read">
        Read
    </button>
    <button type="button" class="btn btn-default" data-type="update">
        Update
    </button>
    <button type="button" class="btn btn-default" data-type="delete">
        Delete
    </button>
</div>
