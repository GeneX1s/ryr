<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Models\UserBankAccount;

class GetGeneralData
{
	public static function get_familiy_relation()
	{
		$family_relation = DB::table('_option_map')->select('_val')->where('category', 'Family Relation')->get();
		$data = [];
		foreach ($family_relation as $relation) {
			array_push($data, $relation->_val);
		}
		return $data;
	}

	public static function get_contact_types()
	{
		$types = [
			'Email',
			'Phone',
			'Whatsapp',
			'Line',
			'Facebook',
			'Twitter',
			'Instagram',
			'LinkedIn',
			'Youtube',
			'Website',
			'Other'
		];
		return $types;
	}

	public static function get_type_id()
	{
		$types = [
			"KTP",
			"KK",
			"SIM A",
			"SIM B",
			"SIM C",
			"NPWP",

		];
		return $types;
	}

	public static function get_religion()
	{
		$religion = [
			'BUDHA',
			'HINDU',
			'MOSLEM',
			'CATHOLIC',
			'Budha',
			'KHONGHUCU',
			'PROTESTANT'
		];
		return $religion;
	}

	public static function get_education_level()
	{
		$education = [
			'SD',
			'SMP',
			'SMA',
			'SMK',
			'D1',
			'D2',
			'D3',
			'D4',
			'S1',
			'S2',
			'S3'
		];
		return $education;
	}

	public static function get_question_other_information()
	{
		$question = [
			"visi",
			"kelebihan",
			'kelemahan',
			"alasan ingin bergabung",
			"informasi lowongan",
			"yang menyarankan",
			"posisi yang diinginkan kedepan",
			"cita-cita pekerjaan",
			"jenis pekerjaan",
			"jenis lingkungan kerja",
			"orang paling disenangi",
			"orang paling tidak disenangi",
			"situasi sulit mengambil keputusan",
			"pernah melamar di perusahaan atau grup",
			"punya kenalan",
			"pernah dirawat di rumah sakit",
			"pernah diberhentikan",
			"pinjaman kredit atau  online",
			"mengikuti rekrutmen di perusahaan lain",
			"masih terikat kontrak",
			"pekerjaan sampingan",
			"pernah mengikuti psikotes",
			"keluarga yang mempunyai penyakit kronis",
			"bersedia ditempatkan di luar kota",
			"pernah ke luar negeri",
			"gaji pokok",
			"tunjangan transportasi",
			"tunjangan handphone",
			"tunjangan lainnya",
			"fasilitas mobil",
			"fasilitas transportasi",
			"fasilitas handphone",
			"fasilitas kesehatan",
			"fasilitas kacamata",
			"fasilitas dana pensiun",
			"fasilitas lainnya",
			"gaji yang diharapkan",
		];
		return $question;
	}

	/*
	Fungsi ini digunakan untuk mendapatkan jumlah karyawan saat ini dengan parameter hirarki posisi
	*/
	public static function current_position_total($hierarchy)
	{
		$count = DB::table('v_account')->where('we_job_title_key', $hierarchy)->count();
		return $count;
	}

	public static function get_author($token = null)
	{
		if ($token == null) {
			return "Not Have Access";
		}

		$bearer = $token;
		$token = explode(".", $bearer);
		$token = base64_decode($token[1]);
		$token = json_decode($token);
		$cserial = $token->data->cserial;
		$user = Redis::get(env('REDIS_PREFIX') . $cserial);
		$user = json_decode($user);
		return $user;
	}

	public static function key_val_option_map($key)
	{
		$result = DB::table('_option_map')
			->where('_status', 'Active')
			->where('_key', $key)
			->select(
				'_key',
				'_val',
			)
			->first();

		if (is_null($result)) {
			$key_val = NULL;
		} else if ($result->_key == NULL) {
			$key_val = NULL;
		} else {
			$key_val = $result;
		}

		return $key_val;
	}

	public static function get_job_title($serial)
	{
		$job_title = DB::table('v_account')
			->select(
				'we_job_title_key AS _key',
				'we_job_title AS _val',
			)
			->where('serial', $serial)
			->first();

		return $job_title;
	}

	// public static function get_bag_account($serial_account)
	// {
	// 	$bank_account = UserBankAccount::where('serial_account', $serial_account)->where("bank_name", "LIKE", "%Bank Artha Graha%")->get();
	// 	return $bank_account;
	// }

	// public static function get_all_bank_account($serial_account)
	// {
	// 	$bank_account = UserBankAccount::where('serial_account', $serial_account)->get();

	// 	return $bank_account;
	// }

	public static function get_all_bank()
	{
		$data = ' [
			{
				"id": "7",
				"text": "Bank Artha Graha"
			},
			{
				"id": "1",
				"text": "Bank BCA"
			},
			{
				"id": "10",
				"text": "Bank BII"
			},
			{
				"id": "17",
				"text": "Bank BJB"
			},
			{
				"id": "3",
				"text": "Bank BNI"
			},
			{
				"id": "4",
				"text": "Bank BRI"
			},
			{
				"id": "5",
				"text": "Bank BTN"
			},
			{
				"id": "21",
				"text": "Bank BTPN"
			},
			{
				"id": "14",
				"text": "Bank Bukopin"
			},
			{
				"id": "6",
				"text": "Bank CIMB Niaga"
			},
			{
				"id": "18",
				"text": "Bank DKI"
			},
			{
				"id": "8",
				"text": "Bank Danamon"
			},
			{
				"id": "23",
				"text": "Bank Lainnya"
			},
			{
				"id": "2",
				"text": "Bank Mandiri"
			},
			{
				"id": "11",
				"text": "Bank Maybank"
			},
			{
				"id": "16",
				"text": "Bank Mega"
			},
			{
				"id": "20",
				"text": "Bank Muamalat"
			},
			{
				"id": "12",
				"text": "Bank OCBC NISP"
			},
			{
				"id": "13",
				"text": "Bank Panin"
			},
			{
				"id": "9",
				"text": "Bank Permata"
			},
			{
				"id": "22",
				"text": "Bank Sinarmas"
			},
			{
				"id": "19",
				"text": "Bank Syariah Indonesia"
			},
			{
				"id": "15",
				"text": "Bank UOB Indonesia"
			}
		]';

		$data = json_decode($data, true);
		// return self::sortBankData($data);
		return $data;
	}
	private static function sortBankData($data)
	{
		$data = json_decode($data, true);

		usort($data, function ($a, $b) {
			return strcmp($a['text'], $b['text']);
		});

		return $data;
	}
}
