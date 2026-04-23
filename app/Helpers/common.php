<?php
use App\Models\UserManagement;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\MainFormMasterModel;
use App\Models\SubFormMasterModel;
use App\Models\FormMasterModel;


function getSideBar()
{



   
      $mainFormList = MainFormMasterModel::select('mainformId','mainformName','route_name','mainform_icon')->where('delflag',0)->get();


    $html="";

    	$html.='<ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" key="t-menu">Menu</li>
            <li>
               <a href="/dashboard" class="waves-effect">
            
              
               <span key="t-dashboards">Dashboard</span>
               </a>
          
            </li>';
            
            
            foreach($mainFormList as $rowMenu)   
            {
                
             if(isset($rowMenu->route_name))   
             {
                 
                 $route=route($rowMenu->route_name);
             } else{
                 $route='#';
                 
             }
                
            $html.='<li>
               <a href="'.$route.'" class="has-arrow waves-effect">
              
               <span key="t-ecommerce">'.$rowMenu->mainformName.'</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">';
               
               $subMenu=DB::table('sub_form_master')->where('mainformId',$rowMenu->mainformId)->get();
               
             foreach(subFormList($rowMenu->mainformId) as $rowSubMenu)
            {   
			  $html.='<li>
		  	 <a href="javascript: void(0);" class="has-arrow waves-effect">
        
               <span key="t-ecommerce">'.$rowSubMenu->subformName.'</span>
               </a>
               <ul class="sub-menu" aria-expanded="false">'; 
               
			   foreach(FormList($rowSubMenu->subformId,$rowSubMenu->mainformId) as $rowForm)
               {
                     $html.='<a href="'.route($rowForm->form_name).'" key="t-customers">'.$rowForm->form_label.'</a>';
			         }
			  
			  $html.='</ul>
			  </li>';
            }
			  
                 
				  
              $html.=' </ul>
            </li>';
            }
            
            


         $html.='</ul>';
	
	echo  $html;
}

function subFormList($mainformId)
{

$submenuList = SubFormMasterModel::select('subformId','mainformId','subformName','subform_icon','sub_form_route')->where('mainformId',$mainformId)->get();

return $submenuList;
}

function FormList($subformId,$mainformId)
{
    
    $Authicateuser = UserManagement::join('form_auth', 'form_auth.form_id', '=', 'form_master.form_code')
    ->where('form_auth.user_type','=',Session::get('user_type'))
    ->where('form_master.delflag',0)
    ->where(["form_master.mainformId"=>$mainformId,"form_master.subformId"=>$subformId])  
    ->orderBy('seq_no')
    ->get(['form_master.form_code','form_master.form_label','form_master.form_name','form_auth.write_access','form_auth.edit_access','form_auth.delete_access','form_master.head_id']);
        
//$FormList = FormMasterModel::select('form_name','form_label')->where(["mainformId"=>$mainformId,"subformId"=>$subformId])->get();

return $Authicateuser;

}
function indian_number_format($num){
  $num=explode('.',$num);
  $dec=(count($num)==2)?'.'.$num[1]:'.00';
  $num = (string)$num[0];
  if( strlen($num) < 4) return $num;
  $tail = substr($num,-3);
  $head = substr($num,0,-3);
  $head = preg_replace("/\B(?=(?:\d{2})+(?!\d))/",",",$head);
  return $head.",".$tail.$dec;
}
?>