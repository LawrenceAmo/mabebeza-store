<x-customer-layout>

    <div class=" ">

        <div class="card p-3">

            <div class=" text-center border-bottom pb-3">
                <p class="h3 font-weight-bold text-danger"> 
                    <i class="fa fa-times-circle" aria-hidden="true"></i> Ooops! Payment Unsuccessful!!!</p>
            <hr>

                    <p class="">We regret to inform you that your payment was unsuccessful. We apologize for any inconvenience this may have caused. Please review the following information:</p>
                <p class="h5">Order Details:</p>
               <p class=""> Order Number: <span class="font-weight-bold text-danger">{{$order->order_number}}</span></p>

               <p class="">
                <div class="h5">Payment Status:</div>
                Unfortunately, we were unable to process your payment successfully. Please ensure that the payment information provided is accurate and try again. If the issue persists, we recommend contacting your bank or payment provider for further assistance.
               </p>

               <p class="h5">Questions or Assistance:</p>
                    <p class="">
                        If you have any questions or need assistance, 
                    our friendly customer support team is here to help. 
                    Please contact us at <a href="tel:+27719273100">(+27) 71 927 3100</a> or <a href="mailto:careline@mabebeza.com">careline@mabebeza.com</a>.
                    </p>

                <p class="">We apologize for any inconvenience caused and appreciate your understanding. Thank you for considering <b>Mabebeza</b>.</p>
 
            </div>
             
        </div>
    </div>

</x-customer-layout>