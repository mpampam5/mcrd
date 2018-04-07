<?php
function me($value)
{
  return config_item($value);
}

function directory($value)
{
  return config_item($value);
}
function sess($str)
{
  $ci = get_instance();
   return $ci->session->userdata("$str");
}


function cmb_dinamis($id,$name,$table,$field,$pk,$selected){
    $ci = get_instance();
    $cmb = "<select name='$name' id='$id' class='form-control'>";
    $data = $ci->db->get($table)->result();
    if ($selected==null) {
      $cmb .="<option value=''>--pilih--</option>";
    }
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".$d->$field."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function cmb_menu($id,$name,$table,$field,$pk,$selected){
    $ci = get_instance();
    $cmb = "<select name='$name' id='$id' class='form-control'>";
    $data = $ci->db->get($table)->result();
    if ($selected==null) {
      $cmb .="<option value='0'>Ya</option>";
    }else {
      $cmb .="<option value='0'";
      $cmb .= $selected==0?" selected='selected'":'';
      $cmb .=">YA</option>";
    }
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  strtoupper($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;
}


function groups($table,$id_level,$id_menus)
{
  $ci = get_instance();
  $query = $ci->db->where(array("id_level"=>$id_level))->get($table);

  if ($query->num_rows()>0) {
    $menu = $query->row();
    if ($menu->access!=null) {
      $menus=json_decode($menu->access,true);
      if (in_array($id_menus,$menus)) {
        return true;
      }else {
        return false;
      }
    }else {
      return false;
    }

  }
}
