@extends('layouts.master')

@section('content')
<style>
    .hide {
        display: none;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Daily Sale Master</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Daily Sale Master</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Daily Sale Master</h4>
                @if ($errors->any())

                <div class="col-md-6">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @if(isset($DailySale))
                <form action="{{ route('DailySale.update',$DailySale) }}" method="POST" id="cityFrm">
                    @method('put')

                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shiftName-input" class="form-label">Date<span
                                        class="label-required">*</span></label>
                                <input type="text" name="shiftName" class="form-control" id="formrow-shiftName-input"
                                    value="{{ $DailySale->shiftName}}" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-userId-input">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shortName-input" class="form-label">Shift<span
                                        class="label-required">*</span></label>
                                <input type="text" name="shortName" class="form-control" id="formrow-shortName-input"
                                    value="{{ $DailySale->shortName }}" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-userId-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shift_from-input" class="form-label">Worker<span
                                        class="label-required">*</span></label>
                                <input type="time" name="shift_from" class="form-control" id="formrow-shift_from-input"
                                    value="{{ $DailySale->shift_from }}" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-userId-input">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="formrow-shift_to-input" class="form-label">Shift To<span
                                        class="label-required">*</span></label>
                                <input type="time" name="shift_to" class="form-control" id="formrow-shift_to-input"
                                    value="{{ $DailySale->shift_to }}" required>
                                <input type="hidden" name="userId" value="{{ Session::get('userId')}}"
                                    class="form-control" id="formrow-userId-input">
                            </div>
                        </div>




                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('DailySale.index') }}" class="btn btn-danger w-md">Cancel</a>
                    </div>
                </form>

                @else
                <form action="{{ route('DailySale.store') }}" method="POST" id="dailySaleForm">
                    @csrf

                    {{-- Master Section --}}
                    <div class="row">
                        <div class="col-md-3">
                            <label>Date</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                            <input type="hidden" name="created_by" value="{{ Session::get('userId')}}" class="form-control" id="formrow-email-input">
                        </div>
                        <div class="col-md-3">
                            <label>Shift</label>

                            <select name="shift_id" class="form-select" id="shift_id" required>
                                <option value="">--- Select Shift ---</option>
                                @foreach($shift as $row)
                                <option value="{{ $row->shift_id }}">{{ $row->shiftName }}</option>
                                @endforeach
                            </select>



                        </div>
                        <div class="col-md-3">
                            <label>Worker</label>
                            <select name="worker_id" class="form-select" id="worker_id" required>
                                <option value="">--- Select Worker ---</option>
                                @foreach($Worker as $row)
                                <option value="{{ $row->employee_id }}">{{ $row->employee_name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <hr>

                    {{-- Detail Table --}}
                    <h5>Machine Fuel Sale Details</h5>

                    <table class="table table-bordered" id="detailTable">
                        <thead>
                            <tr>
                                <th>Field</th>
                                <th>Row 1</th>
                                <th>Row 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Machine</th>
                                <td>
                                    <select name="details[0][machine_id]" class="form-select">
                                        <option value="">--- Select ---</option>
                                        @foreach($MachineDiesel as $row)
                                        <option value="{{ $row->machine_id }}">{{ $row->machine_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="details[1][machine_id]" class="form-select">
                                        <option value="">--- Select ---</option>
                                        @foreach($MachinePetrol as $row)
                                        <option value="{{ $row->machine_id }}">{{ $row->machine_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th>Fuel Type</th>
                                <td readonly>
                                    <select name="details[0][fuel_type_id]" class="form-select" readonly>
                                        <option value="">--- Select Fuel Type ---</option>
                                        @foreach($FuelTypelist as $row)
                                        <option value="{{ $row->fuel_type_id }}"
                                            {{ $row->fuel_type_id == 1 ? 'selected' : '' }}>
                                            {{ $row->fuel_type_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="details[1][fuel_type_id]" class="form-select" readonly>
                                        <option value="">--- Select Fuel Type ---</option>
                                        @foreach($FuelTypelist as $row)
                                        <option value="{{ $row->fuel_type_id }}"
                                            {{ $row->fuel_type_id == 2 ? 'selected' : '' }}>
                                            {{ $row->fuel_type_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Opening</th>
                                <td><input type="number" name="details[0][opening_reading]" class="form-control opening"
                                        data-index="0"></td>
                                <td><input type="number" name="details[1][opening_reading]" class="form-control opening"
                                        data-index="1"></td>
                            </tr>

                            <tr>
                                <th>Closing</th>
                                <td><input type="number" name="details[0][closing_reading]" class="form-control closing"
                                        data-index="0"></td>
                                <td><input type="number" name="details[1][closing_reading]" class="form-control closing"
                                        data-index="1"></td>
                            </tr>

                            <tr>
                                <th>Sale</th>
                                <td><input type="number" name="details[0][Sale]" class="form-control sale"
                                        data-index="0" readonly></td>
                                <td><input type="number" name="details[1][Sale]" class="form-control sale"
                                        data-index="1" readonly></td>
                            </tr>

                            <tr>
                                <th>Testing</th>
                                <td><input type="number" name="details[0][testing]" class="form-control testing"
                                        data-index="0"></td>
                                <td><input type="number" name="details[1][testing]" class="form-control testing"
                                        data-index="1"></td>
                            </tr>

                            <tr>
                                <th>Actual Sale</th>
                                <td><input type="number" name="details[0][actual_sale_liter]"
                                        class="form-control actual-sale" data-index="0" readonly></td>
                                <td><input type="number" name="details[1][actual_sale_liter]"
                                        class="form-control actual-sale" data-index="1" readonly></td>
                            </tr>

                            <tr>
                                <th>Rate</th>
                                <td><input type="number" name="details[0][Rate]" class="form-control rate"
                                        data-index="0"></td>
                                <td><input type="number" name="details[1][Rate]" class="form-control rate"
                                        data-index="1"></td>
                            </tr>

                            <tr>
                                <th>Total Amount</th>
                                <td><input type="number" name="details[0][total_amount]"
                                        class="form-control total-amount" data-index="0" readonly></td>
                                <td><input type="number" name="details[1][total_amount]"
                                        class="form-control total-amount" data-index="1" readonly></td>
                            </tr>
                    </table>

                    <hr>
                    <div class="row">

                        <div class="col-md-3">
                            <label>Final Total</label>
                            <input type="text" name="Final_Total_Amount" id="Final_Total_Amount" class="form-control"
                                required>
                        </div>

                        <div class="col-md-3">
                            <label>Pouch Oil</label>
                            <input type="text" name="Pouch_Oil" id="Pouch_Oil" class="form-control" required>
                        </div>


                    </div>

                    <hr>

                    {{-- Paymode Table --}}
                    <h5>Payment Mode Details</h5>
                    <table class="table table-bordered" id="paymodeTable">
                        <thead>
                            <tr>
                                <th>Payment Mode</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paymentModes as $mode)
                            <tr>
                                <td>{{ $mode->pm_name }}</td>
                                <td><input type="number" name="payment_amount[{{ $mode->pm_id }}]" class="form-control"
                                        placeholder="Enter amount">
                                </td>
                                <td><button type="button" class="btn btn-danger btn-sm remove-row">Remove</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    <h5>Expense Details</h5>
                    <table class="table table-bordered" id="ExpenseTable">
                        <thead>
                            <tr>
                                <th>Expense</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="expense[]" class="form-select">
                                        <option value="">--- Select Expense ---</option>
                                        @foreach($Expense as $row)
                                        <option value="{{ $row->exp_id }}">{{ $row->exp_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="expense_amount[]" class="form-control amount"
                                        onchange="updateTotal()" placeholder="Enter amount">

                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <label>Total Expense</label>
                            <input type="text" name="Expense" id="Expense" class="form-control" readonly>
                        </div>

                        <div class="col-md-3">
                            <label>Cash to Collect</label>
                            <input type="text" name="Cash_Total" id="Cash_Total" class="form-control" required>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                @endif


            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->


    <!-- end col -->
</div>
<!-- end row -->


<!-- end row -->

<script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
document.getElementById('shift_id').addEventListener('change', function() {
    const shiftId = this.value;
    const date = document.getElementById('date').value;

    if (shiftId && date) {
        fetch(`/get-opening?shift_id=${shiftId}&date=${date}`)
            .then(res => res.json())
            .then(response => {
                const data = response.data || [];

                // Loop through all rows with .opening
                document.querySelectorAll('.opening').forEach(input => {
                    const rowIndex = input.dataset.index;
                    const machineSelect = document.querySelector(
                        `[name="details[${rowIndex}][machine_id]"]`);
                    const machineId = machineSelect.value;

                    // Find matching machine in response
                    const record = data.find(item => item.machine_id == machineId);
                    input.value = record ? record.closing_reading : 0;
                });
            })
            .catch(err => console.error('Error fetching opening:', err));
    }
});
</script> -->
<!-- <script>
document.getElementById('shift_id').addEventListener('change', function() {
    const shiftId = this.value;
    const date = document.getElementById('date').value;

    // Collect all selected machine IDs
    const machineSelects = document.querySelectorAll('select[name^="details"][name$="[machine_id]"]');
    const machineIds = Array.from(machineSelects)
        .map(sel => sel.value)
        .filter(id => id !== "");

    if (shiftId && date && machineIds.length > 0) {
        fetch(`/get-opening?shift_id=${shiftId}&date=${date}&machine_ids[]=` + machineIds.join('&machine_ids[]='))
            .then(res => res.json())
            .then(response => {
                const data = response.data || [];

                document.querySelectorAll('.opening').forEach(input => {
                    const rowIndex = input.dataset.index;
                    const machineSelect = document.querySelector(`[name="details[${rowIndex}][machine_id]"]`);
                    const machineId = machineSelect.value;

                    const record = data.find(item => item.machine_id == machineId);
                    input.value = record ? record.closing_reading : 0;
                });
            })
            .catch(err => console.error('Error fetching opening:', err));
    }
});
</script> -->
<script>
    document.getElementById('shift_id').addEventListener('change', function() {
        const shiftId = this.value;
        const date = document.getElementById('date').value;

        // Collect all selected machine IDs from the table
        const machineSelects = document.querySelectorAll('select[name^="details"][name$="[machine_id]"]');
        const machineIds = Array.from(machineSelects)
            .map(sel => sel.value)
            .filter(id => id !== "");

        if (shiftId && date && machineIds.length > 0) {
            const params = new URLSearchParams();
            params.append('shift_id', shiftId);
            params.append('date', date);
            machineIds.forEach(id => params.append('machine_ids[]', id));

            fetch(`/get-opening?${params.toString()}`)
                .then(res => res.json())
                .then(response => {
                    const data = response.data || [];

                    // Update each opening input machine-wise
                    document.querySelectorAll('.opening').forEach(input => {
                        const rowIndex = input.dataset.index;
                        const machineSelect = document.querySelector(`[name="details[${rowIndex}][machine_id]"]`);
                        const machineId = machineSelect ? machineSelect.value : null;

                        const record = data.find(item => item.machine_id == machineId);
                        input.value = record ? record.closing_reading : 0;
                    });
                })
                .catch(err => console.error('Error fetching opening:', err));
        }
    });

    // Optional: re-fetch if date changes
    document.getElementById('date').addEventListener('change', () => {
        document.getElementById('shift_id').dispatchEvent(new Event('change'));
    });

    // Optional: re-fetch if any machine changes
    document.querySelectorAll('select[name^="details"][name$="[machine_id]"]').forEach(sel => {
        sel.addEventListener('change', () => {
            document.getElementById('shift_id').dispatchEvent(new Event('change'));
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').value = today;
    });

    document.addEventListener("DOMContentLoaded", function() {

        // Function to calculate total expense
        function updateTotalExpense() {
            let totalExpense = 0;
            document.querySelectorAll('#ExpenseTable .amount').forEach(input => {
                totalExpense += parseFloat(input.value) || 0;
            });
            document.getElementById('Expense').value = totalExpense.toFixed(2);
            updateCashTotal();
        }

        // Function to calculate total of Paymode table
        function updatePaymodeTotal() {
            let totalPaymode = 0;
            document.querySelectorAll('#paymodeTable input[type="number"]').forEach(input => {
                totalPaymode += parseFloat(input.value) || 0;
            });
            return totalPaymode;
        }

        // Function to calculate final cash to collect
        function updateCashTotal() {
            const finalTotal = parseFloat(document.getElementById('Final_Total_Amount').value) || 0;
            const pouchOil = parseFloat(document.getElementById('Pouch_Oil').value) || 0;
            const totalExpense = parseFloat(document.getElementById('Expense').value) || 0;
            const paymodeTotal = updatePaymodeTotal();

            const cashTotal = finalTotal - paymodeTotal - pouchOil - totalExpense;
            document.getElementById('Cash_Total').value = cashTotal.toFixed(2);
        }

        // Event listeners for recalculating totals
        document.addEventListener('input', function(e) {
            if (e.target.matches('#Final_Total_Amount, #Pouch_Oil')) {
                updateCashTotal();
            }
            if (e.target.closest('#paymodeTable') && e.target.type === 'number') {
                updateCashTotal();
            }
            if (e.target.closest('#ExpenseTable') && e.target.classList.contains('amount')) {
                updateTotalExpense();
            }
        });

        // Handle Add/Remove rows in Expense Table dynamically
        document.querySelector('#ExpenseTable').addEventListener('click', function(e) {
            if (e.target.classList.contains('add-row')) {
                let row = e.target.closest('tr');
                let clone = row.cloneNode(true);
                clone.querySelectorAll('input').forEach(input => input.value = '');
                row.parentNode.appendChild(clone);
            } else if (e.target.classList.contains('remove-row')) {
                let rows = document.querySelectorAll('#ExpenseTable tbody tr');
                if (rows.length > 1) e.target.closest('tr').remove();
                updateTotalExpense();
            }
        });

    });

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('#ExpenseTable .amount').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('Expense').value = total.toFixed(2);
    }

    // Add/Remove row
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-row')) {
            const newRow = `
        <tr>
            <td>
                <select name="expense[]" class="form-select">
                    <option value="">--- Select Expense ---</option>
                    @foreach($Expense as $row)
                        <option value="{{ $row->exp_id }}">{{ $row->exp_name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="amount[]" class="form-control amount" onchange="updateTotal()" placeholder="Enter amount">
            </td>
            <td>
                <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                <button type="button" class="btn btn-danger btn-sm remove-row">Remove</button>
            </td>
        </tr>`;
            document.querySelector('#ExpenseTable tbody').insertAdjacentHTML('beforeend', newRow);
        }

        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
            updateTotal();
        }
    });


    function updateFinalTotal() {
        let total = 0;
        document.querySelectorAll('.total-amount').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('Final_Total_Amount').value = total;
    }

    // Call it once on page load
    updateFinalTotal()
    document.addEventListener('DOMContentLoaded', function() {

        // Function to fetch and set rate for a given dropdown
        function updateRate(select) {
            const fuelTypeId = select.value;
            const index = select.name.match(/\d+/)[0]; // extract [0], [1], etc.
            const rateInput = document.querySelector(`input[name="details[${index}][Rate]"]`);

            if (fuelTypeId) {
                fetch(`/get-fuel-rate/${fuelTypeId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.rate !== null) {
                            rateInput.value = data.rate;
                        } else {
                            rateInput.value = '';
                            console.warn('No rate found for fuel type:', fuelTypeId);
                        }
                    })
                    .catch(err => console.error(err));
            } else {
                rateInput.value = '';
            }
        }

        // For every fuel type dropdown
        document.querySelectorAll('select[name^="details"]').forEach(function(select) {
            // 1️⃣ Handle change event
            select.addEventListener('change', function() {
                updateRate(this);
            });

            // 2️⃣ Handle preselected value (on page load)
            if (select.value) {
                updateRate(select);
            }
        });
    });

    document.addEventListener('input', function(e) {
        const classes = e.target.classList;
        const index = e.target.getAttribute('data-index');

        // --- Calculate Sale (Closing - Opening) ---
        if (classes.contains('opening') || classes.contains('closing')) {
            const opening = parseFloat(document.querySelector(`.opening[data-index="${index}"]`).value) || 0;
            const closing = parseFloat(document.querySelector(`.closing[data-index="${index}"]`).value) || 0;
            const sale = Math.max(closing - opening, 0);
            document.querySelector(`.sale[data-index="${index}"]`).value = sale;

            // Update Actual Sale & Total Amount
            updateActualSale(index);
            updateTotalAmount(index);
        }

        // --- Calculate Actual Sale (Sale - Testing) ---
        if (classes.contains('testing')) {
            updateActualSale(index);
            updateTotalAmount(index);
        }

        // --- Calculate Total Amount (Actual Sale * Rate) ---
        if (classes.contains('actual-sale') || classes.contains('rate')) {
            updateTotalAmount(index);
        }

        function updateActualSale(index) {
            const sale = parseFloat(document.querySelector(`.sale[data-index="${index}"]`).value) || 0;
            const testing = parseFloat(document.querySelector(`.testing[data-index="${index}"]`).value) || 0;
            const actualSale = Math.max(sale - testing, 0);
            document.querySelector(`.actual-sale[data-index="${index}"]`).value = actualSale;
            updateFinalTotal()
        }

        function updateTotalAmount(index) {
            const actualSale = parseFloat(document.querySelector(`.actual-sale[data-index="${index}"]`).value) || 0;
            const rate = parseFloat(document.querySelector(`.rate[data-index="${index}"]`).value) || 0;
            const total = actualSale * rate;
            document.querySelector(`.total-amount[data-index="${index}"]`).value = total.toFixed(2);
            updateFinalTotal()
        }
        updateFinalTotal()
    });
</script>
<script>
    $('#cityFrm').parsley();
    @php

    if (isset($isView) == 1) {
        @endphp
        $(function() {

            $("input").attr('disabled', true);
            $("select").attr('disabled', true);
            $("button[type='submit']").removeAttr('type').addClass("hide");
        });
        @php
    }
    @endphp


    function getState(val) { //alert(val);
        $.ajax({
            type: "GET",
            url: "{{ route('StateList') }}",
            data: 'country_id=' + val,
            success: function(data) {
                $("#state_id").html(data.html);
            }
        });
    }

    function getDistrict(val) { //alert(val);
        $.ajax({
            type: "GET",
            url: "{{ route('DistrictList') }}",
            data: 'state_id=' + val,
            success: function(data) {
                $("#dist_id").html(data.html);
            }
        });
    }

    function getTaluka(val) { //alert(val);
        $.ajax({
            type: "GET",
            url: "{{ route('TalukaList') }}",
            data: 'dist_id=' + val,
            success: function(data) {
                $("#taluka_id").html(data.html);
            }
        });
    }
</script>
<!-- end row -->
@endsection