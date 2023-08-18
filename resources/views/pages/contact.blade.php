<x-guest-layout> 
    <!-- Main content -->
    <main   class="m-0 p-0">
        <main class="m-0 p-0" id="app">
             <!-- Container -->
            <a class="" href="{{ route('store-locator')}}">
              <img class="d-block w-100" src="{{ asset('images/background/slides/banner3.jpg')}}" alt="Third slide">
            </a>
             <section class="slice   pt-0">
            <!-- Container -->
            <div class="container   mt-0">

              <div class="text-dark rounded p-3  ">
                <div class="  h3 text-purple "><p class=" ">Contact Us</p></div>
                <div class="row  border-bottom pb-3 pt-5">
                  <div class="col-4">
                       <div class=""> 
                           <a href="tel:+27615895114" class="text-dark"> <i class="fa fa-phone    "></i> &nbsp;  +27 61 589 5114</a> <br>
                        </div>
                  </div>
                  <div class="col-4">
                    <div class=""> 
                       <a href="mailto:careline@mabebeza.com" class="text-dark"><i class="fa fa-envelope"  ></i> &nbsp; careline@mabebeza.com</a>
                     </div>
                   </div>
                   <div class="col-4">
                    <div class=""> 
                        <a href="https://instagram.com/mabebezababy?igshid=YmMyMTA2M2Y=" class="text-dark"><i class="fab fa-instagram"></i> &nbsp; MabebezaBaby</a> <br>
                        <a href="https://www.facebook.com/mabebezababy" class="text-dark"><i class="fab fa-facebook" ></i> &nbsp; MabebezaBaby</a>
                    </div>
                   </div>
                  </div>
 
                  <div class="py-5">
                    <div class=" h3 text-purple">Store Locator</div>
                    <div class="">
                      <a href="{{ route('store-locator')}}" class="btn btn-sm rounded btn-purple">find our Store location</a>
                    </div>
                  </div>
                </div>
              
            </div>
    
          </section>
       
      </main>
    </main>
    <script>
      const { createApp } = Vue;
  </script>
</x-guest-layout>