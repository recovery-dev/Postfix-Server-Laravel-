$(".task-edit").click(e => {
  const id = e.toElement.dataset.id;
  $("#task-edit-id").val(id)
  $.ajax({
    url: "/task/task/" + id,
    success: res => {
      $("#task_name").val(res[0]["task_name"]);
      $("#description").val(res[0]["description"]);
      $(".task-time").val(res[0]["reservation_time"]);
      
      $("#task_name").val(res[0]["task_name"]);
      $("#status").val(res[0]["status"]);
      $("#description").val(res[0]["description"]);

      $("#from_equal").val(res[0]["from_equal"]);
      $("#from_contains").val(res[0]["from_contains"]);
      $("#from_start").val(res[0]["from_start"]);
      $("#from_end").val(res[0]["from_end"]);
      $("#from_regex").val(res[0]["from_regex"]);

      $("#recipient_equal").val(res[0]["recipient_equal"]);
      $("#recipient_contains").val(res[0]["recipient_contains"]);
      $("#recipient_start").val(res[0]["recipient_start"]);
      $("#recipient_end").val(res[0]["recipient_end"]);
      $("#recipient_regex").val(res[0]["recipient_regex"]);
      
      $("#subject_equal").val(res[0]["subject_equal"]);
      $("#subject_contains").val(res[0]["subject_contains"]);
      $("#subject_start").val(res[0]["subject_start"]);
      $("#subject_end").val(res[0]["subject_end"]);
      $("#subject_regex").val(res[0]["subject_regex"]);

      $("#body_equal").val(res[0]["body_equal"]);
      $("#body_contains").val(res[0]["body_contains"]);
      $("#body_start").val(res[0]["body_start"]);
      $("#body_end").val(res[0]["body_end"]);
      $("#body_regex").val(res[0]["body_regex"]);

      $("#everyhour").val(res[0]["everyhour"]);
      $("#everyday").val(res[0]["everyday"]);
      $("#everyweek").val(res[0]["everyweek"]);
      $("#everymonth").val(res[0]["everymonth"]);
      $("#everyyear").val(res[0]["everyyear"]);
  
    }
  });
});

$(".task-add-form").submit(function(event) {
  const data = $(this).serializeArray();
  console.log("data is to be added into the task table", data);
  event.preventDefault();
  console.log("add-task")
  $.ajax({
    url: "/task/add",
    type: "POST",
    data: data,
    success: res => {
      console.log("task added:" + res);
    }
  });
});

$(".task-edit-form").submit(function(event) {
  const data = $(this).serializeArray();
  console.log(data);
  event.preventDefault();
  $.ajax({
    url: "/task/edit",
    type: "POST",
    data: data,
    success: res => {
      console.log("task edited:" + res);
    }
  });
});

$(".del-task").click(e => {
  $(".task-delete").click();
});
