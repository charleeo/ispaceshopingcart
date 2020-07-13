let button = document.querySelectorAll('.view-btn');
let showMore = document.querySelectorAll('.show-more');
button.forEach(btn=>{
  btn.addEventListener('click', ()=>{
    btn.previousElementSibling.classList.toggle('show-more');
  if(btn.value == "More Details"){
    btn.value = "Less Details";
  }else{
    
    btn.value = "More Details";
  }
  });
});

