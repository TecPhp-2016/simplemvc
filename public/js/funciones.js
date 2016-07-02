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

function pairwise(list) {
  if (list.length == 1) { return list[0]; }
  var first = list[0],
      rest  = list.slice(1),
      pairs = rest.map(function (x) { return rest.concat(x); });

      console.log(pairs);
  return pairs.concat(pairwise(rest));
}

function cartesianProduct(arr)
{
    return arr.reduce(function(a,b){
        return a.map(function(x){
            return b.map(function(y){
                return x.concat(y);
            })
        }).reduce(function(a,b){ return a.concat(b) },[])
    }, [[]])
}

$(document).ready(function(){
  $('a.delete').click(function(){
    var id = $(this).attr('id');
    console.log('Click on item ', id);
    deleteUser(id);
  });
  
  console.log('cartesianProduct:', cartesianProduct([[1,2,3,4,5],[1,2,3,4,5]]));
});