<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailingList extends Model
{

    public static function laratablesCustomAction($mailing_list)
    {
        $data = [
            'mailing_list'=>$mailing_list
        ];
        return view('actions.mailing_list_actions')->with($data)->render();
    }


    public function setEmailAddressesAttribute($value)
    {

        $validEmails = '';
        $noSpaces = preg_replace('/\s+/', '', $value);
        $noSpacesArr = explode(',',$noSpaces);

        $i = 0;
        foreach ($noSpacesArr as $item){
            $validEmails .= $i == 0 ? $item : ','.$item;
            $i++;
        }

        $this->attributes['addresses'] = $validEmails;
    }


}
