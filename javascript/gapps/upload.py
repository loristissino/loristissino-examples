#!/usr/bin/env python3

# This script can be used to test file uploading on Google Drive

import requests
import base64
import mimetypes
import os
import sys

# --- CONFIGURATION ---
# Replace with your actual Web App URL
SCRIPT_URL = "https://script.google.com/macros/s/SCRIPT_ID_AFTER_DEPLOYMENT/exec"
# ---------------------

def upload_file(file_path):
    if not os.path.exists(file_path):
        print(f"Error: File '{file_path}' not found.")
        return

    filename = os.path.basename(file_path)

    # 1. Determine MIME type automatically (e.g., 'image/png' or 'application/pdf')
    mime_type, _ = mimetypes.guess_type(file_path)
    if mime_type is None:
        mime_type = 'application/octet-stream'  # Safe fallback

    print(f"Preparing to upload: {filename}")
    print(f"Detected Type: {mime_type}")

    # 2. Read and Base64 encode the file
    # We encode to Base64 to ensure binary data survives the HTTP transfer to GAS
    try:
        with open(file_path, "rb") as f:
            raw_data = f.read()
            # .decode('utf-8') turns the bytes object into a standard string
            b64_data = base64.b64encode(raw_data).decode('utf-8')
    except Exception as e:
        print(f"Error reading file: {e}")
        return

    # 3. Construct URL parameters
    # We pass the metadata in the URL so GAS knows how to interpret the Base64 string
    params = {
        'filename': filename,
        'filetype': mime_type
    }

    # 4. Send Request
    # We send the Base64 string as raw text body
    headers = {'Content-Type': 'text/plain'}

    print("Sending request...")
    try:
        response = requests.post(
            SCRIPT_URL,
            params=params,
            data=b64_data,
            headers=headers
        )
        
        # 5. Handle Response
        if response.status_code == 200:
            print("\n✅ Upload Successful!")
            print("Server Response:", response.text)
        else:
            print(f"\n❌ Failed. Status Code: {response.status_code}")
            print("Response:", response.text)

    except requests.exceptions.RequestException as e:
        print(f"\n❌ Network Error: {e}")

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("Usage: python upload.py <path_to_file>")
    else:
        upload_file(sys.argv[1])
