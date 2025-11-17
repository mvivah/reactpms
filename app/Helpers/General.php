<?php
use Carbon\Carbon;
use App\Models\Batch;
use App\Helpers\Security;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

if (! function_exists ('date_picker_date_now')) {
    function date_picker_date_now()
    {
        return date_picker_format_date(get_date_time_now());
    }
}
if (! function_exists ('calculate_days_left')) {
function calculate_days_left($dueDate)
{
    return Carbon::now()->diffInDays(Carbon::parse($dueDate), false);
}
}
if (! function_exists ('date_picker_format_date')) {
    function date_picker_format_date($date)
    {
        if (!$date) return '';
        return date("d M Y", strtotime($date));
    }
}

if (! function_exists ('default_date_picker_format_date')) {
    function default_date_picker_format_date($date)
    {
        if (!$date) return '';
        return date("Y-m-d", strtotime($date));
    }
}

if (! function_exists ('short_year_format_date')) {
    function short_year_format_date($date)
    {
        if(!$date){
            return '- -- ----';
        }
        return date("j M y", strtotime($date));
    }
}

if (! function_exists ('full_date')) {
    function full_date($date)
    {
        if(!$date){
            return '- -- ----';
        }
        return date("D, jS M Y", strtotime($date));
    }
}

if (! function_exists ('month_year_date')) {
    function month_year_date($date)
    {
        if(!$date){
            return '- -- ----';
        }
        return date("M Y", strtotime($date));
    }
}


if (! function_exists ('date_to_time')) {
    function date_to_time($date)
    {
        if(!$date){
            return '- -- ----';
        }
        return date("H:i a", strtotime($date));
    }
}

if (! function_exists ('full_year_format_date')) {
    function full_year_format_date($date)
    {
        if(!$date){
            return '- -- ----';
        }
        return date("j M Y", strtotime($date));
    }
}

// change date to database date format
if (! function_exists ('db_date_format')) {
    function db_date_format($date)
    {
        if(!isset($date) || $date == "") return null;
        return date("Y-m-d", strtotime($date));
    }
}

// change date to database date time format
if (!function_exists('db_date_format_timestamp')) {
    function db_date_format_timestamp()
    {
        return date("Y-m-d h:i:s");
    }
}

// change date to database date time format
if (!function_exists('db_datetime_format')) {
    function db_datetime_format($date)
    {
        if (!$date  || $date == "") {
            return '';
        }
        return date("Y-m-d h:i:s", strtotime($date));
    }
}

if (!function_exists('file_name_datetime')) {
    function file_name_datetime($date)
    {
        if (!$date  || $date == "") {
            return '';
        }
        return date("Y_M_d_his", strtotime($date));
    }
}


if (!function_exists('get_user_friendly_date')) {
    function get_user_friendly_date($date)
    {
        if (!$date  || $date == "") {
            return '';
        }
        return date("d M Y", strtotime($date));
    }
}

if (!function_exists('get_user_friendly_date_for_email')) {
    function get_user_friendly_date_for_email($date)
    {
        if (!$date || $date == "") {
            return '';
        }
        return date("F d Y", strtotime($date));
    }
}

if (!function_exists('get_user_friendly_date_time')) {
    function get_user_friendly_date_time($date)
    {
        if (!$date  || $date == "") {
            return '';
        }
        return date("d M Y, g:i a", strtotime($date));
    }
}

if (!function_exists('get_user_friendly_date_time_time_first')) {
    function get_user_friendly_date_time_time_first($date)
    {
        if (!$date  || $date == "") {
            return '';
        }
        return date("g:i a, d M Y", strtotime($date));
    }
}

if (!function_exists('get_date_time_now')) {
    function get_date_time_now()
    {
        return Carbon::now();
    }
}

if (!function_exists('get_edms_html_form_date')) {
    function get_edms_html_form_date($date)
    {
        if (!$date || $date == "") {
            return '';
        }
        return date('Y-m-d', strtotime($date));
    }
}

if (! function_exists ('legal_no_date_format')) {
    function legal_no_date_format($date)
    {
        return date("j-M-Y", strtotime($date));
    }
}

if (! function_exists ('encrypt_data')) {
    function encrypt_data($param)
    {
      return Crypt::encrypt($param);
    }
}

if (! function_exists ('decrypt_data')) {
    function decrypt_data($param)
    {
      return Crypt::decrypt($param);
    }
}


if (! function_exists ('procurement_letter_key_records')) {
    function procurement_letter_key_records()
    {
        return array(
          "request_to_initiate_procurement_proceedings"=> "Request to initiate procurement proceedings",
          "demand_driven",""
        );
    }
}


if (! function_exists ('format_audit_type')) {
    function format_audit_type($audit_type)
    {
        return ucwords(str_replace('_',' ',$audit_type));
    }
}

if (! function_exists ('stripUnderScore')) {
    function stripUnderScore($string)
    {
        return str_replace('_',' ',$string);
    }
}

if (! function_exists ('ucwords_strip_underscore')) {
    function ucwords_strip_underscore($string)
    {
        return ucwords(str_replace('_',' ',$string));
    }
}

if (! function_exists ('ucwords_strip_dash')) {
    function ucwords_strip_dash($string)
    {
        return ucwords(str_replace('-',' ',$string));
    }
}


if (! function_exists ('oag_opinions')) {
    function oag_opinions()
    {
        return array('qualified','unqualified','adverse');
    }
}

if (! function_exists ('get_current_year')) {
    function get_current_year(){return date('Y');}
}

if (! function_exists ('is_emis_file')) {
    function is_emis_file($filename){
      return (pathinfo($filename, PATHINFO_EXTENSION) == 'emis') ? true : false;
    }
}

if (! function_exists ('is_valid_json')) {
    function is_valid_json($data){
      json_decode($data);
      return (json_last_error() == JSON_ERROR_NONE);
    }
}

if (! function_exists ('validate_emis_file')) {
    function validate_emis_file($request)
    {
        if ($request->hasFile('emis_file_name')) {
            // Get filename
            $file = $request->file('emis_file_name');
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get file extension
            $extension = $file->getClientOriginalExtension();

            // check if file is selected
            if (empty($file)) {
                return response()->json([
                    'status'=>'failure',
                    'message' => 'No file uploaded'
                ]);
            }

            // upload or store the file
            $path = $file->store('uploads');

            // get file content
            $file_content = Storage::disk('local')->get($path);

            // check if file is emis file
            if (!is_emis_file($filenameWithExt)) {
                return response()->json([
                    'status'=>'failure',
                    'message' => 'This is not a valid .emis file'
                ]);
            }
            // check if file content is json data
            if (!is_valid_json($file_content)) {
                return response()->json([
                    'status'=>'failure',
                    'message' => 'File content must be json'
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $file_content
            ]);

        } else {
            return response()->json([
                'status'=>'failure',
                'message' => 'File name is not properly set'
            ]);
        }
    }
}
    if (! function_exists ('request_loader')) {
        function request_loader(){
          return '
          <div id="" class="request_loader_ form-group row hide">
            <div class="col-md-6 col-md-offset-5">
                <i class="ace-icon fa fa-spinner fa-spin orange bigger-225"></i> Please wait...
            </div>
          </div>
          ';
        }
    }

    if (! function_exists ('get_months')) {
        function get_months(){
          return ['January','February','March','April','May','June','July','August','September','October','November','December'];
        }
    }
    if (! function_exists ('get_quarters')) {
        function get_quarters(){
          return ['Quarter 1','Quarter 2','Quarter 3','Quarter 4'];
        }
    }

    if (! function_exists ('get_activity_categories')) {
        function get_activity_categories()
        {
            return array(
              'supply_driven',
              'demand_driven',
            );
        }
    }

    if (! function_exists ('get_evaluation_criteria_options')) {
        function get_evaluation_criteria_options()
        {
            return array("Un-satisfactory","Moderately satisfactory","Satisfactory","Highly-Satisfactory");
        }
    }

    if (! function_exists ('get_cb_evaluation_report_training_numerics')) {
      function get_cb_evaluation_report_training_numerics($cb_activity,$child_count,$child,$total_unsat=0,$total_mod_sat=0,$total_sat=0,$total_h_sat=0){
        $unsat_count = 0;
        $mod_sat_count = 0;
        $sat_count = 0;
        $h_sat_count = 0;
        foreach ($cb_activity->participants as $person) {
          if($person->survey){
            $row_total = 0;
            $unsat_count += @$person->survey->training_evaluations->where('survey_eval_criteria_id',$child->id)->where('comment',get_evaluation_criteria_options()[0])->count();

            $mod_sat_count += @$person->survey->training_evaluations->where('survey_eval_criteria_id',$child->id)->where('comment',get_evaluation_criteria_options()[1])->count();

            $sat_count += @$person->survey->training_evaluations->where('survey_eval_criteria_id',$child->id)->where('comment',get_evaluation_criteria_options()[2])->count();

            $h_sat_count += @$person->survey->training_evaluations->where('survey_eval_criteria_id',$child->id)->where('comment',get_evaluation_criteria_options()[3])->count();
          }
        }

        $row_total = $unsat_count + $mod_sat_count + $sat_count + $h_sat_count;
        // $unsat_count++;
        $total_unsat += $unsat_count;
        $total_mod_sat += $mod_sat_count;
        $total_sat += $sat_count;
        $total_h_sat += $h_sat_count;

        $unsat_average = floor($total_unsat/$child_count);
        $mod_sat_average = floor($total_mod_sat/$child_count);
        $sat_average = floor($total_sat/$child_count);
        $h_sat_average = floor($total_h_sat/$child_count);

        $section_total_average = $unsat_average + $mod_sat_average + $sat_average + $h_sat_average;

        $unsat_percentage = floor(($unsat_average/$cb_activity->participants->count())*100);
        $mod_sat_percentage = floor(($mod_sat_average/$cb_activity->participants->count())*100);
        $sat_percentage = floor(($sat_average/$cb_activity->participants->count())*100);
        $h_sat_percentage = floor(($h_sat_average/$cb_activity->participants->count())*100);

        $row_percentage = $unsat_percentage + $mod_sat_percentage + $sat_percentage + $h_sat_percentage;

        return array(
          // Get counts
          'unsat_count'=>$unsat_count,
          'mod_sat_count'=>$mod_sat_count,
          'sat_count'=>$sat_count,
          'h_sat_count'=>$h_sat_count,
          'row_total'=>$row_total,

          // get totals
          'total_unsat'=>$total_unsat,
          'total_mod_sat'=>$total_mod_sat,
          'total_sat'=>$total_sat,
          'total_h_nsat'=>$total_h_sat,

          // get Averages
          'unsat_average'=>$unsat_average,
          'mod_sat_average'=>$mod_sat_average,
          'sat_average'=>$sat_average,
          'h_sat_average'=>$h_sat_average,
          'section_total_average'=>$section_total_average,

          // get percentages
          'unsat_percentage'=>$unsat_percentage,
          'mod_sat_percentage'=>$mod_sat_percentage,
          'sat_percentage'=>$sat_percentage,
          'h_sat_percentage'=>$h_sat_percentage

        );
      }
    }

    if(! function_exists('get_central_gov_id')){
        function get_central_gov_id(){
            return 'App\EntityType'::where("type_name", "LIKE", "%Central%")->orwhere("type_name", "LIKE", "%CG%")->first()->id;
        }
    }
    if(! function_exists('get_local_gov_id')){
        function get_local_gov_id(){
            return 'App\EntityType'::where("type_name", "LIKE", "%Local%")->orwhere("type_name", "LIKE", "%LG%")->first()->id;
        }
    }
    if(! function_exists('get_report_months')){
        function get_report_months(){
            return array(
                ['7','July'],
                ['8','August'],
                ['9','September'],
                ['10','October'],
                ['11','November'],
                ['12','December'],
                ['1','January'],
                ['2','February'],
                ['3','March'],
                ['4','April'],
                ['5','May'],
                ['6','June'],

            );
        }
    }

    if(! function_exists('get_month_name')){
        function get_month_name($monthInt){
            $months = get_months();
            return $months[$monthInt-1];
        }
    }

    if(! function_exists('get_response_types')){
        function get_response_types(){
            return array('Letter','Email','Phone Call');
        }
    }

    if(! function_exists('get_report_quarters')){
        function get_report_quarters(){
            return array(
                ['1','Quarter 1'],
                ['2','Quarter 2'],
                ['3','Quarter 3'],
                ['4','Quarter 4']

            );
        }
    }
    if(! function_exists('get_quarter_name')){
        function get_quarter_name($quarterInt){
            $quarters = get_quarters();
            return $quarters[$quarterInt-1];
        }
    }


    if (!function_exists('strip_white_space')) {

        function strip_white_space($value)
        {
            return $value == null ? $value : preg_replace('!\s+!', ' ', trim($value));
        }

    }

    if (!function_exists('get_emis_file_type_notes')) {
        function get_emis_file_type_notes($attachmentNotes)
        {
            if($attachmentNotes == null) return "";
            $arrResult = explode('-',$attachmentNotes);
            return trim($arrResult[0]);
        }
    }

    if (!function_exists('redirectBackWithSessionError')) {
        function redirectBackWithSessionError($error, $routeName = null)
        {
            \session()->flash('errorMsg', $error);
            if ($routeName == null) {
                return redirect()->back();
            }
            return \redirect(route($routeName));
        }
    }

    if (!function_exists('redirectBackWithSessionSuccess')) {
        function redirectBackWithSessionSuccess($msg, $routeName = null)
        {
            \session()->flash('successMsg', $msg);
            if ($routeName == null) {
                return redirect()->back();
            }
            return \redirect(route($routeName));
        }
    }



    if (! function_exists ('user_full_name')) {
        function user_full_name($user){
            return !isset($user) ? "" : $user->first_name .' '.$user->last_name;
        }
    }

    if (! function_exists ('user_department')) {
        function user_department($user){
            if(!isset($user)) return null;
            return !isset($user->department) ? null : $user->department->name;
        }
    }

    if (! function_exists ('user_region')) {
        function user_region($user){
            if(!isset($user)) return null;
            return !isset($user->regional_office) ? null : $user->regional_office->name;
        }
    }

    if (! function_exists ('user_designation')) {
        function user_designation($user){
            if(!isset($user)) return null;
            return !isset($user->user_designation) ? null : $user->user_designation->title;
        }
    }

    if (! function_exists ('getEmployeeFromUserList')) {
        function getEmployeeFromUserList($username, $users){

            if(!isset($users)) return null;
            foreach ($users as $user){
                if($user->username == $username){
                    return $user;
                }
            }

            return null;

        }
    }

    if (! function_exists ('getUserFullName')) {
        function getUserFullName($user){

            return isset($user) ? $user->first_name . ' ' . $user->last_name : '';

        }
    }


    if (! function_exists ('addSpaceInfrontOfCapsLetterInWord')) {
        function addSpaceInfrontOfCapsLetterInWord($value){
            return preg_replace('/(?<! )(?<!^)[A-Z]/',' $0', $value);
        }
    }

    if (! function_exists ('authenticate_module_access')) {
        function authenticate_module_access($module, $rights){
            foreach ( $rights as $right){
                if($right->area == $module && $right->access_right == ACCESS_RIGHT_GRANT_ACCESS){
                    return true;
                }
            }
            return false;
        }
    }

    if (! function_exists ('authenticate_module_subsection_access')) {
        function authenticate_module_subsection_access($module,$sub_module, $rights){
            foreach ( $rights as $right){
                $area = $module.':::'.$sub_module;
                if($right->area == $area && $right->access_right == ACCESS_RIGHT_GRANT_ACCESS){
                    return true;
                }
            }
            return false;
        }
    }

    if (! function_exists ('clear_spaces')) {
        function clear_spaces($value){
            return str_replace(' ','',$value);
        }
    }

    if (! function_exists ('get_districts')) {
        function get_districts(){
            return session(Security::$SESSION_EMIS_DISTRICTS);
        }
    }

    if (! function_exists ('get_district_name')) {
        function get_district_name($district_id){
            foreach (get_districts() as $district){
                if($district->id == $district_id) return $district->district_name;
            }
            return null;
        }
    }
    if (! function_exists ('get_hof')) {
        function get_hof(){
            return session(Security::$SESSION_HOF);
        }
    }

    if (! function_exists ('get_global_value')) {
        function get_global_value($variableName){
            try{
                $record = \App\GlobalValue::where('variable_name', $variableName)->latest()->first();
                return isset($record) ? $record->value : null;
            }catch (\Exception $exception){
                return null;
            }
        }
    }

    if (! function_exists ('get_days_to_expiry')) {
        function get_days_to_expiry($date){
            try{
                if($date == null)  return 0;
                return number_format(Carbon::now()->diffInDays(Carbon::parse($date), false));
            }catch (\Exception $exception){
                return null;
            }
        }
    }


    if (! function_exists ('get_user_by_username')) {
        function get_user_by_username($users, $username){
            try{

                foreach ($users as $user){
                    if($user->username == $username)  return $user;
                }
                return null;

            }catch (\Exception $exception){
                return null;
            }
        }
    }

    if (! function_exists ('get_dept_names')) {
        function get_dept_names(){
            return array(
                'Corporate',
                'Legal and Investigations',
                'Performance Monitoring',
                'Capacity Building',
                'Operations',
            );
        }
    }

    if (! function_exists ('format_to_currency')) {
        function format_to_currency($value, $showShillingSign = true){
            $cost = $value;
            if($cost == "" || $cost == null){
                return $cost;
            }
            $cost = number_format($cost);
            return $showShillingSign ? $cost."/="  : $cost;

        }
    }

    if (! function_exists ('form_val')) {
        function form_val($record, $fieldName, $formatToNo = false){
            return isset($record)?($formatToNo ? number_format(@$record->$fieldName):@$record->$fieldName):'';
        }
    }
    if (!  function_exists('get_expiry_status')){
        function get_expiry_status($expiry_date){
            $today = date('Y-m-d');
            if($expiry_date < $today){
                return '<span class="badge bg-danger">Expired</span>';
            }elseif($expiry_date < date('Y-m-d', strtotime('+6 months'))){
                return '<span class="badge bg-warning">Expiring</span>';
            }else{
                return '<span class="badge bg-success">Valid</span>';
            }
        }
    }
    
    if (! function_exists ('form_select_option')) {
        function form_select_option($record, $fieldName,$optionValue){
            if(!isset($record) || $record->$fieldName != $optionValue){
                return '';
            }else{
                return 'selected';
            }
        }
    }

    if (! function_exists ('form_check_radio')) {
        function form_check_radio($record, $fieldName,$optionValue){
            if(!isset($record) || $record->$fieldName != $optionValue){
                return '';
            }else{
                return 'checked';
            }
        }
    }

    if(!function_exists('get_validation_errs')){
        function get_validation_errs($validator, array $fieldsValidated) {

            //get the errors object
            $errors = $validator->errors();

            $fieldToErrorMap = array();
            foreach ($fieldsValidated as $field){

                if ($errors->has($field)) {
                    $fieldToErrorMap[$field] = $errors->first($field); //add to list of error
                }
            }
            return $fieldToErrorMap;
        }

    }

    if (!function_exists('get_app_server_db_configs')) {
        function get_app_server_db_configs()
        {
            $dbConfigs = array(
                [
                    'db_name' => 'pms',
                    'username' => DB_BACKUP_USERNAME,
                    'password' => DB_BACKUP_PASSWORD,
                    'backup_folder' => DB_BACKUP_APP_SERVER_DB_BACKUP_FOLDER.'\pms',
                ]
            );

            return $dbConfigs;

        }

    }

    if (!function_exists('db_date_time_format_db_backup')) {
        function db_date_time_format_db_backup($date)
        {
            if ($date == '' || $date == '- -- ----') return null;
            return date("Y-m-d his", strtotime($date));
        }
    }

    if (!function_exists('get_maintenance_req_type')) {
        function get_maintenance_req_type($request)
        {
            return $request->request_type;
        }
    }

    if (!function_exists('get_financial_years')) {
        function get_financial_years()
        {
            return [
                '2016-17',
                '2017-18',
                '2018-19',
                '2019-20',
                '2020-21',
                '2021-22',
                '2022-23',
                '2023-24',
                '2024-25',
                '2025-26',
                '2026-27',
            ];
        }
    }

    if (!function_exists('get_service_types')) {
        function get_service_types()
        {
            return [
                'Supplies',
                'Works',
                'Consultancy Services',
                'Non-Consultancy Services'
            ];
        }
    }

    if (!function_exists('generateInitials')) {
        function generateInitials(string $name)
        {
            $words = explode(' ', $name);
            if (count($words) >= 2) {
                return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
            }
            return makeInitialsFromSingleWord($name);
        }
    }

    if (!function_exists('makeInitialsFromSingleWord')) {
        function makeInitialsFromSingleWord(string $name) : string
        {
            preg_match_all('#([A-Z]+)#', $name, $capitals);
            if (count($capitals[1]) >= 2) {
                return substr(implode('', $capitals[1]), 0, 2);
            }
            return strtoupper(substr($name, 0, 2));
        }
    }

    if (!function_exists('getAuthUser')) {
        function getAuthUser()
        {
            return session('user');
        }
    }

    if (!function_exists('get_attached_doc_file_name_date')) {
        function get_attached_doc_file_name_date()
        {
            $date = Carbon::now();
            if (!$date  || $date == "") {
                return '';
            }
            return date("M_d_y", strtotime($date)).'_'.$date->timestamp;
        }
    }

    if (!function_exists('get_json_obj_from_array')) {
        function get_json_obj_from_array($array, $key)
        {
            return isset($array[$key]) ? json_decode(json_encode($array[$key]),false) : null;
        }
    }

    if (! function_exists ('json_print')) {
        function json_print($json) {
            if(!isset($json)){
                return $json;
            }
            return '<pre>' . json_encode(json_decode($json), JSON_PRETTY_PRINT) . '</pre>';
        }
    }

    if (! function_exists ('edit')) {
        function edit($editable) {
            return isset($editable) && $editable == true;
        }
    }

    if (! function_exists ('readonly')) {
        function readonly($editable, $isdropDown = false) {
            return edit($editable)?'':($isdropDown?'disabled':'readonly');
        }
    }

    if (! function_exists ('fuelRequestTypesIssueFrequencies')) {
        function fuelRequestTypesIssueFrequencies() {
            return
            [
                "Weekly","Biweekly","Monthly","Adhoc"
            ];
        }
    }

    if (! function_exists ('userGroupMailingList')) {
        function userGroupMailingList($groupName) {
            $group = Group::where('group_name',$groupName)->latest()->first();
            if($group == null) return [];

            $userEmails = GroupUser::where('group_id',$group->id)->get()->pluck('username')->toArray();
            return $userEmails;
        }
    }

    if (! function_exists ('models_with_readonly_doc_action')) {
        function models_with_readonly_doc_action() {
            return['App\BankAccount','App\FuelCard','App\FundsTransferLetter'];
        }
    }

    if (! function_exists ('get_request_category_name')) {
        function get_request_category_name($requestCategoryArray) {
            return $requestCategoryArray['category'];
        }
    }

    if (! function_exists ('get_request_category_mode')) {
        function get_request_category_mode($requestCategory) {
            return request_category_arr($requestCategory)['mode'];
        }
    }

    if (! function_exists ('fy_months_arr')) {
        function fy_months_arr() {
            return [FY_MONTHS_JULY,FY_MONTHS_AUGUST,FY_MONTHS_SEPTEMBER,FY_MONTHS_OCTOBER,FY_MONTHS_NOVEMBER,FY_MONTHS_DECEMBER,
                FY_MONTHS_JANUARY,FY_MONTHS_FEBRUARY,FY_MONTHS_MARCH,FY_MONTHS_APRIL,FY_MONTHS_MAY,FY_MONTHS_JUNE];
        }
    }

    if (! function_exists ('fy_months')) {
        function fy_months() {
            return  Collect(fy_months_arr())->pluck('month')->toArray();
        }
    }

    if (! function_exists ('get_fy_month_source_of_year')) {
        function get_fy_month_source_of_year($monthText) {
            $monthDetail = get_fy_month_detail($monthText);
            if(isset($monthDetail)) return  $monthDetail->yearIndicator;
            return  null;
        }
    }

    if (! function_exists ('get_fy_month_detail')) {
        function get_fy_month_detail($monthText) {
            foreach (fy_months_arr() as $month){
                if($month['month'] == $monthText) return new FyMonthDetail($monthText, $month['count'],$month['year']);
            }
            return  null;
        }
    }

    if (! function_exists ('get_fy_month_detail_by_count')) {
        function get_fy_month_detail_by_count($count) {
            foreach (fy_months_arr() as $month){
                if($month['count'] == $count) return new FyMonthDetail($month['month'], $month['count'],$month['year']);
            }
            return  null;
        }
    }

    if (! function_exists ('flush_session_msg_success')) {
        function flush_session_msg_success($msg) {
            Session::flash('successMessage', $msg);
        }
    }

    if (! function_exists ('flush_session_msg_error')) {
        function flush_session_msg_error($msg) {
            Session::flash('errorMessage', $msg);
        }
    }

    if (! function_exists ('link_text')) {
        function link_text($link) {
            if(!isset($link)) return $link;
            $link = str_replace("-"," ",$link);
            $link = ucwords($link);
            return  $link;
        }
    }

    if (! function_exists ('stringify_card_allotment_list')) {
        function stringify_card_allotment_list($allotments) {
            $list = '<ul>';
            foreach ($allotments as $allotment){
                $card = @$allotment->card->fuel_card_number;
                $date = get_user_friendly_date(@$allotment->card_transfer_date);
                $amount = format_to_currency($allotment->amount);
                $list .= '<li>'.$card.': '.$amount.'('.$date.')</li>';
            }
            $list .= '</ul>';
            return  $list;
        }
    }


    if (! function_exists ('pathToStorage')) {
        function pathToStorage() {
            $storageFolder = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
            $absoluteFileFolder = $storageFolder.'public/';
            return $absoluteFileFolder;
        }
    }

    if (! function_exists ('sort_fy_months')) {
        function sort_fy_months($months) {

            $updated = [];
            foreach ($months as $month){
                $updated[] = get_fy_month_detail($month);
            }

            usort($updated, function($a, $b) {
                if ($a->count == $b->count) {
                    return 0;
                }
                return ($a->count < $b->count) ? -1 : 1;
            });

            $sortedMonthText = [];
            foreach ($updated as $item){
                $sortedMonthText[] = $item->month;
            }

            return array_reverse($sortedMonthText);

        }
    }

if (! function_exists ('session_val_set')) {
    function session_val_set($key, $value) {
        session([$key => $value]);
    }
}

if (! function_exists ('session_val_get')) {
    function session_val_get($key) {
        return session($key);
    }
}

if (! function_exists ('display_current_action')) {
    function display_current_action($action) {
        if(preg_match('/Reassigned/',$action)){
            $str = explode('Reassigned',$action);
            return rtrim($str[0]," - ") .' <span class="badge badge-primary">Reassigned '.explode('@',$str[1])[0].'</span>';
        }elseif(preg_match('/Rejected/',$action)){
            $str = explode('Rejected',$action);
            return rtrim($str[0]," - ") .' <span class="badge badge-yellow">Rejected '.explode('@',$str[1])[0].'</span>';
        }else{
            return $action;
        }
    }
}

if(! function_exists('save_response')){
    function save_response($data){
        $save = $data['save'];
        $msg = $data['msg'];
        return response()->json([
            'status' => $save['status'],
            'message' => $save['status'] == 'success' ? 'Details Successfully Captured on '.full_date('Now').'!<br>'.$msg : '<strong>Sorry, we couldn\'t save user details now!</strong><br>'.$save['description'],
            'id' => $save['status'] == 'success' ? $save['record_id'] : null,
            'redirect' => 'wait'
            //'redirect' => false
        ]);
    }
}

if(! function_exists('isContractManager')){
    function isContractManager($contract,$username){
        $managers = $contract->contract_managers->pluck('username')->toArray();
        return in_array($username, $managers);
    }
}

if(! function_exists('getStockTurnover')){
function getStockTurnover($startDate, $endDate)
{
    // Get Cost of Goods Sold (COGS)
    $cogs = Batch::join('sales', 'batches.id', '=', 'sales.batch_id')
        ->whereBetween('sales.sales_date', [$startDate, $endDate])
        ->sum(DB::raw('batches.purchase_price * sales.quantity_sold'));

    // Get Opening Stock Value (at start of the period)
    $openingStock = Batch::whereDate('created_at', '<', $startDate)
        ->sum(DB::raw('purchase_price * available_quantity'));

    // Get Closing Stock Value (at end of the period)
    $closingStock = Batch::whereDate('created_at', '<=', $endDate)
        ->sum(DB::raw('purchase_price * available_quantity'));

    // Calculate Average Inventory Value
    $averageInventory = ($openingStock + $closingStock) / 2;

    // Calculate Stock Turnover Ratio
    $stockTurnover = ($averageInventory > 0) ? ($cogs / $averageInventory) : 0;

    return response()->json([
        'cogs' => $cogs,
        'opening_stock' => $openingStock,
        'closing_stock' => $closingStock,
        'average_inventory' => $averageInventory,
        'stock_turnover' => $stockTurnover,
    ]);
}
}