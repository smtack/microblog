const toggleMenu = document.querySelector('#toggle-menu');
const menu = document.querySelector('.menu');

const postResults = document.querySelector('.post-results');
const userResults = document.querySelector('.user-results');
const togglePostResults = document.querySelector('#toggle-post-results');
const toggleUserResults = document.querySelector('#toggle-user-results');

window.onload = () => {
  menu.style.display = "none";
}

toggleMenu.addEventListener('click', () => {
  if(menu.style.display == "none") {
    menu.style.display = "block";
  } else {
    menu.style.display = "none";
  }
})

if(postResults) {
  window.onload = () => {
    userResults.style.display = "none";
    togglePostResults.style.borderBottom = "5px solid #22313f";
  }

  togglePostResults.addEventListener('click', () => {
    postResults.style.display = "block";
    userResults.style.display = "none";
    togglePostResults.style.borderBottom = "5px solid #22313f";
    toggleUserResults.style.borderBottom = "none";
  })

  toggleUserResults.addEventListener('click', () => {
    postResults.style.display = "none";
    userResults.style.display = "block";
    togglePostResults.style.borderBottom = "none";
    toggleUserResults.style.borderBottom = "5px solid #22313f";
  })
}