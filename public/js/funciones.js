function deleteUser(id){
  $.ajax({
    method: "POST",
    url: "http://saso.local/mvc/api/deleteUser?ajax=true",
    data: { id: id }
  })
  .done(function( result ) {
    if (result.success){
      $('a.delete#'+id).parent('td').parent('tr').remove();
    }
  });
}

$(document).ready(function(){
  $('a.delete').click(function(){
    var id = $(this).attr('id');
    console.log('Click on item ', id);
    deleteUser(id);
  });
  
});