// Get the form element
const logInForm = document.getElementById('log-in-form');
const registerForm = document.getElementById('register-form');
const addPostForm = document.getElementById('add-post-form');
const addPostBtn = document.getElementById('add-post-btn');
var articleBtn = document.querySelectorAll('.read-more-btn');

articleBtn.forEach(function(button) {
  button.addEventListener('click', function() {

    console.log("Button clicked. Id: " + this.id);
   
  });
});

function setSessionCookie(name, value, days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function getSessionCookie(name) {
  const cookieString = document.cookie;
  const cookies = cookieString.split(';');
  for (let i = 0; i < cookies.length; i++) {
      const cookie = cookies[i].trim();
      // Check if this cookie is the one we're looking for
      if (cookie.startsWith(name + '=')) {
          return cookie.substring(name.length + 1);
      }
  }
  // Cookie not found
  return null;
}

if (logInForm !== null) {
  logInForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    
   let email = document.getElementById('email');
   let password = document.getElementById('password');

   let url = "http://localhost/blog-app/backend/index.php/login";


   const data = {
    "email": email.value,
    "password":password.value
    };
    try {

      const response = await fetch(url, {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
      });
  
      if (!response.ok) {
        throw new Error('Error');
    }

    const dataa = await response.json();
    console.log(dataa);
    if(dataa["status"]==true){
      setSessionCookie("user_id",dataa["status"],10);
      window.location.href = '../pages/home.html';
    }
    } catch (error) {
    console.error('Error:', error);
    }
    


});
}

if(registerForm!==null){
  registerForm.addEventListener("submit",async (event)=>{
  event.preventDefault();

  let name = document.getElementById('name');
  let surname = document.getElementById('surname');
  let email = document.getElementById('email');
  let password = document.getElementById('password');

  let url = "http://localhost/blog-app/backend/index.php/register";

  console.log(name.value);
 
   const data = {
    "name":name.value,
    "surname":surname.value,
    "email":email.value,
    "password":password.value
    };

    try {

      const response = await fetch(url, {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
      });
  
      if (!response.ok) {
        throw new Error('Error');
    }

    const dataa = await response.json();
    console.log(dataa["status"]);
    if(dataa["status"]===true){
      window.location.href = "../pages/login.html";
    }
    } catch (error) {
    console.error('Error:', error);
    }


  })
}

if(addPostForm!==null){

  addPostForm.addEventListener("submit", (event)=>{
    event.preventDefault();

    let heading = document.getElementById('heading');
    let shortDesc= document.getElementById('shortDesc');
    let desc= document.getElementById('desc');
    let img = document.getElementById('imageInput').files[0];


    const data = {
      "heading":heading.value,
      "shortDesc":shortDesc.value,
      "desc":desc.value,
      "img":img.name,
      "user_id":getSessionCookie("user_id")
      };

      let url = "http://localhost/blog-app/backend/index.php/add-post";

      fetch(url, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      }).then(response => response.json()).then(data=>{
          //console.log("response:",data);
          window.location.href = '../pages/home.html';
          if(data==true){
            window.location.href = '../pages/home.html';
          }
      })
      .catch(error => {
          console.error('Error:', error);
      });

      
  })
}

