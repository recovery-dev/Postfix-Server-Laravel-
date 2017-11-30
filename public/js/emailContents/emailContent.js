$(".attachment").css("display", "none")

$(".email-item").click( e => {
  event.preventDefault()
  email_id = e.currentTarget.dataset.id
  $("#sequence").val(e.currentTarget.dataset.seq)
  $.ajax({
    url: '/contents/' + email_id,
    type: 'GET',
    success: res => {
      console.log("response:", res)
      $('.mail_date').text(res[0].receive_time)
      $(".mail_body").text(res[0].body_text)
      $(".mail_subject").text(res[0].subject)
      $(".mail_sender").text(res[0].sender)
      // $(".mail_task_status").css('color', 'green')
      const attachment = res[0].structure
      if (attachment) {
        $('.attachment').css('display', 'block')
      } else {
        $(".attachment").css("display", "none")
      }
    }
  })
})

$(".create-mailbox").click( e => {
  $.ajax({
    url: '/contents/mailbox/create',
    data: {
      'id': $("#imap_account_id").val(),
      "_token": $('#token').val(),
      'name': $('#mailbox-name').val()
    },
    type: 'POST',
    success: res => {
      console.log("mailbox created successfully")
    }
  })
})
$(".mark-as-read").click( e => {
  if (!$("#sequence").val()) {
    return alert("Select the email to mark");
  }
  $.ajax({
    url: '/contents/read',
    data: {
      'id': $("#imap_account_id").val(),
      "_token": $('#token').val(),
      'sequence': $("#sequence").val()
    },
    type: 'POST',
    success: res => {
      console.log("mailbox marked as seen")
    }
  })
})
$(".mark-as-unread").click( e => {
  if (!$("#sequence").val()) {
    return alert("Select the email to mark");
  }
  $.ajax({
    url: '/contents/unread',
    data: {
      'id': $("#imap_account_id").val(),
      "_token": $('#token').val(),
      'sequence': $("#sequence").val()
    },
    type: 'POST',
    success: res => {
      console.log("mailbox marked as seen")
    }
  })
})
$(".move-to").click( e => {
  if (!$("#sequence").val()) {
    return alert("Select the email to move");
  }
  $.ajax({
    url: '/contents/mailbox/list/' + $('#imap_account_id').val() ,
    type: "GET",
    success: res => {
      $('.mailbox').remove()
      res.forEach(function(element) {
        const mailbox = element.split('}')[1]

        const span = document.createElement("span")
        span.innerHTML = mailbox
        span.className = 'mailbox'
        span.addEventListener('click', e => {
          const modal = document.getElementsByClassName("move-to-modal")[0];
          modal.classList.remove("move-to-effect");
          // span.classList.add('reverse-effect')
          const mailboxName = e.toElement.innerHTML
           $.ajax({
             url: "/contents/move",
             data: {
               _token: $("#token").val(),
               id: $("#imap_account_id").val(),
               name: mailboxName,
               sequence: $("#sequence").val()
             },
             type: "POST",
             success: res => {
               console.log("mail moved successfully");
             }
           })
        })
        document.getElementsByClassName("move-to-modal")[0].appendChild(span);
      }, this);
    }
  })
  $(".move-to-modal").addClass("move-to-effect");
  
})

$(".delete-mailbox").click( e => {
  $.ajax({
    url: '/contents/mailbox/delete',
    data: {
      "_token": $('#token').val(),
      'id': $("#imap_account_id").val(),
      'name': $("#mailbox").val() // Current mailbox to be deleted
    },
    type: 'POST',
    success: res => {
      console.log("mailbox deleted successfully")
    }
  })
})  
$(".delete-email").click( e => {
  if (!$("#sequence").val()) {
    return alert("Select the email to delete");
  } 
  $.ajax({
    url: '/contents/mail/delete',
    data: {
      "_token": $('#token').val(),
      'id': $("#imap_account_id").val(),
      "sequence": $("#sequence").val()
    },
    type: 'POST',
    success: res => {
      console.log("Email deleted successfully")
    }
  })
})

$(document).bind('mouseup', e => {
  if (!$(e.target).is(".move-to-modal, .move-to")) {
    console.log("Here is ...")
    $('.move-to-modal').removeClass('move-to-effect')
  }
})