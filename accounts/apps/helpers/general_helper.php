<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function mythumb($name) {
  $ext = explode('.', $name);
  $data = $ext[0] . '_thumb.' . $ext[1];

  return $data;
}

function mymediam($name) {
  $ext = explode('.', $name);
  $data = $ext[0] . '_mediam.' . $ext[1];

  return $data;
}

function getMonthString($n) {
  $timestamp = mktime(0, 0, 0, $n, 1, 2005);
  return date("M", $timestamp);
}

function date_to_db($ui_date){
  $temp = explode('/', $ui_date);
  $db_date = $temp[2] . '-' . $temp[1] . '-' . $temp[0];
  return $db_date;
}

function date_to_ui($db_date){
  $temp = explode('-', $db_date);
  $ui_date = $temp[2] . '/' . $temp[1] . '/' . $temp[0];
  return $ui_date;
}


function sum_subarrays_by_key($arr, $key) {
  $sum = 0;
  foreach ($arr as $sub_array1) {
    $sum += $sub_array1[$key];
    if (isset($sub_array1['child'])) {
      foreach ($sub_array1['child'] as $sub_array2) {
        $sum += $sub_array2[$key];
        if (isset($sub_array2['child'])) {
          foreach ($sub_array2['child'] as $sub_array3) {
            $sum += $sub_array3[$key];
            if (isset($sub_array3['child'])) {
              foreach ($sub_array3['child'] as $sub_array4) {
                $sum += $sub_array4[$key];
                if (isset($sub_array4['child'])) {
                  foreach ($sub_array4['child'] as $sub_array5) {
                    $sum += $sub_array5[$key];
                    if (isset($sub_array5['child'])) {
                      foreach ($sub_array5['child'] as $sub_array6) {
                        $sum += $sub_array6[$key];
                        if (isset($sub_array6['child'])) {
                          foreach ($sub_array6['child'] as $sub_array7) {
                            $sum += $sub_array7[$key];
                            if (isset($sub_array7['child'])) {
                              foreach ($sub_array7['child'] as $sub_array8) {
                                $sum += $sub_array8[$key];
                                if (isset($sub_array8['child'])) {
                                  foreach ($sub_array8['child'] as $sub_array9) {
                                    $sum += $sub_array9[$key];
                                    if (isset($sub_array9['child'])) {
                                      foreach ($sub_array9['child'] as $sub_array10) {
                                        $sum += $sub_array10[$key];
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
  return $sum;
}

/*
$array - nothing to say
$group_keys - columns which have to be grouped - can be STRING or ARRAY (STRING, STRING[, ...])
$sum_keys - columns which have to be summed - can be STRING or ARRAY (STRING, STRING[, ...])
$count_key - must be STRING - count the grouped keys
*/
function array_distinct($array, $group_keys, $sum_keys = NULL, $count_key = NULL) {
  if (!is_array($group_keys))
    $group_keys = array($group_keys);
  if (!is_array($sum_keys))
    $sum_keys = array($sum_keys);

  $existing_sub_keys = array();
  $output = array();

  foreach ($array as $key => $sub_array) {
    $puffer = NULL;
    #group keys
    foreach ($group_keys as $group_key) {
      $puffer .= $sub_array[$group_key];
    }
    $puffer = serialize($puffer);
    if (!in_array($puffer, $existing_sub_keys)) {
      $existing_sub_keys[$key] = $puffer;
      $output[$key] = $sub_array;
    } else {
      $puffer = array_search($puffer, $existing_sub_keys);
      #sum keys
      foreach ($sum_keys as $sum_key) {
        if (is_string($sum_key))
          $output[$puffer][$sum_key] += $sub_array[$sum_key];
      }
      #count grouped keys
      if (!array_key_exists($count_key, $output[$puffer]))
        $output[$puffer][$count_key] = 1;
      if (is_string($count_key))
        $output[$puffer][$count_key]++;
    }
  }
  return $output;
}

function array_sort($array, $on, $order=SORT_ASC) {
  $new_array = array();
  $sortable_array = array();

  if (count($array) > 0) {
    foreach ($array as $k => $v) {
      if (is_array($v)) {
        foreach ($v as $k2 => $v2) {
          if ($k2 == $on) {
            $sortable_array[$k] = $v2;
          }
        }
      } else {
        $sortable_array[$k] = $v;
      }
    }

    switch ($order) {
      case SORT_ASC:
        asort($sortable_array);
        break;
      case SORT_DESC:
        arsort($sortable_array);
        break;
    }

    foreach ($sortable_array as $k => $v) {
      $new_array[$k] = $array[$k];
    }
  }

  return $new_array;
}

/*
  $people = array(
  12345 => array(
  'id' => 12345,
  'first_name' => 'Joe',
  'surname' => 'Bloggs',
  'age' => 23,
  'sex' => 'm'
  ),
  12346 => array(
  'id' => 12346,
  'first_name' => 'Adam',
  'surname' => 'Smith',
  'age' => 18,
  'sex' => 'm'
  ),
  12347 => array(
  'id' => 12347,
  'first_name' => 'Amy',
  'surname' => 'Jones',
  'age' => 21,
  'sex' => 'f'
  )
  );

  print_r(array_sort($people, 'age', SORT_DESC)); // Sort by oldest first
  print_r(array_sort($people, 'surname', SORT_ASC)); // Sort by surname
 */

function country_list() {
  return '
  <option value="AF">Afghanistan (??????????????????)</option>
  <option value="AX">Aland Islands</option>
  <option value="AL">Albania (Shqip??ria)</option>
  <option value="DZ">Algeria (??????????????)</option>
  <option value="AS">American Samoa</option>
  <option value="AD">Andorra</option>
  <option value="AO">Angola</option>
  <option value="AI">Anguilla</option>
  <option value="AQ">Antarctica</option>
  <option value="AG">Antigua and Barbuda</option>
  <option value="AR">Argentina</option>
  <option value="AM">Armenia (????????????????)</option>
  <option value="AW">Aruba</option>
  <option value="AU">Australia</option>
  <option value="AT">Austria (??sterreich)</option>
  <option value="AZ">Azerbaijan (Az??rbaycan)</option>
  <option value="BS">Bahamas</option>
  <option value="BH">Bahrain (??????????????)</option>
  <option selected="" value="BD">Bangladesh (????????????????????????)</option>
  <option value="BB">Barbados</option>
  <option value="BY">Belarus (??????????????????)</option>
  <option value="BE">
  Belgium (Belgi??)
  </option>
  <option value="BZ">
  Belize
  </option>
  <option value="BJ">
  Benin (B??nin)
  </option>
  <option value="BM">
  Bermuda
  </option>
  <option value="BT">
  Bhutan (???????????????????????????)
  </option>
  <option value="BO">
  Bolivia
  </option>
  <option value="BA">
  Bosnia and Herzegovina (Bosna i Hercegovina)
  </option>
  <option value="BW">
  Botswana
  </option>
  <option value="BV">
  Bouvet Island
  </option>
  <option value="BR">
  Brazil (Brasil)
  </option>
  <option value="IO">
  British Indian Ocean Territory
  </option>
  <option value="BN">
  Brunei (Brunei Darussalam)
  </option>
  <option value="BG">
  Bulgaria (????????????????)
  </option>
  <option value="BF">
  Burkina Faso
  </option>
  <option value="BI">
  Burundi (Uburundi)
  </option>
  <option value="KH">
  Cambodia (Kampuchea)
  </option>
  <option value="CM">
  Cameroon (Cameroun)
  </option>
  <option value="CA">
  Canada
  </option>
  <option value="CV">
  Cape Verde (Cabo Verde)
  </option>
  <option value="KY">
  Cayman Islands
  </option>
  <option value="CF">
  Central African Republic (R??publique Centrafricaine)
  </option>
  <option value="TD">
  Chad (Tchad)
  </option>
  <option value="CL">
  Chile
  </option>
  <option value="CN">
  China (??????)
  </option>
  <option value="CX">
  Christmas Island
  </option>
  <option value="CC">
  Cocos Islands
  </option>
  <option value="CO">
  Colombia
  </option>
  <option value="KM">
  Comoros (Comores)
  </option>
  <option value="CG">
  Congo
  </option>
  <option value="CD">
  Congo, Democratic Republic of the
  </option>
  <option value="CK">
  Cook Islands
  </option>
  <option value="CR">
  Costa Rica
  </option>
  <option value="CI">
  C??te d Ivoire
  </option>
  <option value="HR">
  Croatia (Hrvatska)
  </option>
  <option value="CU">
  Cuba
  </option>
  <option value="CY">
  Cyprus (????????????)
  </option>
  <option value="CZ">
  Czech Republic (??esko)
  </option>
  <option value="DK">
  Denmark (Danmark)
  </option>
  <option value="DJ">
  Djibouti
  </option>
  <option value="DM">
  Dominica
  </option>
  <option value="DO">
  Dominican Republic
  </option>
  <option value="EC">
  Ecuador
  </option>
  <option value="EG">
  Egypt (??????)
  </option>
  <option value="SV">
  El Salvador
  </option>
  <option value="GQ">
  Equatorial Guinea (Guinea Ecuatorial)
  </option>
  <option value="ER">
  Eritrea (Ertra)
  </option>
  <option value="EE">
  Estonia (Eesti)
  </option>
  <option value="ET">
  Ethiopia
  </option>
  <option value="FK">
  Falkland Islands
  </option>
  <option value="FO">
  Faroe Islands
  </option>
  <option value="FJ">
  Fiji
  </option>
  <option value="FI">
  Finland (Suomi)
  </option>
  <option value="FR">
  France
  </option>
  <option value="GF">
  French Guiana
  </option>
  <option value="PF">
  French Polynesia
  </option>
  <option value="TF">
  French Southern Territories
  </option>
  <option value="GA">
  Gabon
  </option>
  <option value="GM">
  Gambia
  </option>
  <option value="GE">
  Georgia (??????????????????????????????)
  </option>
  <option value="DE">
  Germany (Deutschland)
  </option>
  <option value="GH">
  Ghana
  </option>
  <option value="GI">
  Gibraltar
  </option>
  <option value="GR">
  Greece (??????????)
  </option>
  <option value="GL">
  Greenland
  </option>
  <option value="GD">
  Grenada
  </option>
  <option value="GP">
  Guadeloupe
  </option>
  <option value="GU">
  Guam
  </option>
  <option value="GT">
  Guatemala
  </option>
  <option value="GG">
  Guernsey
  </option>
  <option value="GN">
  Guinea (Guin??e)
  </option>
  <option value="GW">
  Guinea-Bissau (Guin??-Bissau)
  </option>
  <option value="GY">
  Guyana
  </option>
  <option value="HT">
  Haiti (Ha??ti)
  </option>
  <option value="HM">
  Heard Island and McDonald Islands
  </option>
  <option value="HN">
  Honduras
  </option>
  <option value="HK">
  Hong Kong
  </option>
  <option value="HU">
  Hungary (Magyarorsz??g)
  </option>
  <option value="IS">
  Iceland (??sland)
  </option>
  <option value="IN">
  India
  </option>
  <option value="ID">
  Indonesia
  </option>
  <option value="IR">
  Iran (??????????)
  </option>
  <option value="IQ">
  Iraq (????????????)
  </option>
  <option value="IE">
  Ireland
  </option>
  <option value="IM">
  Isle of Man
  </option>
  <option value="IL">
  Israel (??????????)
  </option>
  <option value="IT">
  Italy (Italia)
  </option>
  <option value="JM">
  Jamaica
  </option>
  <option value="JP">
  Japan (??????)
  </option>
  <option value="JE">
  Jersey
  </option>
  <option value="JO">
  Jordan (????????????)
  </option>
  <option value="KZ">
  Kazakhstan (??????????????????)
  </option>
  <option value="KE">
  Kenya
  </option>
  <option value="KI">
  Kiribati
  </option>
  <option value="KW">
  Kuwait (????????????)
  </option>
  <option value="KG">
  Kyrgyzstan (????????????????????)
  </option>
  <option value="LA">
  Laos (????????????)
  </option>
  <option value="LV">
  Latvia (Latvija)
  </option>
  <option value="LB">
  Lebanon (??????????)
  </option>
  <option value="LS">
  Lesotho
  </option>
  <option value="LR">
  Liberia
  </option>
  <option value="LY">
  Libya (??????????)
  </option>
  <option value="LI">
  Liechtenstein
  </option>
  <option value="LT">
  Lithuania (Lietuva)
  </option>
  <option value="LU">
  Luxembourg (L??tzebuerg)
  </option>
  <option value="MO">
  Macao
  </option>
  <option value="MK">
  Macedonia (????????????????????)
  </option>
  <option value="MG">
  Madagascar (Madagasikara)
  </option>
  <option value="MW">
  Malawi
  </option>
  <option value="MY">
  Malaysia
  </option>
  <option value="MV">
  Maldives (???????????????? ??????????????????????)
  </option>
  <option value="ML">
  Mali
  </option>
  <option value="MT">
  Malta
  </option>
  <option value="MH">
  Marshall Islands
  </option>
  <option value="MQ">
  Martinique
  </option>
  <option value="MR">
  Mauritania (??????????????????)
  </option>
  <option value="MU">
  Mauritius
  </option>
  <option value="YT">
  Mayotte
  </option>
  <option value="MX">
  Mexico (M??xico)
  </option>
  <option value="FM">
  Micronesia
  </option>
  <option value="MD">
  Moldova
  </option>
  <option value="MC">
  Monaco
  </option>
  <option value="MN">
  Mongolia (???????????? ??????)
  </option>
  <option value="ME">
  Montenegro (???????? ????????)
  </option>
  <option value="MS">
  Montserrat
  </option>
  <option value="MA">
  Morocco (????????????)
  </option>
  <option value="MZ">
  Mozambique (Mo??ambique)
  </option>
  <option value="MM">
  Myanmar (Burma)
  </option>
  <option value="NA">
  Namibia
  </option>
  <option value="NR">
  Nauru (Naoero)
  </option>
  <option value="NP">
  Nepal (???????????????)
  </option>
  <option value="NL">
  Netherlands (Nederland)
  </option>
  <option value="AN">
  Netherlands Antilles
  </option>
  <option value="NC">
  New Caledonia
  </option>
  <option value="NZ">
  New Zealand
  </option>
  <option value="NI">
  Nicaragua
  </option>
  <option value="NE">
  Niger
  </option>
  <option value="NG">
  Nigeria
  </option>
  <option value="NU">
  Niue
  </option>
  <option value="NF">
  Norfolk Island
  </option>
  <option value="MP">
  Northern Mariana Islands
  </option>
  <option value="KP">
  North Korea (??????)
  </option>
  <option value="NO">
  Norway (Norge)
  </option>
  <option value="OM">
  Oman (????????)
  </option>
  <option value="PK">
  Pakistan (??????????????)
  </option>
  <option value="PW">
  Palau (Belau)
  </option>
  <option value="PS">
  Palestinian Territories
  </option>
  <option value="PA">
  Panama (Panam??)
  </option>
  <option value="PG">
  Papua New Guinea
  </option>
  <option value="PY">
  Paraguay
  </option>
  <option value="PE">
  Peru (Per??)
  </option>
  <option value="PH">
  Philippines (Pilipinas)
  </option>
  <option value="PN">
  Pitcairn
  </option>
  <option value="PL">
  Poland (Polska)
  </option>
  <option value="PT">
  Portugal
  </option>
  <option value="PR">
  Puerto Rico
  </option>
  <option value="QA">
  Qatar (??????)
  </option>
  <option value="RE">
  Reunion
  </option>
  <option value="RO">
  Romania (Rom??nia)
  </option>
  <option value="RU">
  Russia (????????????)
  </option>
  <option value="RW">
  Rwanda
  </option>
  <option value="SH">
  Saint Helena
  </option>
  <option value="KN">
  Saint Kitts and Nevis
  </option>
  <option value="LC">
  Saint Lucia
  </option>
  <option value="PM">
  Saint Pierre and Miquelon
  </option>
  <option value="VC">
  Saint Vincent and the Grenadines
  </option>
  <option value="WS">
  Samoa
  </option>
  <option value="SM">
  San Marino
  </option>
  <option value="ST">
  S??o Tom?? and Pr??ncipe
  </option>
  <option value="SA">
  Saudi Arabia (?????????????? ?????????????? ????????????????)
  </option>
  <option value="SN">
  Senegal (S??n??gal)
  </option>
  <option value="RS">
  Serbia (????????????)
  </option>
  <option value="CS">
  Serbia and Montenegro (???????????? ?? ???????? ????????)
  </option>
  <option value="SC">
  Seychelles
  </option>
  <option value="SL">
  Sierra Leone
  </option>
  <option value="SG">
  Singapore (Singapura)
  </option>
  <option value="SK">
  Slovakia (Slovensko)
  </option>
  <option value="SI">
  Slovenia (Slovenija)
  </option>
  <option value="SB">
  Solomon Islands
  </option>
  <option value="SO">
  Somalia (Soomaaliya)
  </option>
  <option value="ZA">
  South Africa
  </option>
  <option value="GS">
  South Georgia and the South Sandwich Islands
  </option>
  <option value="KR">
  South Korea (??????)
  </option>
  <option value="ES">
  Spain (Espa??a)
  </option>
  <option value="LK">
  Sri Lanka
  </option>
  <option value="SD">
  Sudan (??????????????)
  </option>
  <option value="SR">
  Suriname
  </option>
  <option value="SJ">
  Svalbard and Jan Mayen
  </option>
  <option value="SZ">
  Swaziland
  </option>
  <option value="SE">
  Sweden (Sverige)
  </option>
  <option value="CH">
  Switzerland (Schweiz)
  </option>
  <option value="SY">
  Syria (??????????)
  </option>
  <option value="TW">
  Taiwan (??????)
  </option>
  <option value="TJ">
  Tajikistan (????????????????????)
  </option>
  <option value="TZ">
  Tanzania
  </option>
  <option value="TH">
  Thailand (??????????????????????????????????????????)
  </option>
  <option value="TL">
  Timor-Leste
  </option>
  <option value="TG">
  Togo
  </option>
  <option value="TK">
  Tokelau
  </option>
  <option value="TO">
  Tonga
  </option>
  <option value="TT">
  Trinidad and Tobago
  </option>
  <option value="TN">
  Tunisia (????????)
  </option>
  <option value="TR">
  Turkey (T??rkiye)
  </option>
  <option value="TM">
  Turkmenistan (T??rkmenistan)
  </option>
  <option value="TC">
  Turks and Caicos Islands
  </option>
  <option value="TV">
  Tuvalu
  </option>
  <option value="UG">
  Uganda
  </option>
  <option value="UA">
  Ukraine (??????????????)
  </option>
  <option value="AE">
  United Arab Emirates (???????????????? ???????????????? ????????????????)
  </option>
  <option value="GB">
  United Kingdom
  </option>
  <option value="US">
  United States
  </option>
  <option value="UM">
  United States minor outlying islands
  </option>
  <option value="UY">
  Uruguay
  </option>
  <option value="UZ">
  Uzbekistan (O zbekiston)
  </option>
  <option value="VU">
  Vanuatu
  </option>
  <option value="VA">
  Vatican City (Citt?? del Vaticano)
  </option>
  <option value="VE">
  Venezuela
  </option>
  <option value="VN">
  Vietnam (Vi???t Nam)
  </option>
  <option value="VG">
  Virgin Islands, British
  </option>
  <option value="VI">
  Virgin Islands, U.S.
  </option>
  <option value="WF">
  Wallis and Futuna
  </option>
  <option value="EH">
  Western Sahara (?????????????? ??????????????)
  </option>
  <option value="YE">
  Yemen (??????????)
  </option>
  <option value="ZM">
  Zambia
  </option>
  <option value="ZW">
  Zimbabwe
  </option>';
}