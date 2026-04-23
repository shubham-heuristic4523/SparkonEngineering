<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/metismenu/metismenu.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/node-waves/waves.min.js')}}"></script>

<link href="https://cdn.jsdelivr.net/select2/3.5.2/select2.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/select2/3.5.2/select2.min.js"></script>

<!-- Required datatable js -->
<script src="{{ URL::asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ URL::asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ URL::asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
<script>
$('.select2').select2();
$('form').parsley();


// $(document).keypress(function(event) {
//     if (event.which == '13') {

//         event.preventDefault();
//     }
// });

//tab convert to enter



$('body').on('keydown', 'input, select', function(e) {
    if (e.key === "Enter") {
        var self = $(this),
            form = self.parents('form:eq(0)'),
            focusable,
            next;

            var curr_row_index = $(this).closest("TR").index();
            var total_row_index =$('tr', $('.table').find('tbody')).length;

        // If the current input is finish_meter, move to color_id
        if (self.hasClass('finish_meter')) {
            next = self.closest('tr').find('.color_id');
        }
        // If the current input is color_id, move to weight
        else if (self.hasClass('color_id')) {
            next = self.closest('tr').find('.weight');
        }
        // If the current input is weight, move to the next row's finish_meter
        else if (self.hasClass('weight')) {
            next = self.closest('tr').next().find('.finish_meter');
        }
        // For other input fields, proceed to the next focusable element
        else {
            focusable = form.find('input,a,select,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this) + 1);
        }

        if (next.length) {
            next.focus();
        } 
        else if(next.length==0)
        {
            //focusable = form.find('input,a,select,button,textarea').filter(':visible');
            //next = focusable.eq(5001);
            $('[tabindex=5001]').focus();
            //next.focus();
            next.length=-1;
        }
        else {
            form.submit();
        }
        return false;
    }
});



// $(window).ready(function() {
//     setInterval(function() {
//         $('body').addClass("sidebar-enable vertical-collpsed")
//     }, 9000);

// });

//  window.addEventListener('beforeunload', function (e) {
//             var confirmationMessage = 'Are you sure you want to leave? Your changes may not be saved.';

//             // Standard for most browsers
//             e.returnValue = confirmationMessage;

//             // For some older browsers
//             return confirmationMessage;
//         });
</script>






<!-- App js -->
<script src="{{ URL::asset('assets/js/app.js') }}"></script>