<?php
// include '03_loginForm/form.php';
include 'home-header.php';
include 'tutoring.php';
include 'teacher-resource.php';
include 'student-resource.php';
include '00_siteNavigation/socialMed.php' ;
?>

<button onclick="topFunction()" id="myBtn"><span class="fa fa-chevron-up"></span></button>
<script>
// Navigation Bar
var prevScrollpos = window.pageYOffset;
var mybutton = document.getElementById("myBtn");
var hideNav = document.getElementById("hideNav");
var socialNav = document.getElementById("socialIcon");

window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    hideNav.style.marginTop = "0";
    socialNav.style.right = "0";
  } else {
    hideNav.style.marginTop = "-120px";
    socialNav.style.right = "-60px";
  }
  prevScrollpos = currentScrollPos;

  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
</script>

