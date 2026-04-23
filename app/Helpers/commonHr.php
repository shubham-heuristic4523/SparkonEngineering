<?php 
use App\Models\FormMasterModel;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


function getSideBarHr()
{


   $Authicateuser = FormMasterModel::join('form_auth', 'form_auth.form_id', '=', 'form_master.form_code')
->where('form_auth.emp_id','=',Session::get('userId'))
->where('form_master.delflag','=',0)
->orderBy('form_master.form_code')
->get(['form_master.form_code','form_master.form_label','form_master.form_name', 'form_auth.write_access', 'form_auth.edit_access','form_auth.delete_access','form_master.head_id']);


$html="";


	$html.='						<ul class="side-menu">
							<li class="side-item side-item-category mt-4">Dashboards</li>

		                 <li class="slide">
								<a class="side-menu__item" data-toggle="slide" href="#">
									<i class="feather feather-home sidemenu_icon"></i>
									<span class="side-menu__label">HRMS</span><i class="angle fa fa-angle-right"></i>
								</a>
								<ul class="slide-menu">';
		 foreach($Authicateuser as $check)
		 {

  if($check->head_id==13)						    
{	    
	$html.='<li><a href="'.route($check->form_name).'"  class="slide-item">'.$check->form_label.'</a></li>';
	
	}
 }
	
								$html.='	</ul>
							</li>


					
							

						</ul>';


						echo $html;


}

 function getcompany()
{


 $companyfetch=DB::table('maincompany_master')->where('maincompany_id',Session::get('maincompany_id'))->where('delflag',0)->first(); 



return $companyfetch;
}

?>