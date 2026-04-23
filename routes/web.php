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
use App\Http\Controllers\ProcessOrderReportController;
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
use App\Http\Controllers\BomController;
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
use App\Http\Controllers\UnraisedPOItemsController;
use App\Http\Controllers\MainFormMasterController;
use App\Http\Controllers\SubFormMasterController;
use App\Http\Controllers\ProcessOrderController;
use App\Http\Controllers\UnraisedProcessOrderItemsController;
use App\Http\Controllers\StockAssociationForFabricController;
use App\Http\Controllers\StockAssociationController;
use App\Http\Controllers\QCTrimsInwardController;
use App\Http\Controllers\OpenOrderPPCController;
use App\Http\Controllers\PackingVendorMasterController;
use App\Http\Controllers\ReturnPackingInhouseMasterController;
use App\Http\Controllers\WashingInhouseController;


use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\PurchaseReturnReportController;
use App\Http\Controllers\UnraisedPurchaseReturnController;

use App\Http\Controllers\GreigeToDyingOutwordController;
use App\Http\Controllers\DyingToFinishOutwordController;
use App\Http\Controllers\ColourController;
use App\Http\Controllers\ClassificationMasterController;
use App\Http\Controllers\ConsumptionChartController;
use App\Http\Controllers\CuttingEntryController;
use App\Http\Controllers\FinishInwardController;
use App\Http\Controllers\StitchingInwardController;
use App\Http\Controllers\FinishToCuttingOutwardController;
use App\Http\Controllers\StitchingOutwordController;
use App\Http\Controllers\StitchingInwordController;
use App\Http\Controllers\PackingOutwardController;
use App\Http\Controllers\ConsumptionChartControllernew;
use App\Http\Controllers\PackingInwardController;
use App\Http\Controllers\ProcessCheckingController;
use App\Http\Controllers\FinishedFabricPurchaseController;
use App\Http\Controllers\FinishGoodQualityMasterController;
use App\Http\Controllers\DeliveryChallanController;


// 14/10/2025
use App\Http\Controllers\DailySaleMasterController;
use App\Http\Controllers\FuelTypeController;
use App\Http\Controllers\FuelRateController;
use App\Http\Controllers\PaymentModeController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DipController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ShiftMasterController;
use App\Http\Controllers\PetrolDipController;
use App\Http\Controllers\RequisitionEntryController;





use App\Http\Controllers\StatusController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ApprovalStatusController;
use App\Http\Controllers\EnquiryPunchingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HandoverOfOrderController;
use App\Http\Controllers\ReceiptOfOrderController;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UnitMasterController;
use App\Http\Controllers\ShapeController;
use App\Http\Controllers\MocController;
use App\Http\Controllers\EstimationOfOrderController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\ApprovalStatusMasterController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\KeyAreaMasterController;
use App\Http\Controllers\TechnoCommercialController;
use App\Http\Controllers\TermsandConditionController;
use App\Http\Controllers\ProjectMasterController;
use App\Http\Controllers\ProjectDetailController;

// 03-11-2025
use App\Http\Controllers\UserMasterController;


use App\Http\Controllers\ShapeTypeController;
use App\Http\Controllers\ShapeSubTypeController;
use App\Http\Controllers\WeightThicknessController;
use App\Http\Controllers\ScheduleMasterController;
use App\Http\Controllers\ShareScheduleController;
use App\Http\Controllers\WBSMasterController;
use App\Http\Controllers\ProjectActivityController;
use App\Http\Controllers\DelayMasterController;

use App\Http\Controllers\SubJobWBSMasterController;
//27022026
use App\Http\Controllers\GstController;

use App\Http\Controllers\TabController;

use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\CalculationDrawingDocumentController;

use App\Http\Controllers\MaterialSpecificationController;
use App\Http\Controllers\PlateCuttingLayoutController;
use App\Http\Controllers\MiscellaneousTypeController;
use App\Http\Controllers\ProcessNameMasterController;
use App\Http\Controllers\ItemCategoryTypeController;




//added by shubham chhanwal on 15/04/2026
//purchase GRN 
use App\Http\Controllers\PurchaseGrnController;
use App\Http\Controllers\PurchaseGrnDetailsController;
use App\Http\Controllers\VendorPoController;
use App\Http\Controllers\VendorPoPartController;
use App\Http\Controllers\VendorPoMaterialController;
use App\Http\Controllers\SkuMasterController;



Route::resource('Requisition_Entry', RequisitionEntryController::class);
Route::resource('petrol-dip', PetrolDipController::class);
Route::resource('FuelType', FuelTypeController::class);
Route::resource('FuelRate', FuelRateController::class);
Route::resource('PaymentMode', PaymentModeController::class);
Route::resource('Machine', MachineController::class);
Route::resource('Expense', ExpenseController::class);
Route::resource('Dip', DipController::class);
Route::resource('Worker', WorkerController::class);
Route::resource('DailySale', DailySaleMasterController::class);
Route::get('/get-fuel-rate/{fuel_type_id}', [DailySaleMasterController::class, 'getFuelRate']);
Route::get('/get-opening', [DailySaleMasterController::class, 'getOpening']);
Route::resource('shift', ShiftMasterController::class);



Route::resource('Status', StatusController::class);
Route::resource('Enquiry', EnquiryController::class);
Route::resource('ApprovalStatus', ApprovalStatusController::class);
Route::resource('EnquiryPunching', EnquiryPunchingController::class);
Route::resource('EmployeeMaster', EmployeeController::class);
Route::get('DeactivatedList', [EmployeeController::class, 'DeactivatedList'])->name('DeactivatedList');
Route::post('worker_import', [EmployeeController::class, 'worker_import'])->name('worker_import');
Route::delete('/EmployeeMaster/{w_id}', [EmployeeController::class, 'destroy'])->name('EmployeeMaster.destroy');
Route::get('/employee-export', [EmployeeController::class, 'export'])
    ->name('employee.export');

Route::post('/employee/import', [EmployeeController::class, 'emp_import'])
    ->name('emp_import');


Route::resource('HandoverOfOrder', HandoverOfOrderController::class);
Route::get('/get-client-po-no/{id}', [HandoverOfOrderController::class, 'getClientPoNo']);

Route::resource('ReceiptOfOrder', ReceiptOfOrderController::class);
Route::get('/get-estimate-no', [ReceiptOfOrderController::class, 'getEstimate']);
Route::get('/get-client-by-workorder', [BudgetController::class, 'getClientByWorkOrder']);
Route::resource('EstimationOfOrder', EstimationOfOrderController::class);
Route::get('/get-enquiry-details/{code}', [App\Http\Controllers\EstimationOfOrderController::class, 'getEnquiryDetails'])
    ->name('get.enquiry.details');
Route::get('get-shape-sub-types/{shape_type_id}', [EstimationOfOrderController::class, 'getShapeSubTypes']);
Route::get('/get-od-by-nb', [EstimationOfOrderController::class, 'getOdByNb']);
Route::get('/get-thickness-weight', [EstimationOfOrderController::class, 'getThicknessWeight']);
Route::get('/get-weight-by-od', [EstimationOfOrderController::class, 'getWeightByOD']);
Route::get('/get-outside-diameter', [EstimationOfOrderController::class, 'getOutsideDiameter']);
Route::get('/get-schedule-values', [EstimationOfOrderController::class, 'getScheduleValues']);
Route::get('/get-shape-types/{shape_id}', [EstimationOfOrderController::class, 'getShapeTypes']);
Route::get('get-material-spec/{moc_id}', [EstimationOfOrderController::class, 'getMaterialSpec']);
Route::get('/get-items-by-category', [EstimationOfOrderController::class, 'getItemsByCategory']);


//05-04-2026
Route::get('/getItemsByCategory', [EstimationOfOrderController::class, 'getItemsByCategory']);
Route::get('/getShapesByItem', [EstimationOfOrderController::class, 'getShapesByItem']);
Route::get('/getShapeTypesByShape', [EstimationOfOrderController::class, 'getShapeTypesByShape']);
Route::get('/getShapeSubTypesByType', [EstimationOfOrderController::class, 'getShapeSubTypesByType']);
Route::get('/getMaterialSpecByItem', [EstimationOfOrderController::class, 'getMaterialSpecByItem']);


// 280126

Route::get(
    '/EstimationOfOrder/create/{enquiry_code?}',
    [EstimationOfOrderController::class, 'create']
)->name('EstimationOfOrder.create');

Route::get('/getWeightbyMetricinch', [EstimationOfOrderController::class, 'getWeightbyMetricinch']);
Route::get('/getUnitsByItem', [EstimationOfOrderController::class, 'getUnitsByItem']);
Route::get('/getWeightBySize', [EstimationOfOrderController::class, 'getWeightBySize']);
Route::get('/getWeightByHexbotlfullthread', [EstimationOfOrderController::class, 'getWeightByHexbotlfullthread']);
Route::get('/getWeightByStd', [EstimationOfOrderController::class, 'getWeightByStd']);


Route::resource('ShapeType', ShapeTypeController::class);
Route::resource('ShapeSubType', ShapeSubTypeController::class);
//01-04-2026
Route::get('/get-shape-type/{shapeId}', [ShapeSubTypeController::class, 'getShapeType']);
Route::resource('WeightThicknessMaster', WeightThicknessController::class);

Route::resource('Item_Master', ItemController::class);
Route::resource('UnitMaster', UnitMasterController::class);
Route::resource('Shape', ShapeController::class);
//01-04-2026
Route::get('/get-item-category/{typeId}', [ShapeController::class, 'getItemCategory']);
Route::get('/get-item/{catId}', [ShapeController::class, 'getItem']);
Route::resource('Moc_Master', MocController::class);
Route::resource('/ItemCategory', ItemCategoryController::class);
Route::resource('ApprovalStatusMaster', ApprovalStatusMasterController::class);
Route::resource('BudgetWorkOrder', BudgetController::class);
Route::resource('KeyArea', KeyAreaMasterController::class);
Route::resource('Termsandcondition', TermsandConditionController::class);
Route::resource('ProjectMaster', ProjectMasterController::class);

Route::resource('TechnoCommercial', TechnoCommercialController::class);
Route::get('/get-estimate-details/{estimate_no}', [App\Http\Controllers\TechnoCommercialController::class, 'getEstimateDetails']);

Route::resource('ProjectDetail', ProjectDetailController::class);
Route::resource('ScheduleMaster', ScheduleMasterController::class);
Route::resource('ShareSchedule', ShareScheduleController::class);
Route::resource('WBSMaster', WBSMasterController::class);
Route::resource('ProjectActivity', ProjectActivityController::class);
Route::resource('DelayMaster', DelayMasterController::class);

Route::resource('SubJobWBSMaster', SubJobWBSMasterController::class);
Route::post('sub-task-save', [SubJobWBSMasterController::class, 'subTaskSave'])
    ->name('SubJobWBSMaster.subtaskSave');




// 03-11-2025
Route::resource('User_Master', UserMasterController::class);
Route::get('/get-user-type-permissions', [PermissionController::class, 'getUserTypePermissions'])->name('getUserTypePermissions');




//comment and add below
// Route::get('/get-user-type-permissions', [PermissionController::class, 'getUserTypePermissions'])->name('getUserTypePermissions');
Route::get('getPermissionsByUserType', [PermissionController::class, 'getPermissionsByUserType']);




Route::get('/', function () {
    return view('login');
});

Route::get('login', [LoginController::class, 'index']);

Route::post('/Auth', [LoginController::class, 'auth'])->name('Auth');

Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'admin_auth'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::resource('DashboardMaster', DashboardController::class);

    //HRMS

    Route::resource('Employee', EmployeeMasterController::class);
    Route::get('getconsolidatedbasic', [EmployeeMasterController::class, 'getconsolidatedbasic'])->name('getconsolidatedbasic');
    Route::post('biomatricExist', [EmployeeMasterController::class, 'biomatricExist'])->name('biomatricExist');
    Route::post('EmployeeCodeExist', [EmployeeMasterController::class, 'EmployeeCodeExist'])->name('EmployeeCodeExist');
    Route::get('StateList', [EmployeeMasterController::class, 'GetStateList'])->name('StateList');
    Route::get('DistrictList', [EmployeeMasterController::class, 'GetDistrictList'])->name('DistrictList');
    Route::get('TalukaList', [EmployeeMasterController::class, 'GetTalukaList'])->name('TalukaList');
    Route::get('SubCompanies', [EmployeeMasterController::class, 'SubCompanies'])->name('SubCompanies');
    Route::get('employeeIDCard/{id}', [EmployeeMasterController::class, 'employeeIDCard']);
    Route::post('get_rate_detail', [EmployeeMasterController::class, 'get_rate_detail'])->name('get_rate_detail');
    Route::resource('Branch', BranchController::class);
    Route::resource('Bank', BankMasterController::class);
    Route::post('getifscCode', [EmployeeMasterController::class, 'getifscCode'])->name('getifscCode');
    Route::get('SubBranch', [EmployeeMasterController::class, 'SubBranch'])->name('SubBranch');
    Route::get('step2/{id}', [EmployeeMasterController::class, 'step2']);
    Route::post('step2Store', [EmployeeMasterController::class, 'step2Store'])->name('step2Store');
    Route::get('step2Edit/{id}', [EmployeeMasterController::class, 'step2Edit']);
    Route::put('step2Update/{id}', [EmployeeMasterController::class, 'step2Update'])->name('step2Update');
    Route::get('branchwiseEmployeeList', [EmployeeMasterController::class, 'branchwiseEmployeeListnew'])->name('branchwiseEmployeeList');
    Route::post('Employeeimport', [EmployeeMasterController::class, 'Employeeimport'])->name('Employeeimport');
    Route::post('LeaveBalanceimports', [EmployeeMasterController::class, 'LeaveBalanceimports'])->name('LeaveBalanceimports');
    Route::post('SalaryAdvanceExportImport', [EmployeeMasterController::class, 'SalaryAdvanceExportImport'])->name('SalaryAdvanceExportImport');
    Route::post('SalaryDeductionExport', [EmployeeMasterController::class, 'SalaryDeductionExport'])->name('SalaryDeductionExport');
    Route::resource('SalaryTransactionMulti', SalaryTransactionMultiController::class);
    Route::get('salarySummary', [SalaryTransactionMultiController::class, 'salarySummary'])->name('salarySummary');
    Route::get('export_neft/{id1}/{id2}/{id3}/{id4}/{id5}/{id6}', [SalaryTransactionMultiController::class, 'export_neft']);
    Route::post('employeeSalaryDetailMultiple', [SalaryTransactionMultiController::class, 'employeeSalaryDetailMultiple'])->name('employeeSalaryDetailMultiple');
    Route::get('employeeSalaryDetail', [SalaryTransactionController::class, 'employeeSalaryDetail'])->name('employeeSalaryDetail');
    Route::get('rptsalarystruture', [SalaryTransactionMultiController::class, 'rptsalarystruture'])->name('rptsalarystruture');
    Route::get('wages_register_form2', [SalaryTransactionMultiController::class, 'wages_register_form2'])->name('wages_register_form2');
    Route::get('combine_wages_register_form2', [SalaryTransactionMultiController::class, 'combine_wages_register_form2'])->name('combine_wages_register_form2');
    Route::get('rptsalarystrutureworker', [SalaryTransactionMultiController::class, 'rptSalaryStrutureNonComplianceWorker'])->name('rptsalarystrutureworker');
    Route::get('printsalarystruture', [SalaryTransactionMultiController::class, 'printsalarystruture'])->name('printsalarystruture');
    Route::get('PTReport', [SalaryTransactionMultiController::class, 'PTReport'])->name('PTReport');
    Route::get('getDepartmentCost', [SalaryTransactionMultiController::class, 'getDepartmentCost'])->name('getDepartmentCost');
    Route::get('ESICReport', [SalaryTransactionMultiController::class, 'ESICReport'])->name('ESICReport');
    Route::get('pfReport', [SalaryTransactionMultiController::class, 'pfReport'])->name('pfReport');
    Route::get('rptsalarySummary', [SalaryTransactionMultiController::class, 'rptsalarySummary'])->name('rptsalarySummary');
    Route::get('NEFT', [SalaryTransactionMultiController::class, 'NEFT'])->name('NEFT');
    Route::get('production_monthly_summary', [SalaryTransactionMultiController::class, 'production_monthly_summary'])->name('production_monthly_summary');
    Route::get('BonusRegister', [SalaryTransactionMultiController::class, 'BonusRegister'])->name('BonusRegister');
    Route::get('PAIDDAY', [SalaryTransactionMultiController::class, 'PAIDDAY'])->name('PAIDDAY');
    Route::get('salarySummary', [SalaryTransactionMultiController::class, 'salarySummary'])->name('salarySummary');
    Route::get('salaryReport', [SalaryTransactionMultiController::class, 'salaryReport'])->name('salaryReport');
    Route::get('rptsalarystruture', [SalaryTransactionMultiController::class, 'rptsalarystruture'])->name('rptsalarystruture');
    Route::get('rptSalaryStrutureActual', [SalaryTransactionMultiController::class, 'rptSalaryStrutureActual'])->name('rptSalaryStrutureActual');
    Route::get('rptSalaryStrutureC', [SalaryTransactionMultiController::class, 'rptSalaryStrutureC'])->name('rptSalaryStrutureC');
    Route::resource('AdvanceSalary', AdvanceSalaryController::class);
    Route::get('getAttendanceReport', [AttendanceDetailController::class, 'getAttendanceReport'])->name('getAttendanceReport');
    Route::get('paid_days', [AdvanceSalaryController::class, 'paid_days'])->name('paid_days');
    Route::get('route_type', [AdvanceSalaryController::class, 'route_type'])->name('route_type');
    Route::post('get_paid_days_list', [AdvanceSalaryController::class, 'get_paid_days_list'])->name('get_paid_days_list');
    Route::post('update_paid_days', [AdvanceSalaryController::class, 'update_paid_days'])->name('update_paid_days');
    Route::get('paid_days_list/{id}', [AdvanceSalaryController::class, 'paid_days_list']);
    Route::post('rptAttendanceshow', [AttendanceDetailController::class, 'rptAttendanceshow'])->name('rptAttendanceshow');
    Route::post('rptAttendance', [AttendanceDetailController::class, 'rptAttendance'])->name('rptAttendance');
    Route::post('updateAndInsertAttendance', [AttendanceDetailController::class, 'updateAndInsertAttendance'])->name('updateAndInsertAttendance');
    Route::post('loadAttendanceData', [AttendanceDetailController::class, 'loadAttendanceData'])->name('loadAttendanceData');
    Route::post('insert_weeklyoff', [AttendanceDetailController::class, 'insert_weeklyoff'])->name('insert_weeklyoff');
    Route::post('absent_shuffle', [AttendanceDetailController::class, 'absent_shuffle'])->name('absent_shuffle');
    Route::resource('Attendance', AttendanceDetailController::class);
    Route::get('Present', [AttendanceDetailController::class, 'Present'])->name('PresentE');
    Route::get('PresentNoOutPunch', [AttendanceDetailController::class, 'PresentNoOutPunch'])->name('PresentNoOutPunch');
    Route::get('Absent', [AttendanceDetailController::class, 'Absent'])->name('AbsentE');
    Route::post('Attendanceimport', [AttendanceDetailController::class, 'Attendanceimport'])->name('Attendanceimport');
    Route::post('getAttendanceDataFromServer', [AttendanceDetailController::class, 'getAttendanceDataFromServer'])->name('getAttendanceDataFromServer');
    Route::resource('Designation', DesignationController::class);
    Route::get('printComplianceWorkerrpt', [SalaryTransactionMultiController::class, 'printComplianceWorkerrpt'])->name('printComplianceWorkerrpt');
    Route::get('salary_register_staff', [SalaryTransactionMultiController::class, 'salary_register_staff'])->name('salary_register_staff');
    Route::get('salary_register_worker', [SalaryTransactionMultiController::class, 'salary_register_worker'])->name('salary_register_worker');
    Route::get('printStaffReport', [SalaryTransactionMultiController::class, 'printStaffReport'])->name('printStaffReport');
    Route::get('salary_slip_bulk', [SalaryTransactionMultiController::class, 'salary_slip_bulk'])->name('salary_slip_bulk');
    Route::get('print_worker_report', [SalaryTransactionMultiController::class, 'print_worker_report'])->name('print_worker_report');
    Route::get('getPeriodicMuster', [AttendanceDetailController::class, 'getPeriodicMuster'])->name('getPeriodicMuster');
    Route::post('rptPeriodicMuster', [AttendanceDetailController::class, 'rptPeriodicMuster'])->name('rptPeriodicMuster');
    Route::post('musterRollStore', [AttendanceDetailController::class, 'musterRollStore'])->name('musterRollStore');
    Route::post('loadMusterRoll', [AttendanceDetailController::class, 'loadMusterRoll'])->name('loadMusterRoll');
    Route::get('reverseAttendanceShow', [AttendanceDetailController::class, 'reverseAttendanceShow'])->name('reverseAttendanceShow');
    Route::post('rptAttendanceshowRev', [AttendanceDetailController::class, 'rptAttendanceshowRev'])->name('rptAttendanceshowRev');
    Route::post('reverseAttendanceStore', [AttendanceDetailController::class, 'reverseAttendanceStore'])->name('reverseAttendanceStore');
    Route::post('checkexist', [AttendanceDetailController::class, 'checkexist'])->name('checkexist');
    Route::post('updateAndInsertAttendanceReverse', [AttendanceDetailController::class, 'updateAndInsertAttendanceReverse'])->name('updateAndInsertAttendanceReverse');
    Route::post('loadAttendanceDataReverse', [AttendanceDetailController::class, 'loadAttendanceDataReverse'])->name('loadAttendanceDataReverse');

    Route::resource('Percentage', PercentageController::class);
    Route::resource('Increment', IncrementController::class);
    Route::get('LetterOfferIncrement', [IncrementController::class, 'show'])->name('LetterOfferIncrement');
    Route::get('getRptIncrement', [IncrementController::class, 'getRptIncrement'])->name('getRptIncrement');
    Route::post('rpt_increment', [IncrementController::class, 'rpt_increment'])->name('rpt_increment');
    Route::get('getEmployeeDetails', [IncrementController::class, 'getEmployeeDetails'])->name('getEmployeeDetails');
    Route::post('increment_import', [IncrementController::class, 'increment_import'])->name('increment_import');
    Route::post('increment_export', [IncrementController::class, 'increment_export'])->name('increment_export');
    Route::post('update_rate_of_wages', [IncrementController::class, 'update_rate_of_wages'])->name('update_rate_of_wages');
    Route::post('get_employee_detail', [IncrementController::class, 'get_employee_detail'])->name('get_employee_detail');
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
    Route::get('/SubStyleList', [SubStyleController::class, 'GetSubStyleList'])->name('SubStyleList');
    Route::get('/StyleList', [SubStyleController::class, 'GetStyleList'])->name('StyleList');
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
    Route::get('getEmployee', [UserManagementController::class, 'getEmployee'])->name('getEmployee');
    Route::resource('User_Management', PermissionController::class);
    Route::resource('District', DistrictController::class);
    Route::resource('Taluka', TalukaController::class);
    Route::resource('Category', CategoryContoller::class);

    Route::resource('Rack', RackController::class);

    Route::resource('Item', ItemMasterController::class);

    Route::get('list/{id}', [ItemMasterController::class, 'activeDeactiveList']);
    Route::get('RepeatItem/{id}', [ItemMasterController::class, 'RepeatItem'])->name('RepeatItem');
    Route::post('/RepeatItemSave', [ItemMasterController::class, 'RepeatItemSave'])->name('RepeatItemSave');

    Route::post('itemimport', [ItemMasterController::class, 'itemimport'])->name('itemimport');
    Route::get('/ClassList', [ItemMasterController::class, 'GetClassList'])->name('ClassList');
    Route::get('/ClassDetailList', [ItemMasterController::class, 'ClassDetailList'])->name('ClassDetailList');
    Route::get('GetClassificationData', [ItemMasterController::class, 'GetClassificationData'])->name('GetClassificationData');
    Route::get('GetItemData', [ItemMasterController::class, 'GetItemData'])->name('GetItemData');
    Route::get('GetItemDataFromDetail', [ItemMasterController::class, 'GetItemDataFromDetail'])->name('GetItemDataFromDetail');
    Route::get('itemexist', [ItemMasterController::class, 'itemexist'])->name('itemexist');

    Route::resource('OtherPurchase', OtherPurchaseControlller::class);
    Route::get('GSTPER', [OtherPurchaseControlller::class, 'GetData'])->name('GSTPER');
    Route::resource('GeneralSales', GeneralSaleController::class);
    Route::resource('MultiPayment', MultiPaymentController::class);
    Route::get('getPaymentBillDetails', [MultiPaymentController::class, 'getPaymentBillDetails'])->name('GetPaymentBillDetails');
    Route::resource('MultiReceipt', MultiReceiptController::class);
    Route::resource('Receipt_Transaction', ReceiptController::class);
    Route::resource('Payment_Transaction', PaymentController::class);
    Route::resource('Journal_Voucher', JournalVoucherController::class);
    Route::resource('Contra_Transaction', ContraTransactionController::class);
    Route::get('getUnpaidBills', [MultiReceiptController::class, 'getUnpaidBills'])->name('getUnpaidBills');
    Route::get('getReceiptDetail', [MultiReceiptController::class, 'getReceiptDetail'])->name('getReceiptDetail');
    Route::get('getUnpaidPaymentBills', [MultiPaymentController::class, 'getUnpaidPaymentBills'])->name('getUnpaidPaymentBills');
    Route::get('getPaymentDetail', [MultiPaymentController::class, 'getPaymentDetail'])->name('getPaymentDetail');
    Route::resource('Fabric_Purchase', FabricController::class);
    Route::get('PartyShortlist', [FabricController::class, 'PartyShortlist'])->name('PartyShortlist');
    Route::resource('GeneralPurchaseReturn', GeneralPurchaseReturnController::class);
    Route::resource('GeneralSalesReturn', GeneralSalesReturnController::class);
    Route::resource('DrNote', DrNoteController::class);
    Route::resource('CrNote', CrNoteController::class);
    Route::get('PartyDetail', [DrNoteController::class, 'GetData'])->name('PartyDetail');
    Route::get('PartyDetail', [CrNoteController::class, 'GetData'])->name('PartyDetail');
    Route::get('/StateList', [LedgerController::class, 'GetStateList'])->name('StateList');
    Route::get('/DistrictList', [LedgerController::class, 'GetDistrictList'])->name('DistrictList');
    Route::get('/TalukaList', [LedgerController::class, 'GetTalukaList'])->name('TalukaList');
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

    Route::get('/export/worker-format', [LedgerController::class, 'exportWorkerFormat'])
        ->name('worker.export.format');

    Route::post('/ledger/import', [LedgerController::class, 'importLedger'])
        ->name('worker_import');


    Route::post('importcolor', [ColorController::class, 'importcolor'])->name('importcolor');

    Route::resource('Classification', ClassificationController::class);
    Route::resource('Size', SizeController::class);
    Route::resource('Location', LocationController::class);

    Route::resource('PurchaseOrder', PurchaseOrderController::class);
    Route::post('getTermsDetail', [PurchaseOrderController::class, 'getTermsDetail'])->name('getTermsDetail');
    Route::get('getItemPO', [PurchaseOrderController::class, 'getItemPO'])->name('getItemPO');

    Route::get('GetStockDetailPopup', [PurchaseOrderController::class, 'GetStockDetailPopup'])->name('GetStockDetailPopup');






    Route::resource('TrimsInward', TrimsInwardController::class);

    Route::get('/getPoForTrims', [TrimsInwardController::class, 'getPoForTrims'])->name('getPoForTrims');
    Route::get('checkPOIsExist', [TrimsInwardController::class, 'checkPOIsExist'])->name('checkPOIsExist');
    Route::get('TrimsGRNPrint/{id}', [TrimsInwardController::class, 'TrimsGRNPrint']);
    Route::get('/GetTrimCodeWiseData', [TrimsInwardController::class, 'GetTrimCodeWiseData'])->name('GetTrimCodeWiseData');
    Route::get('/GetTrimCodeWiseStockData', [TrimsInwardController::class, 'GetTrimCodeWiseStockData'])->name('GetTrimCodeWiseStockData');
    Route::get('/GetCompareTrimFabricPOInwardData', [StockReportController::class, 'GetCompareTrimFabricPOInwardData'])->name('GetCompareTrimFabricPOInwardData');

    Route::get('/getPoMasterDetailTrims', [TrimsInwardController::class, 'getPoMasterDetailTrims'])->name('getPoMasterDetailTrims');
    Route::get('/GetTrimsGRNReport', [TrimsInwardController::class, 'GetTrimsGRNReport'])->name('GetTrimsGRNReport');
    Route::get('/TrimsGRNReportPrint', [TrimsInwardController::class, 'TrimsGRNReportPrint'])->name('TrimsGRNReportPrint');
    Route::get('/GetOnPageTrimStock', [TrimsInwardController::class, 'GetOnPageTrimStock'])->name('GetOnPageTrimStock');

    Route::get('/TrimsInwardData', [TrimsInwardController::class, 'GetTrimsInwardList'])->name('TrimsInwardData');
    Route::get('/GetComparePOInwardList', [TrimsInwardController::class, 'GetComparePOInwardList'])->name('GetComparePOInwardList');
    Route::get('/loadDateWiseTrimStockData', [TrimsInwardController::class, 'loadDateWiseTrimStockData'])->name('loadDateWiseTrimStockData');
    Route::get('/TrimsStocks1', [TrimsInwardController::class, 'TrimsStocks1'])->name('TrimsStocks1');
    Route::get('/LoadTrimsStockDataTrialCloned', [TrimsInwardController::class, 'LoadTrimsStockDataTrialCloned'])->name('LoadTrimsStockDataTrialCloned');
    Route::get('/GetTrimsInOutStockReportForm', [TrimsInwardController::class, 'GetTrimsInOutStockReportForm'])->name('GetTrimsInOutStockReportForm');
    Route::get('/TrimsInOutStockReport', [TrimsInwardController::class, 'TrimsInOutStockReport'])->name('TrimsInOutStockReport');
    Route::get('/TrimsInwardShowAll', [TrimsInwardController::class, 'TrimsInwardShowAll'])->name('TrimsInwardShowAll');

    Route::get('/TrimsGRNData', [TrimsInwardController::class, 'TrimsGRNData'])->name('TrimsGRNData');
    Route::get('/TrimsGRNDataMD/{id}', [TrimsInwardController::class, 'TrimsGRNDataMD'])->name('TrimsGRNDataMD');
    Route::get('/TrimsStockData', [TrimsInwardController::class, 'TrimsStockData'])->name('TrimsStockData');
    Route::get('/TrimsStockDataMD/{id}/{id1}', [TrimsInwardController::class, 'TrimsStockDataMD'])->name('TrimsStockDataMD');
    Route::get('/TrimsPOVsGRNDashboard', [TrimsInwardController::class, 'TrimsPOVsGRNDashboard'])->name('TrimsPOVsGRNDashboard');
    Route::get('/TrimsStockData1', [TrimsInwardController::class, 'TrimsStockData1'])->name('TrimsStockData1');
    Route::get('/trimStocks', [TrimsInwardController::class, 'trimStocks'])->name('trimStocks');
    Route::get('/loadDumpTrimStockData', [TrimsInwardController::class, 'loadDumpTrimStockData'])->name('loadDumpTrimStockData');
    Route::get('/TrimsStockDataTrial', [TrimsInwardController::class, 'TrimsStockDataTrial'])->name('TrimsStockDataTrial');
    Route::get('/TrimsStockDataTrialCloned', [TrimsInwardController::class, 'TrimsStockDataTrialCloned'])->name('TrimsStockDataTrialCloned');
    Route::get('/UpdateFoutDumpData', [TrimsInwardController::class, 'UpdateFoutDumpData'])->name('UpdateFoutDumpData');

    Route::get('stockAllocate', [TrimsInwardController::class, 'stockAllocate'])->name('stockAllocate');
    Route::get('RunCronTrimJob', [TrimsInwardController::class, 'RunCronTrimJob'])->name('RunCronTrimJob');


    Route::resource('FabricSummaryGRN', FabricSummaryGRNController::class);
    Route::get('/GetPOItemList', [FabricSummaryGRNController::class, 'GetPOItemList'])->name('GetPOItemList');
    Route::get('/GetPOColorList', [FabricSummaryGRNController::class, 'GetPOColorList'])->name('GetPOColorList');
    Route::get('/GetPoCodeFromChk', [FabricSummaryGRNController::class, 'GetPoCodeFromChk'])->name('GetPoCodeFromChk');
    Route::get('FabricSummaryGRNReport/{id}', [FabricSummaryGRNController::class, 'FabricSummaryGRNReport'])->name('FabricSummaryGRNReport');






    Route::get('POApprovalList', [PurchaseOrderController::class, 'show'])->name('POApprovalList');
    Route::get('GetPOList', [PurchaseOrderController::class, 'GetPOList'])->name('GetPOList');
    Route::get('getBoMDetail', [PurchaseOrderController::class, 'getBoMDetail'])->name('getBoMDetail');
    Route::get('getItemListForPO', [PurchaseOrderController::class, 'getItemListForPO'])->name('getItemListForPO');
    Route::get('getClassLists', [PurchaseOrderController::class, 'getClassLists'])->name('getClassLists');

    Route::get('PODisApprovalList', [PurchaseOrderController::class, 'Disapprovedshow'])->name('PODisApprovalList');
    Route::get('PartyDetail', [PurchaseOrderController::class, 'GetPartyDetails'])->name('PartyDetail');

    Route::resource('Brand', BrandController::class);
    Route::resource('Season', SeasonController::class);
    Route::resource('JobStatus', JobStatusController::class);
    Route::resource('BuyerJobCard', BuyerJobCardController::class);



    Route::resource('FabricInward', FabricInwardController::class);

    Route::resource('SystemLockMaster', SystemLockMasterController::class);
    Route::get('changeStatus', [SystemLockMasterController::class, 'changeStatus'])->name('changeStatus');



    Route::get('/PrintBarcode', [FabricInwardController::class, 'PrintFabricBarcode'])->name('PrintBarcode');

    Route::get('/FabricGRNData', [FabricInwardController::class, 'FabricGRNData'])->name('FabricGRNData');

    Route::get('/FabricStockData', [FabricInwardController::class, 'FabricStockData'])->name('FabricStockData');
    Route::get('/FabricStockSummaryData', [FabricInwardController::class, 'FabricStockSummaryData'])->name('FabricStockSummaryData');



    Route::get('/TrimsGRNData', [TrimsInwardController::class, 'TrimsGRNData'])->name('TrimsGRNData');
    Route::get('/TrimsStockData', [TrimsInwardController::class, 'TrimsStockData'])->name('TrimsStockData');


    Route::get('/getPo', [FabricInwardController::class, 'getPo'])->name('getPo');

    Route::get('/getPoMasterDetail', [FabricInwardController::class, 'getPoMasterDetail'])->name('getPoMasterDetail');


    Route::get('PODetail', [FabricInwardController::class, 'getPODetails'])->name('PODetail');
    Route::get('ItemRateFromPO', [FabricInwardController::class, 'getItemRateFromPO'])->name('ItemRateFromPO');
    Route::get('ItemMinMaxFromPO', [FabricInwardController::class, 'getItemMinMaxFromPO'])->name('ItemMinMaxFromPO');

    Route::resource('MainForm', MainFormMasterController::class);
    Route::resource('SubForm', SubFormMasterController::class);

    // Start SalesOrderCosting-------------------//
    Route::resource('SalesOrderCosting', SalesOrderCostingController::class);

    Route::get('/GetCostingData/{id}', [SalesOrderCostingController::class, 'GetCostingData']);

    Route::get('/SalesOrderDetails', [BuyerPurchaseOrderController::class, 'getSalesOrderDetails'])->name('SalesOrderDetails');
    Route::get('/GetSizeOrderDetailList', [BuyerPurchaseOrderController::class, 'GetSizeOrderDetailList'])->name('GetSizeOrderDetailList');



    Route::get('/ItemDetails', [SalesOrderCostingController::class, 'GetItemData'])->name('ItemDetails');

    Route::get('/SalesCostingProfitSheet', [SalesOrderCostingController::class, 'costingProfitSheet'])->name('SalesCostingProfitSheet');
    Route::get('/SalesCostingProfitSheet2', [SalesOrderCostingController::class, 'costingProfitSheet2'])->name('SalesCostingProfitSheet2');

    Route::get('/GetCostingProfitByFilter', [SalesOrderCostingController::class, 'GetCostingProfitByFilter'])->name('GetCostingProfitByFilter');
    Route::get('/costingProfitSheet3', [SalesOrderCostingController::class, 'costingProfitSheet3'])->name('costingProfitSheet3');








    // Vendor Work Order Start ----------------------------
    Route::resource('VendorWorkOrder', VendorWorkOrderController::class);

    Route::get('VWPrint/{id}', [VendorWorkOrderController::class, 'VWPrint']);

    Route::get('/W_GetOrderQty', [VendorWorkOrderController::class, 'W_GetOrderQty'])->name('W_GetOrderQty');
    Route::get('/W_GetSizeList', [VendorWorkOrderController::class, 'W_GetSizeList'])->name('W_GetSizeList');
    Route::get('/W_GetItemList', [VendorWorkOrderController::class, 'W_GetItemList'])->name('W_GetItemList');
    Route::get('/W_GetClassList', [VendorWorkOrderController::class, 'W_GetClassList'])->name('W_GetClassList');
    Route::get('/W_GetColorList', [VendorWorkOrderController::class, 'W_GetColorList'])->name('W_GetColorList');
    Route::get('/GetFabricConsumption', [VendorWorkOrderController::class, 'GetFabricConsumption'])->name('GetFabricConsumption');
    Route::get('/GetSewingConsumption', [VendorWorkOrderController::class, 'GetSewingConsumption'])->name('GetSewingConsumption');
    Route::get('/GetPackingConsumption', [VendorWorkOrderController::class, 'GetPackingConsumption'])->name('GetPackingConsumption');
    Route::get('/GetTrimFabricConsumption', [VendorWorkOrderController::class, 'GetTrimFabricConsumption'])->name('GetTrimFabricConsumption');
    Route::get('/VendorAllWorkOrders', [VendorWorkOrderController::class, 'getVendorAllWorkOrders'])->name('VendorAllWorkOrders');

    // Vendor Work Order End ----------------------------



    //Vendor Purchase Order Start -----------------
    Route::resource('VendorPurchaseOrder', VendorPurchaseOrderController::class);

    Route::get('VPPrint/{id}', [VendorPurchaseOrderController::class, 'VPPrint']);

    Route::get('/VPO_GetOrderQty', [VendorPurchaseOrderController::class, 'VPO_GetOrderQty'])->name('VPO_GetOrderQty');
    Route::get('/VPO_GetSizeList', [VendorPurchaseOrderController::class, 'VPO_GetSizeList'])->name('VPO_GetSizeList');
    Route::get('/VPO_GetItemList', [VendorPurchaseOrderController::class, 'VPO_GetItemList'])->name('VPO_GetItemList');
    Route::get('/VPO_GetClassList', [VendorPurchaseOrderController::class, 'VPO_GetClassList'])->name('VPO_GetClassList');
    Route::get('/VPO_GetColorList', [VendorPurchaseOrderController::class, 'VPO_GetColorList'])->name('VPO_GetColorList');
    Route::get('/GetFabricConsumptionPO', [VendorPurchaseOrderController::class, 'GetFabricConsumptionPO'])->name('GetFabricConsumptionPO');
    Route::get('/CuttingPOItemList', [VendorPurchaseOrderController::class, 'GetCuttingPOItemList'])->name('CuttingPOItemList');
    Route::get('/POVsMaterialIssueReport', [VendorPurchaseOrderController::class, 'POVsMaterialIssueReport'])->name('POVsMaterialIssueReport');



    Route::get('/VendorPurchaseOrderDetails', [VendorPurchaseOrderController::class, 'getVendorPurchaseOrderDetails'])->name('VendorPurchaseOrderDetails');
    Route::get('/getVendorPO', [VendorPurchaseOrderController::class, 'getVendorPO'])->name('getVendorPO');
    Route::get('/getVendorAllPO', [VendorPurchaseOrderController::class, 'getVendorAllPO'])->name('getVendorAllPO');

    Route::get('/GetVPOVsIssueReport', [VendorPurchaseOrderController::class, 'GetVPOVsIssueReport'])->name('GetVPOVsIssueReport');

    //Vendor Purchase Order End -----------------




    // Route::get('/GetCostingData/{id}',[SalesOrderCostingController::class,'GetCostingData']);

    // Route::get('/SalesOrderDetails',[SalesOrderCostingController::class,'getSalesOrderDetails'])->name('SalesOrderDetails');
    // Route::get('/ItemDetails',[SalesOrderCostingController::class,'GetItemData'])->name('ItemDetails');
    Route::get('/PrintSaleTransaction/{id}', [SaleTransactionMasterController::class, 'PrintSaleTransaction'])->name('PrintSaleTransaction');
    Route::resource('SaleTransaction', SaleTransactionMasterController::class);
    Route::get('/getSalesOrderData', [SaleTransactionMasterController::class, 'getSalesOrderData'])->name('getSalesOrderData');
    Route::get('/CartonPackingList', [SaleTransactionMasterController::class, 'CartonPackingList'])->name('CartonPackingList');
    // Route::get('/GetSalesOrderList',[SaleTransactionMasterController::class,'GetSalesOrderList'])->name('GetSalesOrderList');

    Route::get('/GetSaleReport', [SaleTransactionMasterController::class, 'GetSaleReport'])->name('GetSaleReport');
    Route::get('/SaleFilterReport', [SaleTransactionMasterController::class, 'SaleFilterReport'])->name('SaleFilterReport');
    Route::get('/SaleFilterReportMD/{id}', [SaleTransactionMasterController::class, 'SaleFilterReportMD'])->name('SaleFilterReportMD');
    Route::get('GetSalesInvoiceCode', [SaleTransactionMasterController::class, 'GetSalesInvoiceCode'])->name('GetSalesInvoiceCode');
    Route::get('saleTransactionShowAll', [SaleTransactionMasterController::class, 'saleTransactionShowAll'])->name('saleTransactionShowAll');
    Route::get('SalesTransactionPrint', [SaleTransactionMasterController::class, 'SalesTransactionPrint'])->name('SalesTransactionPrint');
    Route::get('GetKGDPLSales', [SaleTransactionMasterController::class, 'GetKGDPLSales'])->name('GetKGDPLSales');
    // End SalesOrderCosting-------------------//

    Route::resource('FabricChecking', FabricCheckingController::class);
    Route::get('/InwardList', [FabricCheckingController::class, 'getDetails'])->name('InwardList');
    Route::get('/InwardMasterList', [FabricCheckingController::class, 'getMasterdata'])->name('InwardMasterList');
    Route::resource('BuyerPurchaseOrder', BuyerPurchaseOrderController::class);
    Route::get('SaleOrderPrint/{id}', [BuyerPurchaseOrderController::class, 'show']);
    Route::get('/GetAddress', [BuyerPurchaseOrderController::class, 'getAddress'])->name('GetAddress');
    Route::get('/TaxList', [BuyerPurchaseOrderController::class, 'GetTaxList'])->name('TaxList');
    Route::get('/SizeDetailList', [BuyerPurchaseOrderController::class, 'GetSizeDetailList'])->name('SizeDetailList');
    Route::get('/SizeDetailListMaster', [BuyerPurchaseOrderController::class, 'GetSizeDetailListMaster'])->name('SizeDetailListMaster');
    Route::get('/SizeDetailListMasterExcel', [BuyerPurchaseOrderController::class, 'GetSizeDetailListMasterExcel'])->name('SizeDetailListMasterExcel');

    Route::get('/GetSalesOrderList', [BuyerPurchaseOrderController::class, 'GetSalesOrderList'])->name('GetSalesOrderList');

    Route::get('/SalesOrderOpen', [BuyerPurchaseOrderController::class, 'SalesOrderOpen'])->name('SalesOrderOpen');
    Route::get('/SalesOrderSample', [BuyerPurchaseOrderController::class, 'SalesOrderSample'])->name('SalesOrderSample');
    Route::get('/SalesOrderClosed', [BuyerPurchaseOrderController::class, 'SalesOrderClosed'])->name('SalesOrderClosed');
    Route::get('/SalesOrderCancelled', [BuyerPurchaseOrderController::class, 'SalesOrderCancelled'])->name('SalesOrderCancelled');
    Route::get('/OpenSalesOrderDashboard', [BuyerPurchaseOrderController::class, 'OpenSalesOrderDashboard'])->name('OpenSalesOrderDashboard');
    Route::get('/BuyerOpenSalesOrderDashboard', [BuyerPurchaseOrderController::class, 'BuyerOpenSalesOrderDashboard'])->name('BuyerOpenSalesOrderDashboard');
    Route::get('/OpenSalesOrderDetailDashboard', [BuyerPurchaseOrderController::class, 'OpenSalesOrderDetailDashboard'])->name('OpenSalesOrderDetailDashboard');
    Route::get('/TotalSalesOrderDetailDashboard', [BuyerPurchaseOrderController::class, 'TotalSalesOrderDetailDashboard'])->name('TotalSalesOrderDetailDashboard');
    Route::get('/OpenSalesOrderMonthDetailDashboard', [BuyerPurchaseOrderController::class, 'OpenSalesOrderMonthDetailDashboard'])->name('OpenSalesOrderMonthDetailDashboard');
    Route::get('/TotalSalesOrderDetailDashboardFilter', [BuyerPurchaseOrderController::class, 'TotalSalesOrderDetailDashboardFilter'])->name('TotalSalesOrderDetailDashboardFilter');


    Route::get('/DailyProductionDetailDashboard', [BuyerPurchaseOrderController::class, 'DailyProductionDetailDashboard'])->name('DailyProductionDetailDashboard');
    Route::get('/OrderProgressDetailDashboard', [BuyerPurchaseOrderController::class, 'OrderProgressDetailDashboard'])->name('OrderProgressDetailDashboard');
    Route::get('/OrderProgressFinishingDetailDashboard', [BuyerPurchaseOrderController::class, 'OrderProgressFinishingDetailDashboard'])->name('OrderProgressFinishingDetailDashboard');
    Route::get('/OrderProgressPackingDetailDashboard', [BuyerPurchaseOrderController::class, 'OrderProgressPackingDetailDashboard'])->name('OrderProgressPackingDetailDashboard');



    Route::get('/SalesOrderCostingBOMStatusDashboard', [BuyerPurchaseOrderController::class, 'SalesOrderCostingBOMStatusDashboard'])->name('SalesOrderCostingBOMStatusDashboard');
    Route::get('/CostingOHPDashboard', [BuyerPurchaseOrderController::class, 'CostingOHPDashboard'])->name('CostingOHPDashboard');
    Route::get('/CostingVSBudgetDashboard', [BuyerPurchaseOrderController::class, 'CostingVSBudgetDashboard'])->name('CostingVSBudgetDashboard');


    Route::get('/GetOCRReport', [BuyerPurchaseOrderController::class, 'GetOCRReport'])->name('GetOCRReport');
    Route::get('/GetMerchandiseOCRReport', [BuyerPurchaseOrderController::class, 'GetMerchandiseOCRReport'])->name('GetMerchandiseOCRReport');
    Route::get('/MerchandiseOCRReport', [BuyerPurchaseOrderController::class, 'MerchandiseOCRReport'])->name('MerchandiseOCRReport');
    Route::get('/GetOCRSummaryReport', [BuyerPurchaseOrderController::class, 'GetOCRSummaryReport'])->name('GetOCRSummaryReport');
    Route::get('/GetOrderVsShipmentReport', [BuyerPurchaseOrderController::class, 'GetOrderVsShipmentReport'])->name('GetOrderVsShipmentReport');

    Route::get('/OCRSummaryReport', [BuyerPurchaseOrderController::class, 'OCRSummaryReport'])->name('OCRSummaryReport');

    Route::get('/OCRReport', [BuyerPurchaseOrderController::class, 'OCRReport'])->name('OCRReport');


    Route::get('/GetCutPlanReport', [BuyerPurchaseOrderController::class, 'GetCutPlanReport'])->name('GetCutPlanReport');
    Route::get('/CuttingPOList', [BuyerPurchaseOrderController::class, 'CuttingPOList'])->name('CuttingPOList');
    Route::get('/CutPlanReport', [BuyerPurchaseOrderController::class, 'CutPlanReport'])->name('CutPlanReport');


    Route::get('/SeasonList', [BuyerPurchaseOrderController::class, 'GetSeasonList'])->name('SeasonList');
    Route::get('/BrandList', [BuyerPurchaseOrderController::class, 'GetBrandList'])->name('BrandList');

    Route::post('/getSaleOrderPPKTables', [BuyerPurchaseOrderController::class, 'getSaleOrderPPKTables'])->name('getSaleOrderPPKTables');
    Route::post('storePPKTables', [BuyerPurchaseOrderController::class, 'storePPKTables'])->name('storePPKTables');
    Route::post('getRatio', [BuyerPurchaseOrderController::class, 'getRatio'])->name('getRatio');


    Route::get('getFGStyle', [BuyerPurchaseOrderController::class, 'getFGStyle'])->name('getFGStyle');
    Route::get('getLocation', [BuyerPurchaseOrderController::class, 'getLocation'])->name('getLocation');
    Route::post('ledgersitecode', [BuyerPurchaseOrderController::class, 'ledgersitecode'])->name('ledgersitecode');
    Route::get('getColor', [BuyerPurchaseOrderController::class, 'getColor'])->name('getColor');

    Route::resource('PPK', PPKController::class);
    Route::post('getPPKTables', [PPKController::class, 'getPPKTables'])->name('getPPKTables');
    Route::post('/getcurrency', [BuyerPurchaseOrderController::class, 'getcurrency'])->name('getcurrency');

    Route::resource('Task', TaskMasterController::class);
    Route::get('/CompletedTask', [TaskMasterController::class, 'CompletedTaskList'])->name('CompletedTask');
    Route::resource('MaterialOutward', MaterialOutwardController::class);
    Route::resource('MaterialInward', MaterialInwardController::class);

    Route::resource('FabricCutting', CuttingMasterController::class);
    Route::get('/RatioList', [CuttingMasterController::class, 'getRatioDetails'])->name('RatioList');
    Route::get('/EndDataList', [CuttingMasterController::class, 'getEndDataDetails'])->name('EndDataList');
    Route::get('/CheckingFabricList', [CuttingMasterController::class, 'getCheckingFabricdata'])->name('CheckingFabricList');
    Route::get('/CheckingMasterList', [CuttingMasterController::class, 'getCheckingMasterdata'])->name('CheckingMasterList');

    Route::get('/CompletedCutting', [CuttingMasterController::class, 'CompletedCutting'])->name('CompletedCutting');

    Route::resource('StitchingInhouse', StitchingInhouseMasterController::class);
    Route::get('/VendorWorkOrderDetails', [StitchingInhouseMasterController::class, 'getVendorWorkOrderDetails'])->name('VendorWorkOrderDetails');
    Route::get('/VW_GetOrderQty', [StitchingInhouseMasterController::class, 'VW_GetOrderQty'])->name('VW_GetOrderQty');
    Route::get('/StitchingGRNDashboard', [StitchingInhouseMasterController::class, 'StitchingGRNDashboard'])->name('StitchingGRNDashboard');

    Route::get('/GetDailyProductionReport', [StitchingInhouseMasterController::class, 'GetDailyProductionReport'])->name('GetDailyProductionReport');
    Route::get('/DailyProductionReport', [StitchingInhouseMasterController::class, 'DailyProductionReport'])->name('DailyProductionReport');
    Route::get('/GetVendorStatusReport', [StitchingInhouseMasterController::class, 'GetVendorStatusReport'])->name('GetVendorStatusReport');
    Route::get('/VendorStatusReport', [StitchingInhouseMasterController::class, 'VendorStatusReport'])->name('VendorStatusReport');

    Route::get('/StitchingGRNPrint/{id}', [StitchingInhouseMasterController::class, 'StitchingGRNPrint']);

    Route::get('/CutPanelGRNShowAll', [CutPanelGRNMasterController::class, 'CutPanelGRNShowAll'])->name('CutPanelGRNShowAll');
    Route::resource('CutPanelIssue', CutPanelIssueMasterController::class);
    Route::get('/VW_GetCutOrderQty', [CutPanelIssueMasterController::class, 'VW_GetCutOrderQty'])->name('VW_GetCutOrderQty');
    Route::get('/GetLineList', [CutPanelIssueMasterController::class, 'GetLineList'])->name('GetLineList');
    Route::get('/GetCUTGRNQty', [CutPanelIssueMasterController::class, 'GetCUTGRNQty'])->name('GetCUTGRNQty');

    Route::get('/CUTGRNQty', [CutPanelIssueMasterController::class, 'CUTGRNQty'])->name('CUTGRNQty');

    Route::get('/CutPanelStockSummary', [CutPanelIssueMasterController::class, 'CutPanelStockSummary'])->name('CutPanelStockSummary');
    Route::get('/CutPanelGRNReport', [CutPanelIssueMasterController::class, 'CutPanelGRNReport'])->name('CutPanelGRNReport');
    Route::get('cutPanelIssueShowAll', [CutPanelIssueMasterController::class, 'cutPanelIssueShowAll'])->name('cutPanelIssueShowAll');

    Route::get('/CutPanelIssuePrint/{id}', [CutPanelIssueMasterController::class, 'CutPanelIssuePrint']);


    Route::get('/CutPanelIssueReport', [CutPanelIssueMasterController::class, 'CutPanelIssueReport'])->name('CutPanelIssueReport');
    Route::resource('OutwardForFinishing', OutwardForFinishingMasterController::class);
    Route::get('/vpo_GetFinishingPOQty', [OutwardForFinishingMasterController::class, 'vpo_GetFinishingPOQty'])->name('vpo_GetFinishingPOQty');

    Route::get('/OutwardForFinishingPrint/{id}', [OutwardForFinishingMasterController::class, 'OutwardForFinishingPrint']);




    Route::get('/GetSTITCHINGGRNQty', [FinishingInhouseMasterController::class, 'GetSTITCHINGGRNQty'])->name('GetSTITCHINGGRNQty');
    Route::get('/FinishingGRNPrint/{id}', [FinishingInhouseMasterController::class, 'FinishingGRNPrint']);

    Route::resource('OutwardForPacking', OutwardForPackingMasterController::class);
    Route::get('/vpo_GetPackingPOQty', [OutwardForPackingMasterController::class, 'vpo_GetPackingPOQty'])->name('vpo_GetPackingPOQty');

    Route::get('/OutwardForPackingPrint/{id}', [OutwardForPackingMasterController::class, 'OutwardForPackingPrint']);



    Route::resource('CutPanelGRN', CutPanelGRNMasterController::class);
    Route::get('/VPO_GetCutOrderQty', [CutPanelGRNMasterController::class, 'VPO_GetCutOrderQty'])->name('VPO_GetCutOrderQty');
    Route::get('/VendorProcessOrderDetails', [CutPanelGRNMasterController::class, 'getVendorProcessOrderDetails'])->name('VendorProcessOrderDetails');
    Route::get('/CutPanelGRNPrint/{id}', [CutPanelGRNMasterController::class, 'CutPanelGRNPrint']);


    Route::resource('QCStitchingInhouse', QCStitchingInhouseMasterController::class);
    Route::get('/StitchingInhouseDetails', [QCStitchingInhouseMasterController::class, 'getStitchingInhouseDetails'])->name('StitchingInhouseDetails');
    Route::get('/STI_GetOrderQty', [QCStitchingInhouseMasterController::class, 'STI_GetOrderQty'])->name('STI_GetOrderQty');
    Route::get('/QCStitchingReport', [QCStitchingInhouseMasterController::class, 'QCStitchingReport'])->name('QCStitchingReport');


    Route::get('/QCStitchingGRNPrint/{id}', [QCStitchingInhouseMasterController::class, 'QCStitchingGRNPrint']);

    Route::resource('FinishingInhouse', FinishingInhouseMasterController::class);
    //Route::get('/QCStitchingInhouseDetails',[FinishingInhouseMasterController::class,'getQCStitchingInhouseDetails'])->name('QCStitchingInhouseDetails');
    //Route::get('/QC_GetOrderQty',[FinishingInhouseMasterController::class,'QC_GetOrderQty'])->name('QC_GetOrderQty');
    Route::get('/vpo_GetFinishedPOQty', [FinishingInhouseMasterController::class, 'vpo_GetFinishedPOQty'])->name('vpo_GetFinishedPOQty');


    Route::resource('PackingInhouse', PackingInhouseMasterController::class);
    Route::get('/PackingInhouseDetails', [PackingInhouseMasterController::class, 'getFinishingInhouseDetails'])->name('FinishingInhouseDetails');
    Route::get('/FNSI_GetOrderQty', [PackingInhouseMasterController::class, 'FNSI_GetOrderQty'])->name('FNSI_GetOrderQty');
    Route::get('/GetFINISHINGGRNQty', [PackingInhouseMasterController::class, 'GetFINISHINGGRNQty'])->name('GetFINISHINGGRNQty');
    Route::get('/Op_GetOrderQty', [PackingInhouseMasterController::class, 'Op_GetOrderQty'])->name('Op_GetOrderQty');
    Route::get('/PackingGRNPrint/{id}', [PackingInhouseMasterController::class, 'PackingGRNPrint']);
    Route::get('/PackingGRNReport', [PackingInhouseMasterController::class, 'PackingGRNReport'])->name('PackingGRNReport');


    Route::resource('CartonPackingInhouse', CartonPackingInhouseMasterController::class);
    Route::get('/CartonPackingInhouseDetails', [CartonPackingInhouseMasterController::class, 'getPackingInhouseDetails'])->name('PackingInhouseDetails');
    Route::get('/PKI_GetOrderQty', [CartonPackingInhouseMasterController::class, 'PKI_GetOrderQty'])->name('PKI_GetOrderQty');
    Route::get('/PKI_GetOrdarQtyByRow', [CartonPackingInhouseMasterController::class, 'PKI_GetOrdarQtyByRow'])->name('PKI_GetOrdarQtyByRow');
    Route::get('/checkDifferentSizeGroup', [CartonPackingInhouseMasterController::class, 'checkDifferentSizeGroup'])->name('checkDifferentSizeGroup');
    Route::get('/FGStockReport', [CartonPackingInhouseMasterController::class, 'FGStockReport'])->name('FGStockReport');
    Route::get('/FGStockSummaryReport', [CartonPackingInhouseMasterController::class, 'FGStockSummaryReport'])->name('FGStockSummaryReport');
    Route::get('/cartonPackingShowAll', [CartonPackingInhouseMasterController::class, 'cartonPackingShowAll'])->name('cartonPackingShowAll');

    Route::get('/PKI_GetColorList', [CartonPackingInhouseMasterController::class, 'PKI_GetColorList'])->name('PKI_GetColorList');
    Route::get('PKI_GetMaxMinvalueList', [CartonPackingInhouseMasterController::class, 'GetMaxMinvalueList'])->name('PKI_GetMaxMinvalueList');

    Route::get('NewSalesOrderList', [CartonPackingInhouseMasterController::class, 'getSalesOrderList'])->name('NewSalesOrderList');
    Route::get('/BuyerLocationList', [CartonPackingInhouseMasterController::class, 'getBuyerLocationList'])->name('BuyerLocationList');

    Route::get('/CartonPackingPrint/{id}', [CartonPackingInhouseMasterController::class, 'CartonPackingPrint']);

    Route::resource('TransferPackingInhouse', TransferPackingInhouseMasterController::class);
    Route::get('/FG_GetRawData', [TransferPackingInhouseMasterController::class, 'FG_GetRawData'])->name('FG_GetRawData');
    Route::get('/FGStockData', [TransferPackingInhouseMasterController::class, 'FGStockData'])->name('FGStockData');
    Route::get('/FG_GetColorList', [TransferPackingInhouseMasterController::class, 'FG_GetColorList'])->name('FG_GetColorList');
    Route::get('/FGPackingInhouseDetails', [TransferPackingInhouseMasterController::class, 'FGPackingInhouseDetails'])->name('FGPackingInhouseDetails');
    Route::get('/PKI_GetTransferQtyByRow', [TransferPackingInhouseMasterController::class, 'PKI_GetTransferQtyByRow'])->name('PKI_GetTransferQtyByRow');
    Route::get('TPKI_GetMaxMinvalueList', [TransferPackingInhouseMasterController::class, 'TPKI_GetMaxMinvalueList'])->name('TPKI_GetMaxMinvalueList');



    Route::resource('Task', TaskMasterController::class);
    Route::get('/CommanData', [TaskMasterController::class, 'getCommanDetails'])->name('CommanData');
    Route::get('/SizeBalanceList', [TaskMasterController::class, 'getBalanceDetails'])->name('SizeBalanceList');
    Route::get('TaskList', [CuttingMasterController::class, 'GetTaskList'])->name('TaskList');

    Route::resource('FabricTrimCard', FabricTrimCardMasterController::class);
    Route::get('/JobCardDetail', [FabricTrimCardMasterController::class, 'getJobCardDetails'])->name('JobCardDetail');


    Route::get('/Average', [FabricTrimCardMasterController::class, 'getColorAverage'])->name('Average');
    Route::get('/AverageTrim', [FabricTrimCardMasterController::class, 'getColorAverageTrim'])->name('AverageTrim');
    Route::get('/ColorDetails', [FabricTrimCardMasterController::class, 'getColorDetails'])->name('ColorDetails');
    Route::get('/TrimColorDetails', [FabricTrimCardMasterController::class, 'getTrimColorDetails'])->name('TrimColorDetails');

    Route::get('/SalesOrderDetail2', [FabricOutwardController::class, 'getSalesOrderDetail2'])->name('SalesOrderDetail2');

    Route::get('/FabricOutwardData', [FabricOutwardController::class, 'FabricOutwardData'])->name('FabricOutwardData');



    Route::resource('JobCardReport', BuyerJobcardReportController::class);
    Route::resource('InwardReport', FabricInwardReportController::class);
    Route::get('FabricGRNPrintNew/{id}', [FabricInwardReportController::class, 'FabricGRNPrint']);
    Route::get('/GetFabricGRNReport', [FabricInwardReportController::class, 'GetFabricGRNReport'])->name('GetFabricGRNReport');
    Route::get('/FabricGRNFilterReport', [FabricInwardReportController::class, 'FabricGRNFilterReport'])->name('FabricGRNFilterReport');


    Route::resource('BundleBarcode', BundleController::class);
    Route::get('AddBundleBarcode/{id1}/{id2}', [BundleController::class, 'AddBundleBarcode']);
    Route::get('/BundleList', [BundleController::class, 'getDetails'])->name('BundleList');
    Route::get('/BundleSplitList', [BundleController::class, 'getRowDetails'])->name('BundleSplitList');
    Route::get('/BundlePrint', [BundleController::class, 'BundlePrinting'])->name('BundlePrint');
    Route::get('/SessionValue', [BundleController::class, 'getSessionValue'])->name('SessionValue');
    Route::get('/GetJobPartList', [BundleController::class, 'GetJobPartList'])->name('GetJobPartList');


    //*********Production Routes Starts **********
    Route::resource('CostingCategory', CostingCategoryController::class);
    Route::resource('CostingParticular', CostingParticularController::class);
    Route::get('/GetCostingParticularList', [CostingParticularController::class, 'GetCostingParticularList'])->name('GetCostingParticularList');







    Route::resource('OperationType', OperationTypeController::class);
    Route::resource('OperationMaster', OperationMasterController::class);
    Route::get('GetStyleList', [OperationMasterController::class, 'getStyleList'])->name('GetStyleList');
    Route::get('checkOperationalExistingRecord', [OperationMasterController::class, 'checkOperationalExistingRecord'])->name('checkOperationalExistingRecord');
    Route::resource('JobOperation', JobOperationController::class);
    Route::get('getCommanOperationMaster', [JobOperationController::class, 'getCommanOperationMaster'])->name('getCommanOperationMaster');
    Route::get('getJobCard', [JobOperationController::class, 'getJobCard'])->name('getJobCard');
    Route::get('getStylelist', [JobOperationController::class, 'getStylelist'])->name('getStylelist');
    Route::get('checkExistingRecord', [JobOperationController::class, 'checkExistingRecord'])->name('checkExistingRecord');
    Route::get('getCommanOperations', [JobOperationController::class, 'getCommanOperations'])->name('getCommanOperations');
    Route::get('getOperationListFromOperationDetail', [JobOperationController::class, 'getOperationListFromOperationDetail'])->name('getOperationListFromOperationDetail');
    Route::get('JobOperationPrint/{id}', [JobOperationController::class, 'show']);
    Route::get('show1', [JobOperationController::class, 'show1'])->name('show1');


    Route::resource('Production', ProductionController::class);

    Route::get('WorkerProductionReportForm', [ProductionController::class, 'WorkerProductionReportForm'])->name('WorkerProductionReportForm');
    Route::get('SalaryPaymentReportForm', [ProductionController::class, 'SalaryPaymentReportForm'])->name('SalaryPaymentReportForm');
    Route::get('getBundleData', [ProductionController::class, 'getBundleData'])->name('getBundleData');
    Route::get('getBundleDatanew', [ProductionController::class, 'getBundleDatanew'])->name('getBundleDatanew');
    Route::get('MontlyWorkerReportForm', [ProductionController::class, 'MontlyWorkerReportForm'])->name('MontlyWorkerReportForm');

    Route::get('getopereationtable', [ProductionController::class, 'getopereationtable'])->name('getopereationtable');
    Route::get('getOprationRate', [ProductionController::class, 'getOprationRate'])->name('getOprationRate');
    Route::get('getBarcodeList', [ProductionController::class, 'getBarcodeList'])->name('getBarcodeList');
    Route::get('getStyleDetails', [ProductionController::class, 'getStyleDetails'])->name('getStyleDetails');


    Route::get('getWorkers', [ProductionController::class, 'getWorkers'])->name('getWorkers');
    Route::get('getBundleDatavalidate', [ProductionController::class, 'getBundleDatavalidate'])->name('getBundleDatavalidate');
    Route::get('GetWorkerDayandOperation', [ProductionController::class, 'GetWorkerDayandOperation'])->name('GetWorkerDayandOperation');
    Route::get('deleterows', [ProductionController::class, 'deleterows'])->name('deleterows');






    Route::resource('OtherProduction', OtherProductionController::class);
    Route::post('import_other_production', [OtherProductionController::class, 'import_other_production'])->name('import_other_production');
    Route::get('checkQtyLimit', [OtherProductionController::class, 'checkQtyLimit'])->name('checkQtyLimit');
    Route::get('getOtherBundleDatanew', [OtherProductionController::class, 'getOtherBundleDatanew'])->name('getOtherBundleDatanew');
    Route::get('getOtherBundleData', [OtherProductionController::class, 'getOtherBundleData'])->name('getOtherBundleData');
    Route::get('getOtherStyleDetails', [OtherProductionController::class, 'getOtherStyleDetails'])->name('getOtherStyleDetails');
    Route::get('getOtherOprationRate', [OtherProductionController::class, 'getOtherOprationRate'])->name('getOtherOprationRate');
    Route::get('getOtherBundleDatavalidate', [OtherProductionController::class, 'getOtherBundleDatavalidate'])->name('getOtherBundleDatavalidate');
    Route::get('deleteOtherrows', [OtherProductionController::class, 'deleteOtherrows'])->name('deleteOtherrows');
    Route::get('getSizeQtyDropdownData', [OtherProductionController::class, 'getSizeQtyDropdownData'])->name('getSizeQtyDropdownData');
    Route::get('getQty', [OtherProductionController::class, 'getQty'])->name('getQty');
    Route::get('getStyleListFromOperationType', [OtherProductionController::class, 'getStyleListFromOperationType'])->name('getStyleListFromOperationType');



    //*********Production Routes End **********



    //Yarn Inward 
    Route::resource('YarnInward', YarnInwardController::class);
    Route::resource('YarnType', YarnTypeController::class);
    Route::resource('Broker', BrokerMasterController::class);



    Route::resource('JobPart', JobPartController::class);
    Route::resource('FabricTrimPart', FabricTrimPartController::class);
    Route::resource('Quality', QualityController::class);

    Route::post('qualityimport', [QualityController::class, 'qualityimport'])->name('qualityimport');

    Route::resource('FabricOutward', FabricOutwardController::class);
    //Fabric Outward Controller for Fabric Issue to Internal Department.
    Route::get('/FabricRecord', [FabricOutwardController::class, 'getFabricRecord'])->name('FabricRecord');
    Route::resource('FabricOutwardReport', FabricOutwardReportController::class);


    Route::get('/GetFabricInOutStockReportForm', [FabricOutwardReportController::class, 'GetFabricInOutStockReportForm'])->name('GetFabricInOutStockReportForm');

    Route::get('/FabricInOutStockReport', [FabricOutwardReportController::class, 'getFabricInOutStockReport'])->name('FabricInOutStockReport');
    Route::get('FabricOutwardPrint/{id}', [FabricOutwardReportController::class, 'FabricOutwardPrint']);
    Route::get('FabricOutwardRollsPrint/{id}', [FabricOutwardReportController::class, 'FabricOutwardRollsPrint']);

    Route::resource('FabricCheckingReport', FabricCheckingReportController::class);

    Route::get('FabricCheckPrint/{id}', [FabricCheckingReportController::class, 'FabricCheckPrint']);
    Route::resource('FabricCuttingReport', FabricCuttingReportController::class);
    Route::resource('FabricTrimCardReport', FabricTrimCardReportController::class);





    Route::resource('InwardStore', MaterialInwardStoreController::class);


    Route::get('/inwardApprovalList', [MaterialInwardStoreController::class, 'show'])->name('inwardApprovalList');

    Route::get('/getPoDetails', [MaterialInwardStoreController::class, 'getPoDetails'])->name('getPoDetails');

    Route::get('/getPoMasterDetails', [MaterialInwardStoreController::class, 'getPoMasterDetails'])->name('getPoMasterDetails');

    Route::resource('Requisition', RequisitionController::class);

    Route::get('/requisitionApproval', [RequisitionController::class, 'show'])->name('requisitionApproval');


    Route::get('/GETSTOCK', [RequisitionController::class, 'GETSTOCK'])->name('GETSTOCK');


    Route::resource('RequisitionOutward', RequisitionOutwardController::class);


    Route::get('/getRequitionDetails', [RequisitionOutwardController::class, 'getRequitionDetails'])->name('getRequitionDetails');
    Route::get('/getMasterDetails', [RequisitionOutwardController::class, 'getMasterDetails'])->name('getMasterDetails');

    Route::resource('ReturnableOutward', ReturnableOutwardController::class);


    Route::resource('POReport', POReportController::class);
    Route::post('POReport/pdf', [POReportController::class, 'pdf'])->name('pdf');

    Route::get('/FabricStock', [StockReportController::class, 'FabricStock'])->name('FabricStock');
    Route::get('/FabricSummary', [StockReportController::class, 'FabricStock2'])->name('FabricSummary');
    Route::get('/FabricStockPage', [StockReportController::class, 'GetOnPageFabricStock'])->name('FabricStockPage');


    Route::get('/InwardData', [StockReportController::class, 'GetInwardFabList'])->name('InwardData');
    Route::get('/FabricSummaryPage', [StockReportController::class, 'GetOnPageFabricStockSummary'])->name('FabricSummaryPage');



    Route::get('/GetCompareFabricPOInwardData', [StockReportController::class, 'GetCompareFabricPOInwardData'])->name('GetCompareFabricPOInwardData');


    Route::get('/FabricSummaryPage', [StockReportController::class, 'GetOnPageFabricStockSummary'])->name('FabricSummaryPage');



    Route::resource('POReportItemWise', POItemWiseReportController::class);
    Route::post('POReportItemWise/pdf', [POItemWiseReportController::class, 'pdf'])->name('itempdf');


    Route::resource('MIStoreReport', MaterialInwardStoreReportController::class);

    Route::post('MIStoreReport/pdf', [MaterialInwardStoreReportController::class, 'pdf'])->name('inwardpdf');


    Route::resource('RequisitionReport', RequisitionReportController::class);

    Route::post('RequisitionReport/pdf', [RequisitionReportController::class, 'pdf'])->name('Requisitionpdf');


    Route::resource('MIStoreReportItemwise', MIStoreItemwiseReportController::class);

    Route::post('MIStoreReportItemwise/pdf', [MIStoreItemwiseReportController::class, 'pdf'])->name('MIitempdf');

    Route::resource('RequisitionOutwardReport', RequisitionOutwardReportController::class);

    Route::post('RequisitionOutwardReport/pdf', [RequisitionOutwardReportController::class, 'pdf'])->name('MIOutwardpdf');


    Route::get('MostPurchaseItems/pdf', [POItemWiseReportController::class, 'itemsPdf'])->name('itemsPdf');

    Route::get('MostConsumedItems/pdf', [POItemWiseReportController::class, 'MostconsumeditemsPdf'])->name('Mostconsumeditems');

    Route::get('StockReport/pdf', [StockReportController::class, 'itemStockPdf'])->name('itemStockPdf');

    Route::get('print/{id}', [POReportController::class, 'generatePO']);

    Route::resource('TrimsOutward', TrimsOutwardController::class);

    Route::get('getVendorCode', [TrimsOutwardController::class, 'getVendorCode'])->name('getVendorCode');
    Route::get('getTrimsItemRate', [TrimsOutwardController::class, 'getTrimsItemRate'])->name('getTrimsItemRate');
    Route::get('print_po/{id}', [POReportController::class, 'generatePO']);


    Route::get('TrimsOutwardData', [TrimsOutwardController::class, 'TrimsOutwardData'])->name('TrimsOutwardData');


    Route::get('getVendorProcessOrder', [TrimsOutwardController::class, 'getVendorProcessOrder'])->name('getVendorProcessOrder');
    Route::get('getVendorMasterDetail', [TrimsOutwardController::class, 'getVendorMasterDetail'])->name('getVendorMasterDetail');

    Route::get('getvendortablenew', [TrimsOutwardController::class, 'getvendortablenew'])->name('getvendortablenew');
    Route::get('getProcessTrimData', [TrimsOutwardController::class, 'getProcessTrimData'])->name('getProcessTrimData');

    Route::get('TrimOutwardPrint/{id}', [TrimsOutwardController::class, 'show']);
    Route::get('TrimOutwardStandardPrint/{id}', [TrimsOutwardController::class, 'TrimOutwardStandardPrint']);
    Route::get('TrimOutwardStandardPrint2/{id}', [TrimsOutwardController::class, 'TrimOutwardStandardPrint2']);




    Route::resource('PresentEmployees', PresentEmployeesController::class);
    Route::resource('ActivityMaster', ActivityMasterController::class);
    Route::resource('ActivityTypeMaster', ActivityTypeMasterController::class);
    Route::resource('T_And_A_Master', T_And_A_MasterController::class);
    Route::get('getSalesOrderDetail', [T_And_A_MasterController::class, 'getSalesOrderDetail'])->name('getSalesOrderDetail');
    Route::get('Timeline', [T_And_A_MasterController::class, 'Timeline'])->name('Timeline');
    Route::get('GetTNAMasterData', [T_And_A_MasterController::class, 'GetTNAMasterData'])->name('GetTNAMasterData');
    Route::resource('PPCMaster', PPCMasterController::class);



    Route::resource('T_And_A_TemplateMaster', T_And_A_TemplateMasterController::class);
    Route::get('getSalesOrderDetail2', [T_And_A_TemplateMasterController::class, 'getSalesOrderDetail2'])->name('getSalesOrderDetail2');
    Route::get('Timeline2', [T_And_A_TemplateMasterController::class, 'Timeline2'])->name('Timeline2');



    Route::get('PPCCalendarReport/{id}/{id2}', [PPCMasterController::class, 'PPCCalendarReport']);
    //Route::get('PPCCalendarReport',[PPCMasterController::class,'PPCCalendarReport'])->name('PPCCalendarReport');

    Route::get('QtyConversion', [ItemMasterController::class, 'QtyConversion'])->name('QtyConversion');
    Route::get('GetClassifyData', [ItemMasterController::class, 'GetClassifyData'])->name('GetClassifyData');
    Route::get('GetSupplierId', [ItemMasterController::class, 'GetSupplierId'])->name('GetSupplierId');
    Route::get('GetSupplierList', [ItemMasterController::class, 'GetSupplierList'])->name('GetSupplierList');
    Route::get('GetClassifictionData', [ItemMasterController::class, 'GetClassifictionData'])->name('GetClassifictionData');


    Route::resource('SingleSizeMaster', SingleSizeMasterController::class);

    Route::resource('SalesOrderCostingProcessMaster', SalesOrderCostingProcessMasterController::class);
    Route::get('GetCatWiseItemList', [SalesOrderCostingProcessMasterController::class, 'GetCatWiseItemList'])->name('GetCatWiseItemList');
    Route::get('popupData', [SalesOrderCostingProcessMasterController::class, 'popupData'])->name('popupData');
    Route::post('SalesPrrocssUpdate', [SalesOrderCostingProcessMasterController::class, 'SalesPrrocssUpdate'])->name('SalesPrrocssUpdate');
    Route::resource('BOMProcessMaster', BOMProcessController::class);
    Route::get('GetSocData', [BOMProcessController::class, 'GetSocData'])->name('GetSocData');
    Route::get('GetBuyerPurchaseData', [BOMProcessController::class, 'GetBuyerPurchaseData'])->name('GetBuyerPurchaseData');
    Route::get('bomProcessPrint/{id}', [BOMProcessController::class, 'bomProcessPrint'])->name('bomProcessPrint');
    Route::get('RepeatSalesOrderCostingProcessMaster/{id}', [SalesOrderCostingProcessMasterController::class, 'RepeatSalesOrderCostingProcessMaster'])->name('RepeatSalesOrderCostingProcessMaster');
    Route::get('SalesOrderCostingProcessPrint/{id}', [SalesOrderCostingProcessMasterController::class, 'SalesOrderCostingProcessPrint'])->name('SalesOrderCostingProcessPrint');
    Route::post('RepeatSaveSalesOrderCosting', [SalesOrderCostingProcessMasterController::class, 'RepeatSaveSalesOrderCosting'])->name('RepeatSaveSalesOrderCosting');
    Route::get('getStyleDescription', [SalesOrderCostingProcessMasterController::class, 'getStyleDescription'])->name('getStyleDescription');
    Route::get('getStyleNoList', [SalesOrderCostingProcessMasterController::class, 'getStyleNoList'])->name('getStyleNoList');

    Route::get('GetBrandData', [SalesOrderCostingProcessMasterController::class, 'GetBrandData'])->name('GetBrandData');
    Route::get('GetSeasonData', [SalesOrderCostingProcessMasterController::class, 'GetSeasonData'])->name('GetSeasonData');
    Route::get('SaveMarginData', [SalesOrderCostingProcessMasterController::class, 'SaveMarginData'])->name('SaveMarginData');
    Route::get('CheckStyleNo', [SalesOrderCostingProcessMasterController::class, 'CheckStyleNo'])->name('CheckStyleNo');
    Route::get('GetCurrencyData', [SalesOrderCostingProcessMasterController::class, 'GetCurrencyData'])->name('GetCurrencyData');
    Route::get('GetFGData', [SalesOrderCostingProcessMasterController::class, 'GetFGData'])->name('GetFGData');
    Route::get('GetItemBOMUnit', [SalesOrderCostingProcessMasterController::class, 'GetItemBOMUnit'])->name('GetItemBOMUnit');
    Route::get('GetUnitAmount', [SalesOrderCostingProcessMasterController::class, 'GetUnitAmount'])->name('GetUnitAmount');


    Route::get('GetItemRateFromItemCode', [SalesOrderCostingProcessMasterController::class, 'GetItemRateFromItemCode'])->name('GetItemRateFromItemCode');
    Route::get('GetSuplierList', [SalesOrderCostingProcessMasterController::class, 'GetSuplierList'])->name('GetSuplierList');

    Route::get('getLedger', [SalesOrderCostingProcessMasterController::class, 'getLedger'])->name('getLedger');
    Route::get('getSeason', [SalesOrderCostingProcessMasterController::class, 'getSeason'])->name('getSeason');
    Route::get('getItem', [SalesOrderCostingProcessMasterController::class, 'getItem'])->name('getItem');
    Route::get('getSize', [SalesOrderCostingProcessMasterController::class, 'getSize'])->name('getSize');
    Route::get('getBrand', [SalesOrderCostingProcessMasterController::class, 'getBrand'])->name('getBrand');
    Route::get('getCost', [SalesOrderCostingProcessMasterController::class, 'getCost'])->name('getCost');
    Route::get('getmarginhead', [SalesOrderCostingProcessMasterController::class, 'getmarginhead'])->name('getmarginhead');



    Route::post('/SavePopupColor', [BuyerPurchaseOrderController::class, 'SavePopupColor'])->name('SavePopupColor');
    Route::get('/CheckColor', [BuyerPurchaseOrderController::class, 'CheckColor'])->name('CheckColor');
    Route::get('/GetLetestColorList', [BuyerPurchaseOrderController::class, 'GetLetestColorList'])->name('GetLetestColorList');
    Route::resource('ItemSize', ItemSizeController::class);

    Route::resource('UnraisedPOItems', UnraisedPOItemsController::class);
    Route::get('StoreItemstoRaisePO', [UnraisedPOItemsController::class, 'StoreItemstoRaisePO'])->name('StoreItemstoRaisePO');


    Route::get('StoreItemsSkuMaster', [BOMProcessController::class, 'StoreItemsSkuMaster'])->name('StoreItemsSkuMaster');





    Route::resource('ProcessOrder', ProcessOrderController::class);
    Route::get('ProcessOrderApprovalList', [ProcessOrderController::class, 'show'])->name('ProcessOrderApprovalList');
    Route::get('ProcessOrderDisApprovalList', [ProcessOrderController::class, 'Disapprovedshow'])->name('ProcessOrderDisApprovalList');
    Route::get('getBoMDetail', [ProcessOrderController::class, 'getBoMDetail'])->name('getBoMDetail');
    Route::get('getClassLists', [ProcessOrderController::class, 'getClassLists'])->name('getClassLists');
    Route::get('GetPOList', [ProcessOrderController::class, 'GetPOList'])->name('GetPOList');
    Route::get('PartyDetail', [ProcessOrderController::class, 'GetPartyDetails'])->name('PartyDetail');


    Route::resource('UnraisedProcessOrderItems', UnraisedProcessOrderItemsController::class);
    Route::get('StoreItemstoRaiseProcessOrder', [UnraisedProcessOrderItemsController::class, 'StoreItemstoRaiseProcessOrder'])->name('StoreItemstoRaiseProcessOrder');
    Route::get('getItemListForProcessOrder', [ProcessOrderController::class, 'getItemListForProcessOrder'])->name('getItemListForProcessOrder');



    Route::resource('StockAssociation', StockAssociationController::class);

    Route::get('GetAllocatedStockData', [StockAssociationController::class, 'GetAllocatedStockData'])->name('GetAllocatedStockData');

    Route::get('GetItemDataFromDetail', [StockAssociationController::class, 'GetItemDataFromDetail'])->name('GetItemDataFromDetail');

    Route::resource('StockAssociationForFabric', StockAssociationForFabricController::class);

    Route::get('getPoForFabric', [FabricSummaryGRNController::class, 'getPoForFabric'])->name('getPoForFabric');
    Route::get('stockAllocateForFabric', [FabricSummaryGRNController::class, 'stockAllocateForFabric'])->name('stockAllocateForFabric');

    Route::get('GetAllocatedFabricStockData', [StockAssociationForFabricController::class, 'GetAllocatedFabricStockData'])->name('GetAllocatedFabricStockData');

    Route::get('GetItemFabricDataFromDetail', [StockAssociationForFabricController::class, 'GetItemFabricDataFromDetail'])->name('GetItemFabricDataFromDetail');

    Route::get('StoreItemstoRaiseProcessOrderForPO', [UnraisedProcessOrderItemsController::class, 'StoreItemstoRaiseProcessOrderForPO'])->name('StoreItemstoRaiseProcessOrderForPO');


    Route::get('print/{id}', [ProcessOrderReportController::class, 'generateProcessOrder']);

    Route::get('GetClassifictionTrimsData', [ItemMasterController::class, 'GetClassifictionTrimsData'])->name('GetClassifictionTrimsData');




    // New Routes
    Route::get('/checkCostingStatus', [BuyerPurchaseOrderController::class, 'checkCostingStatus'])->name('checkCostingStatus');
    Route::get('/GetFabricConsumptionPO2', [VendorPurchaseOrderController::class, 'GetFabricConsumptionPO2'])->name('GetFabricConsumptionPO2');
    Route::get('/GetTrimFabricConsumption2', [VendorPurchaseOrderController::class, 'GetTrimFabricConsumption2'])->name('GetTrimFabricConsumption2');
    Route::get('/GetPackingConsumption2', [VendorPurchaseOrderController::class, 'GetPackingConsumption2'])->name('GetPackingConsumption2');
    Route::get('/SalesOrderDetailsform', [VendorPurchaseOrderController::class, 'SalesOrderDetailsform'])->name('SalesOrderDetailsform');
    Route::get('/GetSewingConsumption1', [VendorWorkOrderController::class, 'GetSewingConsumption1'])->name('GetSewingConsumption1');
    Route::post('WorkOrderClose', [VendorWorkOrderController::class, 'WorkOrderClose'])->name('WorkOrderClose');
    Route::get('GetSewingData', [VendorWorkOrderController::class, 'GetSewingData'])->name('GetSewingData');






    Route::get('getItemListFromPO', [PurchaseOrderController::class, 'getItemListFromPO'])->name('getItemListFromPO');
    Route::get('getItemDescription', [TrimsOutwardController::class, 'getItemDescription'])->name('getItemDescription');


    Route::resource('QCTrimsInward', QCTrimsInwardController::class);
    Route::get('/getPoForQCTrims', [QCTrimsInwardController::class, 'getPoForQCTrims'])->name('getPoForQCTrims');
    Route::get('GRNDetail', [QCTrimsInwardController::class, 'getGRNDetails'])->name('GRNDetail');
    Route::get('stockAllocateGRN', [QCTrimsInwardController::class, 'stockAllocateGRN'])->name('stockAllocateGRN');
    Route::get('/GetTrimCodeWiseGRNData', [QCTrimsInwardController::class, 'GetTrimCodeWiseGRNData'])->name('GetTrimCodeWiseGRNData');
    Route::get('QCTrimsGRNPrint/{id}', [QCTrimsInwardController::class, 'QCTrimsGRNPrint']);
    Route::get('TrimsGRNPrint/{id}', [TrimsInwardController::class, 'TrimsGRNPrint']);
    Route::get('stockAllocateDiff', [QCTrimsInwardController::class, 'stockAllocateDiff'])->name('stockAllocateDiff');
    Route::get('/GetSewingConsumption1', [VendorPurchaseOrderController::class, 'GetSewingConsumption1'])->name('GetSewingConsumption1');


    Route::resource('OpenOrderPPC', OpenOrderPPCController::class);
    Route::get('rptOpenOrderPPC', [OpenOrderPPCController::class, 'rptOpenOrderPPC'])->name('rptOpenOrderPPC');
    Route::get('GetPPCData', [PPCMasterController::class, 'GetPPCData'])->name('GetPPCData');


    Route::resource('PackingVendor', PackingVendorMasterController::class);
    Route::get('/PackingVendorGRNPrint/{id}', [PackingVendorMasterController::class, 'PackingVendorGRNPrint']);
    Route::get('/FNSI_GetOrderQty1', [PackingVendorMasterController::class, 'FNSI_GetOrderQty1'])->name('FNSI_GetOrderQty1');


    Route::resource('ReturnPackingInhouseMaster', ReturnPackingInhouseMasterController::class);
    Route::get('/GetTaxType', [ReturnPackingInhouseMasterController::class, 'GetTaxType'])->name('GetTaxType');
    Route::get('GetSaleInvoices', [ReturnPackingInhouseMasterController::class, 'GetSaleInvoices'])->name('GetSaleInvoices');
    Route::get('/Op_ReturnGetOrderQty', [ReturnPackingInhouseMasterController::class, 'Op_ReturnGetOrderQty'])->name('Op_ReturnGetOrderQty');
    Route::get('/ReturnPackingInhousePrint/{id}', [ReturnPackingInhouseMasterController::class, 'ReturnPackingInhousePrint']);


    Route::resource('WashingInhouse', WashingInhouseController::class);
    Route::get('WashingGRNPrint/{id}', [WashingInhouseController::class, 'WashingGRNPrint'])->name('WashingGRNPrint');
    Route::get('/vpo_GetWashingPOQty', [WashingInhouseController::class, 'vpo_GetWashingPOQty'])->name('vpo_GetWashingPOQty');
    Route::get('/WashingInwardReport', [WashingInhouseController::class, 'WashingInwardReport'])->name('WashingInwardReport');
    Route::get('/WashingOutwardReport', [WashingInhouseController::class, 'WashingOutwardReport'])->name('WashingOutwardReport');
    Route::get('/WashingInwardOutwardReport', [WashingInhouseController::class, 'WashingInwardOutwardReport'])->name('WashingInwardOutwardReport');


    Route::resource('UnraisedPurchaseReturn', UnraisedPurchaseReturnController::class);
    Route::get('StoreItemstoRaisePurchaseReturn', [UnraisedPurchaseReturnController::class, 'StoreItemstoRaisePurchaseReturn'])->name('StoreItemstoRaisePurchaseReturn');
    Route::get('StoreItemstoRaisePurchaseReturn', [UnraisedPurchaseReturnController::class, 'StoreItemstoRaisePurchaseReturn'])->name('StoreItemstoRaisePurchaseReturn');
    Route::get('QCTrimsGRNPrint/{id}', [QCTrimsInwardController::class, 'QCTrimsGRNPrint']);


    Route::resource('PurchaseReturn', PurchaseReturnController::class);
    Route::get('PartyDetail', [PurchaseReturnController::class, 'GetPartyDetails'])->name('PartyDetail');
    Route::get('getItemListForPurchaseReturn', [PurchaseReturnController::class, 'getItemListForPurchaseReturn'])->name('getItemListForPurchaseReturn');
    Route::get('print_purchase_return/{id}', [PurchaseReturnReportController::class, 'generatePurchaseReturn']);

    Route::get('PartyDetails', [PurchaseOrderController::class, 'GetPartyDetails'])->name('PartyDetails');
    Route::get('/PrintReturnPackingInhouse/{id}', [ReturnPackingInhouseMasterController::class, 'PrintReturnPackingInhouse']);
    Route::get('getSaleBillNo', [GeneralSalesReturnController::class, 'getSaleBillNo'])->name('getSaleBillNo');
    // 12/3/24
    Route::resource('GreigeToDyingOutword', GreigeToDyingOutwordController::class);
    Route::resource('DyingToFinishOutword', DyingToFinishOutwordController::class);
    Route::resource('Colour', ColourController::class);
    Route::resource('ClassificationMaster', ClassificationMasterController::class);
    Route::resource('ConsumptionChart', ConsumptionChartController::class);
    Route::resource('CuttingEntry', CuttingEntryController::class);
    Route::resource('FinishInward', FinishInwardController::class);
    Route::resource('StitchingInward', StitchingInwardController::class);
    Route::resource('FinishToCuttingOutward', FinishToCuttingOutwardController::class);
    Route::resource('StitchingOutword', StitchingOutwordController::class);
    Route::get('lotNo', [DyingToFinishOutwordController::class, 'lotNo'])->name('lotNo');
    // 13/3/24
    // Route::get('lotinwardNo',[FinishInwardController::class,'lotinwardNo'])->name('lotinwardNo');
    Route::get('lotoutwardNo', [FinishToCuttingOutwardController::class, 'lotoutwardNo'])->name('lotoutwardNo');
    Route::get('tagaQuantity', [FinishToCuttingOutwardController::class, 'tagaQuantity'])->name('tagaQuantity');
    Route::get('OutwardNo', [CuttingEntryController::class, 'OutwardNo'])->name('OutwardNo');
    Route::get('gettagano', [FinishToCuttingOutwardController::class, 'gettagano'])->name('gettagano');
    Route::resource('StitchingOutword', StitchingOutwordController::class);
    Route::resource('StitchingInword', StitchingInwordController::class);
    Route::resource('PackingOutward', PackingOutwardController::class);
    Route::resource('ConsumptionChartnew', ConsumptionChartControllernew::class);
    Route::get('/VenodrList', [StitchingInwordController::class, 'GetVenodrList'])->name('VenodrList');
    Route::get('/VendorDetailList', [StitchingInwordController::class, 'getDetails'])->name('VendorDetailList');

    Route::get('/allDetailList', [ConsumptionChartControllernew::class, 'getQuantityDeails'])->name('allDetailList');
    Route::get('toggleTable', [PackingOutwardController::class, 'toggleTable'])->name('toggleTable');
    Route::resource('PackingInward', PackingInwardController::class);
    Route::get('GetPass', [PackingInwardController::class, 'GetPass'])->name('GetPass');
    Route::get('ConsumTable', [PackingInwardController::class, 'ConsumTable'])->name('ConsumTable');
    Route::get('getquality', [SaleTransactionMasterController::class, 'getquality'])->name('getquality');
    Route::get('/gettableDetails', [TrimsOutwardController::class, 'gettableDetails'])->name('gettableDetails');
    Route::get('/getPackingOutwardNo', [TrimsOutwardController::class, 'getPackingOutwardNo'])->name('getPackingOutwardNo');

    Route::get('GetGreigeToDyingOutwordReport', [GreigeToDyingOutwordController::class, 'GetGreigeToDyingOutwordReport'])->name('GetGreigeToDyingOutwordReport');
    Route::post('RptGreigeToDyingOutwordReport', [GreigeToDyingOutwordController::class, 'RptGreigeToDyingOutwordReport'])->name('RptGreigeToDyingOutwordReport');
    Route::get('GetDyingToFinishOutwordReport', [DyingToFinishOutwordController::class, 'GetDyingToFinishOutwordReport'])->name('GetDyingToFinishOutwordReport');
    Route::post('RptDyingToFinishOutwordReport', [DyingToFinishOutwordController::class, 'RptDyingToFinishOutwordReport'])->name('RptDyingToFinishOutwordReport');
    Route::get('processcheckingdata/{id}', [ProcessCheckingController::class, 'processcheckingdata'])->name('processcheckingdata');
    Route::resource('ProcessChecking', ProcessCheckingController::class);
    Route::resource('FinishedFabricPurchase', FinishedFabricPurchaseController::class);

    Route::get('GetProcessCheckingReport', [ProcessCheckingController::class, 'GetProcessCheckingReport'])->name('GetProcessCheckingReport');
    Route::post('RptProcessCheckingReport', [ProcessCheckingController::class, 'RptProcessCheckingReport'])->name('RptProcessCheckingReport');
    Route::get('GetProcessCheckingSummaryReport', [ProcessCheckingController::class, 'GetProcessCheckingSummaryReport'])->name('GetProcessCheckingSummaryReport');
    Route::post('RptProcessCheckingSummaryReport', [ProcessCheckingController::class, 'RptProcessCheckingSummaryReport'])->name('RptProcessCheckingSummaryReport');
    Route::get('GetFinishInwardReport', [FinishInwardController::class, 'GetFinishInwardReport'])->name('GetFinishInwardReport');
    Route::post('RptFinishInwardReport', [FinishInwardController::class, 'RptFinishInwardReport'])->name('RptFinishInwardReport');
    Route::get('GetFinishInwardSummaryReport', [FinishInwardController::class, 'GetFinishInwardSummaryReport'])->name('GetFinishInwardSummaryReport');
    Route::post('RptFinishInwardSummaryReport', [FinishInwardController::class, 'RptFinishInwardSummaryReport'])->name('RptFinishInwardSummaryReport');
    Route::get('GetFinishToCuttingOutwardReport', [FinishToCuttingOutwardController::class, 'GetFinishToCuttingOutwardReport'])->name('GetFinishToCuttingOutwardReport');
    Route::post('RptFinishToCuttingOutwardReport', [FinishToCuttingOutwardController::class, 'RptFinishToCuttingOutwardReport'])->name('RptFinishToCuttingOutwardReport');
    Route::get('GetSaleTransactionReport', [SaleTransactionMasterController::class, 'GetSaleTransactionReport'])->name('GetSaleTransactionReport');
    Route::post('RptSaleTransactionReport', [SaleTransactionMasterController::class, 'RptSaleTransactionReport'])->name('RptSaleTransactionReport');
    Route::get('GetStitchingInwordReport', [StitchingInwordController::class, 'GetStitchingInwordReport'])->name('GetStitchingInwordReport');
    Route::post('RptStitchingInwordReport', [StitchingInwordController::class, 'RptStitchingInwordReport'])->name('RptStitchingInwordReport');
    Route::get('GetStitchingOutwordReport', [StitchingOutwordController::class, 'GetStitchingOutwordReport'])->name('GetStitchingOutwordReport');
    Route::post('RptStitchingOutwordReport', [StitchingOutwordController::class, 'RptStitchingOutwordReport'])->name('RptStitchingOutwordReport');
    Route::get('GetPackingInwardReport', [PackingInwardController::class, 'GetPackingInwardReport'])->name('GetPackingInwardReport');
    Route::post('RptPackingInwardReport', [PackingInwardController::class, 'RptPackingInwardReport'])->name('RptPackingInwardReport');
    Route::get('GetPackingOutwardReport', [PackingOutwardController::class, 'GetPackingOutwardReport'])->name('GetPackingOutwardReport');
    Route::post('RptPackingOutwardReport', [PackingOutwardController::class, 'RptPackingOutwardReport'])->name('RptPackingOutwardReport');
    Route::resource('FinishGoodQuality', FinishGoodQualityMasterController::class);
    Route::get('/PrintCuttingEntry/{id}', [CuttingEntryController::class, 'PrintCuttingEntry'])->name('PrintCuttingEntry');
    Route::get('/PrintFinishToCuttingOutward/{id}', [FinishToCuttingOutwardController::class, 'PrintFinishToCuttingOutward'])->name('PrintFinishToCuttingOutward');

    Route::get('OutwardNo1', [CuttingEntryController::class, 'OutwardNo1'])->name('OutwardNo1');
    Route::get('getGetPassNo', [StitchingOutwordController::class, 'getGetPassNo'])->name('getGetPassNo');
    Route::get('VendorNo', [StitchingInwordController::class, 'VendorNo'])->name('VendorNo');
    Route::get('getGatePassNo', [PackingOutwardController::class, 'getGatePassNo'])->name('getGatePassNo');
    Route::get('getItemcodebyclass', [PackingOutwardController::class, 'getItemcodebyclass'])->name('getItemcodebyclass');
    Route::get('/PrintStitchingOutward/{id}', [StitchingOutwordController::class, 'PrintStitchingOutward'])->name('PrintStitchingOutward');
    Route::get('/PrintStitchingInward/{id}', [StitchingInwordController::class, 'PrintStitchingInward'])->name('PrintStitchingInward');
    Route::get('/PrintPackingOutward/{id}', [PackingOutwardController::class, 'PrintPackingOutward'])->name('PrintPackingOutward');
    Route::resource('DeliveryChallan', DeliveryChallanController::class);
    Route::get('GetPassNoDC', [DeliveryChallanController::class, 'GetPassNoDC'])->name('GetPassNoDC');
    Route::get('GetDeliveryChallanReport', [DeliveryChallanController::class, 'GetDeliveryChallanReport'])->name('GetDeliveryChallanReport');
    Route::post('RptDeliveryChallanReport', [DeliveryChallanController::class, 'RptDeliveryChallanReport'])->name('RptDeliveryChallanReport');
    Route::get('/PrintDeliveryChallan/{id}', [DeliveryChallanController::class, 'PrintDeliveryChallan'])->name('PrintDeliveryChallan');
    Route::get('/PrintPackingInward/{id}', [PackingInwardController::class, 'PrintPackingInward'])->name('PrintPackingInward');
    Route::get('GetCuttingEntryReport', [CuttingEntryController::class, 'GetCuttingEntryReport'])->name('GetCuttingEntryReport');
    Route::post('RptCuttingEntryReport', [CuttingEntryController::class, 'RptCuttingEntryReport'])->name('RptCuttingEntryReport');
    Route::get('ConsumTable1', [PackingInwardController::class, 'ConsumTable1'])->name('ConsumTable1');
    Route::get('gettrimcode', [TrimsInwardController::class, 'gettrimcode'])->name('gettrimcode');

    Route::get('GetStockReport', [PackingOutwardController::class, 'GetStockReport'])->name('GetStockReport');
    Route::post('RptStockReport', [PackingOutwardController::class, 'RptStockReport'])->name('RptStockReport');
    Route::get('GetTrimInward', [TrimsInwardController::class, 'GetTrimInward'])->name('GetTrimInward');
    Route::post('RptTrimInward', [TrimsInwardController::class, 'RptTrimInward'])->name('RptTrimInward');




    Route::get('/PrintProcessChecking/{id}', [ProcessCheckingController::class, 'PrintProcessChecking'])->name('PrintProcessChecking');
    Route::get('/PrintFinishInward/{id}', [FinishInwardController::class, 'PrintFinishInward'])->name('PrintFinishInward');
    Route::get('/PrintFinishedFabricPurchase/{id}', [FinishedFabricPurchaseController::class, 'PrintFinishedFabricPurchase'])->name('PrintFinishedFabricPurchase');


    Route::resource('Ledger', LedgerController::class);
    Route::resource('/Tab', TabController::class);

    Route::get('/get-employees-by-group/{egroup_id}', [TabController::class, 'getEmployeesByGroup'])->name('getEmployeesByGroup');

    Route::get('/get-states/{country_id}', [TabController::class, 'getStates']);
    Route::get('/get-districts/{state_id}', [TabController::class, 'getDistricts']);
    Route::get('/get-talukas/{dist_id}', [TabController::class, 'getTalukas']);
    Route::get('/get-cities/{taluka_id}', [TabController::class, 'getCities']);
    // Route::get('/EnquiryPunching/view', [EnquiryPunchingController::class, 'view'])->name('EnquiryPunching.view');
    Route::get('/EnquiryPunching/view/{enquiry_id}', [EnquiryPunchingController::class, 'view'])->name('EnquiryPunching.view');

    Route::get(
        'enquiry-punching/print/{enquiry_id}',
        [EnquiryPunchingController::class, 'print']
    )->name('EnquiryPunching.print');


    Route::resource('DocumentType', DocumentTypeController::class);
    Route::resource('CalculationDrawingDocument', CalculationDrawingDocumentController::class);
    Route::get(
        '/get-client-by-workorder/{id}',
        [CalculationDrawingDocumentController::class, 'getClientByWorkOrder']
    )->name('get.client.by.workorder');
    // 0522026
    Route::get('/get-tag-no/{receipt_id}', [CalculationDrawingDocumentController::class, 'getTagNo']);
    Route::get('/get-mfg-serial', [CalculationDrawingDocumentController::class, 'getMfgSerial'])
        ->name('get.mfg.serial');



    Route::resource('MaterialSpecification', MaterialSpecificationController::class);

    Route::get(
        'get-shape-type',
        [MaterialSpecificationController::class, 'getShapeType']
    )
        ->name('getShapeType');

    Route::get(
        'get-shape-sub-type',
        [MaterialSpecificationController::class, 'getShapesubType']
    )
        ->name('getShapesubType');
        
    //01-04-2026    
    Route::get('/get-item-category/{typeId}', [MaterialSpecificationController::class, 'getItemCategory']);
    Route::get('/get-item/{catId}', [MaterialSpecificationController::class, 'getItem']);
    Route::get('/get-shape/{itemId}', [MaterialSpecificationController::class, 'getShapeByItem']);



    Route::resource('PlateCuttingLayout', PlateCuttingLayoutController::class);
    Route::get('/get-mfg-serial-by-tags', [PlateCuttingLayoutController::class, 'getMfgSerialByTags'])->name('get.mfg.serial.by.tags');


    Route::get('/plate-cutting-print', [PlateCuttingLayoutController::class, 'print'])
        ->name('PlateCuttingLayout.print');
    Route::get('/plate-cutting-report', [PlateCuttingLayoutController::class, 'plateCuttingReport'])->name('plateCuttingReport');

    Route::get('/get-tag-no', [CalculationDrawingDocumentController::class, 'getTagNoByWorkOrder']);

    Route::get('/get-document-description', [CalculationDrawingDocumentController::class, 'getDocumentDescription']);


    Route::get('/GetDcifilter', [CalculationDrawingDocumentController::class, 'getDciReport'])
        ->name('DciReport');


    Route::resource('BOM', BomController::class);
    Route::get('/get-moc-density/{id}', [BomController::class, 'getMocDensity']);
    Route::get('/get-item-tag-client/{id}', [BomController::class, 'getItemTagClient']);
    Route::get('/get-weight-by-shape', [BomController::class, 'getWeightByShape'])
        ->name('get.weight.by.shape');

    Route::resource('Gst', GstController::class);

    Route::resource('MiscellaneousType', MiscellaneousTypeController::class);
    Route::resource('ProcessName', ProcessNameMasterController::class);
    Route::get('/get-work-order', [HandoverOfOrderController::class, 'getWorkOrder']);


    Route::get('/GetBillOfMaterial', [BomController::class, 'GetBillOfMaterial'])
        ->name('GetBillOfMaterial');

    Route::get('/bill-of-material-report', [BomController::class, 'BillOfMaterialReport'])
        ->name('BillOfMaterialReport');

    Route::get('/getBomDetails', [BomController::class, 'getBomDetails'])
        ->name('getBomDetails');

    Route::get(
        '/GetDetailBillOfMaterial',
        [BomController::class, 'GetDetailBillOfMaterialFilter']
    )->name('GetDetailBillOfMaterial');

    // Report Page
    Route::get(
        '/Detail_Bill_of_Material_Report',
        [BomController::class, 'GetDetailBillOfMaterial']
    )->name('Detail_Bill_of_Material_Report');


    //14-02-26

    Route::get('getEmployeeByDept', [UserMasterController::class, 'getEmployeeByDept'])->name('getEmployeeByDept');
    
    Route::resource('ItemCategoryType', ItemCategoryTypeController::class);
    
    Route::get('getItemCatByType', [ItemCategoryController::class, 'getItemCatByType'])->name('getItemCatByType');

});


//added by shubham chhanwal on 15/04/2026
//purchase GRN 
 
Route::post('/grn/store', [PurchaseGrnController::class, 'store'])->name('grn.store');

// Route::get('/grn', [PurchaseGrnController::class, 'index'])->name('grn.index');
Route::get('/GoodReceiptNote', [PurchaseGrnController::class, 'index'])->name('grn.index');
Route::get('/grn/create', [PurchaseGrnController::class, 'create'])->name('grn.create');
Route::put('/grn/{grn_no}', [PurchaseGrnController::class, 'update'])
    ->name('grn.update');
    Route::get('/grn/edit/{grn_no}', [PurchaseGrnController::class, 'edit'])->name('grn.edit');
Route::delete('/grn/delete/{id}', [PurchaseGrnController::class, 'destroy'])->name('grn.destroy');

//purchase Details
Route::get('grn-details', [PurchaseGrnDetailsController::class, 'index'])->name('grn-details.index');
Route::post('/grn-details/update-by-grn/{grn_no}', [PurchaseGrnDetailsController::class, 'updateByGrn']);

Route::get('grn-details/create', [PurchaseGrnDetailsController::class, 'create'])->name('grn-details.create');


Route::post('grn-details/store', [PurchaseGrnDetailsController::class, 'store'])->name('grn-details.store');

Route::get('grn-details/{id}/edit', [PurchaseGrnDetailsController::class, 'edit'])->name('grn-details.edit');

Route::put('grn-details/{id}', [PurchaseGrnDetailsController::class, 'update'])->name('grn-details.update');

Route::delete('grn-details/{id}', [PurchaseGrnDetailsController::class, 'destroy'])->name('grn-details.destroy');


//Vendor Purchase Order

Route::get('/VendorPurchaseOrder', [VendorPoController::class, 'index'])->name('vendor-po.index');
Route::get('/vendor-po/create', [VendorPoController::class, 'create'])->name('vendor-po.create');


// Store ALL data (master + part + material)
Route::post('/vendor-po/store', [VendorPoController::class, 'store'])
    ->name('vendor-po.store');

Route::get('/vendor-po/{id}/edit', [VendorPoController::class, 'edit'])->name('vendor-po.edit');
Route::put('/vendor-po/{id}', [VendorPoController::class, 'update'])
    ->name('vendor-po.update');

Route::delete('/vendor-po/{id}', [VendorPoController::class, 'destroy'])
    ->name('vendor-po.destroy');

    //SKU MASTER added by shubham chhanwal 21/04/2026
Route::get('SkuMaster/create', [SkuMasterController::class, 'create'])->name('sku-master.create');
Route::post('/sku-store', [SkuMasterController::class, 'store'])->name('sku.store');
Route::get('/get-material/{moc_id}', [SkuMasterController::class, 'getMaterial']);
Route::get('/SkuMasterList', [SkuMasterController::class, 'index'])->name('sku.index');
Route::get('/sku/delete/{id}', [SkuMasterController::class, 'destroy'])
    ->name('sku.delete');
Route::get('/sku-edit/{id}', [SkuMasterController::class, 'edit'])->name('sku.edit');
Route::put('/sku/update/{id}', [SkuMasterController::class, 'update'])->name('sku.update');