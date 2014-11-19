<?PHP

//GIF类
Class GifCaptcha {

	Private Static $Txt = '';   //GIF mess
	Private Static $Img = 'GIF89a'; //GIF header 6 bytes
	Private Static $Debug = False; //Is open Debug?
	Private Static $BUF = Array();
	Private Static $LOP = 0;
	Private Static $DIS = 2;
	Private Static $COL = -1;
	Private Static $IMG = -1;

	/**
	  生成GIF图片验证
	  @param $W 宽度
	  @param $H 高度
	  @param $B 背景色
	  /* */
	public static function init($W = 75, $H = 25, $B = '') {
		$chars = 'bcdefhkmnrstuvwxyABCDEFGHKMNPRSTUVWXY34568';
		$length = rand(4, 6);
		for ($i = 0; $i < $length; $i++) {
			self::$Txt .= SubStr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}

		unset($chars);
		IF ($B == '' || stristr($B, ',') == False || substr_count($B, ',') != 2) {
			$B = '255,255,255';
		}
		$B = explode(',', $B);

		//生成一个多帧的GIF动画
		For ($i = 0; $i < 7; $i++) {
			$Im = imagecreate($W, $H);

			//背景
			$bg = imagecolorallocate($Im, $B[0], $B[1], $B[2]);
			imagecolortransparent($Im, $bg);
			unset($bg);
			$mypath = dirname(__FILE__);

			//文字
			$txt = imagecolorallocate($Im, 35, 35, 35);
			$length = strlen(self::$Txt);
			for ($j = 0; $j < $length; $j++) {
				imagettftext($Im, rand(15, 26), rand(-15, 25), rand(0, 15) + $j * 26, rand(0, 5) + $H - 10, $txt, $mypath . '/fonts/spdrhh3db.ttf', self::$Txt[$j]);
			}
			unSet($j);
			unset($length);
			unset($txt);
			imagegif($Im);
			imagedestroy($Im);

			$Imdata[] = ob_get_contents();
			ob_clean();
		}
		unset($W, $H, $B);
		IF (self::$Debug) {
			echo '<pre>', var_dump($Imdata), '</pre>';
			die();
		}
		header('Content-type:image/gif');
		echo self::CreatGif($Imdata, 50);
		return self::$Txt;
	}

	private static function CreatGif($GIF_src, $GIF_dly = 100, $GIF_lop = 0, $GIF_dis = 0, $GIF_red = 0, $GIF_grn = 0, $GIF_blu = 0, $GIF_mod = 'bin') {
		IF (!is_array($GIF_src) && !is_array($GIF_tim)) {
			die('Error:' . __LINE__ . ',Does not supported function for only one image!!');
		}
		self::$LOP = ($GIF_lop > -1) ? $GIF_lop : 0;
		self::$DIS = ($GIF_dis > -1) ? (($GIF_dis < 3) ? $GIF_dis : 3) : 2;
		self::$COL = ($GIF_red > -1 && $GIF_grn > -1 && $GIF_blu > -1) ? ($GIF_red | ($GIF_grn << 8) | ($GIF_blu << 16)) : -1;
		for ($i = 0, $src_count = count($GIF_src); $i < $src_count; $i++) {
			if (strtolower($GIF_mod) == 'url') {
				self::$BUF[] = fread(fopen($GIF_src[$i], 'rb'), filesize($GIF_src[$i]));
			} elseif (strtolower($GIF_mod) == 'bin') {
				self::$BUF[] = $GIF_src[$i];
			} else {
				die('Error:' . __LINE__ . ',Unintelligible flag (' . $GIF_mod . ')!');
			}
			if (!(substr(self::$BUF[$i], 0, 6) == 'GIF87a' || substr(self::$BUF[$i], 0, 6) == 'GIF89a')) {
				die('Error:' . __LINE__ . ',Source ' . $i . ' is not a GIF image!');
			}
			for ($j = (13 + 3 * (2 << (ord(self::$BUF[$i]{10}) & 0x07))), $k = TRUE; $k; $j++) {
				switch (self::$BUF[$i]{$j}) {
					case '!':
						if ((substr(self::$BUF[$i], ($j + 3), 8)) == 'NETSCAPE') {
							die('Error:' . __LINE__ . ',Could not make animation from animated GIF source (' . ($i + 1) . ')!');
						}
						break;
					case ';':
						$k = FALSE;
						break;
				}
			}
		}
		self::AddHeader();
		for ($i = 0, $count_buf = count(self::$BUF); $i < $count_buf; $i++) {
			self::AddFrames($i, $GIF_dly);
		}
		self::$Img .= ';';
		return (self::$Img);
	}

	private static function AddHeader() {
		$i = 0;
		if (ord(self::$BUF[0]{10}) & 0x80) {
			$i = 3 * (2 << (ord(self::$BUF[0]{10}) & 0x07));
			self::$Img .= substr(self::$BUF[0], 6, 7);
			self::$Img .= substr(self::$BUF[0], 13, $i);
			self::$Img .= "!\377\13NETSCAPE2.0\3\1" . chr(self::$LOP & 0xFF) . chr((self::$LOP >> 8) & 0xFF) . "\0";
		}
		unset($i);
	}

	private static function AddFrames($i, $d) {
		$L_str = 13 + 3 * (2 << (ord(self::$BUF[$i]{10}) & 0x07));
		$L_end = strlen(self::$BUF[$i]) - $L_str - 1;
		$L_tmp = substr(self::$BUF[$i], $L_str, $L_end);
		$G_len = 2 << (ord(self::$BUF[0]{10}) & 0x07);
		$L_len = 2 << (ord(self::$BUF[$i]{10}) & 0x07);
		$G_rgb = substr(self::$BUF[0], 13, 3 * (2 << (ord(self::$BUF[0]{10}) & 0x07)));
		$L_rgb = substr(self::$BUF[$i], 13, 3 * (2 << (ord(self::$BUF[$i]{10}) & 0x07)));
		$L_ext = "!\xF9\x04" . chr((self::$DIS << 2) + 0) . chr(($d >> 0) & 0xFF) . chr(($d >> 8) & 0xFF) . "\x0\x0";
		if (self::$COL > -1 && ord(self::$BUF[$i]{10}) & 0x80) {
			for ($j = 0; $j < (2 << (ord(self::$BUF[$i]{10}) & 0x07)); $j++) {
				if (ord($L_rgb{3 * $j + 0}) == (self::$COL >> 0) & 0xFF && ord($L_rgb{3 * $j + 1}) == (self::$COL >> 8) & 0xFF && ord($L_rgb{3 * $j + 2}) == (self::$COL >> 16) & 0xFF) {
					$L_ext = "!\xF9\x04" . chr((self::$DIS << 2) + 1) . chr(($d >> 0) & 0xFF) . chr(($d >> 8) & 0xFF) . chr($j) . "\x0";
					break;
				}
			}
		}
		switch ($L_tmp{0}) {
			case '!':
				$L_img = substr($L_tmp, 8, 10);
				$L_tmp = substr($L_tmp, 18, strlen($L_tmp) - 18);
				break;
			case ',':
				$L_img = substr($L_tmp, 0, 10);
				$L_tmp = substr($L_tmp, 10, strlen($L_tmp) - 10);
				break;
		}
		if (ord(self::$BUF[$i]{10}) & 0x80 && self::$IMG > -1) {
			if ($G_len == $L_len) {
				if (self::compare($G_rgb, $L_rgb, $G_len)) {
					self::$Img .= ($L_ext . $L_img . $L_tmp);
				} else {
					$byte = ord($L_img{9});
					$byte |= 0x80;
					$byte &= 0xF8;
					$byte |= (ord(self::$BUF[0]{10}) & 0x07);
					$L_img{9} = chr($byte);
					self::$Img .= ($L_ext . $L_img . $L_rgb . $L_tmp);
				}
			} else {
				$byte = ord($L_img{9});
				$byte |= 0x80;
				$byte &= 0xF8;
				$byte |= (ord(self::$BUF[$i]{10}) & 0x07);
				$L_img{9} = chr($byte);
				self::$Img .= ($L_ext . $L_img . $L_rgb . $L_tmp);
			}
		} else {
			self::$Img .= ($L_ext . $L_img . $L_tmp);
		}
		self::$IMG = 1;
	}

	private static function Compare($G_Block, $L_Block, $Len) {
		for ($i = 0; $i < $Len; $i++) {
			if ($G_Block{3 * $i + 0} != $L_Block{3 * $i + 0} || $G_Block{3 * $i + 1} != $L_Block{3 * $i + 1} || $G_Block{3 * $i + 2} != $L_Block{3 * $i + 2}) {
				return (0);
			}
		}
		return (1);
	}

}
