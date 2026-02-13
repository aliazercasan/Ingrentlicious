#!/bin/bash

# Database Seeding Script for Linux/Mac
# This script will seed your database with 25 international recipes

echo ""
echo "========================================"
echo "   Database Seeding Script"
echo "========================================"
echo ""
echo "This will add 25 recipes to your database:"
echo "- 5 Japanese recipes"
echo "- 5 Korean recipes"
echo "- 5 Filipino recipes"
echo "- 5 Italian recipes"
echo "- 5 Mexican recipes"
echo ""

read -p "Do you want to continue? (Y/N): " confirm
if [[ ! $confirm =~ ^[Yy]$ ]]; then
    echo ""
    echo "Seeding cancelled."
    exit 0
fi

echo ""
echo "🌱 Starting database seeding..."
echo ""

# Fresh migration (optional - uncomment if you want to reset database)
# echo "🔄 Resetting database..."
# php artisan migrate:fresh
# echo ""

echo "📦 Running seeders..."
php artisan db:seed --class=RecipeDataSeeder

if [ $? -eq 0 ]; then
    echo ""
    echo "✅ Database seeded successfully!"
    echo ""
    echo "📊 Summary:"
    echo "   - 25 recipes created"
    echo "   - Multiple ingredients per recipe"
    echo "   - Random view counts assigned"
    echo ""
    echo "🔗 You can now view the recipes at:"
    echo "   http://127.0.0.1:8000/recipes"
    echo ""
else
    echo ""
    echo "❌ Error: Seeding failed!"
    echo "Please check the error messages above."
    echo ""
fi
