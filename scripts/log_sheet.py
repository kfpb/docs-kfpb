import sys
import argparse
import os
import json
from datetime import datetime

try:
    import requests
    HAS_REQUESTS = True
except ImportError:
    HAS_REQUESTS = False
    import urllib.request

WEBHOOK_URL = "https://script.google.com/macros/s/AKfycbwF59KkBDMZXVzwCNZKmSjh1Oa7aP88_yRT0yhTUj4gxfX697EUmzDmzu5zCIy2gbZNJg/exec"

def send_payload(payload):
    if HAS_REQUESTS:
        try:
            response = requests.post(WEBHOOK_URL, json=payload, timeout=20, allow_redirects=False)
            if response.status_code in [200, 302]:
                return 200, {"status": "success", "message": "Log berhasil dicatat ke Google Sheet SOP I-QS-00-004-03!"}, ""
            try:
                res_data = response.json()
            except Exception:
                res_data = {}
            return response.status_code, res_data, response.text
        except Exception as e:
            return None, {}, str(e)
    else:
        try:
            req = urllib.request.Request(
                WEBHOOK_URL,
                data=json.dumps(payload).encode('utf-8'),
                headers={'Content-Type': 'application/json'}
            )
            with urllib.request.urlopen(req, timeout=15) as resp:
                status_code = resp.getcode()
                raw_text = resp.read().decode('utf-8')
                try:
                    res_data = json.loads(raw_text)
                except Exception:
                    res_data = {}
                return status_code, res_data, raw_text
        except Exception as e:
            return None, {}, str(e)

def main():
    parser = argparse.ArgumentParser(description="Log IT Task ke Google Sheet SOP I-QS-00-004-03")
    
    current_repo = os.path.basename(os.getcwd())

    parser.add_argument("--app", default=current_repo, help="Nama Aplikasi / Sistem")
    parser.add_argument("--tanggal", default=datetime.now().strftime("%d/%m/%Y"), help="Tanggal Permintaan (DD/MM/YYYY)")
    parser.add_argument("--jenis", default="Maintenance / Bugfix", help="Jenis Permintaan")
    parser.add_argument("--user", default="Rizky Fajar", help="Nama User")
    parser.add_argument("--bagian", default="Pengendalian Sistem", help="Bagian / Divisi")
    parser.add_argument("--uraian", required=True, help="Uraian Permintaan / Kendala")
    parser.add_argument("--solusi", default="-", help="Rencana Tindaklanjut / Solusi")
    parser.add_argument("--kategori", default="Minor", help="Kategori Perubahan")
    parser.add_argument("--progres", default="100% Selesai", help="Progres & Hasil")
    parser.add_argument("--selesai", default=None, help="Tanggal Selesai (DD/MM/YYYY)")
    parser.add_argument("--keterangan", default="-", help="Keterangan / File terkait")

    args = parser.parse_args()
    tanggal_selesai = args.selesai if args.selesai else args.tanggal

    payload = {
        "tanggal_permintaan": args.tanggal,
        "nama_aplikasi": args.app,
        "jenis_permintaan": args.jenis,
        "nama_user": args.user,
        "bagian": args.bagian,
        "uraian_permintaan": args.uraian,
        "rencana_tindaklanjut": args.solusi,
        "batas_waktu": "-",
        "kategori_perubahan": args.kategori,
        "progres_hasil": args.progres,
        "tanggal_selesai": tanggal_selesai,
        "keterangan": args.keterangan
    }

    status_code, res_data, raw_text = send_payload(payload)

    if status_code == 200 and res_data.get("status") == "success":
        print(f"[SUCCESS] {res_data.get('message', 'Log berhasil dicatat!')} | Project: {args.app} | Tanggal: {args.tanggal}")
    elif status_code == 200 and res_data.get("status") == "error":
        print(f"[FAILED] Google Sheet Error: {res_data.get('message')} | Payload: {args.uraian}")
    else:
        print(f"[ERROR] HTTP Status: {status_code}, Response: {raw_text}")

if __name__ == "__main__":
    main()
