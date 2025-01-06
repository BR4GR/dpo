# [picoCTF Scan Surprise](https://play.picoctf.org/practice/challenge/444)

## Challenge Description
The flag is hidden in an image file, and we need to extract it using a QR code scanner. This guide walks through the steps to solve the challenge using zbar.

## Steps to Solve

1. **Download and Extract the Challenge Files**
   ```bash
   wget https://artifacts.picoctf.net/c_atlas/15/challenge.zip
   ```


   ```bash
   unzip challenge.zip
   ```
   After extraction, locate the image file containing the QR code.

2. **Install zbar**
   Ensure zbar is installed on your system. If not, install it:
   ```bash
   sudo pacman -S zbar  # Arch Linux
   ```

   ```bash
   sudo apt install zbar-tools  # Debian/Ubuntu
   ```

3. **Scan the QR Code**
   Use zbarimg to scan the QR code and extract its content:
   ```bash
   zbarimg <image-file>
   ```

   Example output:
   ```
   QR-Code:picoCTF{example_flag}
   ```

Category: Forensics