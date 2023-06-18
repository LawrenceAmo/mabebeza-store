<x-guest-layout>

    <div class=" ">
       
        <div class="card p-3">
            
            <div class=" text-center border-bottom pb-3">
                <p class="h3 font-weight-bold text-success"> <i class="fa fa-check-circle" aria-hidden="true"></i> Payment Successful!!!</p>
            <hr>

            <p class="">Thank You for Your Purchase! </p>
  
                <p class="h5">Order Details:</p>
               <p class=""> Order Number: <span class="font-weight-bold text-danger">{{$order->order_number}}</span></p>
 
               <p class="h5">Shipping Information:</p>
                <p class=""> Your order will be shipped within 3 business days. 
                We'll provide you with tracking details via email once your package is on its way.</p>

                <p class="h5">Questions or Assistance:</p>
                    <p class="">
                        If you have any questions or need assistance, 
                    our friendly customer support team is here to help. 
                    Please contact us at <a href="tel:+27719273100">(+27) 71 927 3100</a> or <a href="mailto:careline@mabebeza.com">careline@mabebeza.com</a>.
                    </p>

                <p class="">We appreciate your support and look forward to serving you again in the future.</p>
 
            </div>
             
        </div>
    </div>

</x-guest-layout>