<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\CountryController;
    use App\Http\Controllers\StateController;
    use App\Http\Controllers\UserManagementController;
    use App\Http\Controllers\PermissionController;
    use App\Http\Controllers\DistrictController;
    use App\Http\Controllers\TalukaController;
    use App\Http\Controllers\CityController;
    use App\Http\Controllers\CategoryContoller;
    use App\Http\Controllers\ItemMasterController;
    use App\Http\Controllers\OtherPurchaseControlller;
    use App\Http\Controllers\GeneralSaleController;
    use App\Http\Controllers\MultiPaymentController;
    use App\Http\Controllers\MultiReceiptController;
    use App\Http\Controllers\ReceiptController;
    use App\Http\Controllers\PaymentController;
    use App\Http\Controllers\MerchantMasterController; 
    use App\Http\Controllers\PDMerchantMasterController;  
    use App\Http\Controllers\JournalVoucherController;
    use App\Http\Controllers\ContraTransactionController;
    use App\Http\Controllers\FabricController;
    use App\Http\Controllers\GeneralPurchaseReturnController;
    use App\Http\Controllers\GeneralSalesReturnController;
    use App\Http\Controllers\DrNoteController;
    use App\Http\Controllers\transportController;
    use App\Http\Controllers\LedgerController;
    use App\Http\Controllers\BusinessTypeController;
    use App\Http\Controllers\FirmController;
    use App\Http\Controllers\JobWorkerController;
    use App\Http\Controllers\DepartmentController;
    use App\Http\Controllers\FinishedGoodController;
    use App\Http\Controllers\EmployeeGroupController;
    use App\Http\Controllers\UnitController;
    use App\Http\Controllers\ColorController;
    use App\Http\Controllers\LocationController;
    use App\Http\Controllers\PurchaseOrderController;
    use App\Http\Controllers\BrandController;
    use App\Http\Controllers\SeasonController;
    use App\Http\Controllers\JobStatusController;
    use App\Http\Controllers\BuyerJobCardController;
    use App\Http\Controllers\FabricSummaryGRNController;
    use App\Http\Controllers\FabricInwardController;
    
    use App\Http\Controllers\FabricCheckingController;
    use App\Http\Controllers\BuyerPurchaseOrderController;
    use App\Http\Controllers\SizeController;
    use App\Http\Controllers\TaskMasterController;
    use App\Http\Controllers\CrNoteController;
    use App\Http\Controllers\MaterialOutwardController;
    use App\Http\Controllers\MaterialInwardController;
    use App\Http\Controllers\CuttingMasterController;
    use App\Http\Controllers\FabricTrimCardMasterController;
    use App\Http\Controllers\BuyerJobcardReportController;
    use App\Http\Controllers\FabricInwardReportController;
    use App\Http\Controllers\BundleController;
    use App\Http\Controllers\JobPartController;
    use App\Http\Controllers\FabricTrimPartController;
    use App\Http\Controllers\QualityController;
    use App\Http\Controllers\FabricOutwardController;
    use App\Http\Controllers\FabricCheckingReportController; 
    use App\Http\Controllers\FabricCuttingReportController; 
    use App\Http\Controllers\FabricTrimCardReportController; 
    use App\Http\Controllers\PDFController;
    use App\Http\Controllers\MaterialInwardStoreController;
    use App\Http\Controllers\RequisitionController;
    use App\Http\Controllers\RequisitionOutwardController;
    use App\Http\Controllers\ReturnableOutwardController;
    use App\Http\Controllers\POReportController;
    use App\Http\Controllers\MaterialInwardStoreReportController;
    use App\Http\Controllers\RequisitionReportController;
    use App\Http\Controllers\POItemWiseReportController;
    use App\Http\Controllers\MIStoreItemwiseReportController;
    use App\Http\Controllers\RequisitionOutwardReportController;
    use App\Http\Controllers\StockReportController;
    use App\Http\Controllers\FabricOutwardReportController;
    use App\Http\Controllers\OrderGroupController;
    use App\Http\Controllers\CurrencyController;
    use App\Http\Controllers\PaymentTermsController;
    use App\Http\Controllers\DeliveryTermsController;
    use App\Http\Controllers\ShipmentModeController;
    use App\Http\Controllers\PositionController;
    use App\Http\Controllers\ProcessController; 
    use App\Http\Controllers\WarehouseController;
    use App\Http\Controllers\MachineTypeController; 
    use App\Http\Controllers\FabricDefectController; 
    use App\Http\Controllers\MainStyleController; 
    use App\Http\Controllers\SubStyleController; 
    use App\Http\Controllers\SalesOrderCostingController; 
    use App\Http\Controllers\ClassificationController;
    use App\Http\Controllers\BOMController;
    use App\Http\Controllers\CommissionController;
    use App\Http\Controllers\VendorWorkOrderController;
    use App\Http\Controllers\VendorPurchaseOrderController;
    use App\Http\Controllers\TrimsInwardController;
    use App\Http\Controllers\RackController;
    use App\Http\Controllers\StitchingInhouseMasterController;
    use App\Http\Controllers\FinishingInhouseMasterController;
    use App\Http\Controllers\PackingInhouseMasterController;
    use App\Http\Controllers\TrimsOutwardController;
    use App\Http\Controllers\CartonPackingInhouseMasterController;
    use App\Http\Controllers\CutPanelIssueMasterController;
    use App\Http\Controllers\QCStitchingInhouseMasterController;
    use App\Http\Controllers\LineController;
    use App\Http\Controllers\CutPanelGRNMasterController;
    use App\Http\Controllers\OutwardForFinishingMasterController;
    use App\Http\Controllers\OutwardForPackingMasterController;
    use App\Http\Controllers\SaleTransactionMasterController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\PresentEmployeesController;
    use App\Http\Controllers\ActivityMasterController;
    use App\Http\Controllers\ActivityTypeMasterController;
    use App\Http\Controllers\T_And_A_MasterController;
    use App\Http\Controllers\PPCMasterController;
    use App\Http\Controllers\T_And_A_TemplateMasterController;
    use App\Http\Controllers\TransferPackingInhouseMasterController;
    use App\Http\Controllers\EmployeeMasterController;
    
    
    use App\Http\Controllers\CostingParticularController;
    use App\Http\Controllers\CostingCategoryController;
    use App\Http\Controllers\OperationTypeController;
    use App\Http\Controllers\OperationMasterController;
    use App\Http\Controllers\JobOperationController;
    use App\Http\Controllers\ProductionController;
    use App\Http\Controllers\OtherProductionController;
    use App\Http\Controllers\BranchController;
    use App\Http\Controllers\SalaryTransactionMultiController;
    use App\Http\Controllers\AdvanceSalaryController;
    use App\Http\Controllers\AttendanceDetailController;
    use App\Http\Controllers\DesignationController;
    use App\Http\Controllers\BankMasterController;
    use App\Http\Controllers\SingleSizeMasterController;
    use App\Http\Controllers\YarnInwardController; 
    use App\Http\Controllers\YarnTypeController; 
    use App\Http\Controllers\BrokerMasterController;  
    use App\Http\Controllers\SalesOrderCostingProcessMasterController;  
    use App\Http\Controllers\SystemLockMasterController;
    use App\Http\Controllers\BOMProcessController;
    use App\Http\Controllers\MainCompanyController;
    use App\Http\Controllers\SubCompanyController;
    use App\Http\Controllers\ItemSizeController;
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */
    
    Route::get('/', function () {
        return view('login');
    });
    
    Route::get('login',[LoginController::class,'index']);
    
    Route::post('/Auth',[LoginController::class,'auth'])->name('Auth');
    
    Route::get('/logout',[AdminController::class,'logout'])->name('logout');
    
    Route::group(['middleware'=>'admin_auth'],function(){
    Route::get('/dashboard',[AdminController::class,'dashboard']);
     Route::resource('DashboardMaster', DashboardController::class);
     
     //HRMS
    
       Route::resource('Employee', EmployeeMasterController::class);
    Route::get('getconsolidatedbasic',[EmployeeMasterController::class,'getconsolidatedbasic'])->name('getconsolidatedbasic');
    Route::post('biomatricExist',[EmployeeMasterController::class,'biomatricExist'])->name('biomatricExist');
    Route::post('EmployeeCodeExist',[EmployeeMasterController::class,'EmployeeCodeExist'])->name('EmployeeCodeExist');
    Route::get('StateList',[EmployeeMasterController::class,'GetStateList'])->name('StateList');
    Route::get('DistrictList',[EmployeeMasterController::class,'GetDistrictList'])->name('DistrictList');
    Route::get('TalukaList',[EmployeeMasterController::class,'GetTalukaList'])->name('TalukaList');
    Route::get('SubCompanies',[EmployeeMasterController::class,'SubCompanies'])->name('SubCompanies');
    Route::get('employeeIDCard/{id}',[EmployeeMasterController::class,'employeeIDCard']);
    Route::post('get_rate_detail',[EmployeeMasterController::class,'get_rate_detail'])->name('get_rate_detail');
    Route::resource('Branch', BranchController::class);
    Route::resource('Bank', BankMasterController::class);
    Route::post('getifscCode',[EmployeeMasterController::class,'getifscCode'])->name('getifscCode');
    Route::get('SubBranch',[EmployeeMasterController::class,'SubBranch'])->name('SubBranch');
    Route::get('step2/{id}',[EmployeeMasterController::class,'step2']);
    Route::post('step2Store',[EmployeeMasterController::class,'step2Store'])->name('step2Store');
    Route::get('step2Edit/{id}',[EmployeeMasterController::class,'step2Edit']);
    Route::put('step2Update/{id}',[EmployeeMasterController::class,'step2Update'])->name('step2Update');
    Route::get('branchwiseEmployeeList',[EmployeeMasterController::class,'branchwiseEmployeeListnew'])->name('branchwiseEmployeeList');
    Route::post('Employeeimport',[EmployeeMasterController::class,'Employeeimport'])->name('Employeeimport');
    Route::post('LeaveBalanceimports',[EmployeeMasterController::class,'LeaveBalanceimports'])->name('LeaveBalanceimports');
    Route::post('SalaryAdvanceExportImport',[EmployeeMasterController::class,'SalaryAdvanceExportImport'])->name('SalaryAdvanceExportImport');
    Route::post('SalaryDeductionExport',[EmployeeMasterController::class,'SalaryDeductionExport'])->name('SalaryDeductionExport');
    Route::resource('SalaryTransactionMulti', SalaryTransactionMultiController::class);
    Route::get('salarySummary',[SalaryTransactionMultiController::class,'salarySummary'])->name('salarySummary');
    Route::get('export_neft/{id1}/{id2}/{id3}/{id4}/{id5}/{id6}',[SalaryTransactionMultiController::class,'export_neft']);
    Route::post('employeeSalaryDetailMultiple',[SalaryTransactionMultiController::class,'employeeSalaryDetailMultiple'])->name('employeeSalaryDetailMultiple');
    Route::get('employeeSalaryDetail',[SalaryTransactionController::class,'employeeSalaryDetail'])->name('employeeSalaryDetail');
    Route::get('rptsalarystruture',[SalaryTransactionMultiController::class,'rptsalarystruture'])->name('rptsalarystruture');
    Route::get('wages_register_form2',[SalaryTransactionMultiController::class,'wages_register_form2'])->name('wages_register_form2');
    Route::get('combine_wages_register_form2',[SalaryTransactionMultiController::class,'combine_wages_register_form2'])->name('combine_wages_register_form2');
    Route::get('rptsalarystrutureworker',[SalaryTransactionMultiController::class,'rptSalaryStrutureNonComplianceWorker'])->name('rptsalarystrutureworker');
    Route::get('printsalarystruture',[SalaryTransactionMultiController::class,'printsalarystruture'])->name('printsalarystruture');
    Route::get('PTReport',[SalaryTransactionMultiController::class,'PTReport'])->name('PTReport');
    Route::get('getDepartmentCost',[SalaryTransactionMultiController::class,'getDepartmentCost'])->name('getDepartmentCost');
    Route::get('ESICReport',[SalaryTransactionMultiController::class,'ESICReport'])->name('ESICReport');
    Route::get('pfReport',[SalaryTransactionMultiController::class,'pfReport'])->name('pfReport');
    Route::get('rptsalarySummary',[SalaryTransactionMultiController::class,'rptsalarySummary'])->name('rptsalarySummary');
    Route::get('NEFT',[SalaryTransactionMultiController::class,'NEFT'])->name('NEFT');
    Route::get('production_monthly_summary',[SalaryTransactionMultiController::class,'production_monthly_summary'])->name('production_monthly_summary');
    Route::get('BonusRegister',[SalaryTransactionMultiController::class,'BonusRegister'])->name('BonusRegister');
    Route::get('PAIDDAY',[SalaryTransactionMultiController::class,'PAIDDAY'])->name('PAIDDAY');
    Route::get('salarySummary',[SalaryTransactionMultiController::class,'salarySummary'])->name('salarySummary');
    Route::get('salaryReport',[SalaryTransactionMultiController::class,'salaryReport'])->name('salaryReport');
    Route::get('rptsalarystruture',[SalaryTransactionMultiController::class,'rptsalarystruture'])->name('rptsalarystruture');
    Route::get('rptSalaryStrutureActual',[SalaryTransactionMultiController::class,'rptSalaryStrutureActual'])->name('rptSalaryStrutureActual');
    Route::get('rptSalaryStrutureC',[SalaryTransactionMultiController::class,'rptSalaryStrutureC'])->name('rptSalaryStrutureC');
    Route::resource('AdvanceSalary', AdvanceSalaryController::class);
    Route::get('getAttendanceReport',[AttendanceDetailController::class,'getAttendanceReport'])->name('getAttendanceReport');
    Route::get('paid_days',[AdvanceSalaryController::class,'paid_days'])->name('paid_days'); 
    Route::get('route_type',[AdvanceSalaryController::class,'route_type'])->name('route_type');
    Route::post('get_paid_days_list',[AdvanceSalaryController::class,'get_paid_days_list'])->name('get_paid_days_list'); 
    Route::post('update_paid_days',[AdvanceSalaryController::class,'update_paid_days'])->name('update_paid_days'); 
    Route::get('paid_days_list/{id}',[AdvanceSalaryController::class,'paid_days_list']);
    Route::post('rptAttendanceshow',[AttendanceDetailController::class,'rptAttendanceshow'])->name('rptAttendanceshow');
    Route::post('rptAttendance',[AttendanceDetailController::class,'rptAttendance'])->name('rptAttendance');
    Route::post('updateAndInsertAttendance',[AttendanceDetailController::class,'updateAndInsertAttendance'])->name('updateAndInsertAttendance');
    Route::post('loadAttendanceData',[AttendanceDetailController::class,'loadAttendanceData'])->name('loadAttendanceData');
    Route::post('insert_weeklyoff',[AttendanceDetailController::class,'insert_weeklyoff'])->name('insert_weeklyoff');
    Route::post('absent_shuffle',[AttendanceDetailController::class,'absent_shuffle'])->name('absent_shuffle'); 
    Route::resource('Attendance', AttendanceDetailController::class);
    Route::get('Present',[AttendanceDetailController::class,'Present'])->name('PresentE');
    Route::get('PresentNoOutPunch',[AttendanceDetailController::class,'PresentNoOutPunch'])->name('PresentNoOutPunch');
    Route::get('Absent',[AttendanceDetailController::class,'Absent'])->name('AbsentE');
    Route::post('Attendanceimport',[AttendanceDetailController::class,'Attendanceimport'])->name('Attendanceimport');
    Route::post('getAttendanceDataFromServer',[AttendanceDetailController::class,'getAttendanceDataFromServer'])->name('getAttendanceDataFromServer');
    Route::resource('Designation', DesignationController::class);
    Route::get('printComplianceWorkerrpt',[SalaryTransactionMultiController::class,'printComplianceWorkerrpt'])->name('printComplianceWorkerrpt');
    Route::get('salary_register_staff',[SalaryTransactionMultiController::class,'salary_register_staff'])->name('salary_register_staff');
    Route::get('salary_register_worker',[SalaryTransactionMultiController::class,'salary_register_worker'])->name('salary_register_worker');
    Route::get('printStaffReport',[SalaryTransactionMultiController::class,'printStaffReport'])->name('printStaffReport');
    Route::get('salary_slip_bulk',[SalaryTransactionMultiController::class,'salary_slip_bulk'])->name('salary_slip_bulk');
    Route::get('print_worker_report',[SalaryTransactionMultiController::class,'print_worker_report'])->name('print_worker_report');
    Route::get('getPeriodicMuster',[AttendanceDetailController::class,'getPeriodicMuster'])->name('getPeriodicMuster');
    Route::post('rptPeriodicMuster',[AttendanceDetailController::class,'rptPeriodicMuster'])->name('rptPeriodicMuster');
    Route::post('musterRollStore',[AttendanceDetailController::class,'musterRollStore'])->name('musterRollStore');
    Route::post('loadMusterRoll',[AttendanceDetailController::class,'loadMusterRoll'])->name('loadMusterRoll');
    Route::get('reverseAttendanceShow',[AttendanceDetailController::class,'reverseAttendanceShow'])->name('reverseAttendanceShow');
    Route::post('rptAttendanceshowRev',[AttendanceDetailController::class,'rptAttendanceshowRev'])->name('rptAttendanceshowRev');
    Route::post('reverseAttendanceStore',[AttendanceDetailController::class,'reverseAttendanceStore'])->name('reverseAttendanceStore');
    Route::post('checkexist',[AttendanceDetailController::class,'checkexist'])->name('checkexist');
    Route::post('updateAndInsertAttendanceReverse',[AttendanceDetailController::class,'updateAndInsertAttendanceReverse'])->name('updateAndInsertAttendanceReverse');
    Route::post('loadAttendanceDataReverse',[AttendanceDetailController::class,'loadAttendanceDataReverse'])->name('loadAttendanceDataReverse');
    
    Route::resource('Percentage', PercentageController::class);
    Route::resource('Increment', IncrementController::class);
    Route::get('LetterOfferIncrement',[IncrementController::class, 'show'])->name('LetterOfferIncrement');
    Route::get('getRptIncrement',[IncrementController::class, 'getRptIncrement'])->name('getRptIncrement');
    Route::post('rpt_increment',[IncrementController::class, 'rpt_increment'])->name('rpt_increment');
    Route::get('getEmployeeDetails', [IncrementController::class,'getEmployeeDetails'])->name('getEmployeeDetails');
    Route::post('increment_import',[IncrementController::class,'increment_import'])->name('increment_import');
    Route::post('increment_export',[IncrementController::class,'increment_export'])->name('increment_export');
    Route::post('update_rate_of_wages',[IncrementController::class,'update_rate_of_wages'])->name('update_rate_of_wages');
    Route::post('get_employee_detail',[IncrementController::class, 'get_employee_detail'])->name('get_employee_detail');
    Route::resource('HolidayMaster', HolidayMasterController::class);
    Route::resource('Company', MainCompanyController::class);
    Route::resource('SubCompany', SubCompanyController::class);
    //END HRMS
    
    Route::resource('/Country', CountryController::class); 
    Route::resource('State', StateController::class);
    Route::resource('City', CityController::class);
    Route::resource('Line', LineController::class);
    Route::resource('MainStyle', MainStyleController::class);
    Route::resource('SubStyle', SubStyleController::class);
    Route::get('/SubStyleList',[SubStyleController::class,'GetSubStyleList'])->name('SubStyleList');
    Route::get('/StyleList',[SubStyleController::class,'GetStyleList'])->name('StyleList');
    Route::resource('MerchantMaster', MerchantMasterController::class);
    Route::resource('PDMerchantMaster', PDMerchantMasterController::class);
    
    Route::resource('PaymentTerms', PaymentTermsController::class);
    Route::resource('DeliveryTerms', DeliveryTermsController::class);
    Route::resource('ShipmentMode', ShipmentModeController::class);
    Route::resource('Process', ProcessController::class);
    Route::resource('Warehouse', WarehouseController::class);
    Route::resource('OrderGroup', OrderGroupController::class);
    Route::resource('Currency', CurrencyController::class);
    Route::resource('MachineType', MachineTypeController::class);
    Route::resource('FabricDefect', FabricDefectController::class);
    
    
    Route::resource('Form', UserManagementController::class);
    Route::resource('User_Management', PermissionController::class);
    Route::resource('District', DistrictController::class);
    Route::resource('Taluka', TalukaController::class);
    Route::resource('Category', CategoryContoller::class);
    
    Route::resource('Rack', RackController::class);
    
    Route::resource('Item', ItemMasterController::class);
    
    Route::get('list/{id}',[ItemMasterController::class,'activeDeactiveList']);
    Route::get('RepeatItem/{id}',[ItemMasterController::class,'RepeatItem'])->name('RepeatItem');  
    Route::post('/RepeatItemSave',[ItemMasterController::class,'RepeatItemSave'])->name('RepeatItemSave');
    
    Route::post('itemimport',[ItemMasterController::class,'itemimport'])->name('itemimport');
    Route::get('/ClassList',[ItemMasterController::class,'GetClassList'])->name('ClassList');
    Route::get('/ClassDetailList',[ItemMasterController::class,'ClassDetailList'])->name('ClassDetailList'); 
     
    
    Route::get('itemexist',[ItemMasterController::class,'itemexist'])->name('itemexist');
    
    Route::resource('OtherPurchase', OtherPurchaseControlller::class);
    Route::get('GSTPER',[OtherPurchaseControlller::class,'GetData'])->name('GSTPER');
    Route::resource('GeneralSales', GeneralSaleController::class);
    Route::resource('MultiPayment', MultiPaymentController::class);
    Route::get('getPaymentBillDetails',[MultiPaymentController::class,'getPaymentBillDetails'])->name('GetPaymentBillDetails');
    Route::resource('MultiReceipt', MultiReceiptController::class);
    Route::resource('Receipt_Transaction', ReceiptController::class);
    Route::resource('Payment_Transaction', PaymentController::class);
    Route::resource('Journal_Voucher', JournalVoucherController::class);
    Route::resource('Contra_Transaction', ContraTransactionController::class);
    Route::get('getUnpaidBills',[MultiReceiptController::class,'getUnpaidBills'])->name('getUnpaidBills');
    Route::get('getReceiptDetail',[MultiReceiptController::class,'getReceiptDetail'])->name('getReceiptDetail');
    Route::get('getUnpaidPaymentBills',[MultiPaymentController::class,'getUnpaidPaymentBills'])->name('getUnpaidPaymentBills');
    Route::get('getPaymentDetail',[MultiPaymentController::class,'getPaymentDetail'])->name('getPaymentDetail');
    Route::resource('Fabric_Purchase', FabricController::class);
    Route::get('PartyShortlist',[FabricController::class,'PartyShortlist'])->name('PartyShortlist');
    Route::resource('GeneralPurchaseReturn', GeneralPurchaseReturnController::class);
    Route::resource('GeneralSalesReturn', GeneralSalesReturnController::class);
    Route::resource('DrNote', DrNoteController::class);
    Route::resource('CrNote', CrNoteController::class);
    Route::get('PartyDetail',[DrNoteController::class,'GetData'])->name('PartyDetail');
    Route::get('PartyDetail',[CrNoteController::class,'GetData'])->name('PartyDetail');
    Route::get('/StateList',[LedgerController::class,'GetStateList'])->name('StateList');
    Route::get('/DistrictList',[LedgerController::class,'GetDistrictList'])->name('DistrictList');
    Route::get('/TalukaList',[LedgerController::class,'GetTalukaList'])->name('TalukaList');
    Route::resource('Position', PositionController::class);
    Route::resource('Transport', transportController::class);
    Route::resource('Ledger', LedgerController::class);
    Route::resource('BusinessType', BusinessTypeController::class);
    Route::resource('Firm', FirmController::class);
    Route::resource('JobWorker', JobWorkerController::class);
    Route::resource('Department', DepartmentController::class);
    Route::resource('FinishedGood', FinishedGoodController::class);
    Route::resource('EmployeeGroup', EmployeeGroupController::class);
    Route::resource('Unit', UnitController::class);
    Route::resource('Color', ColorController::class);
    Route::resource('Commission', CommissionController::class);
    
    
    Route::post('importcolor',[ColorController::class,'importcolor'])->name('importcolor');
    
    Route::resource('Classification', ClassificationController::class);
    Route::resource('Size', SizeController::class);
    Route::resource('Location', LocationController::class);
    
    Route::resource('PurchaseOrder', PurchaseOrderController::class);
    
    Route::resource('TrimsInward', TrimsInwardController::class);
    
    Route::get('/getPoForTrims',[TrimsInwardController::class,'getPoForTrims'])->name('getPoForTrims');
    Route::get('TrimsGRNPrint/{id}',[TrimsInwardController::class,'TrimsGRNPrint']);
    
    Route::get('/getPoMasterDetailTrims',[TrimsInwardController::class,'getPoMasterDetailTrims'])->name('getPoMasterDetailTrims');
    Route::get('/GetTrimsGRNReport',[TrimsInwardController::class,'GetTrimsGRNReport'])->name('GetTrimsGRNReport');
    Route::get('/TrimsGRNReportPrint',[TrimsInwardController::class,'TrimsGRNReportPrint'])->name('TrimsGRNReportPrint');
    
    
    Route::get('POApprovalList',[PurchaseOrderController::class,'show'])->name('POApprovalList');
    Route::get('GetPOList',[PurchaseOrderController::class,'GetPOList'])->name('GetPOList');
    Route::get('getBoMDetail',[PurchaseOrderController::class,'getBoMDetail'])->name('getBoMDetail');
    Route::get('getClassLists',[PurchaseOrderController::class,'getClassLists'])->name('getClassLists');
    
    Route::get('PODisApprovalList',[PurchaseOrderController::class,'Disapprovedshow'])->name('PODisApprovalList');
    Route::get('PartyDetail',[PurchaseOrderController::class,'GetPartyDetails'])->name('PartyDetail');
     
    Route::resource('Brand', BrandController::class);
    Route::resource('Season', SeasonController::class);
    Route::resource('JobStatus', JobStatusController::class);
    Route::resource('BuyerJobCard', BuyerJobCardController::class);
    
    Route::resource('FabricSummaryGRN', FabricSummaryGRNController::class);
    
    
    Route::get('/GetPOItemList',[FabricSummaryGRNController::class,'GetPOItemList'])->name('GetPOItemList');
    Route::get('/GetPOColorList',[FabricSummaryGRNController::class,'GetPOColorList'])->name('GetPOColorList');
    
    Route::resource('FabricInward', FabricInwardController::class);
    
     Route::resource('SystemLockMaster', SystemLockMasterController::class);
    Route::get('changeStatus',[SystemLockMasterController::class,'changeStatus'])->name('changeStatus');
    
    
    
    Route::get('/PrintBarcode',[FabricInwardController::class,'PrintFabricBarcode'])->name('PrintBarcode');
    
    Route::get('/FabricGRNData',[FabricInwardController::class,'FabricGRNData'])->name('FabricGRNData');
    
    Route::get('/FabricStockData',[FabricInwardController::class,'FabricStockData'])->name('FabricStockData');
    Route::get('/FabricStockSummaryData',[FabricInwardController::class,'FabricStockSummaryData'])->name('FabricStockSummaryData');
    
    
    
    Route::get('/TrimsGRNData',[TrimsInwardController::class,'TrimsGRNData'])->name('TrimsGRNData');
    Route::get('/TrimsStockData',[TrimsInwardController::class,'TrimsStockData'])->name('TrimsStockData');
    
    
    Route::get('/getPo',[FabricInwardController::class,'getPo'])->name('getPo');
    
    Route::get('/getPoMasterDetail',[FabricInwardController::class,'getPoMasterDetail'])->name('getPoMasterDetail');
    
    
    Route::get('PODetail',[FabricInwardController::class,'getPODetails'])->name('PODetail');
    Route::get('ItemRateFromPO',[FabricInwardController::class,'getItemRateFromPO'])->name('ItemRateFromPO');
    Route::get('ItemMinMaxFromPO',[FabricInwardController::class,'getItemMinMaxFromPO'])->name('ItemMinMaxFromPO');
    
    
    
    
    // Start SalesOrderCosting-------------------//
    Route::resource('SalesOrderCosting', SalesOrderCostingController::class);
    
    Route::get('/GetCostingData/{id}',[SalesOrderCostingController::class,'GetCostingData']);
    
    Route::get('/SalesOrderDetails',[BuyerPurchaseOrderController::class,'getSalesOrderDetails'])->name('SalesOrderDetails');
    Route::get('/ItemDetails',[SalesOrderCostingController::class,'GetItemData'])->name('ItemDetails');
    
    Route::get('/SalesCostingProfitSheet',[SalesOrderCostingController::class,'costingProfitSheet'])->name('SalesCostingProfitSheet');
    Route::get('/SalesCostingProfitSheet2',[SalesOrderCostingController::class,'costingProfitSheet2'])->name('SalesCostingProfitSheet2');
    
    Route::get('/GetCostingProfitByFilter',[SalesOrderCostingController::class,'GetCostingProfitByFilter'])->name('GetCostingProfitByFilter');
    Route::get('/costingProfitSheet3',[SalesOrderCostingController::class,'costingProfitSheet3'])->name('costingProfitSheet3');
    
    Route::resource('BOM', BOMController::class);
    
    Route::get('BUDGETPrint/{id}',[BOMController::class,'show']);
    
    Route::get('BOMPrint/{id}',[BOMController::class,'bomPrint']);
    
    
    Route::get('/GetOrderQty',[BOMController::class,'GetOrderQty'])->name('GetOrderQty');
    
    
    Route::get('/GetSizeList',[BOMController::class,'GetSizeList'])->name('GetSizeList');
    Route::get('/GetItemList',[BOMController::class,'GetItemList'])->name('GetItemList');
    Route::get('/GetClassItemList',[BOMController::class,'GetClassItemList'])->name('GetClassItemList');
    
    Route::get('/GetClassList',[BOMController::class,'GetClassList'])->name('GetClassList');
    Route::get('/GetItemColorList',[BOMController::class,'GetItemColorList'])->name('GetItemColorList');
    Route::get('/GetSewingTrimItemList',[BOMController::class,'GetSewingTrimItemList'])->name('GetSewingTrimItemList');
    Route::get('/GetPackingTrimItemList',[BOMController::class,'GetPackingTrimItemList'])->name('GetPackingTrimItemList');
    
    
    
    Route::get('/GetColorList',[BOMController::class,'GetColorList'])->name('GetColorList');
    Route::get('/FabricWiseSalesOrderCosting',[BOMController::class,'GetFabricWiseSalesOrderCosting'])->name('FabricWiseSalesOrderCosting');
    Route::get('/PackingWiseSalesOrderCosting',[BOMController::class,'GetPackingWiseSalesOrderCosting'])->name('PackingWiseSalesOrderCosting');
    Route::get('/ItemWiseSalesOrderCosting',[BOMController::class,'GetItemWiseSalesOrderCosting'])->name('ItemWiseSalesOrderCosting');
    Route::get('/TrimFabricWiseSalesOrderCosting',[BOMController::class,'GetTrimFabricWiseSalesOrderCosting'])->name('TrimFabricWiseSalesOrderCosting');
    
    
    // Vendor Work Order Start ----------------------------
    Route::resource('VendorWorkOrder', VendorWorkOrderController::class);
    
    Route::get('VWPrint/{id}',[VendorWorkOrderController::class,'VWPrint']);
    
    Route::get('/W_GetOrderQty',[VendorWorkOrderController::class,'W_GetOrderQty'])->name('W_GetOrderQty');
    Route::get('/W_GetSizeList',[VendorWorkOrderController::class,'W_GetSizeList'])->name('W_GetSizeList');
    Route::get('/W_GetItemList',[VendorWorkOrderController::class,'W_GetItemList'])->name('W_GetItemList');
    Route::get('/W_GetClassList',[VendorWorkOrderController::class,'W_GetClassList'])->name('W_GetClassList');
    Route::get('/W_GetColorList',[VendorWorkOrderController::class,'W_GetColorList'])->name('W_GetColorList');
    Route::get('/GetFabricConsumption',[VendorWorkOrderController::class,'GetFabricConsumption'])->name('GetFabricConsumption');
    Route::get('/GetSewingConsumption',[VendorWorkOrderController::class,'GetSewingConsumption'])->name('GetSewingConsumption');
    Route::get('/GetPackingConsumption',[VendorWorkOrderController::class,'GetPackingConsumption'])->name('GetPackingConsumption');
    Route::get('/GetTrimFabricConsumption',[VendorWorkOrderController::class,'GetTrimFabricConsumption'])->name('GetTrimFabricConsumption');
    Route::get('/VendorAllWorkOrders',[VendorWorkOrderController::class,'getVendorAllWorkOrders'])->name('VendorAllWorkOrders');
    
    // Vendor Work Order End ----------------------------
    
    
    
    //Vendor Purchase Order Start -----------------
    Route::resource('VendorPurchaseOrder', VendorPurchaseOrderController::class);
    
    Route::get('VPPrint/{id}',[VendorPurchaseOrderController::class,'VPPrint']);
    
    Route::get('/VPO_GetOrderQty',[VendorPurchaseOrderController::class,'VPO_GetOrderQty'])->name('VPO_GetOrderQty');
    Route::get('/VPO_GetSizeList',[VendorPurchaseOrderController::class,'VPO_GetSizeList'])->name('VPO_GetSizeList');
    Route::get('/VPO_GetItemList',[VendorPurchaseOrderController::class,'VPO_GetItemList'])->name('VPO_GetItemList');
    Route::get('/VPO_GetClassList',[VendorPurchaseOrderController::class,'VPO_GetClassList'])->name('VPO_GetClassList');
    Route::get('/VPO_GetColorList',[VendorPurchaseOrderController::class,'VPO_GetColorList'])->name('VPO_GetColorList');
    Route::get('/GetFabricConsumptionPO',[VendorPurchaseOrderController::class,'GetFabricConsumptionPO'])->name('GetFabricConsumptionPO');
    Route::get('/CuttingPOItemList',[VendorPurchaseOrderController::class,'GetCuttingPOItemList'])->name('CuttingPOItemList');
    Route::get('/POVsMaterialIssueReport',[VendorPurchaseOrderController::class,'POVsMaterialIssueReport'])->name('POVsMaterialIssueReport');
    
    
    
    Route::get('/VendorPurchaseOrderDetails',[VendorPurchaseOrderController::class,'getVendorPurchaseOrderDetails'])->name('VendorPurchaseOrderDetails');
    Route::get('/getVendorPO',[VendorPurchaseOrderController::class,'getVendorPO'])->name('getVendorPO');
    Route::get('/getVendorAllPO',[VendorPurchaseOrderController::class,'getVendorAllPO'])->name('getVendorAllPO');
    
    Route::get('/GetVPOVsIssueReport',[VendorPurchaseOrderController::class,'GetVPOVsIssueReport'])->name('GetVPOVsIssueReport');
    
    //Vendor Purchase Order End -----------------
    
    
    
    
    // Route::get('/GetCostingData/{id}',[SalesOrderCostingController::class,'GetCostingData']);
    
    // Route::get('/SalesOrderDetails',[SalesOrderCostingController::class,'getSalesOrderDetails'])->name('SalesOrderDetails');
    // Route::get('/ItemDetails',[SalesOrderCostingController::class,'GetItemData'])->name('ItemDetails');
    
    Route::resource('SaleTransaction', SaleTransactionMasterController::class);
    Route::get('/getSalesOrderData',[SaleTransactionMasterController::class,'getSalesOrderData'])->name('getSalesOrderData');
    Route::get('/CartonPackingList',[SaleTransactionMasterController::class,'CartonPackingList'])->name('CartonPackingList');
   // Route::get('/GetSalesOrderList',[SaleTransactionMasterController::class,'GetSalesOrderList'])->name('GetSalesOrderList');
    
    Route::get('/GetSaleReport',[SaleTransactionMasterController::class,'GetSaleReport'])->name('GetSaleReport');
    Route::get('/SaleFilterReport',[SaleTransactionMasterController::class,'SaleFilterReport'])->name('SaleFilterReport'); 
    
    // End SalesOrderCosting-------------------//
    
    Route::resource('FabricChecking', FabricCheckingController::class);
    Route::get('/InwardList',[FabricCheckingController::class,'getDetails'])->name('InwardList');
    Route::get('/InwardMasterList',[FabricCheckingController::class,'getMasterdata'])->name('InwardMasterList');
    Route::resource('BuyerPurchaseOrder', BuyerPurchaseOrderController::class);
    Route::get('SaleOrderPrint/{id}',[BuyerPurchaseOrderController::class,'show']);
    Route::get('/GetAddress',[BuyerPurchaseOrderController::class,'getAddress'])->name('GetAddress');
    Route::get('/TaxList',[BuyerPurchaseOrderController::class,'GetTaxList'])->name('TaxList');
    Route::get('/SizeDetailList',[BuyerPurchaseOrderController::class,'GetSizeDetailList'])->name('SizeDetailList');
    Route::get('/SizeDetailListMaster',[BuyerPurchaseOrderController::class,'GetSizeDetailListMaster'])->name('SizeDetailListMaster');
    Route::get('/SizeDetailListMasterExcel',[BuyerPurchaseOrderController::class,'GetSizeDetailListMasterExcel'])->name('SizeDetailListMasterExcel');
    
    Route::get('/GetSalesOrderList',[BuyerPurchaseOrderController::class,'GetSalesOrderList'])->name('GetSalesOrderList');
    
    Route::get('/SalesOrderOpen',[BuyerPurchaseOrderController::class,'SalesOrderOpen'])->name('SalesOrderOpen');
    Route::get('/SalesOrderSample',[BuyerPurchaseOrderController::class,'SalesOrderSample'])->name('SalesOrderSample');
    Route::get('/SalesOrderClosed',[BuyerPurchaseOrderController::class,'SalesOrderClosed'])->name('SalesOrderClosed');
    Route::get('/SalesOrderCancelled',[BuyerPurchaseOrderController::class,'SalesOrderCancelled'])->name('SalesOrderCancelled');
    Route::get('/OpenSalesOrderDashboard',[BuyerPurchaseOrderController::class,'OpenSalesOrderDashboard'])->name('OpenSalesOrderDashboard');
    Route::get('/BuyerOpenSalesOrderDashboard',[BuyerPurchaseOrderController::class,'BuyerOpenSalesOrderDashboard'])->name('BuyerOpenSalesOrderDashboard');
    Route::get('/OpenSalesOrderDetailDashboard',[BuyerPurchaseOrderController::class,'OpenSalesOrderDetailDashboard'])->name('OpenSalesOrderDetailDashboard');
    Route::get('/TotalSalesOrderDetailDashboard',[BuyerPurchaseOrderController::class,'TotalSalesOrderDetailDashboard'])->name('TotalSalesOrderDetailDashboard');
    Route::get('/OpenSalesOrderMonthDetailDashboard',[BuyerPurchaseOrderController::class,'OpenSalesOrderMonthDetailDashboard'])->name('OpenSalesOrderMonthDetailDashboard');
    Route::get('/TotalSalesOrderDetailDashboardFilter',[BuyerPurchaseOrderController::class,'TotalSalesOrderDetailDashboardFilter'])->name('TotalSalesOrderDetailDashboardFilter');
    
    
    Route::get('/DailyProductionDetailDashboard',[BuyerPurchaseOrderController::class,'DailyProductionDetailDashboard'])->name('DailyProductionDetailDashboard');
    Route::get('/OrderProgressDetailDashboard',[BuyerPurchaseOrderController::class,'OrderProgressDetailDashboard'])->name('OrderProgressDetailDashboard');
    Route::get('/OrderProgressFinishingDetailDashboard',[BuyerPurchaseOrderController::class,'OrderProgressFinishingDetailDashboard'])->name('OrderProgressFinishingDetailDashboard');
    Route::get('/OrderProgressPackingDetailDashboard',[BuyerPurchaseOrderController::class,'OrderProgressPackingDetailDashboard'])->name('OrderProgressPackingDetailDashboard');
    
    
    
    Route::get('/SalesOrderCostingBOMStatusDashboard',[BuyerPurchaseOrderController::class,'SalesOrderCostingBOMStatusDashboard'])->name('SalesOrderCostingBOMStatusDashboard');
    Route::get('/CostingOHPDashboard',[BuyerPurchaseOrderController::class,'CostingOHPDashboard'])->name('CostingOHPDashboard');
    Route::get('/CostingVSBudgetDashboard',[BuyerPurchaseOrderController::class,'CostingVSBudgetDashboard'])->name('CostingVSBudgetDashboard');
    
    
    Route::get('/GetOCRReport',[BuyerPurchaseOrderController::class,'GetOCRReport'])->name('GetOCRReport');
    Route::get('/GetMerchandiseOCRReport',[BuyerPurchaseOrderController::class,'GetMerchandiseOCRReport'])->name('GetMerchandiseOCRReport');
    Route::get('/MerchandiseOCRReport',[BuyerPurchaseOrderController::class,'MerchandiseOCRReport'])->name('MerchandiseOCRReport');
    Route::get('/GetOCRSummaryReport',[BuyerPurchaseOrderController::class,'GetOCRSummaryReport'])->name('GetOCRSummaryReport');
    Route::get('/GetOrderVsShipmentReport',[BuyerPurchaseOrderController::class,'GetOrderVsShipmentReport'])->name('GetOrderVsShipmentReport');
    
    Route::get('/OCRSummaryReport',[BuyerPurchaseOrderController::class,'OCRSummaryReport'])->name('OCRSummaryReport');
    
    Route::get('/OCRReport',[BuyerPurchaseOrderController::class,'OCRReport'])->name('OCRReport');
    
    
    Route::get('/GetCutPlanReport',[BuyerPurchaseOrderController::class,'GetCutPlanReport'])->name('GetCutPlanReport');
    Route::get('/CuttingPOList',[BuyerPurchaseOrderController::class,'CuttingPOList'])->name('CuttingPOList');
    Route::get('/CutPlanReport',[BuyerPurchaseOrderController::class,'CutPlanReport'])->name('CutPlanReport');
    
    
    Route::get('/SeasonList',[BuyerPurchaseOrderController::class,'GetSeasonList'])->name('SeasonList');
    Route::get('/BrandList',[BuyerPurchaseOrderController::class,'GetBrandList'])->name('BrandList');
    
     Route::post('/getSaleOrderPPKTables',[BuyerPurchaseOrderController::class,'getSaleOrderPPKTables'])->name('getSaleOrderPPKTables');
     Route::post('storePPKTables',[BuyerPurchaseOrderController::class,'storePPKTables'])->name('storePPKTables');
     Route::post('getRatio',[BuyerPurchaseOrderController::class,'getRatio'])->name('getRatio');
    
     Route::resource('PPK', PPKController::class);
     Route::post('getPPKTables',[PPKController::class,'getPPKTables'])->name('getPPKTables');
      Route::post('/getcurrency',[BuyerPurchaseOrderController::class,'getcurrency'])->name('getcurrency');
    
    Route::resource('Task', TaskMasterController::class);
    Route::get('/CompletedTask',[TaskMasterController::class,'CompletedTaskList'])->name('CompletedTask');
    Route::resource('MaterialOutward', MaterialOutwardController::class);
    Route::resource('MaterialInward', MaterialInwardController::class);
    
    Route::resource('FabricCutting', CuttingMasterController::class);
    Route::get('/RatioList',[CuttingMasterController::class,'getRatioDetails'])->name('RatioList');
    Route::get('/EndDataList',[CuttingMasterController::class,'getEndDataDetails'])->name('EndDataList');
    Route::get('/CheckingFabricList',[CuttingMasterController::class,'getCheckingFabricdata'])->name('CheckingFabricList');
    Route::get('/CheckingMasterList',[CuttingMasterController::class,'getCheckingMasterdata'])->name('CheckingMasterList');
    
    Route::get('/CompletedCutting',[CuttingMasterController::class,'CompletedCutting'])->name('CompletedCutting');
     
    Route::resource('StitchingInhouse', StitchingInhouseMasterController::class);
    Route::get('/VendorWorkOrderDetails',[StitchingInhouseMasterController::class,'getVendorWorkOrderDetails'])->name('VendorWorkOrderDetails');
    Route::get('/VW_GetOrderQty',[StitchingInhouseMasterController::class,'VW_GetOrderQty'])->name('VW_GetOrderQty');
    Route::get('/StitchingGRNDashboard',[StitchingInhouseMasterController::class,'StitchingGRNDashboard'])->name('StitchingGRNDashboard');
    
    Route::get('/GetDailyProductionReport',[StitchingInhouseMasterController::class,'GetDailyProductionReport'])->name('GetDailyProductionReport');
    Route::get('/DailyProductionReport',[StitchingInhouseMasterController::class,'DailyProductionReport'])->name('DailyProductionReport');
    Route::get('/GetVendorStatusReport',[StitchingInhouseMasterController::class,'GetVendorStatusReport'])->name('GetVendorStatusReport');
    Route::get('/VendorStatusReport',[StitchingInhouseMasterController::class,'VendorStatusReport'])->name('VendorStatusReport');
    
     Route::get('/StitchingGRNPrint/{id}',[StitchingInhouseMasterController::class,'StitchingGRNPrint']);
    
    
    Route::resource('CutPanelIssue', CutPanelIssueMasterController::class);
    Route::get('/VW_GetCutOrderQty',[CutPanelIssueMasterController::class,'VW_GetCutOrderQty'])->name('VW_GetCutOrderQty');
    Route::get('/GetLineList',[CutPanelIssueMasterController::class,'GetLineList'])->name('GetLineList');
    Route::get('/GetCUTGRNQty',[CutPanelIssueMasterController::class,'GetCUTGRNQty'])->name('GetCUTGRNQty');
    
    Route::get('/CUTGRNQty',[CutPanelIssueMasterController::class,'CUTGRNQty'])->name('CUTGRNQty');
    
    Route::get('/CutPanelStockSummary',[CutPanelIssueMasterController::class,'CutPanelStockSummary'])->name('CutPanelStockSummary');
    Route::get('/CutPanelGRNReport',[CutPanelIssueMasterController::class,'CutPanelGRNReport'])->name('CutPanelGRNReport');
    
    
    Route::get('/CutPanelIssuePrint/{id}',[CutPanelIssueMasterController::class,'CutPanelIssuePrint']);
     
     
    Route::get('/CutPanelIssueReport',[CutPanelIssueMasterController::class,'CutPanelIssueReport'])->name('CutPanelIssueReport');
    Route::resource('OutwardForFinishing', OutwardForFinishingMasterController::class);
    Route::get('/vpo_GetFinishingPOQty',[OutwardForFinishingMasterController::class,'vpo_GetFinishingPOQty'])->name('vpo_GetFinishingPOQty');
    
    Route::get('/OutwardForFinishingPrint/{id}',[OutwardForFinishingMasterController::class,'OutwardForFinishingPrint']);
    
    
    
    
    Route::get('/GetSTITCHINGGRNQty',[FinishingInhouseMasterController::class,'GetSTITCHINGGRNQty'])->name('GetSTITCHINGGRNQty'); 
    Route::get('/FinishingGRNPrint/{id}',[FinishingInhouseMasterController::class,'FinishingGRNPrint']);
    
    Route::resource('OutwardForPacking', OutwardForPackingMasterController::class);
    Route::get('/vpo_GetPackingPOQty',[OutwardForPackingMasterController::class,'vpo_GetPackingPOQty'])->name('vpo_GetPackingPOQty');  
    
    Route::get('/OutwardForPackingPrint/{id}',[OutwardForPackingMasterController::class,'OutwardForPackingPrint']);
    
    
    
    Route::resource('CutPanelGRN', CutPanelGRNMasterController::class);
    Route::get('/VPO_GetCutOrderQty',[CutPanelGRNMasterController::class,'VPO_GetCutOrderQty'])->name('VPO_GetCutOrderQty');
    Route::get('/VendorProcessOrderDetails',[CutPanelGRNMasterController::class,'getVendorProcessOrderDetails'])->name('VendorProcessOrderDetails');
    Route::get('/CutPanelGRNPrint/{id}',[CutPanelGRNMasterController::class,'CutPanelGRNPrint']);
     
    
    Route::resource('QCStitchingInhouse', QCStitchingInhouseMasterController::class);
    Route::get('/StitchingInhouseDetails',[QCStitchingInhouseMasterController::class,'getStitchingInhouseDetails'])->name('StitchingInhouseDetails');
    Route::get('/STI_GetOrderQty',[QCStitchingInhouseMasterController::class,'STI_GetOrderQty'])->name('STI_GetOrderQty');
    Route::get('/QCStitchingReport',[QCStitchingInhouseMasterController::class,'QCStitchingReport'])->name('QCStitchingReport');
    
    
    Route::get('/QCStitchingGRNPrint/{id}',[QCStitchingInhouseMasterController::class,'QCStitchingGRNPrint']);
    
    Route::resource('FinishingInhouse', FinishingInhouseMasterController::class);
    //Route::get('/QCStitchingInhouseDetails',[FinishingInhouseMasterController::class,'getQCStitchingInhouseDetails'])->name('QCStitchingInhouseDetails');
    //Route::get('/QC_GetOrderQty',[FinishingInhouseMasterController::class,'QC_GetOrderQty'])->name('QC_GetOrderQty');
    Route::get('/vpo_GetFinishedPOQty',[FinishingInhouseMasterController::class,'vpo_GetFinishedPOQty'])->name('vpo_GetFinishedPOQty');
    
    
    Route::resource('PackingInhouse', PackingInhouseMasterController::class);
    Route::get('/PackingInhouseDetails',[PackingInhouseMasterController::class,'getFinishingInhouseDetails'])->name('FinishingInhouseDetails');
    Route::get('/FNSI_GetOrderQty',[PackingInhouseMasterController::class,'FNSI_GetOrderQty'])->name('FNSI_GetOrderQty');
    Route::get('/GetFINISHINGGRNQty',[PackingInhouseMasterController::class,'GetFINISHINGGRNQty'])->name('GetFINISHINGGRNQty');
    Route::get('/Op_GetOrderQty',[PackingInhouseMasterController::class,'Op_GetOrderQty'])->name('Op_GetOrderQty');
    Route::get('/PackingGRNPrint/{id}',[PackingInhouseMasterController::class,'PackingGRNPrint']);
    Route::get('/PackingGRNReport',[PackingInhouseMasterController::class,'PackingGRNReport'])->name('PackingGRNReport');
    
    
    Route::resource('CartonPackingInhouse', CartonPackingInhouseMasterController::class);
    Route::get('/CartonPackingInhouseDetails',[CartonPackingInhouseMasterController::class,'getPackingInhouseDetails'])->name('PackingInhouseDetails');
    Route::get('/PKI_GetOrderQty',[CartonPackingInhouseMasterController::class,'PKI_GetOrderQty'])->name('PKI_GetOrderQty');
    Route::get('/PKI_GetOrdarQtyByRow',[CartonPackingInhouseMasterController::class,'PKI_GetOrdarQtyByRow'])->name('PKI_GetOrdarQtyByRow');
    
    Route::get('/FGStockReport',[CartonPackingInhouseMasterController::class,'FGStockReport'])->name('FGStockReport');
    Route::get('/FGStockSummaryReport',[CartonPackingInhouseMasterController::class,'FGStockSummaryReport'])->name('FGStockSummaryReport');
    
    
    Route::get('/PKI_GetColorList',[CartonPackingInhouseMasterController::class,'PKI_GetColorList'])->name('PKI_GetColorList');
    Route::get('PKI_GetMaxMinvalueList',[CartonPackingInhouseMasterController::class,'GetMaxMinvalueList'])->name('PKI_GetMaxMinvalueList');
    
    Route::get('NewSalesOrderList',[CartonPackingInhouseMasterController::class,'getSalesOrderList'])->name('NewSalesOrderList');
    Route::get('/BuyerLocationList',[CartonPackingInhouseMasterController::class,'getBuyerLocationList'])->name('BuyerLocationList');
    
    Route::get('/CartonPackingPrint/{id}',[CartonPackingInhouseMasterController::class,'CartonPackingPrint']);
    
    Route::resource('TransferPackingInhouse', TransferPackingInhouseMasterController::class);
    Route::get('/FG_GetRawData',[TransferPackingInhouseMasterController::class,'FG_GetRawData'])->name('FG_GetRawData');
    Route::get('/FGStockData',[TransferPackingInhouseMasterController::class,'FGStockData'])->name('FGStockData');
    Route::get('/FG_GetColorList',[TransferPackingInhouseMasterController::class,'FG_GetColorList'])->name('FG_GetColorList');
    Route::get('/FGPackingInhouseDetails',[TransferPackingInhouseMasterController::class,'FGPackingInhouseDetails'])->name('FGPackingInhouseDetails');
    Route::get('/PKI_GetTransferQtyByRow',[TransferPackingInhouseMasterController::class,'PKI_GetTransferQtyByRow'])->name('PKI_GetTransferQtyByRow');
    Route::get('TPKI_GetMaxMinvalueList',[TransferPackingInhouseMasterController::class,'TPKI_GetMaxMinvalueList'])->name('TPKI_GetMaxMinvalueList');
    
    
    
    Route::resource('Task', TaskMasterController::class);
    Route::get('/CommanData',[TaskMasterController::class,'getCommanDetails'])->name('CommanData');
    Route::get('/SizeBalanceList',[TaskMasterController::class,'getBalanceDetails'])->name('SizeBalanceList');
    Route::get('TaskList',[CuttingMasterController::class,'GetTaskList'])->name('TaskList');
    
    Route::resource('FabricTrimCard', FabricTrimCardMasterController::class);
    Route::get('/JobCardDetail',[FabricTrimCardMasterController::class,'getJobCardDetails'])->name('JobCardDetail');
    
    
    Route::get('/Average',[FabricTrimCardMasterController::class,'getColorAverage'])->name('Average');
    Route::get('/AverageTrim',[FabricTrimCardMasterController::class,'getColorAverageTrim'])->name('AverageTrim');
    Route::get('/ColorDetails',[FabricTrimCardMasterController::class,'getColorDetails'])->name('ColorDetails');
    Route::get('/TrimColorDetails',[FabricTrimCardMasterController::class,'getTrimColorDetails'])->name('TrimColorDetails');
    
    Route::get('/SalesOrderDetail2',[FabricOutwardController::class,'getSalesOrderDetail2'])->name('SalesOrderDetail2');
    
    Route::get('/FabricOutwardData',[FabricOutwardController::class,'FabricOutwardData'])->name('FabricOutwardData');
    
    
    
    Route::resource('JobCardReport', BuyerJobcardReportController::class);
    Route::resource('InwardReport', FabricInwardReportController::class);
    Route::get('FabricGRNPrintNew/{id}',[FabricInwardReportController::class,'FabricGRNPrint']);
    Route::get('/GetFabricGRNReport',[FabricInwardReportController::class,'GetFabricGRNReport'])->name('GetFabricGRNReport'); 
    Route::get('/FabricGRNFilterReport',[FabricInwardReportController::class,'FabricGRNFilterReport'])->name('FabricGRNFilterReport'); 
    
    
    Route::resource('BundleBarcode', BundleController::class);
    Route::get('AddBundleBarcode/{id1}/{id2}',[BundleController::class,'AddBundleBarcode']);
    Route::get('/BundleList',[BundleController::class,'getDetails'])->name('BundleList');
    Route::get('/BundleSplitList',[BundleController::class,'getRowDetails'])->name('BundleSplitList');
    Route::get('/BundlePrint',[BundleController::class,'BundlePrinting'])->name('BundlePrint');
    Route::get('/SessionValue',[BundleController::class,'getSessionValue'])->name('SessionValue');
    Route::get('/GetJobPartList',[BundleController::class,'GetJobPartList'])->name('GetJobPartList');
    
    
    //*********Production Routes Starts **********
    Route::resource('CostingCategory', CostingCategoryController::class);
    Route::resource('CostingParticular', CostingParticularController::class);
    Route::get('/GetCostingParticularList',[CostingParticularController::class,'GetCostingParticularList'])->name('GetCostingParticularList');
    
    
    
    
    
    
    
    Route::resource('OperationType', OperationTypeController::class);
    Route::resource('OperationMaster', OperationMasterController::class);
    Route::get('GetStyleList',[OperationMasterController::class,'getStyleList'])->name('GetStyleList');
    Route::get('checkOperationalExistingRecord',[OperationMasterController::class,'checkOperationalExistingRecord'])->name('checkOperationalExistingRecord');
    Route::resource('JobOperation', JobOperationController::class);
    Route::get('getCommanOperationMaster',[JobOperationController::class,'getCommanOperationMaster'])->name('getCommanOperationMaster');
    Route::get('getJobCard',[JobOperationController::class,'getJobCard'])->name('getJobCard');
    Route::get('getStylelist',[JobOperationController::class,'getStylelist'])->name('getStylelist');
    Route::get('checkExistingRecord',[JobOperationController::class,'checkExistingRecord'])->name('checkExistingRecord');
    Route::get('getCommanOperations',[JobOperationController::class,'getCommanOperations'])->name('getCommanOperations');
    Route::get('getOperationListFromOperationDetail',[JobOperationController::class,'getOperationListFromOperationDetail'])->name('getOperationListFromOperationDetail');
    Route::get('JobOperationPrint/{id}',[JobOperationController::class,'show']);
    Route::get('show1',[JobOperationController::class,'show1'])->name('show1'); 
    
    
    Route::resource('Production', ProductionController::class);
    
    Route::get('WorkerProductionReportForm', [ProductionController::class,'WorkerProductionReportForm'])->name('WorkerProductionReportForm');
    Route::get('SalaryPaymentReportForm', [ProductionController::class,'SalaryPaymentReportForm'])->name('SalaryPaymentReportForm');
    Route::get('getBundleData',[ProductionController::class,'getBundleData'])->name('getBundleData');
    Route::get('getBundleDatanew',[ProductionController::class,'getBundleDatanew'])->name('getBundleDatanew');
    Route::get('MontlyWorkerReportForm',[ProductionController::class,'MontlyWorkerReportForm'])->name('MontlyWorkerReportForm');
    
    Route::get('getopereationtable',[ProductionController::class,'getopereationtable'])->name('getopereationtable');
    Route::get('getOprationRate',[ProductionController::class,'getOprationRate'])->name('getOprationRate');
    Route::get('getBarcodeList',[ProductionController::class,'getBarcodeList'])->name('getBarcodeList');
    Route::get('getStyleDetails',[ProductionController::class,'getStyleDetails'])->name('getStyleDetails');
    
    
    Route::get('getWorkers',[ProductionController::class,'getWorkers'])->name('getWorkers');
    
    Route::get('getBundleDatavalidate',[ProductionController::class,'getBundleDatavalidate'])->name('getBundleDatavalidate');
    Route::get('GetWorkerDayandOperation',[ProductionController::class,'GetWorkerDayandOperation'])->name('GetWorkerDayandOperation');
    
    Route::get('deleterows',[ProductionController::class,'deleterows'])->name('deleterows');
    
    
    
    
    
    
    Route::resource('OtherProduction', OtherProductionController::class);
      Route::post('import_other_production',[OtherProductionController::class,'import_other_production'])->name('import_other_production');
    Route::get('checkQtyLimit', [OtherProductionController::class,'checkQtyLimit'])->name('checkQtyLimit');
    Route::get('getOtherBundleDatanew',[OtherProductionController::class,'getOtherBundleDatanew'])->name('getOtherBundleDatanew');
    Route::get('getOtherBundleData',[OtherProductionController::class,'getOtherBundleData'])->name('getOtherBundleData');
    Route::get('getOtherStyleDetails',[OtherProductionController::class,'getOtherStyleDetails'])->name('getOtherStyleDetails');
    Route::get('getOtherOprationRate',[OtherProductionController::class,'getOtherOprationRate'])->name('getOtherOprationRate');
    Route::get('getOtherBundleDatavalidate',[OtherProductionController::class,'getOtherBundleDatavalidate'])->name('getOtherBundleDatavalidate');
    Route::get('deleteOtherrows',[OtherProductionController::class,'deleteOtherrows'])->name('deleteOtherrows');
    Route::get('getSizeQtyDropdownData',[OtherProductionController::class,'getSizeQtyDropdownData'])->name('getSizeQtyDropdownData');
    Route::get('getQty',[OtherProductionController::class,'getQty'])->name('getQty');
    Route::get('getStyleListFromOperationType',[OtherProductionController::class,'getStyleListFromOperationType'])->name('getStyleListFromOperationType');
    
    
    
    //*********Production Routes End **********
    
   
    
    //Yarn Inward 
     Route::resource('YarnInward', YarnInwardController::class);
     Route::resource('YarnType', YarnTypeController::class);
     Route::resource('Broker', BrokerMasterController::class);
    
    
    
    Route::resource('JobPart', JobPartController::class);
    Route::resource('FabricTrimPart', FabricTrimPartController::class);
    Route::resource('Quality', QualityController::class);
    
    Route::post('qualityimport',[QualityController::class,'qualityimport'])->name('qualityimport');
    
    Route::resource('FabricOutward', FabricOutwardController::class);
    //Fabric Outward Controller for Fabric Issue to Internal Department.
    Route::get('/FabricRecord',[FabricOutwardController::class,'getFabricRecord'])->name('FabricRecord');
    Route::resource('FabricOutwardReport', FabricOutwardReportController::class);
    
     
    Route::get('/GetFabricInOutStockReportForm',[FabricOutwardReportController::class,'GetFabricInOutStockReportForm'])->name('GetFabricInOutStockReportForm'); 
     
    Route::get('/FabricInOutStockReport',[FabricOutwardReportController::class,'getFabricInOutStockReport'])->name('FabricInOutStockReport');
    Route::get('FabricOutwardPrint/{id}',[FabricOutwardReportController::class,'FabricOutwardPrint']);
    Route::get('FabricOutwardRollsPrint/{id}',[FabricOutwardReportController::class,'FabricOutwardRollsPrint']);
    
    Route::resource('FabricCheckingReport', FabricCheckingReportController::class);
    
    Route::get('FabricCheckPrint/{id}',[FabricCheckingReportController::class,'FabricCheckPrint']);
    Route::resource('FabricCuttingReport', FabricCuttingReportController::class);
    Route::resource('FabricTrimCardReport', FabricTrimCardReportController::class);
    
    
    
    
    
    Route::resource('InwardStore', MaterialInwardStoreController::class);
    
    
    Route::get('/inwardApprovalList',[MaterialInwardStoreController::class,'show'])->name('inwardApprovalList');
    
    Route::get('/getPoDetails',[MaterialInwardStoreController::class,'getPoDetails'])->name('getPoDetails');
    
    Route::get('/getPoMasterDetails',[MaterialInwardStoreController::class,'getPoMasterDetails'])->name('getPoMasterDetails');
    
    Route::resource('Requisition', RequisitionController::class);
    
    Route::get('/requisitionApproval',[RequisitionController::class,'show'])->name('requisitionApproval');
    
    
    Route::get('/GETSTOCK',[RequisitionController::class,'GETSTOCK'])->name('GETSTOCK');
    
    
    Route::resource('RequisitionOutward', RequisitionOutwardController::class);
    
    
    Route::get('/getRequitionDetails',[RequisitionOutwardController::class,'getRequitionDetails'])->name('getRequitionDetails');
    Route::get('/getMasterDetails',[RequisitionOutwardController::class,'getMasterDetails'])->name('getMasterDetails');
    
    Route::resource('ReturnableOutward', ReturnableOutwardController::class);
    
    
    Route::resource('POReport', POReportController::class);
    Route::post('POReport/pdf',[POReportController::class,'pdf'])->name('pdf');
     
    Route::get('/FabricStock',[StockReportController::class,'FabricStock'])->name('FabricStock');
    Route::get('/FabricSummary',[StockReportController::class,'FabricStock2'])->name('FabricSummary');
    Route::get('/FabricStockPage',[StockReportController::class,'GetOnPageFabricStock'])->name('FabricStockPage');
    
    
    Route::get('/InwardData',[StockReportController::class,'GetInwardFabList'])->name('InwardData');
    Route::get('/FabricSummaryPage',[StockReportController::class,'GetOnPageFabricStockSummary'])->name('FabricSummaryPage');
    
    Route::resource('POReportItemWise', POItemWiseReportController::class);
    Route::post('POReportItemWise/pdf',[POItemWiseReportController::class,'pdf'])->name('itempdf');
    
    
    Route::resource('MIStoreReport', MaterialInwardStoreReportController::class);
    
    Route::post('MIStoreReport/pdf',[MaterialInwardStoreReportController::class,'pdf'])->name('inwardpdf');
    
    
    Route::resource('RequisitionReport', RequisitionReportController::class);
    
    Route::post('RequisitionReport/pdf',[RequisitionReportController::class,'pdf'])->name('Requisitionpdf');
    
    
    Route::resource('MIStoreReportItemwise', MIStoreItemwiseReportController::class);
    
    Route::post('MIStoreReportItemwise/pdf',[MIStoreItemwiseReportController::class,'pdf'])->name('MIitempdf');
    
    Route::resource('RequisitionOutwardReport', RequisitionOutwardReportController::class);
    
    Route::post('RequisitionOutwardReport/pdf',[RequisitionOutwardReportController::class,'pdf'])->name('MIOutwardpdf');
    
    
    Route::get('MostPurchaseItems/pdf',[POItemWiseReportController::class,'itemsPdf'])->name('itemsPdf');
    
    Route::get('MostConsumedItems/pdf',[POItemWiseReportController::class,'MostconsumeditemsPdf'])->name('Mostconsumeditems');
    
    Route::get('StockReport/pdf',[StockReportController::class,'itemStockPdf'])->name('itemStockPdf');
    
    Route::get('print/{id}',[POReportController::class,'generatePO']);
    
    Route::resource('TrimsOutward', TrimsOutwardController::class);
    
    Route::get('getVendorCode',[TrimsOutwardController::class,'getVendorCode'])->name('getVendorCode');
    Route::get('getTrimsItemRate',[TrimsOutwardController::class,'getTrimsItemRate'])->name('getTrimsItemRate');
     
     
 
    Route::get('TrimsOutwardData',[TrimsOutwardController::class,'TrimsOutwardData'])->name('TrimsOutwardData');
     
     
    Route::get('getVendorProcessOrder',[TrimsOutwardController::class,'getVendorProcessOrder'])->name('getVendorProcessOrder');
    Route::get('getVendorMasterDetail',[TrimsOutwardController::class,'getVendorMasterDetail'])->name('getVendorMasterDetail');
    
    Route::get('getvendortablenew',[TrimsOutwardController::class,'getvendortablenew'])->name('getvendortablenew');
    Route::get('getProcessTrimData',[TrimsOutwardController::class,'getProcessTrimData'])->name('getProcessTrimData');
    
    Route::get('TrimOutwardPrint/{id}',[TrimsOutwardController::class,'show']);
    Route::get('TrimOutwardStandardPrint/{id}',[TrimsOutwardController::class,'TrimOutwardStandardPrint']);
    Route::get('TrimOutwardStandardPrint2/{id}',[TrimsOutwardController::class,'TrimOutwardStandardPrint2']);
    



    Route::resource('PresentEmployees', PresentEmployeesController::class);
    Route::resource('ActivityMaster', ActivityMasterController::class);
    Route::resource('ActivityTypeMaster', ActivityTypeMasterController::class);
    Route::resource('T_And_A_Master', T_And_A_MasterController::class);
    Route::get('getSalesOrderDetail', [T_And_A_MasterController::class,'getSalesOrderDetail'])->name('getSalesOrderDetail');
    Route::get('Timeline', [T_And_A_MasterController::class,'Timeline'])->name('Timeline');
 	Route::get('GetTNAMasterData', [T_And_A_MasterController::class,'GetTNAMasterData'])->name('GetTNAMasterData');
    Route::resource('PPCMaster', PPCMasterController::class);



    Route::resource('T_And_A_TemplateMaster', T_And_A_TemplateMasterController::class);
    Route::get('getSalesOrderDetail2', [T_And_A_TemplateMasterController::class,'getSalesOrderDetail2'])->name('getSalesOrderDetail2');
	Route::get('Timeline2', [T_And_A_TemplateMasterController::class,'Timeline2'])->name('Timeline2');


    
    Route::get('PPCCalendarReport/{id}/{id2}',[PPCMasterController::class,'PPCCalendarReport']);
    //Route::get('PPCCalendarReport',[PPCMasterController::class,'PPCCalendarReport'])->name('PPCCalendarReport');
    
    Route::get('QtyConversion',[ItemMasterController::class,'QtyConversion'])->name('QtyConversion');
    Route::get('GetClassifyData',[ItemMasterController::class,'GetClassifyData'])->name('GetClassifyData');
    Route::get('GetSupplierId',[ItemMasterController::class,'GetSupplierId'])->name('GetSupplierId');
    Route::get('GetSupplierList',[ItemMasterController::class,'GetSupplierList'])->name('GetSupplierList');
    
    
    
    Route::resource('SingleSizeMaster', SingleSizeMasterController::class);
    
    Route::resource('SalesOrderCostingProcessMaster', SalesOrderCostingProcessMasterController::class);
    Route::get('GetCatWiseItemList',[SalesOrderCostingProcessMasterController::class,'GetCatWiseItemList'])->name('GetCatWiseItemList');
    Route::get('popupData',[SalesOrderCostingProcessMasterController::class,'popupData'])->name('popupData');
    Route::post('SalesPrrocssUpdate',[SalesOrderCostingProcessMasterController::class,'SalesPrrocssUpdate'])->name('SalesPrrocssUpdate');
   Route::resource('BOMProcessMaster', BOMProcessController::class);
    Route::get('GetSocData',[BOMProcessController::class,'GetSocData'])->name('GetSocData');
    Route::get('GetBuyerPurchaseData',[BOMProcessController::class,'GetBuyerPurchaseData'])->name('GetBuyerPurchaseData');
    Route::get('bomProcessPrint/{id}',[BOMProcessController::class,'bomProcessPrint'])->name('bomProcessPrint');
    Route::get('RepeatSalesOrderCostingProcessMaster/{id}',[SalesOrderCostingProcessMasterController::class,'RepeatSalesOrderCostingProcessMaster'])->name('RepeatSalesOrderCostingProcessMaster');
    Route::get('SalesOrderCostingProcessPrint/{id}',[SalesOrderCostingProcessMasterController::class,'SalesOrderCostingProcessPrint'])->name('SalesOrderCostingProcessPrint');
    Route::post('RepeatSaveSalesOrderCosting',[SalesOrderCostingProcessMasterController::class,'RepeatSaveSalesOrderCosting'])->name('RepeatSaveSalesOrderCosting');
    Route::get('getStyleDescription',[SalesOrderCostingProcessMasterController::class,'getStyleDescription'])->name('getStyleDescription');
    Route::get('getStyleNoList',[SalesOrderCostingProcessMasterController::class,'getStyleNoList'])->name('getStyleNoList');




    Route::get('GetBrandData',[SalesOrderCostingProcessMasterController::class,'GetBrandData'])->name('GetBrandData');
    Route::get('GetSeasonData',[SalesOrderCostingProcessMasterController::class,'GetSeasonData'])->name('GetSeasonData');
    Route::get('SaveMarginData',[SalesOrderCostingProcessMasterController::class,'SaveMarginData'])->name('SaveMarginData');
    Route::get('CheckStyleNo',[SalesOrderCostingProcessMasterController::class,'CheckStyleNo'])->name('CheckStyleNo');
    Route::get('GetCurrencyData',[SalesOrderCostingProcessMasterController::class,'GetCurrencyData'])->name('GetCurrencyData');
    Route::get('GetFGData',[SalesOrderCostingProcessMasterController::class,'GetFGData'])->name('GetFGData');
    Route::get('GetItemBOMUnit',[SalesOrderCostingProcessMasterController::class,'GetItemBOMUnit'])->name('GetItemBOMUnit');
    Route::get('GetUnitAmount',[SalesOrderCostingProcessMasterController::class,'GetUnitAmount'])->name('GetUnitAmount');
    Route::get('GetItemRateFromItemCode',[SalesOrderCostingProcessMasterController::class,'GetItemRateFromItemCode'])->name('GetItemRateFromItemCode');
    Route::get('GetSuplierList',[SalesOrderCostingProcessMasterController::class,'GetSuplierList'])->name('GetSuplierList');
    
   Route::post('/SavePopupColor',[BuyerPurchaseOrderController::class,'SavePopupColor'])->name('SavePopupColor');
   Route::get('/CheckColor',[BuyerPurchaseOrderController::class,'CheckColor'])->name('CheckColor');
   Route::get('/GetLetestColorList',[BuyerPurchaseOrderController::class,'GetLetestColorList'])->name('GetLetestColorList');
     
 Route::resource('ItemSize', ItemSizeController::class);
    


    
    
    
});