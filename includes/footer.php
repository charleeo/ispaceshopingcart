<footer>
  <h3 class="text-primary">Stay in touch</h3>
  <h3>Ispace Club</h3>
  <ul>
    <li>
      <i class="fa fa-globe fa-2x"></i>
      <a href="http://www.ispace.proxynetgroup.com">
        http://www.ispace.proxynetgroup.com
      </a>
    </li>
    <li>
      <i class="fa fa-phone fa-2x"></i>
      <a href="tel: +2348124019660">
        +2348124019660
      </a>
    </li>
      <i class="fa fa-envelope fa-2x"></i>
      <a href="mailto:info@proxynetgroup.com">
        info@proxynetgroup.com
      </a>
    </li>
  </ul>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="./assets/js/custom-js.js"></script>

<script>
    let viewMore = document.querySelectorAll(".show-more");
    let viewBtn = document.querySelectorAll(".view-btn");
    let showlessBtn = document.querySelectorAll(".toggle-btn");
    function ViewAll(){
    viewBtn.forEach(function(btn){
      if(btn.value == 'More'){

      viewMore.forEach(function(m){
        m.classList.remove('show-more');
          btn.value = 'Less'
        });
        }else{
          
        viewMore.forEach(function(m){
          m.classList.add('show-more');
            btn.value = 'More'
          });
        }
      })
    }
</script>
</body>
</html>