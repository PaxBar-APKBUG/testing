#!/bin/bash

# Warna untuk output text
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${BLUE}=========================================${NC}"
echo -e "${BLUE}  PTERODACTYL PREMIUM LOGIN INSTALLER     ${NC}"
echo -e "${BLUE}=========================================${NC}"

# Pastikan dijalankan sebagai root
if [ "$EUID" -ne 0 ]; then
  echo -e "${YELLOW}Harap jalankan script ini sebagai root (sudo bash).${NC}"
  exit 1
fi

# Tentukan lokasi install Pterodactyl
PANEL_PATH="/var/www/pterodactyl"

if [ ! -d "$PANEL_PATH" ]; then
    echo -e "${YELLOW}Folder Pterodactyl tidak ditemukan di $PANEL_PATH!${NC}"
    exit 1
fi

cd $PANEL_PATH

echo -e "${GREEN}[1/3]${NC} Membuat backup login theme bawaan..."
# Backup file lama jika belum pernah di-backup sebelumnya
if [ -f "resources/views/templates/auth/login.blade.php" ] && [ ! -f "resources/views/templates/auth/login.blade.php.bak" ]; then
    cp resources/views/templates/auth/login.blade.php resources/views/templates/auth/login.blade.php.bak
    echo -e "${GREEN}Backup berhasil dibuat: login.blade.php.bak${NC}"
fi

echo -e "${GREEN}[2/3]${NC} Mengunduh tema login premium dari GitHub PaxBar-APKBUG..."
# Menarik langsung file raw dari repo testing kamu
curl -sSL https://raw.githubusercontent.com/PaxBar-APKBUG/testing/main/login.blade.php -o resources/views/templates/auth/login.blade.php

echo -e "${GREEN}[3/3]${NC} Membersihkan cache panel..."
php artisan view:clear
php artisan cache:clear

# Mengatur ulang permission agar tidak error 500
chown -R www-data:www-data $PANEL_PATH/*

echo -e "${BLUE}=========================================${NC}"
echo -e "${GREEN} Selesai! Login theme berhasil diubah. ${NC}"
echo -e "${BLUE} Silakan refresh browser kamu (Ctrl + F5). ${NC}"
echo -e "${BLUE}=========================================${NC}"
