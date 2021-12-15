function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

var menu = document.getElementById('socialIcon');

function showSocial() {
  menu.classList.toggle('force-60');
  menu.classList.toggle('force-0');
  hideNav.classList.toggle('force-margin-top');
}

function showPreloader() {
        document.getElementById('preloader').classList.remove('d-none');
        window.setTimeout(function(){
             document.getElementById('loading-text').innerHTML = 'Retrieving your resources. Please wait...!';
        },5000);
        window.setTimeout(function(){
             document.getElementById('loading-text').innerHTML = 'Finallize your account...!';
        },8000);
        window.setTimeout(function(){
             document.getElementById('loading-text').innerHTML = 'Done...!';
        },11000);

};

//script run on-load

window.onload = function() {
  if (window.localStorage.getItem('usrDta') !== null) {
    var usrDta = JSON.parse(localStorage.getItem('usrDta')).Data;
    document.getElementById('user-login').innerHTML = usrDta.FirstName + ' ' + usrDta.LastName;
    document.getElementById('user-login').href = './index.php?page=usrIndex';
  };
};


// pop-up notification
function showNotice() {
    var currOprPaymnt = localStorage.getItem('currOprPaymnt');
    var usrDta = localStorage.getItem('usrDta');

    if (usrDta == null || usrDta == "") {
      document.getElementById('loginReq').classList.remove('d-none');
      document.getElementById('loginReq').classList.add('d-flex');

    } else {
        document.querySelector('.cardInput').style.display = 'flex';
        token = document.createElement('input');
        token.name = 'currUsrTkn';
        token.type = 'hidden';
        token.value = localStorage.getItem('currUsrTkn');
        document.getElementById('frmStripePayment').appendChild(token);
        for (var i = 0; i < document.querySelectorAll(".email").length; i++) {
            document.querySelectorAll(".email")[i].value =  JSON.parse(usrDta).Data.DetailUserInfo.Email || JSON.parse(usrDta).Data.DetailUserInfo.ParentInfo.Email;
        };

        if (currOprPaymnt !== null && currOprPaymnt !== ''){
            subId = document.createElement('input');
            subId.name = 'subId';
            subId.type = 'hidden';
            subId.value = JSON.parse(currOprPaymnt).Data._id;
            document.getElementById('frmStripePayment').appendChild(subId);
            //card removed
            if (JSON.parse(currOprPaymnt).Data.ExpYear == 0) {
                document.getElementById('frmStripePayment').action = './10_stripe/addNewCard.php';

                domain = document.createElement('input');
                domain.name = 'domain';
                domain.type = 'hidden';
                if (JSON.parse(usrDta).Data.Role[0] == "STUDENT") {
                    domain.value  = 'testprepadmin';
                } else {
                    domain.value =  'classadmin';
                }
                document.getElementById('frmStripePayment').appendChild(domain);
                if(event.target.classList.contains('prcbtn') == true){
                        price = document.createElement('input');
                        price.name = 'price';
                        price.type = 'hidden';
                        price.value = event.target.getAttribute("data-value");
                        document.getElementById('frmStripePayment').appendChild(price);

                        interval = document.createElement('input');
                        interval.name = 'interval';
                        interval.type = 'hidden';
                        interval.value = event.target.getAttribute("data-value2");
                        document.getElementById('frmStripePayment').appendChild(interval);

                        product = document.createElement('input');
                        product.name = 'product';
                        product.type = 'hidden';
                        product.value = event.target.getAttribute("data-value3");
                        document.getElementById('frmStripePayment').appendChild(product);

                    }else{
                        interval = document.createElement('input');
                        interval.name = 'interval';
                        interval.type = 'hidden';
                        interval.value = JSON.parse(currOprPaymnt).Data.Name;
                        document.getElementById('frmStripePayment').appendChild(interval);
                    };
                } else {
                    //card available
                    //change payment if user pay for different interval
                      document.querySelector('.cardInput').style.opacity = '0';
                      document.getElementById('frmStripePayment').action = './10_stripe/updateinterval.php';

                      domain = document.createElement('input');
                      domain.name = 'domain';
                      domain.type = 'hidden';
                      domain.value = event.target.getAttribute("data-value4");
                      document.getElementById('frmStripePayment').appendChild(domain);

                      interval = document.createElement('input');
                      interval.name = 'interval';
                      interval.type = 'hidden';
                      interval.value = event.target.getAttribute("data-value2");
                      document.getElementById('frmStripePayment').appendChild(interval);

                      price = document.createElement('input');
                      price.name = 'price';
                      price.type = 'hidden';
                      price.value = event.target.getAttribute("data-value");
                      document.getElementById('frmStripePayment').appendChild(price);
                      
                      document.getElementById('frmStripePayment').submit();
                      showPreloader();
                };
            }else if (currOprPaymnt == "" || currOprPaymnt == null) {
                  //pay for the 1st time
                    price = document.createElement('input');
                    price.name = 'price';
                    price.type = 'hidden';
                    price.value = event.target.getAttribute("data-value");
                    document.getElementById('frmStripePayment').appendChild(price);

                    product = document.createElement('input');
                    product.name = 'product';
                    product.type = 'hidden';
                    product.value = event.target.getAttribute("data-value3");
                    document.getElementById('frmStripePayment').appendChild(product);

                    interval = document.createElement('input');
                    interval.name = 'interval';
                    interval.type = 'hidden';
                    interval.value = event.target.getAttribute("data-value2");
                    document.getElementById('frmStripePayment').appendChild(interval);

                    domain = document.createElement('input');
                    domain.name = 'domain';
                    domain.type = 'hidden';
                    domain.value = event.target.getAttribute("data-value4");
                    document.getElementById('frmStripePayment').appendChild(domain);

                    event.preventDefault();
            };
        };
    };

function studentSignUp() {
    document.getElementById('Student-Form').style.display = 'flex';
    event.preventDefault();
};

function teacherSignUp() {
    document.getElementById('Teacher-Form').style.display = 'flex';
    event.preventDefault();
};

//switch pricing table
var teacherChart = document.getElementById('price-chart-teacher');
var studentChart = document.getElementById('price-chart-student');
var teacherButton = document.getElementById('teacher-btn');
var studentButton = document.getElementById('student-btn');

function showTeacherPrice() {
  teacherChart.style.display='flex';
  teacherButton.classList.remove('btn-outline-304d73');
  teacherButton.classList.add('btn-304d73');

  studentChart.style.display='none';
  studentButton.classList.remove('btn-304d73');
  studentButton.classList.add('btn-outline-304d73');
}


function showStudentPrice() {
  studentChart.style.display='flex';
  studentButton.classList.add('btn-304d73');
  studentButton.classList.remove('btn-outline-304d73');

  teacherChart.style.display='none';
  teacherButton.classList.add('btn-outline-304d73');
  teacherButton.classList.remove('btn-304d73');
}


function stripePay(e) {
    e.preventDefault();
    var valid = cardValidation();

    if(valid == true) {
      document.getElementById('frmStripePayment').submit();
        return false;
    }
}

function cardValidation () {
    var valid = true;
    var cardNumber = $('#card-number').val();
    var month = $('#month').val();
    var year = $('#year').val();
    var cvc = $('#cvc').val();

    $("#error-message").html("").hide();

    if (cardNumber.trim() == "") {
         valid = false;
    }

    if (month.trim() == "") {
          valid = false;
    }
    if (year.trim() == "") {
        valid = false;
    }
    if (cvc.trim() == "") {
        valid = false;
    }

    if(valid == false) {
        $("#error-message").html("All Fields are required").show();
    }

    return valid;
}
