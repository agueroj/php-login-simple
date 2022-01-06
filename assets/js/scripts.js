document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("form-user").addEventListener('submit', validateForm); 
  });
  
  function validateForm(evento) {
    evento.preventDefault();
    var email = document.getElementById('email').value;
    if(email.length == 0) {
      alert('the email field is empty.');
      return;
    }
    var pass = document.getElementById('password').value;
    if (pass.length == 0) {
      alert('the password field is empty.');
      return;
    }
    var passv = document.getElementById('confirm_password').value;
    if (passv.length == 0) {
      alert('the  confirm password field is empty.');
      return;
    }
    if (passv != pass) {
        alert('Passwords do not match!');
        return;
      }
    this.submit();
  }