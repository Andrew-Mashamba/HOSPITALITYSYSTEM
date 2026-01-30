# Android POS - API Configuration Guide

## Laravel Backend Configuration

Your Laravel backend is configured with:
- **URL**: `http://localhost:8000`
- **Database**: PostgreSQL (localhost:5432)
- **Environment**: local/development

## Android POS Connection Setup

### Scenario 1: Android Emulator (Recommended for Development)

When running the Android app in an **Android Studio Emulator**, use this configuration:

**Why `10.0.2.2`?**
Android emulators run in their own network. The special IP `10.0.2.2` is an alias to your host machine's `127.0.0.1`.

#### Configuration Steps:

1. **Start Laravel Backend**
   ```bash
   cd /Volumes/DATA/PROJECTS/HOSPITALITYSYSTEM/laravel-app
   php artisan serve --host=0.0.0.0 --port=8000
   ```

   Output should show:
   ```
   INFO  Server running on [http://0.0.0.0:8000].
   ```

2. **Configure Android POS**

   Create/Edit `android-pos/local.properties`:
   ```properties
   sdk.dir=/Users/YOUR_USERNAME/Library/Android/sdk
   api.base.url="http://10.0.2.2:8000/api/"
   api.timeout=30
   sync.interval=300
   ```

3. **Test Connection**
   ```bash
   # From emulator, test if backend is reachable
   adb shell
   curl http://10.0.2.2:8000/api/menu
   ```

---

### Scenario 2: Physical Android Device (Same WiFi Network)

When running on a **real Android device** connected to the same WiFi as your Mac:

#### Configuration Steps:

1. **Find Your Mac's Local IP Address**
   ```bash
   ipconfig getifaddr en0  # For WiFi
   # or
   ipconfig getifaddr en1  # For Ethernet
   ```

   Example output: `192.168.1.105`

2. **Start Laravel Backend (accessible on network)**
   ```bash
   cd /Volumes/DATA/PROJECTS/HOSPITALITYSYSTEM/laravel-app
   php artisan serve --host=0.0.0.0 --port=8000
   ```

3. **Configure Android POS**

   Edit `android-pos/local.properties`:
   ```properties
   api.base.url="http://192.168.1.105:8000/api/"
   api.timeout=30
   sync.interval=300
   ```

   ⚠️ **Replace `192.168.1.105` with YOUR actual IP address!**

4. **Allow Network Access**

   Ensure your Mac firewall allows connections on port 8000:
   ```bash
   # Check if port is listening
   lsof -i :8000

   # If firewall blocks, add exception in:
   # System Preferences → Security & Privacy → Firewall → Firewall Options
   ```

5. **Test from Device**

   On your Android device's browser, navigate to:
   ```
   http://192.168.1.105:8000/api/menu
   ```

   You should see JSON response with menu items.

---

### Scenario 3: Production Deployment

For **production deployment** on a live server:

#### Backend Setup:

1. **Deploy Laravel to Server** (e.g., DigitalOcean, AWS, Heroku)

2. **Update Laravel .env**
   ```env
   APP_URL=https://api.seacliff.com
   APP_ENV=production
   APP_DEBUG=false
   ```

3. **Configure HTTPS** (required for production)
   - Set up SSL certificate (Let's Encrypt)
   - Configure Nginx/Apache
   - Force HTTPS in Laravel

#### Android POS Configuration:

**Option A: Update build.gradle (Recommended)**

Edit `android-pos/app/build.gradle`:
```gradle
buildTypes {
    release {
        buildConfigField "String", "API_BASE_URL", '"https://api.seacliff.com/api/"'
    }
    debug {
        buildConfigField "String", "API_BASE_URL", '"http://10.0.2.2:8000/api/"'
    }
}
```

**Option B: Update local.properties**
```properties
api.base.url="https://api.seacliff.com/api/"
```

---

## Quick Reference

| Environment | API Base URL | Use Case |
|-------------|--------------|----------|
| Emulator (Dev) | `http://10.0.2.2:8000/api/` | Android Studio emulator |
| Physical Device | `http://192.168.X.X:8000/api/` | Real device on same WiFi |
| Production | `https://api.seacliff.com/api/` | Live deployment |

---

## Starting the Backend

### Development Server

```bash
cd /Volumes/DATA/PROJECTS/HOSPITALITYSYSTEM/laravel-app

# Option 1: Default (only localhost)
php artisan serve

# Option 2: Network accessible (for devices)
php artisan serve --host=0.0.0.0 --port=8000

# Option 3: Specific IP and port
php artisan serve --host=192.168.1.105 --port=8000
```

### Production Server

Use a proper web server (Nginx/Apache) with PHP-FPM:

```nginx
# Nginx config example
server {
    listen 80;
    server_name api.seacliff.com;
    root /var/www/laravel-app/public;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
}
```

---

## Testing API Connection

### From Terminal (Mac)

```bash
# Test menu endpoint
curl http://localhost:8000/api/menu

# Test with authentication
curl -X POST http://localhost:8000/api/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"waiter@seacliff.com","password":"password","device_name":"test"}'
```

### From Android Emulator

```bash
adb shell
curl http://10.0.2.2:8000/api/menu
```

### From Android App (Logcat)

```bash
# Watch network logs
adb logcat | grep "OkHttp\|Retrofit\|API"

# Check for connection errors
adb logcat *:E
```

---

## Troubleshooting

### Issue: "Unable to resolve host"

**Cause**: Backend not running or wrong IP address

**Solution**:
1. Verify Laravel is running: `php artisan serve --host=0.0.0.0`
2. Check correct IP in `local.properties`
3. Test with curl from terminal first

### Issue: "Connection refused"

**Cause**: Firewall blocking port 8000

**Solution**:
```bash
# Check if port is listening
lsof -i :8000

# Temporarily disable firewall (macOS)
sudo /usr/libexec/ApplicationFirewall/socketfilterfw --setglobalstate off

# Re-enable after testing
sudo /usr/libexec/ApplicationFirewall/socketfilterfw --setglobalstate on
```

### Issue: "Cleartext HTTP traffic not permitted"

**Cause**: Android 9+ blocks HTTP by default

**Solution**: Already configured in `network_security_config.xml`:
```xml
<network-security-config>
    <base-config cleartextTrafficPermitted="true">
        <trust-anchors>
            <certificates src="system" />
        </trust-anchors>
    </base-config>
</network-security-config>
```

### Issue: "401 Unauthorized"

**Cause**: Invalid credentials or expired token

**Solution**:
1. Use correct credentials from Laravel seeders
2. Check token in SharedPreferences
3. Clear app data: `adb shell pm clear com.seacliff.pos`

### Issue: "500 Internal Server Error"

**Cause**: Laravel backend error

**Solution**:
```bash
# Check Laravel logs
tail -f laravel-app/storage/logs/laravel.log

# Enable debug mode temporarily
# In .env: APP_DEBUG=true
```

---

## Current Configuration

Based on your setup:

```properties
# For Android Emulator Development
api.base.url="http://10.0.2.2:8000/api/"
api.timeout=30
sync.interval=300
```

**Start Backend**:
```bash
cd /Volumes/DATA/PROJECTS/HOSPITALITYSYSTEM/laravel-app
php artisan serve --host=0.0.0.0 --port=8000
```

**Test from Browser**:
- http://localhost:8000/api/menu
- http://localhost:8000/api/tables

**Login Credentials** (from seeders):
- Waiter: `waiter@seacliff.com` / `password`
- Manager: `manager@seacliff.com` / `password`
- Admin: `admin@seacliff.com` / `password`

---

## Network Security Config

The Android app includes cleartext traffic support for development:

**File**: `android-pos/app/src/main/res/xml/network_security_config.xml`

```xml
<?xml version="1.0" encoding="utf-8"?>
<network-security-config>
    <!-- Allow cleartext traffic for development -->
    <base-config cleartextTrafficPermitted="true">
        <trust-anchors>
            <certificates src="system" />
        </trust-anchors>
    </base-config>

    <!-- For production, restrict to HTTPS only -->
    <domain-config cleartextTrafficPermitted="false">
        <domain includeSubdomains="true">api.seacliff.com</domain>
    </domain-config>
</network-security-config>
```

**For Production**: Set `cleartextTrafficPermitted="false"` and use HTTPS only.

---

## Summary

✅ **For Development (Emulator)**: Use `http://10.0.2.2:8000/api/`
✅ **For Physical Device**: Use `http://YOUR_MAC_IP:8000/api/`
✅ **For Production**: Use `https://api.seacliff.com/api/`

**Next Step**: Start your Laravel backend with `php artisan serve --host=0.0.0.0` and run the Android app!
