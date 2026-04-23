<?php

namespace App\Traits;
use Illuminate\Http\Request;
use App\Models\EmployeeModel;
use App\Models\IncrementModel;
use DB;

trait EmployeeTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function get_employee_list($sub_company_id) {
        
        $html = '';
        $html .= '<option value="0">All</option>';
       
        $workerlist = DB::table('employeemaster')->where('sub_company_id',$sub_company_id)->whereNotIn('employee_status_id',[3,4])->get();
        foreach ($workerlist as $rowworker) {
                $html .= '<option value="'.$rowworker->employeeCode.'">'.$rowworker->employeeCode.'</option>';
              
  }
        return $html;

    }
    
    
     public function get_employee_info($employeeCode) {
        
      $detail=EmployeeModel::select('employeemaster.fullName','employeemaster.egroup_id','employeemaster.dept_id','employeemaster.maincompany_id','employeemaster.perMonthCtc',
      DB::raw('tbl2.egroup_id as egroup_idreportingManager'),'employeemaster.employee_status_id','employeemaster.genderId','employeemaster.sub_company_id')
      ->leftJoin('employeemaster as tbl2','tbl2.employeeCode','=','employeemaster.reportingmanager')
      ->where('employeemaster.employeeCode',$employeeCode)->first();
        
        return $detail;

    }   
    
        public function get_rate_info($employeeCode,$fdate,$tdate) {
        
        
        $fromDate=date('Y-m-d',strtotime($fdate));
        $toDate=$tdate;
        
     //DB::enableQueryLog();
   
      $detail=IncrementModel::select('increment_id', 'letter_ref', 'employeeCode', 'genderId', 'employee_status_id', 'egroup_id', 'emp_dept_id', 
      'maincompany_id', 'sub_company_id', 'reporting_dept_id', 'wef_date', 'previous_ctc', 'increment_amount', 'basicSalary', 'dearness_allowance', 
      'hra', 'occupational', 'travelling', 'tea_Tiffin', 'uniformworker', 'washing', 'pf', 'pfAmount', 'esic', 'employersesic', 'ptflag', 'pt', 
      'employerspf', 'gratuity', 'ex_gratia', 'fromDate', 'toDate', 'skill_type_id', 'emp_cat_id', 'salaryType', 'costValue', 'grossSalary', 'annualBonus',
      'costToCompanyMonthly', 'annualCtc', 'perMonthCtc', 'travalRate', 'rate', 'gratuityFlag', 'CN', 'annualBonusFlag', 'esicCutOffDate', 'otFlag', 'govbasicSalary', 'govDearness_allowance', 
      'inHandMonthlySalary', 
      'uanNo', 'pfNo', 'esicNo', 'employeeesic', 'userId', 'misRate', 'govHra', 'inHandMonthlySalaryCompliance')
      ->where('employeeCode',$employeeCode)->where('fromDate',$fromDate)->where('toDate',$toDate)->first();
      
      //dd(DB::getQueryLog());
        
        return $detail;

    }   
    
    
    

}