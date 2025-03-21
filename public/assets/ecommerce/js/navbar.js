var burgerBtn = document.getElementById('burgerBtn');
var mobile = document.getElementById('mobile');
var demo1 = document.getElementById('demo1');


burgerBtn.addEventListener('click', function() {
  mobile.classList.toggle('navigation');
}, false);
