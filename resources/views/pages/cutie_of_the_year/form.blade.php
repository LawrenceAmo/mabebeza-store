<x-CutieYear-layout> 
 
    <style>
        .hero_image{
        width: 300px;
        height: 300px;
    }
    ::placeholder {
        font-family: 'Raleway', sans-serif !important; 
    }
    input, select{
        border-radius: 50px !important;
        background-color: aliceblue !important;
    }
    .circle-blue{
        left: 10%;
    }
    .circle-light-blue{
        top: 200px;
        left: 15%;
    }
    .circle-purple{
        /* top: 200px; */
        bottom: -200px;
    
        left: 10%;
    }
    .circle-pink{
        top: 50%;
    }
    
    @media screen and (max-width: 500px) {
        /* .footer{
            background-color: #94d2ec;
            position: fixed;
            bottom: 0px;
        } */
    }
    .input-container {
  position: relative;
}

.input-field {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
}

.placeholder-label {
  position: absolute;
  top: 50%;
  left: 10px;
  transform: translateY(-50%);
  pointer-events: none; /* Prevent label from interfering with input focus */
  transition: transform 0.2s, font-size 0.2s;
}

.input-field:focus + .placeholder-label,
.input-field:not(:placeholder-shown) + .placeholder-label {
  transform: translateY(-100%) scale(0.8);
  font-size: 12px;
  color: #999;
}
    </style>
            <section class="px-5 pt-3">
                <img src="{{ asset('/CutieYear/images/PinkCircle.svg') }}" class="circle-pink" alt=""> 

                <div class="row mx-0 animated fadeInDown">
                    <div class="col-12 text-center p-0 m-0">
                        <p class="animated pulse w-100 pt-2">@include('inc.messages')</p>
                    </div>
                 </div>
                <div class="row ">
                    <div class="col-md-6  d-flex flex-column justify-content-center ">
                        <form action="{{ route('cutie-of-the-year-save')}}" method="post" class="px-3" enctype="multipart/form-data">
                            @csrf
                            <label for="">Your Names</label>
    
                            <div class="row">
                                <div class="col-md-6 form-outline input-container mb-2">
                                    <input type="text" id="myInput" value="{{ old('parent_name',$data["parent_name"])}}" name="parent_name" class="form-control form-control-md input-field" placeholder="Name" />
                                    <label  class="placeholder-label pl-3">Enter your Name</label>
                                </div>
                                 <div class="col-md-6 form-outline input-container mb-2">
                                    <input type="text" value="{{ old('parent_surname',$data["parent_surname"])}}" name="parent_surname" class="form-control form-control-md input-field" placeholder="Surname"/>
                                    <label  class="placeholder-label pl-3">Enter your surname</label>
                                </div>
                            </div>
    
                            <label for="">Baby's Names</label>
                            <div class="row ">
                                <div class="col-md-6 form-outline input-container mb-2">
                                    <input type="text" value="{{ old('child_name',$data["child_name"])}}" name="child_name" class="form-control form-control-md input-field" placeholder="Name" />
                                    <label  class="placeholder-label pl-3">Enter baby's name</label>
                                </div>
                                 <div class=" col-md-6 form-outline input-container mb-2 ">
                                    <input type="text" value="{{ old('child_surname',$data["child_surname"])}}" name="child_surname" class="form-control form-control-md input-field" placeholder="Surname"/>
                                    <label  class="placeholder-label pl-3">Enter baby's surname</label>
                                </div>
                            </div>
    
                            <div class="form-group">
                                 <select class="custom-select" value="{{ old('store',$data["store"])}}" name="store"  >
                                    <option selected disabled>Select Nearest Store</option>
                                    <option value="Mabebeza Mega Mart">Mabebeza Mega Mart</option>
                                    <option value="Mabebeza Bambanani">Mabebeza Bambanani</option>                      
                                </select>
                            </div>
                            <div class="form-outline input-container mb-3">
                                <input type="text" value="{{ old('reciept',$data["reciept"])}}" name="reciept" class="form-control form-control-md input-field " placeholder="Receipt number" />
                                <label  class="placeholder-label pl-3">Enter receipt number</label>
                            </div>
                            <div class="form-outline input-container mb-3">
                                <input type="email" value="{{ old('email',$data["email"])}}" name="email" class="form-control form-control-md input-field " placeholder="Email Address" />
                                <label  class="placeholder-label pl-3">Enter email</label>
                            </div>
                            <div class="form-outline input-container mb-3">
                                <input type="tel" value="{{ old('cell_number',$data["cell_number"])}}" name="cell_number" class="form-control form-control-md input-field " placeholder="Cell Number" />
                                <label  class="placeholder-label pl-3">Enter cell number</label>
                            </div>
                            <div class="form-outline mb-3">
                                <label class=" ">
                                    Baby Photo
                                    <input type="file" value="{{ old('photo',$data["photo"])}}" name="photo" class="form-control  form-control-md border-0" style="border:none;" placeholder="" />
                                </label>
                            </div>
                            <div class="form-outline   text-center">
                                <button type="submit" class="btn-radius btn-purple btn btn-lg p-1 text-white w-50 text-center font-weight-bold btn-radius font-raleway" style="font-size: 1.8em;">submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 text-center ">
                        <p class="mabebeza-name  font-weight-bold text-white mb-0 pb-0" style="line-height: 1;font-size:110px;">MABEBEZA</p>
                        <p class=" m-0 pb-2" style="font-size: 1.8em;line-height: 1.5; font-family: 'cuty-font', cursive; color:#7f38bc">Cutie of the year</p>
                        <div class="pl-5 hero_image_container">
                            <img src="{{ asset('/CutieYear/images/PurpleCircle.svg') }}" class="circle-purple" alt=""> 
                            <img src="{{ asset('/CutieYear/images/LightBlueCircle.svg') }}" class="circle-light-blue" alt=""> 
                
                            <img src="{{ asset('/CutieYear/images/baby.png') }}" class="rounded-circle p-2 bg-white mx-auto hero_image  " alt="">
                        </div>
                    </div>
                </div>
            </section>     

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                const inputField = document.querySelector('.input-field');
                const placeholderLabel = document.querySelector('.placeholder-label');
                
                inputField.addEventListener('input', function() {
                    if (inputField.value) {
                    placeholderLabel.style.transform = 'translateY(-100%) scale(0.8)';
                    placeholderLabel.style.fontSize = '12px';
                    placeholderLabel.style.color = '#999';
                    } else {
                    placeholderLabel.style.transform = 'translateY(-50%)';
                    placeholderLabel.style.fontSize = '16px';
                    placeholderLabel.style.color = '';
                    }
                });
                });
            </script>
</x-CutieYear-layout> 
