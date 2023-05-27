let navbar = document.querySelector('.header .container .header_navbar');

document.querySelector('#menu-icon').onclick = () =>{
   navbar.classList.toggle('active');
}

let cart = document.querySelector('.shopping-cart');

document.querySelector('#shopping').onclick = () =>{
  if(cart != undefined) {
   cart.classList.add('active');
  }
}

if(document.querySelector('#close-cart') != undefined) {
  document.querySelector('#close-cart').onclick = () =>{
    if(cart != undefined) {
     cart.classList.remove('active');
    }
  }
}

window.onscroll = () =>{
    navbar.classList.remove('active');
    cart.classList.remove('active');
};


let account = document.querySelector('.submenu-wrap');


window.onload = function(){ 
  var user = document.querySelector('#user');
  if (user != undefined) {
    user.onclick = () =>{
      account.classList.toggle('open-menu');
    }
  }
};



window.onscroll = () =>{
    account.classList.remove('open-menu');
};

const container = document.querySelector(".container"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");

    //   js code to show/hide password and change icon
pwShowHide.forEach(eyeIcon =>{
    eyeIcon.addEventListener("click", ()=>{
        pwFields.forEach(pwField =>{
            if(pwField.type ==="password"){
                pwField.type = "text";

                pwShowHide.forEach(icon =>{
                    icon.classList.replace("uil-eye-slash", "uil-eye");
                })
            }else{
                pwField.type = "password";

                pwShowHide.forEach(icon =>{
                    icon.classList.replace("uil-eye", "uil-eye-slash");
                })
            }
        }) 
    })
})

// // js code to appear signup and login form
// signUp.addEventListener("click", ( )=>{
//     container.classList.add("active");
// });
// login.addEventListener("click", ( )=>{
//     container.classList.remove("active");
// });

