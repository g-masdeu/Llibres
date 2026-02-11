# 🐳 Deployment Guide - Llibres Application

## Prerequisites

### Server Requirements
- Docker Engine 20.10+
- Docker Compose 2.0+
- At least 2GB RAM
- 10GB free disk space

### Install Docker on Server
```bash
# Ubuntu/Debian
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh
sudo usermod -aG docker $USER

# Install Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

---

## 🚀 First Time Deployment

### 1. Transfer Files to Server

**From your local machine:**
```bash
# Create a deployment package
cd c:\xampp\htdocs\Llibres
tar -czf llibres-app.tar.gz --exclude=node_modules --exclude=vendor --exclude=.git .

# Transfer to server
scp llibres-app.tar.gz user@213.199.55.138:/home/user/
```

### 2. Setup on Server

**SSH into the server:**
```bash
ssh user@213.199.55.138

# Create application directory
mkdir -p /var/www/llibres
cd /var/www/llibres

# Extract files
tar -xzf ~/llibres-app.tar.gz -C /var/www/llibres
```

### 3. Configure Environment

```bash
# Copy production environment
cp .env.production .env

# Edit configuration
nano .env
```

**Important settings to change in `.env`:**
```env
DB_PASSWORD=your_secure_password_here
APP_URL=http://llibres.guillem.tesdt:8084
```

### 4. Deploy Manually

**Configure environment:**
```bash
# Copy production environment
cp .env.production .env

# Edit configuration (change DB password!)
nano .env
```

**Build and start containers:**
```bash
# Build Docker images
docker-compose build --no-cache

# Start all containers
docker-compose up -d

# Wait for MySQL to initialize
sleep 15

# Generate application key
docker-compose exec app php artisan key:generate --force

# Run migrations
docker-compose exec app php artisan migrate --force

# Optional: Seed database
docker-compose exec app php artisan db:seed --force

# Optimize application
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache

# Set permissions
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage
```

---

## 🌐 Domain Configuration

### Option 1: /etc/hosts (Local Testing)
```bash
# On server
echo "127.0.0.1 llibres.guillem.tesdt" | sudo tee -a /etc/hosts

# On your local machine (to access server)
echo "213.199.55.138 llibres.guillem.tesdt" | sudo tee -a /etc/hosts
```

### Option 2: DNS Configuration
Add an A record in your DNS provider:
```
Type: A
Name: llibres.guillem.tesdt
Value: 213.199.55.138
```

---

## 📋 Common Commands

### View Application Logs
```bash
docker-compose logs -f
docker-compose logs -f app    # Just app logs
docker-compose logs -f nginx  # Just nginx logs
```

### Stop Application
```bash
docker-compose down
```

### Restart Application
```bash
docker-compose restart
```

### Access Container Shell
```bash
docker-compose exec app bash
```

### Run Artisan Commands
```bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
docker-compose exec app php artisan cache:clear
```

### Database Backup
```bash
docker-compose exec mysql mysqldump -u llibres_user -p llibres_db > backup_$(date +%Y%m%d).sql
```

### Database Restore
```bash
docker-compose exec -T mysql mysql -u llibres_user -p llibres_db < backup.sql
```

---

## 🔄 Updating the Application

```bash
# Stop containers
docker-compose down

# Pull latest changes (if using git)
git pull origin main

# Rebuild images
docker-compose build --no-cache

# Start containers
docker-compose up -d

# Run migrations
docker-compose exec app php artisan migrate --force

# Clear and cache
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
docker-compose exec app php artisan view:cache
```

---

## 🐛 Troubleshooting

### Port 8084 Already in Use
```bash
# Check what's using the port
sudo lsof -i :8084
# or
sudo netstat -tulpn | grep :8084

# Stop the service or change port in docker-compose.yml
```

### Permission Errors
```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/bootstrap/cache
```

### Database Connection Errors
```bash
# Check MySQL is running
docker-compose ps

# Check MySQL logs
docker-compose logs mysql

# Restart MySQL
docker-compose restart mysql
```

### Clear All Caches
```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan route:clear
docker-compose exec app php artisan view:clear
```

### Rebuild Everything
```bash
docker-compose down -v  # WARNING: This deletes database data!
docker-compose build --no-cache
docker-compose up -d
./deploy.sh
```

---

## 🔒 Security Recommendations

1. **Change Database Password**
   - Use a strong password in `.env`
   
2. **Set APP_DEBUG=false**
   - Already set in `.env.production`

3. **Enable HTTPS** (Optional)
   - Install Certbot for Let's Encrypt SSL
   - Configure Nginx for SSL

4. **Firewall Configuration**
   ```bash
   sudo ufw allow 8084/tcp
   sudo ufw enable
   ```

5. **Regular Backups**
   - Set up automated database backups
   - Backup uploaded files in `storage/app`

---

## 📊 Monitoring

### Check Container Status
```bash
docker-compose ps
```

### Resource Usage
```bash
docker stats
```

### Disk Space
```bash
docker system df
```

---

## 🌟 Accessing the Application

After successful deployment:
- **URL**: http://llibres.guillem.tesdt:8084
- **From Local**: http://213.199.55.138:8084

---

## 📞 Support

For issues or questions:
1. Check application logs: `docker-compose logs -f`
2. Check Laravel logs: `docker-compose exec app tail -f storage/logs/laravel.log`
3. Verify all containers are running: `docker-compose ps`
