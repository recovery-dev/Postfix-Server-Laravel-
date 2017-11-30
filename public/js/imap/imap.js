$('.config-edit').click((e) => {
  $("#edit-id").val(e.toElement.dataset.id)
    $.ajax({
      url: '/imap/config/' + e.toElement.dataset.id,
      success: (res) => {
        $("#edit-id").val(res[0]['id']);
        $("#username").val(res[0]['username']);
        $("#password").val(res[0]['password']);
        $("#fqdn").val(res[0]['fqdn']);
        $("#port").val(res[0]['port']);
        $("#protocol").val(res[0]['protocol']);
        $("#folder_name").val(res[0]['folder_name']);
      }
    });
  }
)

$( ".imap-add-form" ).submit(function(event) {
  const data = $( this ).serializeArray();
  console.log("data is to be added into the IMAP table", data);
  event.preventDefault();
  $.ajax({
    url: '/imap/add',
    type: 'POST',
    data: data,
    success: (res) => {
      console.log("IMAP added:" + res);
    }
  });
});

$( ".imap-edit-form" ).submit(function(event) {
  const data = $( this ).serializeArray();
  console.log(data);
  event.preventDefault();
  $.ajax({
    url: '/imap/edit',
    type: 'POST',
    data: data,
    success: (res) => {
      console.log("IMAP edited:" + res);
    }
  });
});

$('.del-imap-acct').click((e) => {
  $('.config-delete').click();
})