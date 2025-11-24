#!/bin/bash

echo "🚀 Starting Buy My Classmate Inc Setup..."

# Build and start containers
echo "📦 Building Docker containers..."
docker-compose up -d --build

# Wait for containers to be ready
echo "⏳ Waiting for containers to start..."
sleep 5

# Run migrations and seed
echo "🗄️  Running database migrations..."
docker-compose exec app php artisan migrate:fresh --seed --force

# Create storage link
echo "🔗 Creating storage symlink..."
docker-compose exec app php artisan storage:link

# Set permissions
echo "🔐 Setting permissions..."
docker-compose exec app chmod -R 775 storage bootstrap/cache database

echo "✅ Setup complete!"
echo ""
echo "🌐 Application is running at: http://localhost:8000"
echo "👤 Admin Login: admin / admin"
echo ""
echo "📝 Useful commands:"
echo "  - Stop containers: docker-compose down"
echo "  - View logs: docker-compose logs -f"
echo "  - Restart: docker-compose restart"
