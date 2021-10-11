$(document).ready(function() {

  table.url = window.baseUrl+'todo/get/todo/'+window.moduleType+window.customeFilter;
  table.columns = window.column;
  table.columnDefs =  [
  {
    "render": function ( data, type, row ) {
      console.log(row);
        return '<a href="#" class="edit-todo" data-url="'+window.baseUrl+'todo/form/'+row.todo+'" data-toggle="modal" data-target="#modal">'+data+'</a>';
    },
    "targets": 0
  } 
  ];
  table.createDataTable();


  $(document).on('click','.edit-todo',function () {
    thisObj = $(this);
    var url = thisObj.data('url');
    ajax.init();
    ajax.method ='get';
    ajax.url = url;
    ajax.ajaxCall(ajax.displayForm);
  });

  $(document).on('change','.option',function(){
    thisObj = $(this);
    val = thisObj.val();
    if(val == 'Due Date') {
      $('.due_date').show();
      $('.linked_to').hide();
    }else {
      $('.due_date').hide();
      $('.linked_to').show();
    }
  });

});
