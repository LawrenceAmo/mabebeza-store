  
<div class="m-md-5  pt-1 px-md-5">
   <div class="card mt-3">
     <div class="row p-3">
        <div class="col-md-6   " style="border-right: 1px solid grey">

            <div class="d-flex    justify-content-center ">
                <div class="   d-xs-none    text-center">
                     <p class="font-weight-bold h4 font-Raleway text-purple">Welcome To Mabebeza</p>

             <div class=" ">
                  <img
                    class="card-img-top  "
                    src="{{ asset('logo.png') }}"
                    height="300"
                    alt="mabebeza store logo"
                    loading="lazy"
              />
             </div>
              
                <i class="  h5 pt-3 text-muted">Your Data is secure with us</i>
                <p class="   font-weight-light d-none">Text Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Debitis consequatur sint rem facilis totam dolorum aut temporibus. Aliquam dicta optio sint,
                </p>
              </div>
            </div>

        </div>
         <div class="col-md-6  ">

            <div class=" d-flex   border-danger p-1  justify-content-center">
                 <div class="   w-75 ">
                    <h4 class=" ">{{ $logo }}</h4>
                    <p class="  ">
                        {{ $slot }}
                    </p>
                </div>
            </div>

        </div>
    </div>
   </div>
</div>
<script>
    const { createApp } = Vue;
</script>