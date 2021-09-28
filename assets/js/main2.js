function register() {
  var fName = $('#fName').val().trim();
  var lName = $('#lName').val().trim();
  var email = $('#email').val().trim();
  var password = $('#pass').val().trim();
  var passwordConfirm = $('#passConfirm').val().trim();

  var fNamelNameRegex = /^[A-Z][a-z]{2,}(\s[A-Z][a-z]{2,})*$/;
  var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
  var passwordRegex = /^[A-Za-z0-9\.\-\_]{5,}$/;

  if (!fNamelNameRegex.test(fName)) {
    $('#fName').css({ border: '1px solid #AF0606' });
    return false;
  } else {
    $('#fName').css({ border: '1px solid #3D4B0A' });
  }
  if (!fNamelNameRegex.test(lName)) {
    $('#lName').css({ border: '1px solid #AF0606' });
    return false;
  } else {
    $('#lName').css({ border: '1px solid #3D4B0A' });
  }
  if (!emailRegex.test(email)) {
    $('#email').css({ border: '1px solid #AF0606' });
    return false;
  } else {
    $('#email').css({ border: '1px solid #3D4B0A' });
  }
  if (!passwordRegex.test(password)) {
    $('#pass').css({ border: '1px solid #AF0606' });
    return false;
  } else {
    $('#pass').css({ border: '1px solid #3D4B0A' });
  }
  if (passwordConfirm != password) {
    $('#passConfirm').css({ border: '1px solid #AF0606' });
    return false;
  } else {
    $('#passConfirm').css({ border: '1px solid #3D4B0A' });
  }
  return true;
}
function login() {
  var email = $('#emailLog').val().trim();
  var password = $('#passLog').val().trim();

  var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
  var passwordRegex = /^[A-Za-z0-9\.\-\_]{5,}$/;

  if (!emailRegex.test(email)) {
    $('#emailLog').css({ border: '1px solid #AF0606' });
    return false;
  } else {
    $('#emailLog').css({ border: '1px solid #3D4B0A' });
  }
  if (!passwordRegex.test(password)) {
    $('#passLog').css({ border: '1px solid #AF0606' });
    return false;
  } else {
    $('#passLog').css({ border: '1px solid #3D4B0A' });
  }
  return true;
}

$(document).on('click', '#check', function () {
  var checkIn = $('#checkIn').val();
  var checkOut = $('#checkOut').val();
  var roomType = $('#roomType option:selected').val();
  var numPeople = $('#numPeople option:selected').val();

  let date = new Date();
  //console.log(checkout, checkin)
  let checkin = new Date(checkIn);
  let checkout = new Date(checkOut);
  let checkinString = checkin.toLocaleDateString();
  let checkoutString = checkout.toLocaleDateString();

  if (checkin < date) {
    console.log('sdkfesd');
    $('.errorCheckIn').html("Date can't be in the past!");
    return false;
  } else {
    $('.errorCheckIn').html('');
  }
  if (!checkIn) {
    $('.errorCheckIn').html('Please select the date!');
    return false;
  } else {
    $('.errorCheckIn').html('');
  }
  if (checkout < checkin) {
    $('.errorCheckOut').html("Leaving can't be before arrival!");
    return false;
  } else {
    $('.errorCheckOut').html('');
  }
  if (!checkOut) {
    $('.errorCheckOut').html('Please select the date!');
    return false;
  } else {
    $('.errorCheckOut').html('');
  }

  $('html, body').animate(
    {
      scrollTop: $('#scroll').offset().top,
    },
    600
  );

  $.ajax({
    url: 'filterRooms.php',
    method: 'GET',
    data: {
      roomType: roomType,
      numPeople: numPeople,
      checkinString: checkinString,
      checkoutString: checkoutString,
    },
    success: function (data) {
      if (data == '') {
        $('#rooms').html(
          "<section class=' col-md-12 text-center'><h3>We dont have room for your requirements available at the moment.</h3></section>"
        );
      } else {
        let rooms = JSON.parse(data);
        if (rooms.length == 0) {
          $('#rooms').html(
            "<section class=' col-md-12 text-center'><h3>We dont have room for your requirements available at the moment.</h3></section>"
          );
        } else {
          showRooms(rooms);
          //console.log(html);
        }
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });

  return true;
});

// $(document).on("change",".slider1",function(e){
//     console.log($(this).val());
// });
$(document).on('input', '.slider1', function (e) {
  $('.sliderCount1').val($(this).val());
  //console.log($(".slider1").val());
});
$(document).on('input', '.slider2', function (e) {
  $('.sliderCount2').val($(this).val());
});

$(document).on('click', '#search', function () {
  var checkIn = $('#checkIn').val();
  var checkOut = $('#checkOut').val();
  var roomType = $('#roomType option:selected').val();
  var numPeople = $('#numPeople option:selected').val();
  var view = $('#view').val();
  var price1 = $('.slider1').val();
  var price2 = $('.slider2').val();

  let date = new Date();
  //console.log(checkout, checkin)
  let checkin = new Date(checkIn);
  let checkout = new Date(checkOut);
  let checkinString = checkin.toLocaleDateString();
  let checkoutString = checkout.toLocaleDateString();

  if (checkin < date) {
    console.log('sdkfesd');
    $('.errorCheckIn').html("Date can't be in the past!");
    return false;
  } else {
    $('.errorCheckIn').html('');
  }
  if (!checkIn) {
    $('.errorCheckIn').html('Please select the date!');
    return false;
  } else {
    $('.errorCheckIn').html('');
  }
  if (checkout < checkin) {
    $('.errorCheckOut').html("Leaving can't be before arrival!");
    return false;
  } else {
    $('.errorCheckOut').html('');
  }
  if (!checkOut) {
    $('.errorCheckOut').html('Please select the date!');
    return false;
  } else {
    $('.errorCheckOut').html('');
  }

  $.ajax({
    url: 'filterRoomsAdvanced.php',
    method: 'GET',
    data: {
      roomType: roomType,
      numPeople: numPeople,
      checkinString: checkinString,
      checkoutString: checkoutString,
      view: view,
      price1: price1,
      price2: price2,
    },
    success: function (data) {
      if (data == '') {
        $('#rooms').html(
          "<section class=' col-md-12 text-center'><h3>We dont have room for your requirements available at the moment.</h3></section>"
        );
      } else {
        let rooms = JSON.parse(data);
        if (rooms.length == 0) {
          $('#rooms').html(
            "<section class=' col-md-12 text-center'><h3>We dont have room for your requirements available at the moment.</h3></section>"
          );
        } else {
          showRooms(rooms);
          //console.log(html);
        }
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
  return true;
});

function showRooms(rooms) {
  let html = '';
  for (var r of rooms) {
    html += `
        <div class="col-sm col-md-6 col-lg-4 ftco-animate fadeInUp ftco-animated">
        <div class="room">
            <a href="room-single.php?id=${r.idRoom}" class="img d-flex justify-content-center align-items-center" style="background-image: url(images/${r.coverImage});">
                <div class="icon d-flex justify-content-center align-items-center">
                    <span class="icon-search2"></span>
                </div>
            </a>
            <div class="text p-3 text-center">
                <h3 class="mb-3"><a href="rooms-single.html">${r.name}</a></h3>
                <p>${r.number}</p>
                <p><span class="price mr-2">&#36;${r.price}.00</span> <span class="per">per night</span></p>
                    <ul class="list">
                        <li><span>Max: </span>${r.num_people} people</li>
                        <li><span>Size: </span>${r.size} m2</li>
                        <li><span>View: </span>${r.view}</li>
                        <li><span>Bed:  </span>${r.num_beds}</li>
                    </ul>
                    <hr>
                <p class="pt-1"><a href="room-single.php?${r.id}" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
            </div>
        </div>
    </div>
    `;
  }
  $('#rooms').html(html);
}

function contact() {
  var name = $('#name').val().trim();
  var email = $('#email').val().trim();
  var message = $('#message').val();

  var nameRegex = /^[A-Z][a-z]{2,}(\s[A-Z][a-z]{2,})*$/;
  var emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

  if (!nameRegex.test(name)) {
    $('#name').css({ border: '1px solid #AF0606' });
    return false;
  } else {
    $('#name').css({ border: '1px solid #3D4B0A' });
  }
  if (!emailRegex.test(email)) {
    $('#email').css({ border: '1px solid #AF0606' });
    return false;
  } else {
    $('#email').css({ border: '1px solid #3D4B0A' });
  }
  if (!message) {
    $('#message').css({ border: '1px solid #AF0606' });
    return false;
  } else {
    $('#message').css({ border: '1px solid #3D4B0A' });
  }
}

$(document).on('click', '#book', function () {
  var id = $('#id').data('id');
  var checkIn = $('#checkIn').val();
  var checkOut = $('#checkOut').val();
  var numPeople = $('#numPeople option:selected').val();

  let date = new Date();
  let checkin = new Date(checkIn);
  let checkout = new Date(checkOut);
  let checkinString = checkin.toLocaleDateString();
  let checkoutString = checkout.toLocaleDateString();

  if (checkin < date) {
    $('.errorCheckIn').html("Date can't be in the past!");
    return false;
  } else {
    $('.errorCheckIn').html('');
  }
  if (!checkIn) {
    $('.errorCheckIn').html('Please select the date!');
    return false;
  } else {
    $('.errorCheckIn').html('');
  }
  if (checkout < checkin) {
    $('.errorCheckOut').html("Leaving can't be before arrival!");
    return false;
  } else {
    $('.errorCheckOut').html('');
  }
  if (!checkOut) {
    $('.errorCheckOut').html('Please select the date!');
    return false;
  } else {
    $('.errorCheckOut').html('');
  }

  $.ajax({
    url: 'models/bookRoom.php',
    method: 'POST',
    data: {
      id: id,
      numPeople: numPeople,
      checkinString: checkinString,
      checkoutString: checkoutString,
    },
    success: function (data) {
      if (data.success) {
        $('.errorBook').html('The room is succesfully booked');
      } else {
        $('.errorBook').html(
          'The room is unavailable at this time. Try some of our other rooms.'
        );
      }
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
  return true;
});
